<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserOrder;
use App\PlannedMeals;
use App\Cook;



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
        // $orders = UserOrder::all();
        // // $dishes = UserOrder::join('dishes','dishes.did','=','user_orders.dish_id')->get();
        // $oid    = UserOrder::join('orders','orders.id','=','user_orders.order_id')
        //                     ->join('order_mode', 'user_orders.order_id' , '=', 'order_mode.id')
        //                     ->get();

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
        
        // dd($orders);
        // $details = $details->merge($dishes)->merge($orders)->merge($oid);
        return view('dashboard',compact('page_title','orders','dishes','oid'));
    }

    public function showOrders()
    {
        // $orders = UserOrder::all();
        
        // Dish::join('dish_besteaten','dish_besteaten.dish_id', '=', 'dishes.did')
        //                     ->join('besteaten_at', 'besteaten_at.be_id' , '=', 'dish_besteaten.be_id')
        //                     ->get();
        return view('cook.cook',compact('dishes', 'oid'));

    }

    // public function showOrderDet(){
    //     return  view('cook.vieweorder');

    //  }
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
        $orders = UserOrder::all();
        return view('cook.eorders', compact('orders'));
    }


    public function showOrderDet()
    {
        return view('cook.vieweorder');
    }

    public function changeAvailabilityStat(Request $request) {
        $cid  = Auth::id();
        $status = $request['availability'];
        // $status = $request->input('status');
        $cook = Cook::where('id',  $cid)->update(['cook_status' => $status]);

        return response()->json(['data'=>$cook]);
    }

    public function fetch(Request $request){
        $fetch = PlannedMeals::join('dishes','planned_meals.dish_id', '=', 'dishes.did')
                            ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                            ->join('users', 'planned_meals.user_id', '=', 'users.id')
                            ->join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->join('order_mode', 'planned_meals.om_id', '=', 'order_mode.id')
                            ->where('order_status', 'ordered')
                            ->distinct()
                            ->get(['fname','lname','om_name','user_id','note']);
                            // dd($fetch);


        return view('cook.planned', compact('fetch'));
    }

    public function showPlanOrders($id, $planid){

        $meals = PlannedMeals::join('dishes','planned_meals.dish_id', '=', 'dishes.did')
                            ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                            ->join('users', 'planned_meals.user_id', '=', 'users.id')
                            ->join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->join('plans', 'planned_meals.plan_id', '=', 'plans.id')
                            ->join('order_mode', 'planned_meals.om_id', '=', 'order_mode.id')
                            ->where('user_id', $id)
                            ->where('plan_id', $planid)
                            ->where('order_status', 'ordered')
                            ->get();


      return view('cook.userplans', compact('meals'));
    }


     public function cookviewrating(){
        $cid  = Auth::id();
    $cookrev=Cook::where('id', $cid)->get();
    // dd($cookrev);        

    return view('cook.cookreviews', compact('cookrev'));
   }

}
