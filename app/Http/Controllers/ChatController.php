<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    public function __construct()
    {
    	// code here
    }

    public function index(Request $request)
    {
    	return view('chat.index');
    }
}
