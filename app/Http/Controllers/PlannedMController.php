<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\UserPlan;
use App\Dish;
use App\BestEaten;
use App\Event;
use Calendar;

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
    public function index(Request $request){
//       $plans = Plans::all();
//       return view('user.plannedmeals', compact('plans'));

        $events = [];
        $data = Event::all();
        if($data->count()){
          foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                $value->title,
                false,
                // new \DateTime($value->start_date),
                $value->start_date,
                // new \DateTime($value->end_date.' +1 day')
                $value->end_date
            );
          }
       }
        $calendar = Calendar::addEvents($events);
        $breakfast = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 1)
                            ->get();
         $lunch = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 2)
                            ->get();
         $dinner = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 3)
                            ->get();
       $besteaten= BestEaten::all();

        $type = $request['type'];
        // $cal=json_encode($dinner);

        // dd($cal);
        return view('user.pmeals', compact('breakfast', 'lunch', 'dinner', 'besteaten', 'type', 'calendar'))->with(['plans' => Plan::get(), 'cal'=> response()->json($dinner)]);
    }

    public function index1(){
        return view('user.initialpm');
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

    public function showCalendar(){
        return view('user.planCalendar');

    }

    public function storeEvent(Request $request){
          $id = Auth::id();
         $events = Event::create(['user_id' => $id,
                               'dish_id' => $request['dish_id'],
                              'name'=> $request['dish_name'],
                              'type' => $request['type'],
                              'start_date' => $request['start'],
                              'end_date' => $request['end_date']
                         ]);
    }
}
