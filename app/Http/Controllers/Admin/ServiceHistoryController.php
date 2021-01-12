<?php

namespace App\Http\Controllers\Admin;
use App\Models\ServiceHistory;
use App\Http\Controllers\Controller;
use App\Models\Talkroom;

class ServiceHistoryController extends Controller
{
    public function index(){
        $talkrooms = Talkroom::where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('admin.service-history')->with([
            'talkrooms' => $talkrooms
        ]);
    }

    public function serviceDetails($id)
    {
        $talkroom = Talkroom::where('id', $id)->first();
        //return $talkroom;
        return view('admin.close-talkroom')->with([
            'talkroom' => $talkroom
        ]);
    }
}
