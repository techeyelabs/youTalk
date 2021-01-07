<?php

namespace App\Http\Controllers;

use App\Mail\Common;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\User;
use App\Models\Profile;
use App\Models\Chat;
use App\Models\ChatThread;
use App\Models\Follow;
use App\Models\ServiceHistory;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Slot;
use App\Models\Talkroom;
use App\Models\Wallet;
use App\Models\WithdrawRequest;
use App\Models\DepositAmounts;
use App\Models\PendingBankDeposit;
use App\Models\GatewayResponse;
use Illuminate\Support\Facades\Redirect;

use App\Library\TimeLibrary;

use Auth;
use Image;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class MyPageController extends Controller
{
    public function __construct()
    {
        
    }

    public function service()
    {
        $id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $myServices = Service::where('seller_id', $id)->orderBy('id', 'desc')->get();
        $data = [
            'personal' => $personal,
            'myServices' => $myServices,
            'profile' => $prev,
        ];
        return view('personal.mypage', $data);
    }

    public function callhistoryNotification()
    {
        $user = Auth::user()->id;
        $totalReservation = Reservation::where('reserver_id', $user)->where('status', 2)->count();

        return $totalReservation;
    }

    public function talkroomNotification()
    {
        $user = Auth::user()->id;

        $active_talkroom_seller = Talkroom::where('seller_id', $user)->where('status', 2)->get()->count();
        $active_talkroom_buyer = Talkroom::Where('buyer_id', $user)->where('status', 2)->get()->count();

        if($active_talkroom_seller > 0 || $active_talkroom_buyer > 0){
            return 1;
        }else{
            return 0;
        }

    }

    public function messageNotification()
    {
        $user = Auth::user()->id;

        $new_chat = Chat::where('receiver_id', $user)->where('receive_status', 1)->get()->count();

        return $new_chat;
    }

    public function serviceNotification()
    {
        $user_id = Auth::user()->id;
        $myServices = Service::where('seller_id', $user_id)->get();
        $countPending = 0;
        $countConfirmed = 0;
        foreach($myServices as $data){
            foreach($data->reservation as $res){
                if($res->status == 1){
                    $countPending++;
                }else if($res->status == 2){
                    $countConfirmed++; 
                }
            }
        }
        $data = [
            'countPending' => $countPending,
            'countConfirmed' => $countConfirmed
        ];

        return response()->json($data); 
    }

    public function serviceHistory($service_id)
    {
        $id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->orderBy('id', 'desc')->get();
        //return $service_id;
        $id = Auth::user()->id;
        $history = Talkroom::where('seller_id', $id)->where('status', 1)->where('service_id', $service_id)->with('buyer')->get();
        return view('personal.service-history', [
            'history' => $history,
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
        ]);
    }

    public function wallet()
    {
        $id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->orderBy('id', 'desc')->get();
        $dep_amounts = DepositAmounts::all();
        $data = [
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
            'dep_amounts' => $dep_amounts
            // 'next' => $next_reservation
        ];
        return view('personal.mywallet', $data);
    }

    public function addwallet()
    {
        // gateway data preparation
        $id = Auth::user()->id;
        $amount = Wallet::where('user_id', $id)->first()->amount;
        $fromUser = User::select('email', 'name')->where('id', $id)->first();
        $email = $fromUser->email;
        $name = $fromUser->name;
        $TransactionId = 'YT-'.time().'-'.mt_rand(1000, 9999).'-BL';

        // Regular 
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->orderBy('id', 'desc')->get();
        $dep_amounts = DepositAmounts::all();
        $data = [
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
            'dep_amounts' => $dep_amounts,

            // gateway data
            'SiteId' => "14202001",
            'SitePass' => "AnuREB1Z",
            'Amount' => $amount,
            'mail' => $email,
            'CustomerId' =>  $id,
            'name' => $name,
            'TransactionId' => $TransactionId,
            'language'=> "ja"
        ];
        return view('personal.add-wallet', $data);
    }

    public function addwalletcreditCallback(Request $request)
    {
        $SiteIdCheck = "14202001";
        $SitePassCheck = "AnuREB1Z";
        if($SiteIdCheck == $request->SiteId && $SitePassCheck == $request->SitePass){
            $depositor = $request->CustomerId;
            $Amount = $request->Amount;
           
            
            // $Result = $request->Result;
    
            $user = User::where('id', $depositor)->first();
            $user->wallet_balance = $user->wallet_balance + $request->Amount;
            $user->save();
    
            $wallet = new Wallet();
            $wallet->user_id = $depositor;
            $wallet->service_id = 0;
            $wallet->expense_type = 2;
            $wallet->amount = $request->Amount;
            $wallet->save();

             // Save All Callback Data 
            $gatewayresponse = new GatewayResponse();
            $gatewayresponse->SiteId = $request->SiteId;
            $gatewayresponse->SitePass = $request->SitePass;
            $gatewayresponse->Amount = $request->Amount;
            $gatewayresponse->CustomerId = $request->CustomerId;
            $gatewayresponse->name = $request->name;
            $gatewayresponse->mail = $request->mail;
            $gatewayresponse->TransactionId = $request->TransactionId;
            $gatewayresponse->language = $request->language;
            $gatewayresponse->other = $request->other;
            $gatewayresponse->Result = $request->Result;
            $gatewayresponse->save();

            // return response()->json([
            //     "status" => 200
            //   ]);
        } else{
            return response()->json([
                "status" => 404
              ]);
        }
        
        
        return redirect()->route('my-wallet');
    }
    
   
    public function addwalletaction(Request $request)
    {
        $method = $request->method + 1;
        if($method == 3){
            $newpen = new PendingBankDeposit();
            $newpen->user_id = Auth::user()->id;
            $newpen->amount = $request->amount;
            $newpen->status = 1;
            $newpen->save();

            $user = User::find(Auth::user()->id);
        }
        else if($method == 2){
            $depositor = Auth::user()->id;
            $Amount = $request->amount;

            $user = User::where('id', $depositor)->first();
            $user->wallet_balance = $user->wallet_balance + $Amount;
            $user->save();

            $wallet = new Wallet();
            $wallet->user_id = $depositor;
            $wallet->service_id = 0;
            $wallet->expense_type = 2;
            $wallet->amount = $Amount;
            $wallet->save();
        }
        return redirect()->route('my-wallet');
    }

    public function myEarning()
    {
        $id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->orderBy('id', 'desc')->get();

        $user = Auth::user()->id;
        $balance = User::select('earning_balance')->where('id', $user)->first();
        $lifetime_earning = Talkroom::where('seller_id', $user)->sum('cost');
        $last_month_earning = Talkroom::where('seller_id', $user)->whereMonth('created_at', Carbon::now()->month)->sum('cost');
        $requests = WithdrawRequest::where('user_id', $user)->get();
        $data = [
            'balance' => ($balance->earning_balance > 0)?$balance->earning_balance:0,
            'lifetime_earning' => $lifetime_earning,
            'last_month_earning' => $last_month_earning,
            'requests' => $requests,
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev
        ];
        return view('personal.earnings', $data);
    }

    public function withReq(Request $request)
    {
        $new_req = new WithdrawRequest();
        $new_req->user_id = Auth::user()->id;
        $new_req->amount = $request->amount;
        $new_req->status = 1;
        $new_req->save();

        $user = User::find(Auth::user()->id);
        $user->earning_balance = $user->earning_balance - $request->amount;
        $user->save();

        $data = [
            'status' => 200
        ];
        return response()->json($data);
    }

    public function reservation_notification()
    {
        $id = Auth::user()->id;
        $next_reservation = Reservation::select('reservations.*', 's.*', 'sl.*')
                                        ->where('reservations.status', 2)
                                        ->where('s.seller_id', '=', $id)
                                        ->where('sl.day', '>=', date('Y-m-d'))
                                        ->leftjoin('services as s', 's.id', '=', 'reservations.service_id')
                                        ->leftjoin('slots as sl', 'sl.id', '=', 'reservations.slot')
                                        ->orderBy('sl.day', 'asc')
                                        ->orderBy('sl.slot', 'asc')
                                        ->count();
        return $next_reservation;
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $profile_info = Profile::where('user_id', $id)->first();
        $data = [
            'personal' => $personal,
            'profile_info' => $profile_info,
            'profile' => $profile_info
        ];
        return view('personal.mypage-profile', $data);
    }

    public function userProfile($user_id)
    {
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $user_id)->first();
        $profile_info = Profile::where('user_id', $user_id)->first();
        $follow_count =  Follow::where('seller_id', $user_id)->where('status', 2)->count();
        $id = Auth::user()->id;
        $profile = Profile::where('user_id', $id)->first();
        $follow =  Follow::where('seller_id', $user_id)->where('follower_id', $id)->first();
        $completed_services = Talkroom::where('seller_id', $user_id)->where('status', 1)->get()->count();

        //return $follow_count;

        $services = Service::where('seller_id', $user_id)->get();
        $reviews = Review::where('seller_id', $user_id)->get();
        $avg_rating = Review::where('seller_id', $user_id)->avg('rating');
        $avg_rating = number_format($avg_rating,1);
        $total_ratings = $reviews->count();

        $data = [
            'personal' => $personal,
            'profile_info' => $profile_info,
            'profile' => $profile,
            'follow_count' => $follow_count,
            'follow' => $follow,
            'services' => $services,
            'reviews' => $reviews,
            'avg_rating' => $avg_rating,
            'total_ratings' => $total_ratings,
            'completed_services' => $completed_services
        ];
        return view('userpage-profile', $data);
    }

    public function userFollow($seller_id)
    {
        $id = Auth::user()->id;
        
        $seller = Follow::where('seller_id', $seller_id)->where('follower_id', $id)->first();
        if(!$seller){
            $new = new Follow;
            $new->seller_id = $seller_id;
            $new->follower_id = $id;
            $new->status = 2;
            $new->save();
        }
        elseif($seller->status == 1){
            $seller->status = 2;
            $seller->save();
        }
        elseif($seller->status == 2){
            $seller->status = 1;
            $seller->save();
        }

        return Redirect::route('user-page-profile', ['id' => $seller_id]);
    }

    public function profileEdit()
    {
        $id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();

        $data = [
            'profile' => $prev,
            'personal' => $personal
        ];
        return view('personal.edit-profile', $data);
    }

    public function profileEditAction(Request $request)
    {
        if(Auth::user()->id){
            if ($request->hasFile('dp')) {
                $extension = $request->dp->extension();
                $name = time().rand(1000,9999).'.'.$extension;
                $img = Image::make($request->dp);
                $img->save(public_path().'/assets/user/'.$name);
                $img->save(public_path().'/assets/user/'.$name);
            }
            if(isset($name)){
                $profiledata = [
                    'picture' => $name
                ];
                $updateOrder = Profile::where('user_id', Auth::user()->id)->update($profiledata);
            }

            $profiledata = [
                'user_id' => Auth::user()->id,
                'first_name' => isset($request->fname)?$request->fname:'',
                'last_name' => isset($request->lname)?$request->lname:'',
                'gender' => isset($request->gender)?$request->gender:null,
                'dob' => isset($request->dob)?$request->dob: null,
                'phone' => isset($request->phone)?$request->phone:'',
                'address' => isset($request->address)?$request->address:'',
                'bio' => isset($request->bio)?$request->bio:'',
                'bank_name' => isset($request->bank_name)?$request->bank_name:'',
                'acc_number' => isset($request->acc_number)?$request->acc_number:'',
                'branch_name' => isset($request->branch_name)?$request->branch_name:'',
                'acc_type' => isset($request->acc_type)?$request->acc_type:'',
                'acc_name' => isset($request->acc_name)?$request->acc_name:'',
                'facebook' =>isset($request->facebook)?$request->facebook:'',
                'twitter' =>isset($request->twitter)?$request->twitter:'',
                'instagram' =>isset($request->instagram)?$request->instagram:'',
                'youtube' =>isset($request->youtube)?$request->youtube:'',
                'ameblo' =>isset($request->ameblo)?$request->ameblo:'',
                'note' =>isset($request->note)?$request->note:''
            ];
            $updateOrder = Profile::where('user_id', Auth::user()->id)->update($profiledata);
        } else {
            return redirect()->to(route('user-login'));
        }
        return redirect()->to(route('my-page-profile'));
    }
    public function getMessage(Request $request)
    {
        DB::enableQueryLog();
        
        $from = $request->from;
        $to = $request->to;
        $data = [
            'from' => $from,
            'to' => $to,
        ];
        $conv_left = Chat::select('*')->skip(10)->take(10)->get();
        $conv = DB::table('chats')
                    ->select('*')
                    ->where(function ($query) use($from, $to) {
                        $query->where('sender_id', $from)
                                ->where('receiver_id', $to);
                        })
                    ->orWhere(function ($query) use($from, $to){
                        $query->where('receiver_id', $from)
                                ->where('sender_id', $to);
                        })
                    ->get();
        $query = DB::getQueryLog();
        $html_text = '<table style="width: 100%;><tbody>';
        foreach($conv as $con){
            if($con->sender_id == $from)
                {$html_text .= '<tr><td align="left" style="border: none !important"><p style="width: 60%; border-radius: 10px; border: 1px solid #d2d2d2;
                padding: 10px; text-align: left; font-size: 13px; background-color: #e8e8e8">'.nl2br($con->message).'</p></td></tr>';}
            else if($con->sender_id != $from)
                {$html_text .= '<tr><td align="right" style="border: none !important"><p style="width: 60%; border-radius: 10px; border: 1px solid #d2d2d2; 
                padding: 10px; text-align: left; font-size: 13px; background-color: #a8c2ce">'.nl2br($con->message).'</p></td></tr>';}
        }
        $html_text .= '</table></tbody>';
        return $html_text;
    }

    public function sendMessage(Request $request)
    {
        $sender_id = Auth::user()->id;
        $Message = new Chat();
        if($request->receiver >=0 ) 
            $Message->receiver_id = $request->receiver;
        else
            $Message->receiver_id = $request->to_id;
        $Message->sender_id = $sender_id ;
        // $Message->subject = $request->subject;
        if($request->message_text)
            $Message->message = $request->message_text;
        else
            $Message->message = $request->message;
        $Message->save();

        if($request->receiver == 0){
            $top_message = ChatThread::where('receiver_id', 0)->where('sender_id', $sender_id)
                                        ->orWhere(function($query) {
                                            $sender_id = Auth::user()->id;
                                            $query->where('receiver_id', $sender_id)
                                                  ->where('sender_id', 0);
                                        })->first();
            if(!$top_message){
                $chat_thread = new ChatThread();
                $chat_thread->sender_id = $sender_id;
                $chat_thread->receiver_id = 0;
                $chat_thread->recent_message = $request->message_text;
                $chat_thread->save();
            }else{
                $top_message->sender_id = $sender_id;
                $top_message->receiver_id = 0;
                $top_message->recent_message = $request->message_text;
                $top_message->save();
            }

            $user = User::where('id', $sender_id)->first();
            $user->is_admin_checked = 1;
            $user->save();
        }

        return redirect()->back()->with('success', 'Message sent successfully');
    }

    public function mycallHistory()
    {
        $id = Auth::user()->id;
        $totalReservation = Reservation::where('reserver_id', $id)->where('status', 2)->count();
        $personal = User::select('id','email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $my_his = Talkroom::where('buyer_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
        
        $data = [
            'history' => $my_his,
            'personal' => $personal,
            'profile' => $prev,
            'totalReservation' => $totalReservation
        ];
        return view('personal.mycallhistory', $data);
    }

    public function myReservations(Request $request)
    {

        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();

        $reserved_slots = Reservation::where('reserver_id', $request->reservation_id)
                                        ->where('status', 2)->get();

        $html_text = '
        <h5 class="text-center mb-4">電話通話予約通知</h5>';
        foreach($reserved_slots as $data){
            $slot = Slot::where('id', $data->slot)->first();
            $html_text .= '
            <div class="col-md-12 px-0 align-items-center">
                <div><h6 class="mb-0">'.$data->whichService->title.'</h6></div>
                <div class="col-md-12 row pl-0">
                    <div class="col-md-6 pl-0">
                       

                            <h6 class="mr-4">'.$slot->day.' '.$time_slot[$slot->slot].'</h6>';
                           
                            $html_text .='

                        
                    </div>
                    <div class="col-md-6 text-right">
                        <button onclick="cancelReservation('.$data->id.')" class="btn btn-sm btn-outline-secondary text-secondary">Cancel</a>
                    </div>
                </div>
            </div>
            <hr style="height:2px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40);margin-top:5px" />
            ';

        }

        return $html_text;
    }

    public function cancelMyReservation(Request $request)
    {
        $res_id = $request->reservation_id;
        $reservations = Reservation::where('id', $res_id)->first();
        $slots = Slot::where('reservation_id', $res_id)->get();
        foreach ($reservations->slots as $sl){
            if ($sl->id == $reservations->slot){
                $year = date('Y', strtotime($sl->day));
                $month = date('m', strtotime($sl->day));
                $day = date('d', strtotime($sl->day));
                $date_time = $year.'年'.$month.'月'.$day.'日'.$sl->slot.'時';
            }
        }
        //Send mail to buyer
        $emailData = [
            'date_time' => $date_time,
            'seller_name' => $reservations->seller->name,
            'buyer_name' => $reservations->reserver->name,
            'subject' => '【YouTalk】電話予約キャンセルのお知らせ！',
            'from_email' => 'support@youtalk.tel',
            'from_name' => 'YouTalk',
            'template' => 'emailtemplates.layouts.reservation-req-cancel-accepted',
            // 'root'     => $request->root(),
            'email'     => $reservations->seller->email
        ];

        Mail::to($reservations->seller->email)
            ->send(new Common($emailData));


        foreach($slots as $slot){
            $slot->delete();
        }

        $reservations->delete();
        return;
    }

    public function inboxMessage(Request $request)
    {
        $id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        // $data['messages'] = Message::where('to_id', Auth::user()->id)->where('is_deleted', false)->orderBy('created_at', 'desc')->paginate(20);
        $left = Chat::select('sender_id AS other_side')->where('receiver_id', Auth::user()->id)->with('threads_all')->with('threads_all.profile')->orderBy('created_at', 'desc')->groupBy('sender_id');
        $right = Chat::select('receiver_id AS other_side')->where('sender_id', Auth::user()->id)->with('threads_all')->with('threads_all.profile')->orderBy('created_at', 'desc')->groupBy('receiver_id')->union($left)->get();
        // $threads = $left->merge($right);
        $threads = $right;
        $data = [
            'personal' => $personal,
            'messages' => $threads,
            'profile' => $prev
        ];
        // return view('user.read_message', $data);
			return view('personal.mypage-chat', $data);

    }

    public function indUnread(Request $request)
    {
        $other = $request->sender;
        $receiver = Auth::user()->id;
        $count = Chat::where('sender_id', $other)->where('receiver_id', $receiver)->where('receive_status', 1)->count();
        return $count;
    }
}
