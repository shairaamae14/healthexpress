<?php

namespace App\Http\Controllers;

use App\Orders;
use App\UserOrder;
use Illuminate\Http\Request;
use Auth;
use App\OrderMode;
use App\PaymentMethod;
use Cart;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request){
        $option = $request->option;
        if($option == 'Delivery') {
            $service = $option;
        }
        else {
            $service = $option;
        }
        return view('user.paymentmethod', compact('option'));
    }   
    
    public function index()
    {
        return view('user.paymentmethod');
        
    }

    
    public function order(Request $request) {
        $order = new Order();
        $order->m_id = $request['mode_id'];
        $order->save();
        
        return $order;
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
//        dd($request);
//        $mode = OrderMode::create(['om_name' => 'Express Meal']);
        $order= Orders::create(['om_id' => 1]);
        $status = 'Pending';
        if($request['payment_mode'] == 'COD') {
            for ($index = 0; $index < count($request->dish); $index++) {
                $details = UserOrder::create(['user_id' => $user,
                'order_id' => $order->id,
                'dish_id' => $request['dish'][$index],
                'payment_id' => 1,
                'order_date' => $request['order_date'],
                'totalQty' => $request['qty'][$index],
                'totalAmount' => $request['total'][$index],
                'order_status' => $status
                
            ]); 
            }
        }
        Cart::destroy();
        return redirect()->route('user.home');
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
