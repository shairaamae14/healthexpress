<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\UserPlan;
use App\Dish;
use App\BestEaten;
use App\PlannedMeals;
use Calendar;
use mysql_fetch_array;

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

        // $events = [];
        // $data = PlannedMeals::all();
        // if($data->count()){
          // foreach ($data as $key => $value) {
          //   $events[] = Calendar::event(
          //       $value->title,
          //       false,
          //       // new \DateTime($value->start_date),
          //       $value->start_time,
          //       // new \DateTime($value->end_date.' +1 day')
          //       $value->end_time
          //   );
          // }
       // }
        $breakfast = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 1)->take(3)
                            ->get();
         $lunch = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 2)->take(3)
                            ->get();
         $dinner = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 3)->take(3)
                            ->get();
       $besteaten= BestEaten::all();
       $type = $request['type'];
       if($type == 'daily')
        $typeno = 1;
       else if($type == 'weekly')
        $typeno = 2;
       else
        $typeno = 3;
        
        // $cal=json_encode($dinner);

        // dd($cal);
        return view('user.pmeals', compact('breakfast', 'lunch', 'dinner', 'besteaten', 'typeno', 'calendar'))->with(['plans' => Plan::get(), 'cal'=> response()->json($dinner)]);
    }

    public function index1(){
        return view('user.initialpm');
    }

    public function store(Request $request){
//        $id = Auth::id();
//
//        $userplan=UserPlan::create(['numberof' => $request['numberof'],
//                        'user_id' => $id,
//                        'plan_id' => $request['plan'],
//                        'date_started' =>\Carbon\Carbon::now('Asia/Manila')
//            ]);

       

      return redirect()->route('user.plan.show');
    }

    public function showCalendar(){
        return view('user.planCalendar');

    }

    public function storePlans(Request $request){
        $id = Auth::id();
        $events = PlannedMeals::create(['title' => $request['title'],
                                        'user_id' => $id,
                                        'om_id' => $request['om_id'],
                                        'dish_id' => $request['dish_id'],
                                        'be_id'=> $request['be_id'],
                                        'plan_id' => $request['plan_id'],
                                        'start' => $request['start'],
                                        'end' => $request['end'],
                                        'allDay' => false
        ]);
        return response()->json(['data'=>$events]);
        

    }

    public function resetDate(Request $request){
      $title = $request['title'];
      $startdate = $request['start'];
      $enddate = $request['end'];
      $eventid = $request['eventid'];
      // dd($title);

      $update = PlannedMeals::where('id',$eventid)
                      ->update(['title'=>$title, 
                                'start'=>$startdate,
                                'end'=>$enddate
                      ]);
      if($update)
        return response()->json(['status'=>'success']);
      else
        return response()->json(['status'=>'failed']);
    }

    public function fetchPlans(Request $request){

        $events = array();
        $query = PlannedMeals::select('id', 'title', 'start', 'end', 'allDay')->get();

        
        // while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC))
        // {
        //  $e = array();
        //     $e['id'] = $fetch['id'];
        //     $e['title'] = $fetch['title'];
        //     $e['start'] = $fetch['start_time'];
        //     $e['end'] = $fetch['end_time'];

        //     $allday = ($fetch['allDay'] == "true") ? true : false;
        //     $e['allDay'] = $allday;

        //     array_push($events, $e);
        // }
        // echo json_encode($events);
        // echo reponse()->json($query);
        return $query->toJson();
        // return response()->json($query);
    }





}
