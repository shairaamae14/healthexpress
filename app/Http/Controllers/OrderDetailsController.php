<?php

namespace App\Http\Controllers;

use App\OrderDetails;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $odetails = OrderDetails::create(['order_id' =>,
                    'dish_id' => ,
                    'payment_method' =>,
                    'delivery charge' => ,
                    'quantity' => ,
                    'total_amount' => ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderDetails  $orderDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $odetails = OrderDetails::where('order_id', $id)->get();
        $dish = Dish::where('dish_id', )
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderDetails  $orderDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetails  $orderDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if in case naay addtl delivery charge fee
        // calculate dayon sa total amount
        // update
        $odetails = OrderDetails::where('order_id', $id)
                                -> update(['delivery_charge' => ,
                                           'total_amount' => ])
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDetails  $orderDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetails $orderDetails)
    {
        //
    }
}
