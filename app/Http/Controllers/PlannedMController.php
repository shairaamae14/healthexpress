<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\UserPlan;

use Illuminate\Support\Facades\Auth;

class PlannedMController extends Controller
{
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
//    	 $plans = Plans::all();
//    	 return view('user.plannedmeals', compact('plans'));
        
        return view('user.plannedmeals')->with(['plans' => Plan::get()]);
    }

    public function store(Request $request){
//    	  $id = Auth::id();
//
//    	  $userplan=UserPlan::create(['numberof' => $request['numberof'],
//						            'user_id' => $id,
//						            'plan_id' => $request['plan'],
//						            'date_started' =>\Carbon\Carbon::now('Asia/Manila')
//            ]);

    	 

    	return redirect()->route('user.plan.show');
    }

    public function show(){
//    	$id= Auth::id();
//    	$userplan=UserPlan::join('plans' , 'plans.plan_id', '=' , 'user_plan.plan_id')
//    					 ->where('user_id', $id)->get();
//    					 // dd($userplan);
//    	return view('user.plannedCalendar', compact('userplan'));

    }
}
