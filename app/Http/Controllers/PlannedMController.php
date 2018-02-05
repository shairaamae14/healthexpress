<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\UserPlan;
use App\Dish;
use App\BestEaten;
use App\PlannedMeals;
use App\NutritionFacts;
use Braintree_ClientToken;
use Braintree_Transaction;
use Braintree_CreditCard;
use Braintree_Customer;
use Calendar;
use mysql_fetch_array;
use Carbon;

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
        $id = Auth::id();

        //show nutritional facts of dishes
        $dishes = PlannedMeals::join('dishes', 'planned_meals.dish_id', '=', 'dishes.did')
                                  ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                                  ->join('dish_besteaten', 'dishes.did', '=', 'dish_besteaten.dish_id')
                                  ->join('besteaten_at', 'dish_besteaten.be_id', '=', 'besteaten_at.be_id')
                                  ->join('nutritional_facts', 'dishes.did', '=', 'nutritional_facts.ding_id')
                                  ->where('user_id',$id)
                                  ->get();

        //dishes for breakfast
        $breakfast = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 1)->take(3)
                            ->get();

        //dishes for lunch
        $lunch = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 2)->take(4)
                            ->get();

        //dishes for dinner
        $dinner = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 3)->take(3)
                            ->get();

        //all dishes
        $betype = PlannedMeals::join('dishes','planned_meals.dish_id', '=', 'dishes.did')
                            ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                            ->join('users', 'planned_meals.user_id', '=', 'users.id')
                            ->join('plans', 'planned_meals.plan_id', '=', 'plans.id')
                            ->join('order_mode', 'planned_meals.om_id', '=', 'order_mode.id')
                            ->get();

       //get all besteaten
       $besteaten= BestEaten::all();

       $type = $request['type'];
       if($type == 'daily')
        $typeno = 1;
       else if($type == 'weekly')
        $typeno = 2;
       else
        $typeno = 3;
       
        return view('user.pmeals', compact('breakfast', 'lunch', 'dinner', 'besteaten', 'typeno', 'calendar', 'dishes', 'betype'))->with(['plans' => Plan::get(), 'cal'=> response()->json($dinner)]);
    }

    public function index1(){
      $id = Auth::id();
      $plans = PlannedMeals::where('user_id', $id)->get();
      $iteration = FALSE;
      // dd($plans);
      if(count($plans)>0){
        foreach($plans as $plan){
          $result = explode("T",$plan->end);
          if(strtotime($result[0]) > strtotime(date("Y-m-d")))
          {
            $iteration = TRUE;
            if($iteration == TRUE)
              return redirect()->route('user.plan.index');
          }
          return view('user.initialpm');
        }
      }
      else
        return view('user.initialpm');

    }

    public function store(Request $request){       
      return redirect()->route('user.plan.show');
    }

    public function showCalendar(){
        return view('user.planCalendar');
    }

    public function storePlans(Request $request){
        $id = Auth::id();
        $events = PlannedMeals::create([
                                        'title' => $request['title'],
                                        'user_id' => $id,
                                        'om_id' => $request['om_id'],
                                        'dish_id' => $request['dish_id'],
                                        'be_id'=> $request['be_id'],
                                        'plan_id' => $request['plan_id'],
                                        'p_status' => 'Pending',
                                        'start' => $request['start'],
                                        'end' => $request['end'],
                                        'allDay' => 'false',
                                        'order_status' => 'not'
        ]);
        return response()->json(['data'=>$events]);     
    }

    public function resetDate(Request $request){
      $title = $request['title'];
      $startdate = $request['start'];
      $enddate = $request['end'];
      $eventid = $request['id'];

      $update = PlannedMeals::where('pm_id',$eventid)
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

        $id=Auth::id();
        $events = array();
        $query = PlannedMeals::where('user_id', $id)
                            ->where('p_status', 'Pending')
                            
                            ->select('pm_id', 'title', 'dish_id', 'start', 'end', 'allDay')->get();

        return $query->toJson();
    }

    public function deletePlan(Request $request){
      $id = $request['id'];

      $delete = PlannedMeals::where('pm_id', $id)->delete();
                             
      if($delete)
        return response()->json(['status'=>'success']);
      else
        return response()->json(['status'=>'failed']);
    }

    public function addNote(Request $request){
      $id = $request['eventid'];
      $note = $request['note'];

      $update = PlannedMeals::where('pm_id', $id)
                            ->update(['note'=>$note]);
      if($update)
        return response()->json(['status'=>'success']);
      else
        return response()->json(['status'=>'failed']);

    }

    public function summary(){
      $id = Auth::id();
      $data = PlannedMeals::join('dishes','planned_meals.dish_id', '=', 'dishes.did')
                            ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                            ->join('users', 'planned_meals.user_id', '=', 'users.id')
                            ->join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->join('plans', 'planned_meals.plan_id', '=', 'plans.id')
                            ->join('order_mode', 'planned_meals.om_id', '=', 'order_mode.id')
                            ->where('user_id', $id)
                            ->where('p_status', 'Pending')
                            ->where('order_status', 'not')
                            ->get();

      return view('user.summary', compact('data'));
    }
    public function modeOfDelivery(){
      return view('user.modeofdel');
    }
    
    
    public function updatePm(Request $request){
      $pm_id=$request['pm_id'];
      $distance=7; //static
      $delcharge=40.00;
      if($distance>5){
        $delcharge=40+2.50*($distance-5);
      }
      if($request['mode']=="Delivery"){
        $address=$request['d_address'];
        $lat=$request['cityLat'];
        $long=$request['cityLng'];
       // dd($lat, $long, $address);     
      }
      else if($request['mode']=="Pickup"){
        $address=$request['p_address'];
         $lat=$request['cityLatp'];
        $long=$request['cityLngp'];
      }
       
      $pm=PlannedMeals::where('pm_id', $pm_id)
                        ->update(['note'=>$request['spec'],
                                  'mode_delivery'=>$request['mode'],
                                  'address'=>$address,
                                  'pm_longitude'=>$long,
                                  'pm_latitude'=>$lat,
                                  'contact_no'=>$request['contactnum'],
                                  'distance'=>$distance,
                                  'del_charge'=>$delcharge
                                 ]);

    

      return redirect()->route('user.pmsummary');

    }

    public function updateTimePm(Request $request){
      $id = $request['pm_id'];

      $data = PlannedMeals::where('pm_id', $id)
                            ->select('start')
                            ->get();

      foreach($data as $dta){
      
            $ndata = explode("T",$dta->start);
            }
      $arr = array($ndata[0],$request['appt-time']);
      $new = implode("T",$arr);

      $update = PlannedMeals::where('pm_id', $id)
                              ->update(['start' => $new
                            ]);
      return redirect()->route('user.plan.index');
    }


// function distance($lat1, $lon1, $lat2, $lon2, $unit) {

//   $theta = $lon1 - $lon2;
//   $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
//   $dist = acos($dist);
//   $dist = rad2deg($dist);
//   $miles = $dist * 60 * 1.1515;
//   $unit = strtoupper($unit);

//   if ($unit == "K") {
//     return ($miles * 1.609344);
//   } else if ($unit == "N") {
//       return ($miles * 0.8684);
//     } else {
//         return $miles;
//       }
// }

// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";


}
