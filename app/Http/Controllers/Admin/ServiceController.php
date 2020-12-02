<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Review;
use App\Models\Talkroom;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::orderBy('id','desc')->get();

        $recommendation_count = Service::where('recommendation', '>', 0)->get()->count();
        $recommendations = Service::where('recommendation', '>', 0)->get();
        //return $recommendation_count;

        $array = [1,2,3];
        foreach($recommendations as $data){
            //$array = \array_diff($array, [$data->recommendation]);
            $temp = $data->recommendation;
            for($j = 0 ; $j < sizeof($array) ; ++$j){
                if($array[$j] == $temp){
                    array_splice($array, $j, 1);
                }
            }
            
        }

        

        //return $array;
        // $arr = array( 
        //     '1', // [0] 
        //     '2', // [1] 
        //     '3' // [2] 
        // );
        // $arr2 = [1,2,3];

        // array_splice($arr2, 1, 1);

        // return $arr2;

        return view('admin.service')->with([
            'services' => $services,
            'recom_count' => $recommendation_count,
            'recom_free' => $array
        ]);
    }

    public function changeStatus(Request $request){
        $service_id = $request->id;
        $status = DB::table('services')->where('id', $service_id)->value('status');
        if($status == 1){
            DB::table('services')
              ->where('id', $service_id)
              ->update(['status' => 0]);
        }
        else{
            DB::table('services')
              ->where('id', $service_id)
              ->update(['status' => 1]);
        }
        return response("");
        
        
    }

    public function categoryIndex()
    {
        $categories = Category::get();
        return view('admin.category')->with([
            'categories' => $categories
        ]);
    }

    public function addCategory()
    {
        return view('admin.add-category');
    }

    public function storeCategory(Request $request)
    {
        //return $request;

        $this->validate($request, array(
            'category' => 'required',
        ));

        $category = new Category;

        $category->cat_name = $request->category;
        $category->save();

        //redirecting to categorylist 
        return redirect()->route('service-category-list')->with([
            'message' => [
                'status'    => 'alert-success',
                'text'      => 'Successfully created new category.'
            ]
        ]);
    }

    public function categoryEdit($cat_id)
    {
        $category = Category::where('id', $cat_id)->first();

        return view('admin.edit-category')->with([
            'category' => $category
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        //return $request;

        $this->validate($request, array(
            'category' => 'required',
        ));

        $category =  Category::where('id', $id)-> first();

        $category->cat_name = $request->category;
        $category->save();

        //redirecting to categorylist 
        return redirect()->route('service-category-list')->with([
            'message' => [
                'status'    => 'alert-success',
                'text'      => 'Successfully updated category.'
            ]
        ]);

    }

    public function addRecommendation(Request $request)
    {
        //dd($request);
        $service = Service::where('id', $request->service_id)->first();
        $service->recommendation = $request->recom_serial;
        $service->save();
    }

    public function removeRecommendation(Request $request)
    {
        $service = Service::where('id', $request->service_id)->first();
        $service->recommendation = 0;
        $service->save();
    }

    public function serviceDetails($id)
    {
        $service = Service::with('createdBy')->with('createdBy.profile')->with('faqs')->where('id', $id)->first();

        $reviews = Review::where('seller_id', $service->seller_id)->where('service_id', $id)->get();
        $avg_rating = Review::where('seller_id', $service->seller_id)->where('service_id', $id)->avg('rating');
        $avg_rating = number_format($avg_rating,1);
        $total_ratings = $reviews->count();
        $service_data = Service::find($id);
        $call_possible_seller = 0;
        $call_possible_buyer = 0;
        $call_possible_seller = Talkroom::where('status', 2)
                                        ->where(function($query) use ($service){
                                            $query->where('seller_id', $service->seller_id)->orWhere('buyer_id', $service->seller_id);
                                        }) 
                                        ->count();
            
        $data = [
            'service' => $service,
            'reviews' => $reviews,
            'avg_rating' => $avg_rating,
            'total_ratings' => $total_ratings,
            'call_possible_seller' =>$call_possible_seller
        ];

        return view('admin.service-details', $data);
    }
}

