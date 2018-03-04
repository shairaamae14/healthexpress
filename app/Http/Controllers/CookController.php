<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserOrder;
use App\PlannedMeals;
use App\Cook;
use App\Orders;
use App\User;
use App\CookRating;
use App\CookAverage;

class CookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:cook');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $cid  = Auth::id();
        if($request->input('chooseStatus') == 'Completed')
        $page_title = "Completed Orders";
        else if($request->input('chooseStatus') == 'Pending')
        $page_title = "Pending Orders";
        else if($request->input('chooseStatus') == 'Cooking')
        $page_title = "Cooking Orders";
        else if($request->input('chooseStatus') == 'Delivering')
        $page_title = "Delivering Orders";
        else
        $page_title = "All Express Orders";
        if(!$request->input('chooseStatus'))
        {
           $orders = UserOrder::groupBy('user_id', 'order_date')->orderBy('user_orders.order_date', 'desc')->get(); 
           
        }
        else
        {
            if($request->input('chooseStatus') == 'All')
            {
            $orders = UserOrder::groupBy('user_id', 'order_date')->orderBy('user_orders.order_date', 'desc')->get(); 
            }
            else if($request->input('chooseStatus')) {
            $orders = UserOrder::where('user_orders.order_status', $request->input('chooseStatus'))->groupBy('order_date')->orderBy('user_orders.order_date', 'desc')->get(); 
            }
        }

        $sales = UserOrder::whereHas('dishes', function($query) use($cid) {
                $query->where('authorCook_id', $cid); 
        })->where('order_status', 'Completed')->sum('totalAmount');
        $pendingem = UserOrder::whereHas('dishes', function($query) use($cid) {
                $query->where('authorCook_id', $cid);
                $query->where('om_id', 1); 
        })->where('order_status', 'Pending')->get();
        $pendingpm = UserOrder::whereHas('dishes', function($query) use($cid) {
                $query->where('authorCook_id', $cid);
                $query->where('om_id', 2); 
        })->where('order_status', 'Pending')->get();
        $temp = UserOrder::all();

        return view('dashboard',compact('page_title','orders','dishes','oid','sales','pendingem','pendingpm'));
    }

    public function showOrders()
    {
        return view('cook.cook',compact('dishes', 'oid'));

    }

     public function showDishes()
    
    {
        return view('cook.dishes');
    }

      public function changeOrderStats(Request $request)
    {
        $id = $request['id'];
        $status = $request['status'];
        $order = UserOrder::where('uo_id', $id)->update(['order_status'=>$status]);

        return response()->json(['data'=>$order]);
    }

    public function showExOrders()
    {
        $orders = UserOrder::where('om_id',1)->get();
        return view('cook.eorders', compact('orders'));
    }


    public function showOrderDet()
    {
        return view('cook.vieweorder');
    }

    public function changeAvailabilityStat(Request $request) {
        $cid  = Auth::id();
        $status = $request['data'];
        if($status=="Accept Orders"){
            $status="Accepting";
        }
        else{
             $status="NotAccepting";
        }

        // $status = $request->input('status');
        $cook = Cook::where('id',  $cid)->update(['cook_status' => $status]);

        return response()->json(['data'=>$cook]);
    }
    public function fetchCookStats(){
        $cid  = Auth::id();
        $cook=Cook::where('id', $cid)->get("cook_status");
        if($cook=="Accepting"){
            $status="Accept Orders";
        }
        else{
            $status="Not Accepting";
        }
          return $status;
    }

    public function fetch(Request $request){
        $fetch = UserOrder::join('dishes','user_orders.dish_id', '=', 'dishes.did')
                            ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                            ->join('users', 'user_orders.user_id', '=', 'users.id')
                            ->join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->join('order_mode', 'user_orders.om_id', '=', 'order_mode.id')
                            ->where('order_status', 'Pending')
                            ->where('om_id',2)
                            ->distinct()
                            ->get(['fname','lname','om_name','user_id','sidenote']);

        return view('cook.planned', compact('fetch'));
    }

    public function showPlanOrders($id){

        $meals = UserOrder::join('dishes','user_orders.dish_id', '=', 'dishes.did')
                            ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                            ->join('users', 'user_orders.user_id', '=', 'users.id')
                            ->join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->join('order_mode', 'user_orders.om_id', '=', 'order_mode.id')
                            ->where('user_id', $id)
                            ->where('om_id', 2)
                            ->where('order_status', 'NOT LIKE', 'Initial')
                            ->get();


      return view('cook.userplans', compact('meals'));
    }


     public function cookviewrating(){
        $cid  = Auth::id();

              $ratings = CookRating::join('user_orders', 'user_orders.uo_id', '=', 'cook_ratings.uorder_id')
                        ->join('users', 'users.id', '=', 'user_orders.user_id')
                        ->join('dishes', 'dishes.did', '=', 'user_orders.dish_id')
                        ->join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                        ->where('authorCook_id', $cid)
                        ->paginate(5);
   
            $avgrate=CookAverage::where('cook_id', $cid)->get();
                 // dd($avgrate);

    //     $cookrev = CookRating::join('user_orders', 'user_orders.uo_id', '=', 'cook_ratings.uorder_id')
    //                     ->join('dishes', 'dishes.did', '=', 'user_orders.dish_id')
    //                      ->join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
    //                     ->where('authorCook_id', $cid)
    //                     ->paginate(5);
   
    //         $avgrate=CookAverage::join('cook_ratings', 'cook_ratings.id', '=', 'cookrating_avg.cr_id')
    //                     ->join('user_orders', 'user_orders.uo_id', '=', 'cook_ratings.uorder_id')
    //                     ->join('dishes', 'dishes.did', '=', 'user_orders.dish_id')
    //                     ->join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
    //                     ->where('authorCook_id', $cid)
    //                     ->get();
    // // dd($cookrev);        

    return view('cook.cookreviews', compact('ratings', 'avgrate'));
   }

   public function showProfile($cook) 
   {
    return view('cook.cook-profile');
   }
}
