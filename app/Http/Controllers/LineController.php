<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Linehook;

use App\Models\Profile;
use App\Models\Wallet;

use App\Models\User;

class LineController extends Controller
{
    public function __construct()
    {
        $this->CLIENT_ID = '1655646680';
        $this->CLIENT_SECRET = '59ce485635cb943efe6abf0a34b44076';
        $this->REDIRECT_URL = route('line-login-callback');
        $this->VERIFYHOST = false;
        $this->VERIFYPEER = false;
        $this->AUTH_URL = 'https://access.line.me/oauth2/v2.1/authorize';
        $this->PROFILE_URL = 'https://api.line.me/v2/profile';
        $this->REVOKE_URL = 'https://api.line.me/oauth2/v2.1/revoke';
        $this->TOKEN_URL = 'https://api.line.me/oauth2/v2.1/token';
        $this->VERIFYTOKEN_URL = 'https://api.line.me/oauth2/v2.1/verify';
        $this->SEND_MESSAGE_URL = 'https://api.line.me/v2/bot/message/multicast';
    }

    public function login(Request $request)
    {
        $redirectUrl = $this->AUTH_URL.'?response_type=code&client_id='.$this->CLIENT_ID.'&redirect_uri='.$this->REDIRECT_URL.'&state=111111&scope=profile%20openid%20email&bot_prompt=aggressive';

        if(!empty(Auth::user()->line_user_id)){
            $id = isset(Auth::user()->id)?Auth::user()->id: 0;
            $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
            $prev = Profile::where('user_id', $id)->first();
            $wallet = Wallet::where('user_id', $id)->get();
            $data = [
                'personal' => $personal,
                'wallet' => $wallet,
                'profile' => $prev,
                'redirectUrl' => $redirectUrl
            ];
            return view('user.line_notification_setting', $data);
        } 
        return redirect()->away($redirectUrl);
        
    }

    public function loginAction()
    {
        if(!isset($_GET['code'])) return 'invalid request';
        $code = $_GET['code'];
        $this->getAccessToken($code);
        return redirect()->route('front-home')->with('success_message', 'Successfull');
    }

    private function getAccessToken($code)
    {
        $postData = array(
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->REDIRECT_URL,
            'client_id' => $this->CLIENT_ID,
            'client_secret' => $this->CLIENT_SECRET,
        );
        $header = array(
            'Content-Type: application/x-www-form-urlencoded'
        );
        $response = $this->sendCURL($this->TOKEN_URL, $header, 'post', $postData);
        $response = json_decode($response);
        if($response->error) return false;
        return $this->getLineProfile($response->access_token);
        
    }

    private function getLineProfile($accessToken)
    {
        $header = array(
            'Authorization: Bearer '.$accessToken
        );
        $response = $this->sendCURL($this->PROFILE_URL, $header, 'get');
        $response = json_decode($response);
        if($response->error) return false;
        User::where('id', Auth::user()->id)->update(['line_user_id' => $response->userId]);
        $this->sendMessage($response->userId, 'welcome to youtalk notification center');
        return true;
    }
    
    

    // public function webhook(Request $request)
    // {
    //     // $bodyContent = $request->getContent();
    //     $bodyContent = '{"events":[{"type":"follow","replyToken":"8a92f149144447f7b83bb8b963e6a512","source":{"userId":"Ubb001878b118d1f40be2459d1fc543b8","type":"user"},"timestamp":1612436362444,"mode":"active"}],"destination":"U1d98b79ae8abbbe9def1daafa2faa827"}';
    //     if(!empty($bodyContent)){
    //         $bodyContent = json_decode($bodyContent);
    //         if($bodyContent->events){
    //            if($bodyContent->events[0]->type == 'follow'){
    //                $this->reply($bodyContent->events[0]);
    //            }
    //         }
    //         dd($bodyContent);

    //     }
    //     dd(2);
    // }

    public function sendMessage($to, $message)
    {
        $accessToken = 'caqr49RRa6SJ3a32vDw0oCGftHtJk3nG7U5ZYdzhjDT6HD59t4vLC58IJ2hpFWCsg1LF2SMhbbL1Rkf6uDHoQKoAtK5QopSmpXvgzqLIGA9IOUD9F9llpwZEe6BeM9bTeLq0UgiotZxYYYKbKL/kegdB04t89/1O/w1cDnyilFU=';
        $postData = array(
            'to' => [$to],
            "messages" => [
                [
                    "type" => "text",
                    "text" => $message
                ]
            ]
        );
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$accessToken
        );
        

        $response = $this->sendCURL($this->SEND_MESSAGE_URL, $header, 'post', $postData, true);
        return $response;
    }

    private function sendCURL($url, $header, $type, $data=NULL, $json=false) {
        $request = curl_init();

        if ($header != NULL) {
            curl_setopt($request, CURLOPT_HTTPHEADER, $header);
        }

        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_SSL_VERIFYHOST, $this->VERIFYHOST);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, $this->VERIFYPEER);

        if (strtoupper($type) === 'POST') {
            curl_setopt($request, CURLOPT_POST, TRUE);
            if($json) curl_setopt($request, CURLOPT_POSTFIELDS, \json_encode($data));
            else curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($request);
        return $response;
    }
}
