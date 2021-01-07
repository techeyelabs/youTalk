<?php

namespace App\Http\Controllers;

use App\Mail\Common;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\User;
use App\Models\Profile;
use App\Models\Reservation;
use App\Models\CardInfo;
use App\Models\Category;
use App\Models\Slot;
use App\Models\Faq;
use App\Models\ServiceHistory;
use App\Models\FreeServiceManager;
use App\Models\Review;
use App\Models\Talkroom;
use App\Models\TalkroomChat;
use App\Models\Wallet;
use App\Models\CronTest;

use App\Library\TimeLibrary;

use Image;
use Auth;
use DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class ServiceController extends Controller
{
    public function __construct()
    {
        
    }

    public function new()
    {
        $user_id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $user_id)->first();
        $prev = Profile::where('user_id', $user_id)->first();
        $categories = Category::get();
        $service = count(Service::where('seller_id', $user_id)->get());

        $data = [
            'personal' => $personal,
            'profile' => $prev,
            'categories' => $categories,
            'serviceCount' => $service
        ];
        return view('createservice', $data);
    }

    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $user_id)->first();
        $prev = Profile::where('user_id', $user_id)->first();
        $service_prev = Service::find($id);
        $categories = Category::get();
        $data = [
            'personal' => $personal,
            'profile' => $prev,
            'service_prev' => $service_prev,
            'categories' => $categories
        ];
        return view('createservice', $data);
    }

    public function userDisplay($id)
    {
        $service = Service::with('createdBy')->with('createdBy.profile')->with('faqs')->where('id', $id)->first();

        if (isset(Auth::user()->id)){
            $user_id = Auth::user()->id;
            $prev = Profile::where('user_id', $user_id)->first();
        } else {
            $prev = '';
        }
        $reviews = Review::where('seller_id', $service->seller_id)->where('service_id', $id)->get();
        $avg_rating = Review::where('seller_id', $service->seller_id)->where('service_id', $id)->avg('rating');
        $avg_rating = number_format($avg_rating,1);
        $total_ratings = $reviews->count();
        //$service_in_talkroom = Talkroom::where('service_id', $id)->where('status', 2)->get()->count();
        $service_data = Service::find($id);

        $call_possible_seller = 0;
        $call_possible_buyer = 0;

        if(isset(Auth::user()->id)){
            $user_id = Auth::user()->id;
            $call_possible_seller = Talkroom::where('status', 2)
                                            ->where(function($query) use ($service_data){
                                                $query->where('seller_id', $service_data->seller_id)->orWhere('buyer_id', $service_data->seller_id);
                                            }) 
                                            ->count();
            $call_possible_buyer = Talkroom::where('status', 2)
                                            ->where(function($query) use ($user_id){
                                                $query->where('seller_id', $user_id)->orWhere('buyer_id', $user_id);
                                            }) 
                                            ->count();
        }
        $data = [
            'profile' => $prev,
            'service' => $service,
            'reviews' => $reviews,
            'avg_rating' => $avg_rating,
            'total_ratings' => $total_ratings,
            'call_possible_seller' =>$call_possible_seller,
            'call_possible_buyer' => $call_possible_buyer
        ];
        return view('service_details_user', $data);
    }

    public function userDisplaySelf($id)
    {
        $user_id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $user_id)->first();
        $prev = Profile::where('user_id', $user_id)->first();
        $service = Service::with('createdBy')->with('createdBy.profile')->with('faqs')->where('id', $id)->first();
        $data['service'] = $service;
        $data['personal'] = $personal;
        $data['profile'] = $prev;
        return view('service_details_user_self', $data);
    }

    public function newServicePost(Request $request)
    {
        if(Auth::user()->id){
            if($request->edit_flag == 0){
                if ($request->hasFile('thumbimg')) {
                    $extension = $request->thumbimg->extension();
                    $name = time().rand(1000,9999).'.'.$extension;
                    $img = Image::make($request->thumbimg);
                    $img->save(public_path().'/assets/service/'.$name);
                    // $path = $request->image->storeAs('products', $name);
                }
                $title = isset($request->title)?$request->title:'';
                $price = isset($request->price)?$request->price:0;
                $description = isset($request->description)?$request->description:'';
                $instruction = isset($request->instructions)?$request->instructions:'';
                $thunbimg = $name;
        
                $ser = new Service();
                $ser->category_id = $request->service_category;
                $ser->seller_id = Auth::user()->id;
                $ser->title = $title;
                $ser->price = $price;
                $ser->free_min = isset($request->min)?$request->min:0;
                $ser->free_mint_iteration = isset($request->times)?$request->times:0;
                $ser->thumbnail = $thunbimg;
                $ser->details = $description;
                $ser->payment_instructions = $instruction;
                $ser->status = 1;
                $ser->save();
            }
            else {
                $name = '';
                if ($request->hasFile('thumbimg')) {
                    $extension = $request->thumbimg->extension();
                    $name = time().rand(1000,9999).'.'.$extension;
                    $img = Image::make($request->thumbimg);
                    $img->save(public_path().'/assets/service/'.$name);
                    // $path = $request->image->storeAs('products', $name);
                }
                $precv_service = Service::find($request->edit_flag);
                if($name == ''){
                    $name = $precv_service->thumbnail;
                }
                Service::find($request->edit_flag)
                        ->update(
                            [
                                'category_id' => $request->service_category,
                                'title' => $request->title,
                                'price' => $request->price,
                                'free_min' => $request->min,
                                'free_mint_iteration' => $request->times,
                                'thumbnail' => $name,
                                'details' => $request->description,
                                'payment_instructions' => ''
                            ]
                        );
            }
           
        } else {
            return redirect()->to(route('user-login'));
        }
        return redirect()->to(route('my-page-service'));
    }

    public function statusChange($stat, $id)
    {
        $service = Service::where('id', $id)->first();
        $service->seller_status = $stat;
        $service->save();
        return redirect()->back();
    }
    public function reservationChange($stat, $id)
    {
        $service = Service::where('id', $id)->first();
        $service->reservation_status = $stat;
        $service->save();
        return redirect()->back();
    }

    public function makeReserve($id)
    {
        $user_id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $user_id)->first();
        $prev = Profile::where('user_id', $user_id)->first();
        $list = Reservation::with('whichService')->with('slots')->where('reserver_id', $user_id)->where('status', 2)->orderBy('id', 'desc')->get();
       
        $service_id = $id;
        $service = Service::find($id);
        //Free minute management
        $existing_free = FreeServiceManager::where('service_id', $id)->where('buyer_id', $user_id)->first();
        $free_to_get = 0;
        if($existing_free != '' && $existing_free != null){
            if($existing_free->given_times > $existing_free->used_times)
                $free_to_get = $existing_free->given_mins;
        } else {
            $free_to_get = $service->free_min;
        }

        //Buyre balance check
        $user_all = User::find($user_id);
        $balance = $user_all->wallet_balance;

        //Available mins
        $available_mins = floor($balance/$service->price) + $free_to_get;

        if($balance == 0)
            $available_mins = 0;

        $buyer = Auth::user()->id;

        $data = [
            'list' => $list,
            'personal' => $personal,
            'profile' => $prev,
            'service' => $service,
            'available_mins' => $available_mins,
            'balance' => $balance,
        ];
        return view('reservation', $data);
    }

    public function postReserve(Request $request)
    {
        // dd($request);
        //return $request;
        $buyer = Auth::user()->id;
        $service = Service::where('id', $request->service_id)->first();
        //return $seller_id;
        
        $card = new CardInfo();
        $card->card_name = $request->cardname;
        $card->card_number = $request->cardnumber;
        $card->card_validity = $request->validity;
        $card->cvv = $request->cvv;
        $card->service_id = $request->service_id;
        $card->buyer_id = $buyer;
        $card->save();


        $res = new Reservation();
        $res->service_id = $request->service_id;
        $res->seller_id = $service->seller_id;
        $res->reserver_id = $buyer;
        $res->card_cred_id = $card->id;
        $res->status = 1;
        $res->completion_status = 1;
        $res->save();


        $d = str_split($request->d_1);
        $year = implode(array_slice($d, 0, 4));
        $month = implode(array_slice($d, 8, 2));
        $day = implode(array_slice($d, 14, 2));
        $s = new Slot();
        $s->reservation_id = $res->id;
        $s->service_id = $request->service_id;
        $s->buyer_id = $buyer;
        $s->day = $year.'-'.$month.'-'.$day;
        $s->slot = $request->slot_1;
        $s->save(); 

        $d = str_split($request->d_2);
        $year = implode(array_slice($d, 0, 4));
        $month = implode(array_slice($d, 8, 2));
        $day = implode(array_slice($d, 14, 2));
        $s = new Slot();
        $s->reservation_id = $res->id;
        $s->service_id = $request->service_id;
        $s->buyer_id = $buyer;
        $s->day = $year.'-'.$month.'-'.$day;
        $s->slot = $request->slot_2;
        $s->save();

        $d = str_split($request->d_3);
        $year = implode(array_slice($d, 0, 4));
        $month = implode(array_slice($d, 8, 2));
        $day = implode(array_slice($d, 14, 2));
        $s = new Slot();
        $s->reservation_id = $res->id;
        $s->service_id = $request->service_id;
        $s->buyer_id = $buyer;
        $s->day = $year.'-'.$month.'-'.$day;
        $s->slot = $request->slot_3;
        $s->save();
        
        $emailData = [
            'name' => $service->createdBy->name,
            'buyer_name' => Auth::user()->name,
            'subject' => '【YouTalk】電話予約希望のお知らせ！',
            'from_email' => 'support@youtalk.tel',
            'from_name' => 'YouTalk',
            'template' => 'user.email.reservation_req_made',
            'root'     => $request->root()
        ];

        Mail::to($service->createdBy->email)
            ->send(new Common($emailData));

        $id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $profile_info = Profile::where('user_id', $id)->first();
        $data = [
            'personal' => $personal,
            'profile_info' => $profile_info,
            'profile' => $profile_info,
        ];
        // return view('personal.mypage-profile', $data);
        return redirect()->route('user-display-service', ['id' => $request->service_id]);

    }

    public function reservationList()
    {
        $user_id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $user_id)->first();
        $prev = Profile::where('user_id', $user_id)->first();
        $list = Reservation::with('whichService')->with('slots')->where('reserver_id', $user_id)->where('status', 2)->orderBy('id', 'desc')->get();
        $data = [
            'list' => $list,
            'personal' => $personal,
            'profile' => $prev
        ];
        return view('personal.reservation-list', $data);
    }

    public function reservationListindService($id)
    {
        $user_id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $user_id)->first();
        $prev = Profile::where('user_id', $user_id)->first();
        $list = Reservation::select('reservations.*', 'us.name AS buyer')
                            ->where('reservations.service_id', $id)
                            ->where('reservations.status', '=', 1)
                            ->with('slots')
                            ->leftjoin('users as us', 'us.id', '=', 'reservations.reserver_id')
                            ->get();
        $data = [
            'list' => $list,
            'service_id' => $id,
            'personal' => $personal,
            'profile' => $prev
        ];
        return view('seller-res-list', $data);
    }
    public function historyListindService($id)
    {
        $user_id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $user_id)->first();
        $prev = Profile::where('user_id', $user_id)->first();
        $list = ServiceHistory::where('service_id', $id)
                            ->with('service')
                            ->with('receiver')
                            ->with('seller')
                            ->orderBy('id', 'desc')
                            ->get();
        $data = [
            'list' => $list,
            'service_id' => $id,
            'personal' => $personal,
            'profile' => $prev
        ];
        return view('seller-his-list', $data);
    }
    public function accepted_res($id)
    {
        $user_id = Auth::user()->id;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $user_id)->first();
        $prev = Profile::where('user_id', $user_id)->first();
        $list = Reservation::select('reservations.*', 'us.name AS buyer')
                            ->where('reservations.service_id', $id)
                            ->where('reservations.status', '=', 2)
                            ->with('slots')
                            ->leftjoin('users as us', 'us.id', '=', 'reservations.reserver_id')
                            ->get();
        $data = [
            'list' => $list,
            'service_id' => $id,
            'personal' => $personal,
            'profile' => $prev
        ];
        return view('seller-accepted-res-list', $data);
    }

    public function callConfirmation(Request $request)
    {
        // dd($request);
        $talkroom = $request->talkroom;
        $service = $request->serviceId;
        $seller = $request->sellerId;
        $buyer = $request->buyerId;
        $price = $request->price;
        $duration = ceil($request->duration/60);

        if($request->entry == 'true'){
            $existing_talkroom = Talkroom::where('id', $talkroom)->first();
            $existing_talkroom->duration = $existing_talkroom->duration + $duration;
            if($existing_talkroom->duration > $existing_talkroom->free_mint){
                $existing_talkroom->cost = ($existing_talkroom->duration - $existing_talkroom->free_mint) * $price;
            } else {
                $existing_talkroom->cost = 0;
            }
            $existing_talkroom->call_status = 1;
            $existing_talkroom->last_call_end = date("Y-m-d H:i:s");
            $existing_talkroom->save();

            //Push automated message into talkroom
            $hour = date("H");
            $min = date("i");
            $talkroom_chat = new TalkroomChat();
            $talkroom_chat->talkroom_id = $existing_talkroom->id;
            $talkroom_chat->sender_id = 0;
            $talkroom_chat->receiver_id = 0;
            $talkroom_chat->message = $hour.'時'.$min.'分に電話を切りました！';
            $talkroom_chat->save();
        }

        $data = [
            'talkroom' => $existing_talkroom
        ];
        return response()->json($data);
    }

    public function engage_seller(Request $request)
    {
        $id1 = $request->sellerId;    
        $id2 = $request->buyerId;
        $test_talk = Talkroom::where('seller_id', $id1)->where('buyer_id', $id2)->where('status', 2)->first();
        if($test_talk == '' || $test_talk == null){
            $test_talk = Talkroom::where('buyer_id', $id1)->where('seller_id', $id2)->where('status', 2)->first();
        }
        $test_talk->call_status = 2;
        $test_talk->save();

        $hour = date("H");
        $min = date("i");
        $talkroom_chat = new TalkroomChat();
        $talkroom_chat->talkroom_id = $test_talk->id;
        $talkroom_chat->sender_id = 0;
        $talkroom_chat->receiver_id = 0;
        $talkroom_chat->message = $hour.'時'.$min.'分から電話を開始になりました！';
        $talkroom_chat->save();

        $data = [
            'status' => 200
        ];
        return response()->json($data);
    }

    public function talkroomStatus(Request $request)
    {
        $talkroom = Talkroom::where('id', $request->talkroom)->first();
        $data = [
            'status' => $talkroom->status,
            'call_status' => $talkroom->if_call_disabled,
            'url' => url('/talkroom-close', $request->talkroom)
        ];
        return response()->json($data);
    }

    public function accept(Request $request)
    {
        // dd($request);
        Reservation::where('service_id', $request->service_id)
                    ->where('status', 1)
                    ->where('reserver_id', $request->reserver_id)
                    ->update(['slot' => $request->accepted_slot, 'status' => 2]);
        return redirect()->back();

    }

    public function getReservationRequest(Request $request)
    {
      
        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();
       // dd($time_slot);
      
        $s_id = $request->service_id;
        $reservation_req = Reservation::where('service_id', $s_id)->where('status', 1)->get();

        $html_text = '<h5 class="text-center mb-4">電話通話予約希望</h5>';

        if($reservation_req->count() == 0){
            $html_text .= '
            <h6 class="text-center">no reservation request</h6>';
        }

        foreach($reservation_req as $data){
            $html_text .= '
            <div class="col-md-12 row px-0 align-items-center">
            <div class="col-md-9">
            <span>'.$data->reserver->name.'</span><br/><br/>';
            $len = count($data->slots);
            $i = 0;
            $x = ['第一希望', '第二希望', '第三希望'];
            $iter = 0;
            foreach($data->slots as $slots){
                $html_text .= '
                <div class="form-check">
                <input class="form-check-input" type="radio" name="option_req" id="'.$slots->id.'" value="'.$slots->id.'">
                <label class="form-check-label" style="width:100%" for="exampleRadios1">
                <div class="row mb-2">
                    <div class="col-md-4 pr-0">'.$x[$iter].'</div>
                    <div class="col-md-4 px-0">'.$slots->day.'</div>
                    <div class="col-md-4 px-0">'.$time_slot[$slots->slot].'</div>';
                    // if($slots->slot == 1){
                    //     $html_text .= '11:00 AM</div>';
                    // }elseif($slots->slot == 2){
                    //     $html_text .= '02:00 PM</div>';
                    // }else{
                    //     $html_text .= '04:00 PM</div>';
                    // }
                
                $html_text .='
                </div>
                </label>
                </div>';
                $iter++;
            }
            $html_text .= '
            </div>
            <div class="col-md-3 pt-4">
                <button onclick="select_res_req()" class="btn btn-sm btn-outline-secondary text-secondary mb-2" style="width: 120px">決定する</button>
                <button onclick="cancelReservation('.$data->id.')" class="btn btn-sm btn-outline-secondary text-secondary" style="width: 120px">キャンセル</a>
            </div>
        </div>
        <hr style="height:2px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40)" />';
        }
        return $html_text;
    }

    public function cancelReservationRequest(Request $request)
    {
        $res_id = $request->reservation_id;
        $reservation = Reservation::where('id', $res_id)->first();

        //Send mail to seller
        $emailData = [
            'seller_name' => $reservation->seller->name,
            'buyer_name' => $reservation->reserver->name,
            'subject' => '【YouTalk】電話予約希望のキャンセルのお知らせ！',
            'from_email' => 'support@youtalk.tel',
            'from_name' => 'YouTalk',
            'template' => 'emailtemplates.layouts.reservation-req-cancel',
            // 'root'     => $request->root(),
            'email'     => $reservation->reserver->email
        ];
        // dd($emailData);

        Mail::to($reservation->reserver->email)
            ->send(new Common($emailData));
        $reservation->delete();

        return redirect()->back()->with('success', 'Message sent successfully');
    }

    public function cancelAcceptedReservationRequest(Request $request)
    {
        $res_id = $request->reservation_id;
        $reservation = Reservation::where('id', $res_id)->firstOrFail();

        foreach ($reservation->slots as $sl){
            if ($sl->id == $reservation->slot){
                $year = date('Y', strtotime($sl->day));
                $month = date('m', strtotime($sl->day));
                $day = date('d', strtotime($sl->day));
                $date_time = $year.'年'.$month.'月'.$day.'日'.$sl->slot.'時';
            }
        }
        //Send mail to buyer
        $emailData = [
            'date_time' => $date_time,
            'seller_name' => $reservation->seller->name,
            'buyer_name' => $reservation->reserver->name,
            'subject' => '【YouTalk】電話予約キャンセルのお知らせ！',
            'from_email' => 'support@youtalk.tel',
            'from_name' => 'YouTalk',
            'template' => 'emailtemplates.layouts.reservation-req-cancel-accepted-seller',
            // 'root'     => $request->root(),
            'email'     => $reservation->reserver->email
        ];
        // dd($emailData);

        Mail::to($reservation->reserver->email)
            ->send(new Common($emailData));
        $reservation->delete();

        return redirect()->back();
    }

    public function acceptReservationRequest(Request $request)
    {
        $slot_id = $request->selectedOption;
        $accepted_slot = Slot::where('id', $slot_id)->firstOrFail();
        $reservation_id = $accepted_slot->reservation_id;
        $reservation = Reservation::find($reservation_id);
        if($reservation != null){
            $reservation->slot = $slot_id;
            $reservation->status = 2;
            $reservation->save();
        }
        return redirect()->back();
    }

    public function acceptedReservation(Request $request)
    {
        
        
        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();

        $service_id = $request->service_id;
        //return $service_id;
        $reservations = Reservation::where('service_id', $service_id)->where('status', 2)->get();
        
        $html_text = '
        <h5 class="text-center">電話受付予約日程</h5>';
        
        if($reservations->count() == 0){
            $html_text .= '
            <h6 class="text-center">no confirmed reservation</h6>';
        }
            
        //     <div class="col-md-12 row px-0 align-items-center">
        //         <div class="col-md-4">
        //             <span>shiam</span><br/>
        //             <span>電話受付予約時間</span>
        //         </div>
        //         <div class="col-md-4">
        //             <span>dfzgdfg</span>
        //         </div>
        //         <div class="col-md-4">
        //             <span>11:00 AM</span>
        //         </div>      
        //     </div>
        // <hr style="height:2px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40)" />
        // dd($time_slot);
        foreach($reservations as $data){

            $slot_id = $data->slot;
            $slot = Slot::where('id', $slot_id)->first();
            
                $html_text .= '
                <div class="col-md-12 row px-0 align-items-end">
                    <div class="col-md-3">
                        <div>'.$slot->buyer->name.'</div>
                        電話受付予約時間
                    </div>
                    <div class="col-md-3">'.$slot->day.'</div>
                    <div class="col-md-2">'.$time_slot[$slot->slot].'</div>';
                    
                    $html_text .= '
                    <div class="col-md-4 ">
                        <button onclick="cancelConfirmedReservation('.$data->id.')" class="btn btn-sm btn-outline-secondary text-secondary">予約キャンセルする</a>
                    </div>
                </div>
                <hr style="height:2px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40)" />';
            
            
        }

        return $html_text;
    }

    public function leftoutreservations()
    {
        //Cron test
        $test = CronTest::where('id', 1)->first();
        $test->leftouts = date('Y-m-d H:i:s');
        $test->save();

        $all_slots = Slot::get();
        foreach ($all_slots as $all){
            if (date('Ymd') >= date('Ymd', strtotime($all->day))){
                $hour = date('H');
                if ($hour >= $all->slot){
                    Slot::where('reservation_id', $all->reservation_id)->delete();
                    Reservation::where('id', $all->reservation_id)->delete();
                }
            }
        }
    }

    public function expiredReservations()
    {
        //Cron test
        //*
        $test = CronTest::where('id', 1)->first();
        $test->time = date('Y-m-d H:i:s');
        $test->save();

       
        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();

        date_default_timezone_set("Asia/Dhaka");
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $today = $date. " " .$time;

        $reservations = Reservation::where('status', 2)->get();
        //return $reservations;

        //if($reservations->count() > 0){}
        $res_times = [];
        foreach($reservations as $data){
            $res_date = $data->acceptedSlot->day;
            $res_time = $time_slot[$data->acceptedSlot->slot];
            $date_time = $res_date." ".$res_time;
            $final_time = date("Y-m-d H:i", strtotime("50 minutes", strtotime($date_time)));
            $res_times[$data->id] = $final_time;
            //array_push($res_times, $final_time); 
        }
        //return $res_times;

        foreach($reservations as $data){
            $val1 = $res_times[$data->id];

            $datetime1 = new DateTime($val1);
            $datetime2 =  new DateTime($today);

            if($datetime2 > $datetime1){
                //return $val1;
                $data->delete();
            }
            // }else{
            //     return "thik ase";
            // }
        }

        //return "success";
       
    }

    public function closeUserTalkroom()
    {
        //Cron test
        $test = CronTest::where('id', 1)->first();
        $test->close_user_talkroom = date('Y-m-d H:i:s');
        $test->save();

      

        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();

        $users = User::get();
        $res_dateTime = [];

        foreach($users as $user){
            $user_id = $user->id;
            $active_talkroom_as_seller = Talkroom::where('status', 2)
                ->where(function($query) use ($user_id){
                $query->where('seller_id', $user_id)->orWhere('buyer_id', $user_id);
            })->get();
            //$active_talkroom_as_seller = Talkroom::where('seller_id', $user->id)->orWhere('buyer_id', $user->id)->where('status', 2)->get();
            //$active_talkroom_as_buyer = Talkroom::where('buyer_id', $user->id)->where('status', 2)->get();
            //return $active_talkroom_as_seller;
            if($active_talkroom_as_seller->count() > 0){
                $reserver = Reservation::where('status', 2)
                                    ->where(function($query) use ($user_id){
                                    $query->where('reserver_id', $user_id)->orWhere('seller_id', $user_id);  
                })->get();
                //return $reserver;
                foreach($reserver as $data){
                    $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];
                    //array_push($res_dateTime, $temp_dateTime); 
                    $latest_reservation = $temp_dateTime;
                    $final_time = date("Y-m-d H:i:s", strtotime("-10 minutes", strtotime($latest_reservation)));

                    //getting current timedate
                    date_default_timezone_set("Asia/Dhaka");
                    $date = date("Y-m-d");
                    $time = date("H:i:s");
                    $now = $date. " " .$time;

                    $date_latest = new DateTime($final_time);
                    $date_now = new DateTime($now);

                    if($date_now > $date_latest){
                        $active_talkroom_as_seller->if_call_disabled = 1;
                        $active_talkroom_as_seller->save();
                        break;
                    }
                }
            }


        }
        //return $res_dateTime;


    }

    public function openReservedTalkroom()
    {
        //Cron test
        $test = CronTest::where('id', 1)->first();
        $test->auto_talkroom_create = date('Y-m-d H:i:s');
        $test->save();


       
        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();

        $reservations = Reservation::where('status', 2)->get();

        //return $reservations;
        foreach($reservations as $data){
            $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];

            //getting current timedate
            date_default_timezone_set("Asia/Dhaka");
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $now = $date." ".$time;

            $date_latest = new DateTime($temp_dateTime);
            $date_now = new DateTime($now);

            $existing = Talkroom::where('seller_id', $data->seller_id)->where('buyer_id', $data->reserver_id)->where('status', 2)->first();

            //return $existing;
            if($date_now >= $date_latest){
                if($existing == '' || $existing == null){
                    //Get free minute count if any
                    $free_min_to_get = 0;
                    $free_min = $data->whichService->free_min;
                    $free_mint_iteration = $data->whichService->free_mint_iteration;
                    $is_exists = FreeServiceManager::where('service_id', $data->service_id)->where('buyer_id', $data->reserver_id)->first();
                    if($is_exists != '' && $is_exists != null){
                        if($is_exists->given_times > $is_exists->used_times){
                            $free_min_to_get = $is_exists->given_mins ;
                        } 
                    } else {
                        if($free_min > 0 && $free_mint_iteration > 0){
                            $free_manager = new FreeServiceManager();
                            $free_manager->service_id = $data->service_id;
                            $free_manager->buyer_id = $data->reserver_id;
                            $free_manager->given_mins = $free_min;
                            $free_manager->given_times = $free_mint_iteration;
                            $free_manager->used_times = 0;
                            $free_manager->save();
                        }
                        $free_min_to_get = $free_min;
                    }
                    
                    //Now I am going to create new and live talkroom
                    $talkroom_live = new Talkroom();
                    $talkroom_live->service_id  = $data->service_id;
                    $talkroom_live->seller_id  = $data->seller_id;
                    $talkroom_live->buyer_id  = $data->reserver_id;
                    $talkroom_live->status  = 2;
                    $talkroom_live->duration  = 0;
                    $talkroom_live->cost  = 0;
                    $talkroom_live->free_mint  = $free_min_to_get;
                    $talkroom_live->available_mins  = 2;
                    $talkroom_live->payment_method  = 2;
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

                    $live_talkroom = Talkroom::where('buyer_id', $data->reserver_id)->where('status', 2)->first();
                    //return $live_talkroom;

                    //Mail notification to seller
                    $seller_all = User::find($data->seller_id);
                    $buyer_all = User::find($data->reserver_id);

                    $emailData = [
                        'seller_name' => $seller_all->name.' '.$seller_all->last_name,
                        'buyer_name' => $buyer_all->name.' '.$buyer_all->last_name,
                        'subject' => '【YouTalk】トークルーム開始のお知らせ！',
                        'from_email' => 'support@youtalk.tel',
                        'from_name' => 'YouTalk',
                        'template' => 'emailtemplates.layouts.talkroom_notification',
                        'root'     => 'YouTalk.tel',
                        'email'     => $seller_all->email
                    ];

                    Mail::to($data->seller->email)
                        ->send(new Common($emailData));

                    //Mail notification ends

                    $res_dateTime = [];

                    $user_as_reserver = Reservation::where('reserver_id', $data->reserver_id)->where('status', 2)->get();
                    foreach($user_as_reserver as $data){
                        $slot = Slot::where('id', $data->slot)->first();
                        $temp_dateTime = $slot->day." ".$time_slot[$slot->slot];
                        array_push($res_dateTime, $temp_dateTime); 
                    }

                    $seller_as_reserver = Reservation::where('reserver_id', $data->seller_id)->where('status', 2)->get();
                    foreach($seller_as_reserver as $data){
                        $slot = Slot::where('id', $data->slot)->first();
                        $temp_dateTime = $slot->day." ".$time_slot[$slot->slot];
                        array_push($res_dateTime, $temp_dateTime); 
                    }

                    $user_as_seller = Reservation::where('seller_id', $data->seller_id)->where('status', 2)->get();
                    foreach($user_as_seller as $data){
                        $slot = Slot::where('id', $data->slot)->first();
                        $temp_dateTime = $slot->day." ".$time_slot[$slot->slot];
                        array_push($res_dateTime, $temp_dateTime); 
                    }

                    $seller_as_seller = Reservation::where('seller_id', $data->seller_id)->where('status', 2)->get();
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
                    $troom = Talkroom::where('buyer_id', $data->reserver_id)->where('status', 2)->first();
                    $troom->deadline = $final_time;
                    $troom->save();

                    //deleting the reservation
                    $data->delete();
                }
                

            }
        }
        
    }

    public function runningTalkroomClose()
    {
        //Cron test
        $test = CronTest::where('id', 1)->first();
        $test->current_talkroom_close = date('Y-m-d H:i:s');
        $test->save();

       

        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();
        // dd($time_slot);

        $res_dateTime = [];
        $active_talkrooms = Talkroom::where('status', 2)->get();

        foreach($active_talkrooms as $data){
            $seller_id = $data->seller_id;
            $buyer_id = $data->buyer_id;

            $buyer_as_reserver = Reservation::where('reserver_id', $buyer_id)->where('status', 2)->get();
            foreach($buyer_as_reserver as $data){
                $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];
                array_push($res_dateTime, $temp_dateTime); 
            }

            $seller_as_reserver = Reservation::where('reserver_id', $seller_id)->where('status', 2)->get();
            foreach($seller_as_reserver as $data){
                $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];
                array_push($res_dateTime, $temp_dateTime); 
            }

            $buyer_as_seller = Reservation::where('seller_id', $buyer_id)->where('status', 2)->get();
            foreach($buyer_as_seller as $data){
                $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];
                array_push($res_dateTime, $temp_dateTime); 
            }

            $seller_as_seller = Reservation::where('seller_id', $seller_id)->where('status', 2)->get();
            foreach($seller_as_seller as $data){
                $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];
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

            $latest_reservation = $res_dateTime[0];
            //*
            $final_time = date("Y-m-d H:i:s", strtotime("-10 minutes", strtotime($latest_reservation)));

            //getting current timedate
            date_default_timezone_set("Asia/Dhaka");
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $now = $date. " " .$time;

            $date_latest = new DateTime($final_time);
            $date_now = new DateTime($now);

            if($date_now > $date_latest){
                $data->status = 1;
                $data->save();
            }
            
            $res_dateTime = [];
        }

    }

    public function runningCallClose()
    {
        //Cron test
        $test = CronTest::where('id', 1)->first();
        $test->running_call_close = date('Y-m-d H:i:s');
        $test->save();

        $active_talkrooms = Talkroom::where('status', 2)->where('call_status', 1)->get();
        //return $active_talkrooms;
        //getting current timedate
        date_default_timezone_set("Asia/Dhaka");
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $now = $date. " " .$time;

        //return $now;

        foreach($active_talkrooms as $data){
            $start_time = $data->last_call_end;
            $start_plusten_time = date("Y-m-d H:i:s", strtotime("10 minutes", strtotime($start_time)));

            //return $start_plusten_time;

            $date_start_time = new DateTime($start_plusten_time);
            $date_now = new DateTime($now);

            if($date_now > $date_start_time){
                $data->status = 1;
                $data->save();

                //point deduction
                if($data->payment_method == 1){
                    $buyer = User::find($data->buyer_id);
                    $buyer->wallet_balance = $buyer->wallet_balance - $data->cost;
                    $buyer->save();
                }
                //Seller earning balance add
                $seller = User::find($data->seller_id);
                $seller->earning_balance = $seller->earning_balance + $data->cost;
                $seller->save();

                //Push automated message into talkroom
                $talkroom_chat = new TalkroomChat();
                $talkroom_chat->talkroom_id = $data->id;
                $talkroom_chat->sender_id = 0;
                $talkroom_chat->receiver_id = 0;
                $talkroom_chat->message = 'トークルームを終了しました！';
                $talkroom_chat->save();

                if($data->free_mint > 0){
                    $existing = FreeServiceManager::where('service_id', $data->service_id)->where('buyer_id', $data->buyer_id)->first();
                    $existing->used_times = $existing->used_times + 1;
                    $existing->save();
                }

                //Send mail to buyer
                $emailData = [
                    'seller_name' => $data->seller->name,
                    'buyer_name' => $data->buyer->name,
                    'subject' => '【YouTalk】トークルーム終了のお知らせ！',
                    'service_title' => $data->service->title,
                    'date' => $data->created_at->format("Y:m:d"),
                    'duration' => $data->duration,
                    'amount' => $data->cost,
                    'from_email' => 'support@youtalk.tel',
                    'from_name' => 'YouTalk',
                    'template' => 'emailtemplates.layouts.talkroom-close-notification',
                    // 'root'     => $request->root(),
                    'email'     => $data->buyer->email
                ];

                Mail::to($data->buyer->email)
                    ->send(new Common($emailData));
            }

        }
    }

}
