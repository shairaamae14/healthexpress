<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Cook;
use App\Orders;
use App\OrderDetails;
use Illuminate\Http\Request;
use Auth;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('web')->check())
        {
            //if user ang ga log in
        $userLoc = Auth::user()->location;
        $cooks = Cook::where('location', $userLoc)->get();
         return view('user.menu', compact('cooks'));
        //dd($cooks);
        }
        else 
        {
            // if cook
        return view('cook.eorders');    
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCookDishes($id)
    {
        $cook = Cook::find($id);
        $dishes = Dish::where('cook_id', $id)->get();
        //dd($dishes);
        return view('user.dishes-cook', compact('dishes', 'cook'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::id();
        $date = Carbon\Carbon::now();
        // $orders = Orders::create(['user_id' => $user
        //             'order_date' => $date,
        //             'amount'=> ,
        //             'order_mode' => ,
        //             'status' => 'Pending']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        $id = Auth::id();
        if(Auth::guard('cook')->check())
        {
            // return view katong express orders
            $dish = Dish::where('cook_id', $id)->get();
            $order = OrderDetails::where('dish_id', $dish->id)->get();
            return view('cook.eorders', compact($order));
        }
        else {
            // return view sa user nga makakita siya sa iyang orders
            return view('dashboard'); //*new

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        if(Auth::guard('cook')->check())
        {
            // mailisan niya ang status 
            // return view katong pwede sha maka ilis status
            return view('cook.eorderstatus'); //*new
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         if(Auth::guard('cook')->check())
        {
            
            $order = Orders::where('id', $id)
                            ->where('user_id', $request->uid)
                            ->update(['status' => $request->status]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        // if ma cancel ang order pwede ra sguro diri
    }
}
