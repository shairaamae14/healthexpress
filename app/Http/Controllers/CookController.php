<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserOrder;


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
    public function index()
    {   
        // $orders = UserOrder::all();
        // // $dishes = UserOrder::join('dishes','dishes.did','=','user_orders.dish_id')->get();
        // $oid    = UserOrder::join('orders','orders.id','=','user_orders.order_id')
        //                     ->join('order_mode', 'user_orders.order_id' , '=', 'order_mode.id')
        //                     ->get();

        $cid  = Auth::id();

        $dishes=UserOrder::join('dishes' , 'dishes.did', '=' , 'user_orders.dish_id')
                ->join('orders', 'orders.id', '=', 'user_orders.order_id')
                ->join('order_mode', 'order_mode.id', '=', 'orders.om_id')
                ->join('users', 'users.id', '=', 'user_orders.user_id')
                ->join('user_allergens', 'user_allergens.user_id', '=', 'users.id')
                ->join('allergens', 'allergens.allergen_id', '=', 'user_allergens.allergen_id')
                ->join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                ->where('cooks.id', $cid)
                ->get();

        // $details = $details->merge($dishes)->merge($orders)->merge($oid);
        return view('dashboard',compact('orders','dishes','oid'));
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
        // $ids = UserOrder::find($id);
        $status = $request['status'];
        $order = UserOrder::where('uo_id', $id)->update(['order_status'=>$status]);

        return response()->json(['data'=>$order]);
        // return view('cook.eorderstatus');
    }

    public function showExOrders()
    {
        return view('cook.eorders');
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


}
