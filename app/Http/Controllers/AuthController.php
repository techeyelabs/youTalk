<?php

/**
 * @Author: Redefinelab Ltd
 * @Date:   2017-10-16 13:37:36
 * @Last Modified by:   Md Shafkat Hussain Tanvir
 * @Last Modified time: 2017-10-16 13:37:41
 */

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use App\Mail\Common;
use App\Models\Profile;
use App\Models\Wallet;
use App\User;

use Auth;
use Hash;
use Mail;
use App\Http\Controllers\Controller;
use Socialite;
use Validator;
use Cart;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
	public function __construct()
    {

    }

    public function login(){
        if (Auth::user()){
            return redirect()->route('front-home');
        }
        return view('auth.login');
    }

    public function loginFromService($id){
        return view('auth.login', ['service_id'=> $id]);
    }
    
    public function loginAction(Request $request){
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            return redirect()->back()->with('error', 'Credentials do not match');
        }
        if($request->service_id == 0){
            return redirect()->to(route('my-page-profile'));
        }else{
            return Redirect::route('user-display-service', ['id'=> $request->service_id]);
        }
    }

    public function user_registration_rules(array $data)
    {
      $messages = [
        'email.required' => ' この項目は必須です',
        'email.unique' => 'メールアドレスはすでに存在します'
      ];

      $validator = Validator::make($data, [
            'email' => 'required|email|unique:users'
      ], $messages);

      return $validator;
    }

    public function registerRequest(Request $request)
    {
        return view('register_request');
    }

    public function registerRequestAction(Request $request)
    {
        $validator = $this->user_registration_rules($request->toArray());
        if($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput();
        }

        $User = new User();
        $User->name = 'welcome user';
        $User->email = $request->email;
        $User->password = Hash::make(rand(100000,999999));
        $User->register_token = time().rand(1000,9999);
        $User->save();

        $pro = new Profile();
        $pro->picture = 'default.png';
        $pro->save();

        $emailData = [
            'name' => 'User',
            'contact_person' => 'Smith',
            'register_token' => $User->register_token,
            'subject' => '【YouTalk】アカウントの仮登録',
            'from_email' => 'support@youtalk.tel',
            'from_name' => 'YouTalk',
            'template' => 'emailtemplates.layouts.registration_process',
            'root'     => $request->root(),
            'email'     => $request->email
        ];

        try {
            Mail::to($request->email)
                ->send(new Common($emailData));
        }
        catch (Exception $e){
        }
        return redirect()->back()->with('success_message', 'メールを送信しました。');
    }

    public function register(Request $request)
    {
        $token = $request->token;
        $data['user'] = User::where('register_token', $token)->first();
        $data['token'] = $token;
        if($data['user']){
            return view('auth.register', $data);
        }
        abort(404);
    }

    public function registerAction(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:25',
            'email' => 'required|email',
            'password' => ['required','min:8','confirmed']
        ],[
            'password.min' => 'パスワードは８文字以上にする必要があります',
            'password.confirmed' => 'パスワードの確認が一致しません'
        ]);
        $count = 0;
        
        if(preg_match('/([a-z])/', $request->password)){
            $count++;
        }
        if(preg_match('/([A-Z])/', $request->password)){
            $count++;
        }
        if(preg_match('/([0-9])/', $request->password)){
            $count++;
        }

        if($count < 2 || preg_match('/([!$%^&*]+)/', $request->password)){
            return redirect()->back()->withInput()->with('error_message', 'パスワードの書式が間違えています。確認してください。');
        }

        $User = User::where('register_token', $request->token)->first();
        $User->name = $request->first_name;
        $User->last_name = isset($request->last_name)?$request->last_name:'';
        $User->email = $request->email;
        $User->register_token = '';
        $User->password = Hash::make($request->password);
        $User->is_email_verified = true;
        $User->status = true;
        $User->save();

        $amount = new Wallet();
        $amount->user_id = $User->id;
        $amount->service_id = 0;
        $amount->expense_type = 4;
        $amount->amount = 0;
        $amount->save();

        $image = 'default.png';

        $Profile = new Profile();
        $Profile->user_id = $User->id;
        $Profile->picture = $image;
        $Profile->first_name = $request->first_name;;
        $Profile->save();

        $emailData = [
            'name' => $User->name.' '.$User->last_name,
            'contact_person' => 'Smith',
            'subject' => '会員登録完了のお知らせ！',
            'from_email' => 'support@youtalk.tel',
            'from_name' => 'YouTalk',
            'template' => 'user.email.registration_complete_user',
            'root'     => $request->root()
        ];

        try {
            Mail::to($request->email)
                ->send(new Common($emailData));
        }
        catch (Exception $e){
        }
        return redirect()->to(route('login'))->with('success_message', 'ご登録ありがとうございます！'.'<br/>'.' 下記よりログインして弊社サービスをご利用ください。');
    }

    public function validateEmail(Request $request)
    {
        $count = User::where('email', $request->email)->get()->count();
        return $count;
    }

    public function changePassword(Request $request)
    {
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();
        $data = [
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
        ];
        return view('user.change_password', $data);
    }
 
    public function changePasswordAction(Request $request)
    {
    	$this->validate($request, [
            'current_password' => 'required',
            // 'password' => 'required|confirmed'
            'password' => ['required', 
            'min:8',
            'confirmed']
        ],[
            'password.min' => 'パスワードは８文字以上にする必要があります',
            'password.confirmed' => 'パスワードの確認が一致しません'
        ]);
        $count = 0;
        if(preg_match('/([a-z])/', $request->password)){
            $count++;
        }if(preg_match('/([A-Z])/', $request->password)){
            $count++;
        }
        if(preg_match('/([0-9])/', $request->password)){
            $count++;
        }
        //if(preg_match('/([!@#$%^&*])/', $request->password)){
        //     $count++; 
        // }
        if($count < 2 || preg_match('/([!$%^&*]+)/', $request->password)){
            return redirect()->back()->withInput()->with('error_message', 'パスワードの書式が間違えています。確認してください。');
        }

        $emailData = [
            'name' => Auth::user()->name,
            'subject' => '【YouTalk】パスワード変更のお知らせ！',
            'from_email' => 'support@youtalk.tel',
            'from_name' => 'YouTalk',
            'template' => 'auth.change_password',
            'root'     => $request->root()
        ];

        Mail::to(Auth::user()->email)
            ->send(new Common($emailData));

        $User = User::find(Auth::user()->id);
        if (Hash::check($request->current_password, $User->password)) {
            $User->password = Hash::make($request->password);
            $User->save();
            return Redirect::route('login')->with('success_message', 'パスワードは正常に変更されました');
        }
        return redirect()->back()->with('error_message', '現在のパスワードが一致しません');
    }

    public function facebook(Request $request)
    {
		$redirectUrl = $request->root().'/facebook-action';
        return Socialite::driver('facebook')->setScopes(['email'])->redirectUrl($redirectUrl)->redirect();
    }

    public function facebookAction(Request $request)
    {
        $redirectUrl = $request->root().'/facebook-action';
        $user = Socialite::driver('facebook')->redirectUrl($redirectUrl)->user();
        $check = User::where('email', $user->email)->first();
        if($check){
            $check->facebook_id = $user->id;
            $check->is_email_verified = true;
            $check->status = true;
            $check->save();
            $userId = $check->id;
        }else{
            $User = new User();
            $User->facebook_id = $user->id;
            $User->first_name = $user->name;
            $User->pic = $user->avatar_original;
            $User->last_name = '';
            $User->email = $user->email;
            $User->is_email_verified = true;
            $User->status = true;
            $User->created_at = date('Y-m-d H:i:s');
            $User->updated_at = date('Y-m-d H:i:s');
            $User->save();

            $Profile = new Profile();
            $Profile->user_id = $User->id;
            $Profile->save();

            $userId = $User->id;
        }

        if(Auth::check()){
            return redirect()->to(route('user-social'))->with('success_message', 'Facebook connected!');
        }
        Auth::loginUsingId($userId, true);
        return redirect()->intended(route('user-my-page'));

    }

    public function google(Request $request)
    {
        $redirectUrl = $request->root().'/google-action';
        return Socialite::driver('google')->setScopes(['email'])->redirectUrl($redirectUrl)->redirect();
    }

    public function googleAction(Request $request)
    {
        $redirectUrl = $request->root().'/google-action';
        $user = Socialite::driver('google')->redirectUrl($redirectUrl)->user();
        $check = User::where('email', $user->email)->first();
        if($check){
            $check->google_id = $user->id;
            $check->is_email_verified = true;
            $check->status = true;
            $check->save();
            $userId = $check->id;
        }else{
            $User = new User();
            $User->google_id = $user->id;
            $User->first_name = $user->name;
            $User->pic = $user->avatar_original;
            $User->last_name = '';
            $User->email = $user->email;
            $User->is_email_verified = true;
            $User->status = true;
            $User->created_at = date('Y-m-d H:i:s');
            $User->updated_at = date('Y-m-d H:i:s');
            $User->save();

            $Profile = new Profile();
            $Profile->user_id = $User->id;
            $Profile->save();

            $userId = $User->id;
        }

        if(Auth::check()){
            return redirect()->to(route('user-social'))->with('success_message', 'Google connected!');
        }
        Auth::loginUsingId($userId, true);
        return redirect()->intended(route('user-my-page'));
    }

    public function twitter(Request $request)
    {
        $redirectUrl = $request->root().'/twitter-action';
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterAction(Request $request)
    {
        $redirectUrl = $request->root().'/twitter-action';
        $user = Socialite::driver('twitter')->user();
        $check = User::where('twitter_id', $user->id)->first();
        if($check){
            $check->twitter_id = $user->id;
            $check->is_email_verified = true;
            $check->status = true;
            $check->save();
            $userId = $check->id;
        }else{
            $User = new User();
            $User->twitter_id = $user->id;
            $User->first_name = $user->name;
            $User->pic = $user->avatar_original;
            $User->last_name = '';
            $User->email = 'user'.$User->twitter_id.rand(1000,9999).'@example.com';
            $User->is_email_verified = true;
            $User->status = true;
            $User->created_at = date('Y-m-d H:i:s');
            $User->updated_at = date('Y-m-d H:i:s');
            $User->save();

            $Profile = new Profile();
            $Profile->user_id = $User->id;
            $Profile->save();

            $userId = $User->id;
        }

        if(Auth::check()){
            return redirect()->to(route('user-social'))->with('success_message', 'Twitter connected!');
        }

        Auth::loginUsingId($userId, true);
        return redirect()->intended(route('user-my-page'));
    }

    public function yahoo(Request $request)
    {
        $redirectUrl = $request->root().'/yahoo-action';
        return Socialite::driver('yahoo')->redirect();
    }

    public function yahooAction(Request $request)
    {
        $redirectUrl = $request->root().'/yahoo-action';
        $user = Socialite::driver('yahoo')->user();
        $check = User::where('email', $user->email)->first();
        if($check){
            $check->twitter_id = $user->id;
            $check->is_email_verified = true;
            $check->status = true;
            $check->save();
            $userId = $check->id;
        }else{
            $User = new User();
            $User->google_id = $user->id;
            $User->first_name = $user->name;
            $User->pic = $user->avatar_original;
            $User->last_name = '';
            $User->email = $user->email;
            $User->is_email_verified = true;
            $User->status = true;
            $User->created_at = date('Y-m-d H:i:s');
            $User->updated_at = date('Y-m-d H:i:s');
            $User->save();

            $Profile = new Profile();
            $Profile->user_id = $User->id;
            $Profile->save();

            $userId = $User->id;
        }

        if(Auth::check()){
            return redirect()->to(route('user-social'))->with('success_message', 'Yahoo connected!');
        }
        Auth::loginUsingId($userId, true);
        return redirect()->intended(route('user-my-page'));
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->to(route('front-home'));
    }
}
