<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Linehook;

class LineController extends Controller
{
    public function webhook(Request $request)
    {
        $prev = Linehook::where('user_id', 39)->first();
        $prev->line_user_id = "i am here";
        $prev->save();
    }
}
