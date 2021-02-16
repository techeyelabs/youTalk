<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TestController extends Controller
{
    public function index(Request $request)
    {
    	$LineController = new LineController();
        $response = $LineController->sendMessage(Auth::user()->line_user_id, 'How are you doing'.time());
        // $response = $LineController->sendMessage('Ube69f0a19f7e64868f5131875346a185', 'How are you doing');
        dd($response);
    }
}
