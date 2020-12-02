<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use App\Library\TimeLibrary;

class ReservationController extends Controller
{
    public function index(){
       
        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();
        //$reservations = Reservation::with('service')->get();
        $reservations = Reservation::orderBy('created_at','desc')->get();
        //dd($reservations);
        //return $reservations;
        return view('admin.reservation')->with([
            'reservations' => $reservations,
            'time_slot' => $time_slot
        ]);
    }

    // public function changeStatus(Request $request)
    // {
    //     $user_id = $request->id;
    //     $status = DB::table('users')->where('id', $user_id)->value('status');
    //     if($status == 1){
    //         DB::table('users')
    //           ->where('id', $user_id)
    //           ->update(['status' => 0]);
    //     }
    //     else{
    //         DB::table('users')
    //           ->where('id', $user_id)
    //           ->update(['status' => 1]);
    //     }
    //     return response("");
    // }
}
