<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Talkroom;
use App\Models\User;
use App\Models\Profile;
use App\Models\Review;
use App\Models\Wallet;
use App\Models\ServiceHistory;
use App\Models\StaticText;

use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $service_list = Service::where('status', 1)->with('createdBy')->with('createdBy.profile')->orderBy('id', 'desc')->get();

        $data['service'] = $service_list;
        return view('top', $data);
    }
    
    public function top()
    {
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();
        $service_list = Service::where('status',1)
                        ->orderBy('total_amount_last_week','desc')
                        ->orderBy('No_of_sales_last_week','desc')
                        ->get();
        $category= Category::where('status', 1)->get();
        $users = User::select('id')->get();
        $serviceData=Service::where('status', 1)->get();
        $ratings = [];
        $ratingsSeller = [];
        $ratingCountSeller = [];
        $ratingCount = [];
        $seller_status = [];

        foreach($service_list as $service){
            $rating = Review::where('service_id', $service->id)->avg('rating');
            $rating = number_format($rating,1);
            $ratings[$service->id] = $rating;
        }
        foreach($users as $user){
            $ratingSeller = Review::where('seller_id', $user->id)->avg('rating');
            $ratingSeller = number_format($ratingSeller,1);
            $ratingsSeller[$user->id] = $ratingSeller;
        }

        foreach($users as $user){
            $ratingNumber = Review::where('seller_id', $user->id)->get()->count();
            //$ratingSeller = number_format($ratingSeller,1);
            $ratingCountSeller[$user->id] = $ratingNumber;
        }

        foreach($service_list as $service){
            $ratingNumber = Review::where('service_id', $service->id)->get()->count();
            //$ratingSeller = number_format($ratingSeller,1);
            $ratingCount[$service->id] = $ratingNumber;
        }

        foreach($users as $user){
            $seller_status[$user->id] = 0;
        }

        foreach($service_list as $service){
            $active = Talkroom::where('service_id', $service->id)->where('status', 2)->first();
            if($active){
                $seller_status[$active->seller_id] = 1;
                $seller_status[$active->buyer_id] = 1;
            }
        }

        $data = [
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
            'service' => $service_list,
            'category' => $category,
            'serviceData' => $serviceData,
            'ratings' => $ratings,
            'ratingsSeller' => $ratingsSeller,
            'ratingCount' => $ratingCount,
            'ratingCountSeller' => $ratingCountSeller,
            'seller_status' => $seller_status
        ];

        return view('top', $data);
    }

    public function contactUsAction(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:25',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contactUs = new ContactUs();
        $contactUs->name = $request->name;
        $contactUs->email = $request->email;
        $contactUs->message = $request->message;
        $contactUs->save();

        return redirect()->back()->with('success_message', 'Message successfull sent!');
    }

    public function serviceCategory(Request $request)
    {
        $service = Service::where('status', 1)->where('category_id', $request->id)->orderBy('created_at', 'desc')->get();
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();$category= Category::where('status', 1)->get();
        $data = [
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
            'service' => $service,
            'category' => $category,
        ];
        return view('top', $data);
    }

    public function search(Request $request)
    {
        $service_list = $this->service($request);
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();
        $category= Category::where('status', 1)->get();
        $users = User::select('id')->get();

        $serviceData=Service::where('status', 1)->get();

        $ratings = [];
        $ratingsSeller = [];
        $ratingCountSeller = [];
        $ratingCount = [];
        $seller_status = [];

        foreach($service_list as $service){
            $rating = Review::where('service_id', $service->id)->avg('rating');
            $rating = number_format($rating,1);
            $ratings[$service->id] = $rating;
        }
        foreach($users as $user){
            $ratingSeller = Review::where('seller_id', $user->id)->avg('rating');
            $ratingSeller = number_format($ratingSeller,1);
            $ratingsSeller[$user->id] = $ratingSeller;
        }

        
        foreach($users as $user){
            $ratingNumber = Review::where('seller_id', $user->id)->get()->count();
            //$ratingSeller = number_format($ratingSeller,1);
            $ratingCountSeller[$user->id] = $ratingNumber;
        }

        foreach($service_list as $service){
            $ratingNumber = Review::where('service_id', $service->id)->get()->count();
            //$ratingSeller = number_format($ratingSeller,1);
            $ratingCount[$service->id] = $ratingNumber;
        }

        foreach($users as $user){
            $seller_status[$user->id] = 0;
        }

        foreach($service_list as $service){
            $active = Talkroom::where('service_id', $service->id)->where('status', 2)->first();
            if($active){
                $seller_status[$active->seller_id] = 1;
                $seller_status[$active->buyer_id] = 1;
            }
        }

        $data = [
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
            'service' => $service_list,
            'category' => $category,
            'serviceData' => $serviceData,
            'ratings' => $ratings,
            'ratingsSeller' => $ratingsSeller,
            'pre_selected_cat_id' => $request->cat_id,
            'pre_selected_sort_id' => $request->sort_id,
            'ratingCount' => $ratingCount,
            'ratingCountSeller' => $ratingCountSeller,
            'seller_status' => $seller_status
        ];

    	return view('top', $data);
    }

    private function service($request)
    {
        $data = Service::where('status', 1)
            ->when($request->title, function ($query)use ($request) {
                return $query->when($request->cat_id, function ($query)use ($request) {
                                return $query->where('title', 'like', '%'.$request->title.'%')
                                    ->Where('category_id',$request->cat_id)
                                    ->orWhere('price','=', $request->title)
                                    ->orWhere('details','like', '%'.$request->title.'%')
                                        ->orWhereHas('createdBy',function($q)use($request){
                                            $q->where('name','like','%'.$request->title.'%')  
                                            ->orWhere('last_name','like','%'.$request->title.'%');
                                        })
                                    ->orderBy('total_amount_last_week','desc')
                                    ->orderBy('No_of_sales_last_week','desc');
                                }) 
                            ->where('title', 'like', '%'.$request->title.'%')
                            ->orWhere('price','=', $request->title)
                            ->orWhere('details','like', '%'.$request->title.'%')
                                ->orWhereHas('createdBy',function($q)use($request){
                                    $q->where('name','like','%'.$request->title.'%')  
                                    ->orWhere('last_name','like','%'.$request->title.'%');
                                })
                            ->orderBy('total_amount_last_week','desc')
                            ->orderBy('No_of_sales_last_week','desc');
            })
            ->when($request->cat_id, function ($query)use ($request) {
                return $query->Where('category_id',$request->cat_id);
            })
            ->when(($request->sort_id == 1), function ($query) {
                return $query->orderBy('total_amount_last_week','desc')
                            ->orderBy('No_of_sales_last_week','desc')
                            ->orderBy('created_at','desc');
            })
            ->when(($request->sort_id == 2) , function ($query) {
                return $query->orderBy('avg_review_rating','desc')
                            ->orderBy('total_no_of_review','desc');
            })
            ->when(($request->sort_id == 3), function ($query) {
                return $query->orderBy('recommendation')
                            ->orderBy('total_no_of_sales','desc')
                            ->orderBy('total_amount_of_sales','desc')
                            ->orderBy('avg_review_rating','desc');
            });
            
        
        $paginated_data = $data->paginate(9);
        $data = false;
        if($data){
            return new LengthAwarePaginator($data, $paginated_data->total(), $paginated_data->perPage());
        }
        return $paginated_data;
    }

    public function law()
    {
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();
        $stat = StaticText::find(1);
        $data = [
            'txt' => $stat->law,
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
        ];
        return view('stat-text', $data);
    }

    public function privacy()
    {
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();
        $stat = StaticText::find(1);
        $data = [
            'txt' => $stat->privacy,
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
        ];
        return view('stat-text', $data);
    }

    public function uguide()
    {
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();
        $stat = StaticText::find(1);
        $data = [
            'txt' => $stat->user_guide,
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
        ];
        return view('law', $data);
    }

    public function terms()
    {
        $id = isset(Auth::user()->id)?Auth::user()->id: 0;
        $personal = User::select('email', 'name', 'last_name', 'wallet_balance')->where('id', $id)->first();
        $prev = Profile::where('user_id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->get();
        $stat = StaticText::find(1);
        $data = [
            'txt' => $stat->terms,
            'personal' => $personal,
            'wallet' => $wallet,
            'profile' => $prev,
        ];
        return view('stat-text', $data);
    }
}

