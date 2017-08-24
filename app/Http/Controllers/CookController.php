<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('dashboard');
    }

    public function showOrders()
    {
        return view('cook.cook');
    }

    // public function showOrderDet(){
    //     return  view('cook.vieweorder');

    //  }
     public function showDishes()
    
    {
        return view('cook.dishes');
    }

      public function changeOrderStats()
    {
        return view('cook.eorderstatus');
    }

       public function showExOrders()
    {
        return view('cook.eorders');
    }


        public function showOrderDet(){
            return view('cook.vieweorder');
        }


}
