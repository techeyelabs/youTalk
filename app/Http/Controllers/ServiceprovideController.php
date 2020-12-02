<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\User;
use App\Models\ServiceHistory;

use Image;
use Auth;

class ServiceprovideController extends Controller
{
    public function __construct()
    {
        
    }

    public function userDisplay(Request $request)
    {
        $service = Service::find($service_id);
        $total_cost = ($request->duration/60)*$service_price;
        $data = [
            'service_id' => $request->serviceId,
            'provider_id' => $request->sellerId,
            'receiver_id' => $request->buyerId,
            'seconds' => $request->duration,
            'total_amount' => ($request->duration/60)*$service->price,
            'providers_cut' => $total_cost*(80/100),
            'systems_cut' => $total_cost*(20/100),
        ];
        if(ServiceHistory::create($data))
            return 200;
        else 
            return 404;
    }
}
