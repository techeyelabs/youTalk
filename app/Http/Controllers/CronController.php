<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\Talkroom;
use App\Models\Review;

use App\Library\TimeLibrary;

use Illuminate\Http\Request;

class CronController extends Controller
{
    public function __construct()
    {
        
    }

    public function sortingCron()
    {
        //Testing Time Slot Library
        $time_slot_array = new TimeLibrary();
        $time_slot =  $time_slot_array->TimeLibrary();
       // dd($time_slot);

        //Cron test
        $test = Talkroom::where('id', 48)->first();
        $test->duration = 200;
        $test->save();


        $serviceList = Service::select('id')->where('status', 1)->get();
        foreach($serviceList as $sl){
            $id = $sl->id;

            //last week total amount by service id 

            $total_amount_last_week = Talkroom::where('service_id', $id)
                                                ->where('created_at', '>=', Carbon::now()->subDays(7)->toDateTimeString())
                                                ->sum('cost');

            $service_prev = Service::find($id);
            $service_prev->total_amount_last_week = $total_amount_last_week;
            $service_prev->save();

            //last week total sell by service id 

            $total_sell_last_week = Talkroom::where('service_id', $id)
                                                ->where('created_at', '>=', Carbon::now()->subDays(7)->toDateTimeString())
                                                ->count('service_id');

            $service_prev_sell = Service::find($id);
            $service_prev_sell->No_of_sales_last_week = $total_sell_last_week;
            $service_prev_sell->save();

            //total no of review by service id 

            $total_no_review_rating = Review::where('service_id', $id)
                                                ->count('service_id');
                                               
            $service_total_review = Service::find($id);
            $service_total_review->total_no_of_review = $total_no_review_rating;
            $service_total_review->save();


            // Avarage review by service id 

            $total_review_rating = Review::where('service_id',$sl->id)
                                            ->sum('rating');
            if($total_review_rating == 0 || $total_no_review_rating == 0){
                $avg_review = 0;                
            } else {
                $avg_review = $total_review_rating/$total_no_review_rating;
            }
            $service_avg_review = Service::find($id);
            $service_avg_review->avg_review_rating = $avg_review;
            $service_avg_review->save();

            // Total amount by service id 

            $total_amount = Talkroom::where('service_id',$sl->id)
                                            ->sum('cost');
          
            $service_total_amount = Service::find($id);
            $service_total_amount->total_amount_of_sales = $total_amount;
            $service_total_amount->save();

            // Total sell by service id 

            $total_sell = Talkroom::where('service_id',$sl->id)
                                            ->count('cost');
          
            $service_total_sell = Service::find($id);
            $service_total_sell->total_no_of_sales = $total_sell;
            $service_total_sell->save();







            // $total_no_review_rating = Review::where('service_id',$sl->id)
            //                                 ->selectRaw('count(service_id) as service')
            //                                 ->orderBy('service', 'desc')
            //                                 ->get();
            // // $avarage_review_rating = avg($total_no_review_rating);
            // $total_amount = Service::whereHas('talkRoom',function($q){
            //                                         $q->groupBy('service_id')
            //                                         ->selectRaw('count(cost) as service')
            //                                         ->orderBy('service', 'desc');;
            //                                     })->get();
            // $total_sells = Service::whereHas('talkRoom',function($q){
            //                                         $q->groupBy('service_id')
            //                                         ->selectRaw('count(service_id) as service')
            //                                         ->orderBy('service', 'desc');
            //                                     })->get();
            
            // dd($total_no_review_rating);
            // echo $total_amount;
            // echo '<br/>';
        }
        $data = [
            'status' => 200
        ];
        return response()->json($data);
    }
}
