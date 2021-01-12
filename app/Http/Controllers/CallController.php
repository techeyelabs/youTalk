<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Service;
use App\Models\Talkroom;
use App\Models\TalkroomChat;
use App\Models\User;
use Pusher\Pusher;
use App\Mail\Common;
use App\Models\Reservation;
use App\Models\Slot;
use App\Models\FreeServiceManager;
use App\Models\Profile;
use App\Models\Wallet;

use App\Library\TimeLibrary;


use Illuminate\Support\Facades\Mail;

use Auth;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use App\Cron\CronClass;

class CallController extends Controller
{
    public function paymentMethod($service_id)
    {
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();

        $service = Service::where('id', $service_id)->first();
        $user = Auth::user()->id;
        //Free minute management
        $existing_free = FreeServiceManager::where('service_id', $service_id)->where('buyer_id', $user)->first();
        $free_to_get = 0;
        if($existing_free != '' && $existing_free != null){
            if($existing_free->given_times > $existing_free->used_times)
                $free_to_get = $existing_free->given_mins;
        } else {
            $free_to_get = $service->free_min;
        }

        //Buyre balance check
        $user_all = User::find($user);
        $balance = $user_all->wallet_balance;

        //Available mins
        $available_mins = floor($balance/$service->price) + $free_to_get;

        if($balance == 0)
            $available_mins = 0;

        return view('call.payment-method')->with([
            'service' => $service,
            'available_mins' => $available_mins,
            'balance' => $balance,
            'free_mint' => $free_to_get,
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev
        ]);
    }

    public function paymentOption(Request $request)
    {
        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();

        $service_id = $request->service_id; //grab service id 
        $service = Service::where('id', $service_id)->first(); //fetch relevant service
        $id = Auth::user()->id; //grab logged in user id AKA buyer id
        $seller_id = $service->seller_id;

        //Get free minute count if any
        $free_min_to_get = 0;
        $free_min = $service->free_min;
        $free_mint_iteration = $service->free_mint_iteration;
        $is_exists = FreeServiceManager::where('service_id', $service_id)->where('buyer_id', $id)->first();
        if($is_exists != '' && $is_exists != null){
            if($is_exists->given_times > $is_exists->used_times){
                $free_min_to_get = $is_exists->given_mins ;
            } 
        } else {
            if($service->free_min > 0 && $service->free_mint_iteration > 0){
                $free_manager = new FreeServiceManager();
                $free_manager->service_id = $service_id;
                $free_manager->buyer_id = $id;
                $free_manager->given_mins = $service->free_min;
                $free_manager->given_times = $service->free_mint_iteration;
                $free_manager->used_times = 0;
                $free_manager->save();
            }
            $free_min_to_get = $service->free_min;
        }

        //Now I am going to create new and live talkroom
        $talkroom_live = new Talkroom();
        $talkroom_live->service_id  = $service_id;
        $talkroom_live->seller_id  = $service->seller_id;
        $talkroom_live->buyer_id  = $id;
        $talkroom_live->status  = 2;
        $talkroom_live->duration  = 0;
        $talkroom_live->cost  = 0;
        $talkroom_live->free_mint  = $free_min_to_get;
        $talkroom_live->available_mins  = $request->available_mins;
        $talkroom_live->payment_method  = ($request->paymentOptions == 'point'?1:2);
        $talkroom_live->call_start_time  = date("Y-m-d H:i:s");
        $talkroom_live->last_call_end  = date("Y-m-d H:i:s");
        $talkroom_live->talkroom_open_time  = null;
        $talkroom_live->talkroom_close_time  = null;
        $talkroom_live->save();

        //Push automated message into talkroom
        $talkroom_chat = new TalkroomChat();
        $talkroom_chat->talkroom_id = $talkroom_live->id;
        $talkroom_chat->sender_id = 0;
        $talkroom_chat->receiver_id = 0;
        $talkroom_chat->message = 'トークルームを開始しました！';
        $talkroom_chat->save();

        $live_talkroom = Talkroom::where('buyer_id', $id)->where('status', 2)->first();
        //return $live_talkroom;

        //Mail notification to seller
        $seller_all = User::find($service->seller_id);
        $buyer_all = User::find(Auth::user()->id);
        $emailData = [
            'seller_name' => $seller_all->name.' '.$seller_all->last_name,
            'buyer_name' => $buyer_all->name.' '.$buyer_all->last_name,
            'subject' => '【YouTalk】トークルーム開始のお知らせ！',
            'from_email' => 'support@youtalk.tel',
            'from_name' => 'YouTalk',
            'template' => 'emailtemplates.layouts.talkroom_notification',
            'root'     => $request->root(),
            'email'     => $seller_all->email
        ];

        Mail::to($service->createdBy->email)
            ->send(new Common($emailData));

        //Mail notification ends

        $res_dateTime = [];

        $user_as_reserver = Reservation::where('reserver_id', $id)->where('status', 2)->get();
        foreach($user_as_reserver as $data){
            $slot = Slot::where('id', $data->slot)->first();
            $temp_dateTime = $slot->day." ".$time_slot[$slot->slot];
            array_push($res_dateTime, $temp_dateTime); 
        }

        $seller_as_reserver = Reservation::where('reserver_id', $seller_id)->where('status', 2)->get();
        foreach($seller_as_reserver as $data){
            $slot = Slot::where('id', $data->slot)->first();
            $temp_dateTime = $slot->day." ".$time_slot[$slot->slot];
            array_push($res_dateTime, $temp_dateTime); 
        }

        $user_as_seller = Reservation::where('seller_id', $id)->where('status', 2)->get();
        foreach($user_as_seller as $data){
            $slot = Slot::where('id', $data->slot)->first();
            $temp_dateTime = $slot->day." ".$time_slot[$slot->slot];
            array_push($res_dateTime, $temp_dateTime); 
        }

        $seller_as_seller = Reservation::where('seller_id', $seller_id)->where('status', 2)->get();
        foreach($seller_as_seller as $data){
            $slot = Slot::where('id', $data->slot)->first();
            $temp_dateTime = $slot->day." ".$time_slot[$slot->slot];
            array_push($res_dateTime, $temp_dateTime); 
        }

        $len = sizeof($res_dateTime);
        for($i = 0 ; $i < $len; ++$i){
            for($j = 0; $j < $len - $i - 1 ; ++$j){
                $val1 = $res_dateTime[$j];
                $val2 = $res_dateTime[$j+1];

                $datetime1 = new DateTime($val1);
                $datetime2 = new DateTime($val2);

                if($datetime1 > $datetime2){
                    $temp = $res_dateTime[$j];
                    $res_dateTime[$j] = $res_dateTime[$j+1];
                    $res_dateTime[$j+1] = $temp;
                }
            }
        }
        
        //return $res_dateTime[0];
        $final_time = null;
        if(sizeof($res_dateTime) > 0){
            $latest_reservation = $res_dateTime[0];
            $final_time = date("Y-m-d H:i", strtotime("-10 minutes", strtotime($latest_reservation)));
        }
        $troom = Talkroom::where('buyer_id', $id)->where('status', 2)->first();
        $troom->deadline = $final_time;
        $troom->save();
        //return $final_time;

        // return view('call.talkroom')->with([
        //     'service' => $service,
        //     'talkroom' => $live_talkroom,
        //     'final_time' => $final_time
        // ]);

        return redirect()->route('my-talk-room');
    }

    public function openTalkRoom()
    {
        // $closing = new CronClass();
        // $closing->runningTalkroomClose();
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();

        $live_talkroom_seller = Talkroom::where('seller_id', $id)->where('status', 2)->get()->first();
        $live_talkroom_buyer = Talkroom::where('buyer_id', $id)->where('status', 2)->get()->first();

        if(!$live_talkroom_seller && !$live_talkroom_buyer){
            return view('call.no-talkroom', [
                'personal' => $personal,
                'wallet' => $wallet,
                'profile' => $prev
            ]);
        }elseif($live_talkroom_seller){
            return view('call.talkroom', [
                'talkroom' => $live_talkroom_seller,
                'personal' => $personal,
                'wallet' => $wallet,
                'profile' => $prev
            ]);
        }else{
            return view('call.talkroom', [
                'talkroom' => $live_talkroom_buyer,
                'personal' => $personal,
                'wallet' => $wallet,
                'profile' => $prev
            ]);
        }
    }

    public function sellerMessage(Request $request)
    {
        return $request;
    }

    public function closeTalkroom($id)
    {
        $userid = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $userid)->first();
        $prev = Profile::where('user_id', $userid)->first();
        $wallet = Wallet::where('user_id', $userid)->get();
        //$service = Service::where('id', $service_id)->first();
        //return $id;
        $talkroom = Talkroom::where('id', $id)->first();
        //return $talkroom;
        return view('call.talkroom-close')->with([
            'talkroom' => $talkroom,
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev
        ]);
    }

    public function getMessage(Request $request)
    {
        $messages = TalkroomChat::where('talkroom_id', $request->talkroom)->get();
        $count_mes = $messages->count();
        //dd($messages);
        return view('call.message-part', ['messages'=>$messages, 'count_mes' => $count_mes]);
    }

    public function buyerMessage(Request $request)
    {
        $data = new TalkroomChat();
        $data->talkroom_id = $request->talkroom;
        $data->sender_id = $request->sender;
        $data->receiver_id = $request->receiver;
        $data->message = $request->message;
        $data->save();

        return;

        //pusher
        // $options = array(
        //     'cluster' => 'ap2',
        //     'useTLS' => true
        // );

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );
        
        // $data = ['sender' => $request->sender, 'receiver' => $request->receiver]; // sending from and to user id when pressed enter
        // $pusher->trigger('my-channel', 'my-event', $data);

        //$text= $request->message;

        
        //event(new MessageEvent('Hello world'));

    }

    public function postReview(Request $request)
    {
        //return $request;
        $talkroom = Talkroom::where('id', $request->talkroom_id)->first();
        //return $talkroom;
        $review = new Review();
        $review->talkroom_id = $request->talkroom_id;
        $review->service_id = $talkroom->service_id;
        $review->seller_id = $talkroom->seller_id;
        $review->buyer_id = $talkroom->buyer_id;
        $review->rating = $request->rate;
        $review->review = $request->review;
        $review->reply = isset($request->reply)?$request->reply:'';
        $review->save();

        $talkroom->review_status = 2;
        $talkroom->save();

        return Redirect::route('user-display-service', ['id' => $talkroom->service_id])->with('success_message', '評価ありがとうございました！');
        
    }

    public function postReply(Request $request)
    {
        //return $request;
        $review = Review::where('id', $request->review_id)->first();
        $review->reply = $request->reply;
        $review->save();

        return Redirect::route('user-display-service', ['id' => $review->service_id])->with('success_message', '返事あるがとうございました！');;
    }

    public function closeTalkSeller($id)
    {
        $talkroom = Talkroom::where('id', $id)->first();
        $talkroom->status = 1;
        $talkroom->save();

        //point deduction
        if($talkroom->payment_method == 1){
            $buyer = User::find($talkroom->buyer_id);
            $buyer->wallet_balance = $buyer->wallet_balance - $talkroom->cost;
            $buyer->save();
        }
        //Seller earning balance add
        $seller = User::find($talkroom->seller_id);
        $seller->earning_balance = $seller->earning_balance + $talkroom->cost;
        $seller->save();

        //Push automated message into talkroom
        $talkroom_chat = new TalkroomChat();
        $talkroom_chat->talkroom_id = $talkroom->id;
        $talkroom_chat->sender_id = 0;
        $talkroom_chat->receiver_id = 0;
        $talkroom_chat->message = 'トークルームを終了しました！';
        $talkroom_chat->save();

        if($talkroom->free_mint > 0){
            $existing = FreeServiceManager::where('service_id', $talkroom->service_id)->where('buyer_id', $talkroom->buyer_id)->first();
            $existing->used_times = $existing->used_times + 1;
            $existing->save();
        }

        //Send mail to buyer
        $emailData = [
            'seller_name' => $talkroom->seller->name,
            'buyer_name' => $talkroom->buyer->name,
            'subject' => '【YouTalk】トークルーム終了のお知らせ！',
            'service_title' => $talkroom->service->title,
            'date' => $talkroom->created_at->format("Y:m:d"),
            'duration' => $talkroom->duration,
            'amount' => $talkroom->cost,
            'from_email' => 'support@youtalk.tel',
            'from_name' => 'YouTalk',
            'template' => 'emailtemplates.layouts.talkroom-close-notification',
            // 'root'     => $request->root(),
            'email'     => $talkroom->buyer->email
        ];

        Mail::to($talkroom->buyer->email)
            ->send(new Common($emailData));

        return Redirect::route('talk-room-close', ['id'=> $id]);
    }


}
