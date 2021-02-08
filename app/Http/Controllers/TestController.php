<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TestController extends Controller
{
    public function index(Request $request)
    {
    	$LineController = new LineController();
        $LineController->sendMessage(Auth::user()->line_user_id, 'How are you doing');
    }
}
