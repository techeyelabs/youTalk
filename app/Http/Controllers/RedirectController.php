<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function success(Request $request)
    {
    	return redirect()->route('my-wallet')->with('status', 'Payment Successfully Done.');
    }

    public function fail(Request $request)
    {
        return redirect()->route('add-wallet')->with('status', 'Sorry, Payment Failed! Please Try Again.');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('add-wallet')->with('status', 'Payment Cancelled');
    }
}
