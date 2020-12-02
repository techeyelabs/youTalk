<?php

/**
 * @Author: Redefinelab Ltd
 * @Date:   2017-10-17 11:15:24
 * @Last Modified by:   Md Shafkat Hussain Tanvir
 * @Last Modified time: 2017-10-18 13:27:04
 */


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatThread;
use App\Models\ContactUs;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Project;
use App\Models\Product;
use App\Models\Profile;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
	public function __construct()
    {
        
    }

    public function index()
    {
        $unread = User::where('is_admin_checked', 1)->count();
    	return view('admin.dashboard')->with([
            'unread' => $unread
        ]);
    }

    public function showUsers(){
        $users = User::get();
        return view('admin.user')->with([
            'users' => $users
        ]);
    }

    public function userDetails($user_id)
    {
        $user_details = Profile::where('user_id', $user_id)->first();
        //return $user_details;
        return view('admin.profile-details')->with([
            'user_details' => $user_details
        ]);
    }

    public function changeUserStatus(Request $request)
    {
        $user_id = $request->id;
        $status = DB::table('users')->where('id', $user_id)->value('status');
        if($status == 1){
            DB::table('users')
              ->where('id', $user_id)
              ->update(['status' => 0]);
        }
        else{
            DB::table('users')
              ->where('id', $user_id)
              ->update(['status' => 1]);
        }
        return response("");
    }

    public function showContactUs()
    {
        $contacts = ContactUs::orderBy('id','desc')->get();
        return view('admin.contact-us')->with([
            'contacts' => $contacts
        ]);
    }

    public function messageIndex()
    {
        // $arr = [];
        // $arr = new \Illuminate\Database\Eloquent\Collection();
        // $users = User::get();
        // //$message = Chat::where('sender_id', 0)->orderBy('created_at', 'desc')->get();
        // foreach($users as $user){
        //     $message = Chat::where('sender_id', 0)->where('receiver_id', $user->id)->orderBy('created_at', 'desc')->first();
        //     $arr->add($message);
        // }
        // $arr = $arr->sortByDesc('created_at');
        // return $arr;

        $users = ChatThread::orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->get();
        //return $users;
        return view('admin.message-list')->with([
            'users' => $users
        ]);
    }

    public function showMessage($user_id)
    {
        //return $user_id;
        DB::enableQueryLog();
        
        $from = 0;
        $to = $user_id;
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

        DB::table('chats')->where('sender_id', $to)->where('receiver_id', 0)->update(array('receive_status' => 2));
        //return $conv;   
        $user = User::where('id', $user_id)->first();
        //return $user;
        if($user->is_admin_checked == 1){
            $user->is_admin_checked = 2;
            $user->save();
        }
        return view('admin.message')->with([
            'conversation' => $conv,
            'user' => $user
        ]);
    }

    public function sendMessage(Request $request)
    {
        
        //return $request;

        $this->validate($request, array(
            'message_text' => 'required|max:255'
        ));
        
        $message = new Chat();
        $message->sender_id = 0;
        $message->receiver_id = $request->id;
        $message->message = $request->message_text;
        $message->save();

        // $top_message = ChatThread::where('receiver_id', $request->id)->where('sender_id', 0)->first();
        $top_message = ChatThread::where(function ($query) use($request) {
                        $query->where('sender_id', $request->id)
                                ->where('receiver_id', 0);
                        })
                    ->orWhere(function ($query) use($request){
                        $query->where('receiver_id', $request->id)
                                ->where('sender_id', 0);
                        })
                    ->first();
        
        //return $top_message;
        if(!$top_message){
            $chat_thread = new ChatThread();
            $chat_thread->sender_id = 0;
            $chat_thread->receiver_id = $request->id;
            $chat_thread->recent_message = $request->message_text;
            $chat_thread->save();
        }else{
            $top_message->recent_message = $request->message_text;
            $top_message->save();
        }
        // dd($top_message);
        return Redirect::route('show-messages', ['id' => $request->id]);
        
        
    }

    public function massMessage()
    {
        $users = User::get();
        return view('admin.mass-message')->with([
            'users' => $users
        ]);
    }

    public function sendMassMessage(Request $request)
    {
        //return $request;

        $this->validate($request, array(
            'message_text' => 'required|max:255'
        ));
        $users = $request->user;
        //return $users[0];

        for($i = 0 ; $i < sizeof($users) ; ++$i){
            $message = new Chat();
            $message->sender_id = 0;
            $message->receiver_id = $users[$i];
            $message->message = $request->message_text;
            $message->save();

            $top_message = ChatThread::where('receiver_id', $users[$i])->orWhere('sender_id', $users[$i])->first();
            if(!$top_message){
                $chat_thread = new ChatThread();
                $chat_thread->sender_id = 0;
                $chat_thread->receiver_id = $users[$i];
                $chat_thread->recent_message = $request->message_text;
                $chat_thread->save();
            }else{
                $top_message->recent_message = $request->message_text;
                $top_message->save();
            }
        }

        $message = [
            'status' => true,
            'text' => 'Message sent successfully!!'
        ];

        return redirect()->back()->with('message', $message);
        
    }

    public function withdrawPointIndex()
    {
        $requests = WithdrawRequest::orderBy('status')->orderBy('created_at', 'desc')->get();
        // $requests = WithdrawRequest::orderBy('status')->with('user')->orderBy('created_at', 'desc')->get();
        // dd($requests);
        //return $requests;

        $notif_off = WithdrawRequest::where('view_status', 1)->get();
        foreach($notif_off as $data){
            $data->view_status = 2;
            $data->save();
        }

        return view('admin.point-withdraw')->with([
            'withdraw_requests' => $requests
        ]);
    }

    public function acceptWithdrawPoint($id)
    {
        //return $id;
        $withdraw = WithdrawRequest::where('id', $id)->first();
        $withdraw->status = 2;
        $withdraw->save();

        $message = [
            'status' => true,
            'text' => 'Withdraw request accepted successfully!!'
        ];

        return redirect()->back()->with('message', $message);
    }

    public function withdrawNotification()
    {
        $withdraw_notif = WithdrawRequest::where('view_status', 1)->get()->count();
        return $withdraw_notif; 
    }

    public function withdrawNotificationDashboard()
    {
        $withdraw_notif = WithdrawRequest::where('view_status', 1)->get()->count();
        return $withdraw_notif; 
    }
}