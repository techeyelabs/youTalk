<?php

namespace App\Cron;
use App\Models\User;
use App\Models\Talkroom;
use App\Models\Reservation;
use DateTime;

use App\Library\TimeLibrary;


class CronClass
{
    public function __construct()
    {

    }
    public function runningTalkroomClose()
    {
        // $time_slot = [
        //     '12' => '00:00:00',
        //     '1' => '01:00:00',
        //     '2' => '02:00:00',
        //     '3' => '03:00:00',
        //     '4' => '04:00:00',
        //     '5' => '05:00:00',
        //     '6' => '06:00:00',
        //     '7' => '07:00:00',
        //     '8' => '08:00:00',
        //     '9' => '09:00:00',
        //     '10' => '10:00:00',
        //     '11' => '11:00:00',
        //     '12' => '12:00:00',
        //     '13' => '13:00:00',
        //     '14' => '14:00:00',
        //     '15' => '15:00:00',
        //     '16' => '16:00:00',
        //     '17' => '17:00:00',
        //     '18' => '18:00:00',
        //     '19' => '19:00:00',
        //     '20' => '20:00:00',
        //     '21' => '21:00:00',
        //     '22' => '22:00:00',
        //     '23' => '23:00:00'
        // ];

        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();

        $res_dateTime = [];
        $active_talkrooms = Talkroom::where('status', 2)->get();

        foreach($active_talkrooms as $data){
            $seller_id = $data->seller_id;
            $buyer_id = $data->buyer_id;

            $buyer_as_reserver = Reservation::where('reserver_id', $buyer_id)->where('status', 2)->get();
            foreach($buyer_as_reserver as $data){
                $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];
                array_push($res_dateTime, $temp_dateTime); 
            }

            $seller_as_reserver = Reservation::where('reserver_id', $seller_id)->where('status', 2)->get();
            foreach($seller_as_reserver as $data){
                $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];
                array_push($res_dateTime, $temp_dateTime); 
            }

            $buyer_as_seller = Reservation::where('seller_id', $buyer_id)->where('status', 2)->get();
            foreach($buyer_as_seller as $data){
                $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];
                array_push($res_dateTime, $temp_dateTime); 
            }

            $seller_as_seller = Reservation::where('seller_id', $seller_id)->where('status', 2)->get();
            foreach($seller_as_seller as $data){
                $temp_dateTime = $data->acceptedSlot->day." ".$time_slot[$data->acceptedSlot->slot];
                array_push($res_dateTime, $temp_dateTime); 
            }

            $len = sizeof($res_dateTime);
            for($i = 0 ; $i < $len; ++$i){
                for($j = 0; $j < $len - $i - 1 ; ++$j){
                    $val1 = $res_dateTime[$j];
                    $val2 = $res_dateTime[$j+1];

                    $datetime1 = new DateTime($val1);
                    $datetime2 = new DateTime($val2);

                    if($datetime1 > $datetime2){
                        $temp = $res_dateTime[$j];
                        $res_dateTime[$j] = $res_dateTime[$j+1];
                        $res_dateTime[$j+1] = $temp;
                    }
                }
            }

            $latest_reservation = $res_dateTime[0];
            $final_time = date("Y-m-d H:i:s", strtotime("-10 minutes", strtotime($latest_reservation)));

            //getting current timedate
            date_default_timezone_set("Asia/Dhaka");
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $now = $date. " " .$time;

            $date_latest = new DateTime($final_time);
            $date_now = new DateTime($now);

            if($date_now > $date_latest){
                $data->status = 1;
                $data->save();
            }
            
            $res_dateTime = [];
        }

    }

}


