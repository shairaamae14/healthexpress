<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Cook;
use App\UserPlan;
use App\Dish;
use App\BestEaten;
use App\PlannedMeals;
use App\NutritionFacts;
use App\UserOrder;
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
        
         $user = Auth::user()->load('conditions.restrictions','allergies.tol_values');
          $ranges = [];
          $planner = [];
          $dishes = collect();
          $comparisons = ['calories', 'protein', 'total_fat', 'carbohydrate', 'fibre', 'sodium','sat_fat', 'cholesterol'];



          

        $user_orders = UserOrder::where('user_id',$id)->where('order_status','Initial')->get();
            // dd(count($user_orders));
        if(count($user_orders) != 0){
          // $start_end = UserOrder::distinct()->select('planner_start', 'planner_end')->where('user_id',$id)->where('order_status','Initial')->groupBy('planner_start','planner_end')->get();

          $qstart = UserOrder::distinct()->select('planner_start')->where('user_id',$id)->where('order_status','Initial')->first();
          $qend = UserOrder::distinct()->select('planner_end')->where('user_id',$id)->where('order_status','Initial')->first();
          $start = $qstart->planner_start;
          $end = $qend->planner_end;

          //if assigned cook exists
          $hascook = UserOrder::where('user_id', $id)->where('order_status','Initial')->where('cook_id', '!=', 0)->exists();

          if($hascook == false){
            $cook = Cook::inRandomOrder()->select('id')->take(1)->first();
            $cookid = $cook->id;
          }
          else{
            $cook = UserOrder::distinct()->select('cook_id')->where('user_id',$id)->where('order_status','Initial')->first();
            $cookid = $cook->cook_id;
          }


          if(!$user->allergies->count() && !$user->conditions->count())
          {
            $dishes = \App\Dish::whereHas('nfacts', function($query) use ($user) {
              $query->where('calories', '<=', $user->dcr);
            })->get();

          }
          else if($user->allergies->count() && !$user->conditions->count()) {

            foreach($user->allergies as $allergy) {
              $dishes = \App\Dish::whereHas('ingredients', function($query) use($allergy){
                $protein = $allergy->tol_values->threshold_value /100;
                  switch ($allergy->tol_values->level) {
                    case 'High':
                        break;
                    case 'Medium':
                        $proteinMin = $allergy->min / 100;
                        $proteinMax = $allergy->max / 100;
                        $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')
                            ->where('Protein_g', '<', $proteinMin)->orWhere('Protein_g', '<=', $proteinMax);
                        break;
                    case 'Low':
                        $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')->where('Protein_g', '<', $protein);
                        break;
                    default:
                        break;
                    }
              })->get();

              $dishes = \App\Dish::whereDoesntHave('ingredients', function($query) use($allergy){
                $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%');
              })->get();
            }
          }
          else if(!$user->allergies->count() && $user->conditions->count()) {
            $list = \App\Dish::whereHas('nfacts')->get();
            for ($index=0; $index < $list->count() ;$index++) { 
              foreach($user->conditions as $condition) {
                foreach($comparisons as $comparison) {
                  if($condition->restrictions[0][$comparison] < $list[$index]->nfacts[$comparison])
                    $dishes[$index] = $list[$index];
                }
              }
            }
          }
          else{
            foreach ($user->allergies as $allergy) {
              $dishes = \App\Dish::whereHas('ingredients', function($query) use($allergy){
                $protein = $allergy->tol_values->threshold_value /100;
                switch ($allergy->tol_values->level) {
                  case 'High':
                      break;
                  case 'Medium':
                      $proteinMin = $allergy->min / 100;
                      $proteinMax = $allergy->max / 100;
                      $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')
                            ->where('Protein_g', '<', $proteinMin)->orWhere('Protein_g', '<=', $proteinMax)->groupBy('authorCook_id');
                      break;
                  case 'Low':
                      $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')->where('Protein_g', '<', $protein)->groupBy('authorCook_id');
                      break;
                  default:
                      break;
                  }
              })->get();
              $list = \App\Dish::whereDoesntHave('ingredients', function($query) use($allergy){
                $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')->groupBy('authorCook_id');
              })->whereHas('nfacts')->get();
               
              for ($i=0; $i < $list->count(); $i++) {  
                foreach ($user->conditions as $condition) { 
                  foreach ($comparisons as $comparison) {
                    if ($condition->restrictions[0][$comparison] < $list[$i]->nfacts[$comparison]) {             
                      $dishes[$i] = $list[$i];
                    }
                  }
                }
              }
            }
          }


          foreach ($dishes as $dish) {
            $breakfast = $dish->whereHas('besteaten', function($query) {
              $query->where('name', 'Breakfast');
            })->where('dishes.authorCook_id', $cookid)->where('dish_type', 'Planned')->take(5)->get();
            $lunch = $dish->whereHas('besteaten', function($query) {
              $query->where('name', 'Lunch');
            })->where('dishes.authorCook_id', $cookid)->where('dish_type', 'Planned')->take(5)->get();
            $dinner = $dish->whereHas('besteaten', function($query) {
              $query->where('name', 'Dinner');
            })->where('dishes.authorCook_id', $cookid)->where('dish_type', 'Planned')->take(5)->get();
          }

          //show details and nutritional facts of dishes
          $dishes = UserOrder::join('dishes', 'user_orders.dish_id', '=', 'dishes.did')
                                  ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                                  ->join('dish_besteaten', 'dishes.did', '=', 'dish_besteaten.dish_id')
                                  ->join('besteaten_at', 'dish_besteaten.be_id', '=', 'besteaten_at.be_id')
                                  ->join('nutritional_facts', 'dishes.did', '=', 'nutritional_facts.ding_id')
                                  ->where('user_id',$id)
                                  ->get();

          //all dishes
          $betype = UserOrder::join('dishes','user_orders.dish_id', '=', 'dishes.did')
                              ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                              ->join('users', 'user_orders.user_id', '=', 'users.id')
                              ->join('order_mode', 'user_orders.om_id', '=', 'order_mode.id')
                              ->get();

          //get all besteaten
          $besteaten= BestEaten::all();
          
          return view('user.pmeals', compact('breakfast', 'lunch', 'dinner', 'besteaten', 'dishes', 'betype', 'start', 'end', 'start_end'))->with(['plans' => Plan::get(), 'cal'=> response()->json($dinner)]);
        }



        else{

          $cook = Cook::inRandomOrder()->select('id')->take(1)->first();
          $cookid = $cook->id;

          if(!$user->allergies->count() && !$user->conditions->count())
          {
            $dishes = \App\Dish::whereHas('nfacts', function($query) use ($user) {
              $query->where('calories', '<=', $user->dcr);
            })->get();

          }
          else if($user->allergies->count() && !$user->conditions->count()) {

            foreach($user->allergies as $allergy) {
              $dishes = \App\Dish::whereHas('ingredients', function($query) use($allergy){
                $protein = $allergy->tol_values->threshold_value /100;
                  switch ($allergy->tol_values->level) {
                    case 'High':
                        break;
                    case 'Medium':
                        $proteinMin = $allergy->min / 100;
                        $proteinMax = $allergy->max / 100;
                        $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')
                            ->where('Protein_g', '<', $proteinMin)->orWhere('Protein_g', '<=', $proteinMax);
                        break;
                    case 'Low':
                        $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')->where('Protein_g', '<', $protein);
                        break;
                    default:
                        break;
                    }
              })->get();

              $dishes = \App\Dish::whereDoesntHave('ingredients', function($query) use($allergy){
                $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%');
              })->get();
            }
          }
          else if(!$user->allergies->count() && $user->conditions->count()) {
            $list = \App\Dish::whereHas('nfacts')->get();
            for ($index=0; $index < $list->count() ;$index++) { 
              foreach($user->conditions as $condition) {
                foreach($comparisons as $comparison) {
                  if($condition->restrictions[0][$comparison] < $list[$index]->nfacts[$comparison])
                    $dishes[$index] = $list[$index];
                }
              }
            }
          }
          else{
            foreach ($user->allergies as $allergy) {
              $dishes = \App\Dish::whereHas('ingredients', function($query) use($allergy){
                $protein = $allergy->tol_values->threshold_value /100;
                switch ($allergy->tol_values->level) {
                  case 'High':
                      break;
                  case 'Medium':
                      $proteinMin = $allergy->min / 100;
                      $proteinMax = $allergy->max / 100;
                      $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')
                            ->where('Protein_g', '<', $proteinMin)->orWhere('Protein_g', '<=', $proteinMax)->groupBy('authorCook_id');
                      break;
                  case 'Low':
                      $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')->where('Protein_g', '<', $protein)->groupBy('authorCook_id');
                      break;
                  default:
                      break;
                  }
              })->get();
              $list = \App\Dish::whereDoesntHave('ingredients', function($query) use($allergy){
                $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')->groupBy('authorCook_id');
              })->whereHas('nfacts')->get();
               
              for ($i=0; $i < $list->count(); $i++) {  
                foreach ($user->conditions as $condition) { 
                  foreach ($comparisons as $comparison) {
                    if ($condition->restrictions[0][$comparison] < $list[$i]->nfacts[$comparison]) {             
                      $dishes[$i] = $list[$i];
                    }
                  }
                }
              }
            }
          }


          foreach ($dishes as $dish) {
            $breakfast = $dish->whereHas('besteaten', function($query) {
              $query->where('name', 'Breakfast');
            })->where('dishes.authorCook_id', $cookid)->where('dish_type', 'Planned')->take(5)->get();
            $lunch = $dish->whereHas('besteaten', function($query) {
              $query->where('name', 'Lunch');
            })->where('dishes.authorCook_id', $cookid)->where('dish_type', 'Planned')->take(5)->get();
            $dinner = $dish->whereHas('besteaten', function($query) {
              $query->where('name', 'Dinner');
            })->where('dishes.authorCook_id', $cookid)->where('dish_type', 'Planned')->take(5)->get();
          }

          $dates = explode("-", str_replace(' ', '', $request->daterange));
          $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d',strtotime($dates[0])));
          $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d',strtotime($dates[1])));
          $from = \Carbon\Carbon::createFromDate($date1->year, $date1->month, $date1->day);
          $to =  \Carbon\Carbon::createFromDate($date2->year, $date2->month, $date2->day);
          $start = date('Y-m-d',strtotime($dates[0]));
          $end = date('Y-m-d',strtotime($dates[1]));
       
          for ($date=$from; $date->lte($to); $date->addDay()) { 
            $ranges[] = $date->format('Y-m-d\TH:m:s');
            $planner[] = $date->format('Y-m-d H:m:s');
          }

          $count = count($planner) - 1;

          while ($count >= 0) {
            $bfast = UserOrder::create([
                                        'user_id' => $user->id,
                                        'totalQty' => 1,
                                        'totalAmount' => $breakfast->shuffle()[0]->sellingPrice,
                                        'order_status' =>'Initial',
                                        'om_id' => 2,
                                        'dish_id' => $breakfast->shuffle()[0]->did,
                                        'title' => $breakfast->shuffle()[0]->dish_name,
                                        'planner_start' => reset($planner),
                                        'planner_end' => end($planner),
                                        'start' => $ranges[$count],
                                        'end' => $ranges[$count] ,
                                        'allDay' => 'false',
                                        'cook_id' => $cookid
                                        ]);
            $lun = UserOrder::create([
                                        'user_id' => $user->id,
                                        'totalQty' => 1,
                                        'totalAmount' => $lunch->shuffle()[0]->sellingPrice,
                                        'order_status' => 'Initial',
                                        'om_id' => 2,
                                        'dish_id' => $lunch->shuffle()[0]->did,
                                        'title' => $lunch->shuffle()[0]->dish_name,
                                        'planner_start' => reset($planner),
                                        'planner_end' => end($planner),
                                        'start' => $ranges[$count],
                                        'end' => $ranges[$count] ,
                                        'allDay' => 'false',
                                        'cook_id' => $cookid
                                        ]);

            $din = UserOrder::create([
                                        'user_id' => $user->id,
                                        'totalQty' => 1,
                                        'totalAmount' => $dinner->shuffle()[0]->sellingPrice,
                                        'order_status' => 'Initial',
                                        'om_id' => 2,
                                        'dish_id' => $dinner->shuffle()[0]->did,
                                        'title' => $dinner->shuffle()[0]->dish_name,
                                        'planner_start' => reset($planner),
                                        'planner_end' => end($planner),
                                        'start' => $ranges[$count],
                                        'end' => $ranges[$count] ,
                                        'allDay' => 'false',
                                        'cook_id' => $cookid
                                        ]);

            $count--;
          }

          //show nutritional facts of dishes
          $dishes = UserOrder::join('dishes', 'user_orders.dish_id', '=', 'dishes.did')
                                  ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                                  ->join('dish_besteaten', 'dishes.did', '=', 'dish_besteaten.dish_id')
                                  ->join('besteaten_at', 'dish_besteaten.be_id', '=', 'besteaten_at.be_id')
                                  ->join('nutritional_facts', 'dishes.did', '=', 'nutritional_facts.ding_id')
                                  ->where('user_id',$id)
                                  ->get();

          //all dishes
          $betype = UserOrder::join('dishes','user_orders.dish_id', '=', 'dishes.did')
                              ->join('cooks', 'dishes.authorCook_id' , '=', 'cooks.id')
                              ->join('users', 'user_orders.user_id', '=', 'users.id')
                              ->join('order_mode', 'user_orders.om_id', '=', 'order_mode.id')
                              ->get();

          //get all besteaten
          $besteaten= BestEaten::all();
          

          return view('user.pmeals', compact('breakfast', 'lunch', 'dinner', 'besteaten', 'dishes', 'betype', 'start', 'end'))->with(['plans' => Plan::get(), 'cal'=> response()->json($dinner)]);

        }
        
            
    }


    public function index1(){
      $id = Auth::id();
      $plans = UserOrder::where('user_id', $id)->where('order_status', 'LIKE', 'Initial')->get();
      $latest =  UserOrder::where('user_id', $id)->where('order_status', 'LIKE', 'Initial')->latest('created_at')->first();
      if($latest)
      {
         $start = $latest->planner_start;
          $end = $latest->planner_end;
      }
     
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
          
        }
      }
      else
        return view('user.initialpm');

    }

    public function store(Request $request){       
      return redirect()->route('user.plan.show');
    }

    // public function showCalendar(){
    //     return view('user.planCalendar');
    // }

    public function storePlans(Request $request){
        $id = Auth::id();
         $events = UserOrder::create([
                                        'title' => $request['title'],
                                        'user_id' => $id,
                                        'om_id' => $request['om_id'],
                                        'dish_id' => $request['dish_id'],
                                        'order_status' => 'Initial',
                                        'planner_start' => $request['start'],
                                        'planner_end' => $request['end'],
                                        'start' => $request['start'],
                                        'end' => $request['end'],
                                        'allDay' => 'false'
        ]);
        return response()->json(['data'=>$events]);     
    }

    public function resetDate(Request $request){
      $title = $request['title'];
      $startdate = $request['start'];
      $enddate = $request['end'];
      $eventid = $request['id'];

      $update = UserOrder::where('uo_id',$eventid)
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
        $query = UserOrder::where('user_id', $id)
                            ->where('order_status', 'Initial')
                            ->select('uo_id', 'title', 'dish_id', 'start', 'end', 'allDay')->get();

        return $query->toJson();
    }
      public function fetchPlanOrders(Request $request){

        $id=Auth::id();
        $events = array();
        $query = UserOrder::where('user_id', $id)
                            ->where('order_status', 'Pending')
                            ->select('uo_id', 'title', 'dish_id', 'start', 'end', 'allDay')->get();

        return $query->toJson();
    }

    public function deletePlan(Request $request){
      $id = $request['id'];

      $delete = UserOrder::where('uo_id', $id)->delete();
                             
      if($delete)
        return response()->json(['status'=>'success']);
      else
        return response()->json(['status'=>'failed']);
    }

    // public function addNote(Request $request){
    //   $id = $request['eventid'];
    //   $note = $request['note'];

    //   $update = PlannedMeals::where('pm_id', $id)
    //                         ->update(['note'=>$note]);
    //   if($update)
    //     return response()->json(['status'=>'success']);
    //   else
    //     return response()->json(['status'=>'failed']);

    // }

    public function summary(){
      $id = Auth::id();
      $data = UserOrder::join('dishes','dishes.did','=','user_orders.dish_id')
                            ->where('user_id', $id)
                            ->where('order_status', 'Initial')
                            ->get();
      // $initialdishes = UserOrder::join('dishes','dishes.did','=','user_orders.dish_id')
      //                       ->where('user_id', $id)
      //                       ->where('om_id', 2)
      //                       ->get();
                            // dd($initialdishes);
                            // dd($data);
      $start = $data[0]->planner_start;
      $end = $data[0]->end;
       $allMealCost=0;
       $totalDelFee=0;
       $allcost=0;
        for($i=0; $i<count($data); $i++){
          $allMealCost+=$data[$i]->totalAmount;
          $totalDelFee+=$data[$i]->delivery_fee;
          $allcost=$allMealCost+$totalDelFee;
        }
         // $allMealCost=round($allMealCost,2);
         //  $totalDelFee=round($totalDelFee,2);
         //  $allcost=round($allcost, 2);
         $allMealCost= number_format($allMealCost,2);
         $totalDelFee= number_format($totalDelFee,2);
         $allcost= number_format($allcost,2);
        // dd($totalDelFee);
      
      return view('user.summary', compact('data', 'allMealCost', 'totalDelFee', 'allcost', 'start','end'));
    }
    public function modeOfDelivery(){
      return view('user.modeofdel');
    }
  
    public function updatePm(Request $request){
    $uo_id=$request['uo_id'];
        if($request['mode']=="Delivery"){
        $address=$request['d_address'];
        $lat=$request['cityLat'];
        $long=$request['cityLng'];  
      }
      else if($request['mode']=="Pickup"){
        $address=$request['p_address'];
         $lat=$request['cityLatp'];
        $long=$request['cityLngp'];
        $delcharge=0;
        $distance=0;

      }
    //TO GET LATLONG OF THE USER AND COOK
      $userlat=0;
      $userlng=0;
      $cooklat=0;
      $cooklng=0;
        //USER LATLNG
       $userlat=$request['cityLat'];
       $userlng=$request['cityLng'];
       //COOK LATLNG
      $cooklat=$request['cityLatp'];
        $cooklng=$request['cityLngp'];
             
      // dd($cooklat, $cooklong);
       
      if($request['mode']=="Delivery"){
      $delcharge=0;
      $distance=0;
      //CALCULATION OF DISTANCE
      $theta = $cooklng - $userlng;
      $dist = sin(deg2rad($cooklat)) * sin(deg2rad($userlat)) +  cos(deg2rad($cooklat)) * cos(deg2rad($userlat)) * cos(deg2rad($theta));
      $distacos = acos($dist);
      $distrad= rad2deg($distacos);
      $miles = $distrad * 60 * 1.1515;
      $distance=$miles * 1.609344;
      $distance=round($distance,2);
      if($distance>5.00){
        $delcharge=40.00+(2.50*($distance-5));
        // dd($delcharge);
      }
     else if ($distance<=5.00){
      $delcharge=40.00;
      }
    }
    else{
      $delcharge=0;
      $distance=0;
    }

        // dd($delcharge);
       
      $pm=UserOrder::where('uo_id', $uo_id)
                        ->update(['sidenote'=>$request['spec'],
                                  'delivery_fee'=>$delcharge,
                                  'address'=>$address,
                                   'contact_no'=>$request['contactnum'],
                                    'mode_delivery'=>$request['mode'],
                                      'distance'=>$distance,
                                  'longitude'=>$long,
                                  'latitude'=>$lat
                                 ]);

    

      return redirect()->route('user.pmsummary');

    }

    public function updateTimePm(Request $request){
      $id = $request['uo_id'];

      $data = UserOrder::where('uo_id', $id)
                            ->select('start')
                            ->get();

      foreach($data as $dta){
      
            $ndata = explode("T",$dta->start);
            }
      $arr = array($ndata[0],$request['appt-time']);
      $new = implode("T",$arr);

      $update = UserOrder::where('uo_id', $id)
                              ->update(['start' => $new
                            ]);
      return redirect()->route('user.plan.index');
    }


    public function showAllorders(){
       $id = Auth::id();
      $data = UserOrder::join('dishes','dishes.did','=','user_orders.dish_id')
                            ->where('user_id', $id)
                            ->where('order_status', 'Pending')
                            ->where('om_id', 2)
                            ->get();
      // $initialdishes = UserOrder::join('dishes','dishes.did','=','user_orders.dish_id')
      //                       ->where('user_id', $id)
      //                       ->where('om_id', 2)
      //                       ->get();
                            // dd($initialdishes);
                            // dd($data);
      $start = $data[0]->planner_start;
      $end = $data[0]->end;
       $allMealCost=0;
       $totalDelFee=0;
       $allcost=0;
        for($i=0; $i<count($data); $i++){
          $allMealCost+=$data[$i]->totalAmount;
          $totalDelFee+=$data[$i]->delivery_fee;
          $allcost=$allMealCost+$totalDelFee;
        }
         $allMealCost=round($allMealCost,2);
          $totalDelFee=round($totalDelFee,2);
          $allcost=round($allcost, 2);
         $allMealCost= number_format($allMealCost,2);
         $totalDelFee= number_format($totalDelFee,2);
         $allcost= number_format($allcost,2);
       return view('user.pmallorders',compact('data', 'allMealCost', 'totalDelFee', 'allcost', 'start','end'));
       // return view('user.pmallorders', compact('start', 'end', 'data'));
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
