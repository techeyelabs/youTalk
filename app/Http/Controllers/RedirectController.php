<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function success(Request $request)
    {
    	return redirect()->route('my-wallet')->with('status', '決済完了しました！');
    }

    public function fail(Request $request)
    {
        return redirect()->route('add-wallet')->with('status', '決済失敗しました！');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('add-wallet')->with('status', '決済キャンセルされました！');
    }
}
