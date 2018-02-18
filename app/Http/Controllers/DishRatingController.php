<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Ratings;
use App\Dish;
use App\UserOrder;
use App\CookRating;
use App\PlannedMeals;
use App\DishAverage;
use App\CookAverage;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class DishRatingController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    public function index()
    {
    	$id = Auth::id();
        $dishes = Ratings::where('Dish_id', $id)
                        ->get();  
        
    }

    public function storeRating(Request $request){
          $userid = Auth::id();
           $id= $request['dish_id'];
           $date=Carbon::now();
           $ndate=explode(" ",$date);
           $userorder=UserOrder::where('dish_id', $id)
                                  ->where('user_id', $userid)
                                  ->get();
          //IF NAKA ORDER NA SYA
             if(!$userorder->isEmpty()){
              foreach($userorder as $uo){
                 $new = Ratings::create(['comment' => $request['review'],
                                    'rating'  => $request['rating'],
                                    'date_rated'=>$ndate[0],
                                    'uorder_id'=>$uo->uo_id,
                                    'dish_id'=>$id
                                  ]);
               }
            //GET ALL THE RATINGS OF THE DISH
             $rate=Ratings::where('dish_id', $id)
                        ->get();
              //CALCULATE AVERAGE
              $avg=0;
              $average=0;
              $tempwhole=0;
              $r=count($rate);
              for($i=0; $i<$r; $i++){
                $avg+=$rate[$i]->rating/$r;
              }

               $average=round($avg, 1);
               $tempavg=$average;
               $tempwhole=floor($tempavg);
               $tempdec=$tempavg-$tempwhole;
               // dd($tempdec);
                if($tempdec==0.0){
                $average=$average;
                // dd($average);
               }
               else if($tempdec<=0.5 || $tempdec>=0.5){
                $tempdec=0.5;
                $average=$tempwhole + $tempdec;
                  // dd($average);
               }                     

              $averagedish = DishAverage::where('dish_id', $id)->get();
              // dd($averagedish);
              //if wala pay average ang dish
              if($averagedish->isEmpty()) {
                // dd("hello");
                $avg= DishAverage::create(['average'=>$average,
                                      'dr_id'=>0,
                                      'dish_id'=>$id
                                      ]);
              }
              //else if naa na ang ish sa dish average
              else{
              $avgrate= DishAverage::where('dish_id', $id)
                                    ->update(['average'=>$average]);
                                  }

             }
         //ELSE IF WA PA SYA KA ORDER
            else{
                return Redirect::back()->withErrors(["Sorry! you're not allowed to rate this this dish. You must order first"]);
              }
         return redirect()->route('home.details', compact('id', 'ratings', 'avgrate'))->with('success', 'Thank you for rating this dish!');;
    }

        public function storeRating2(Request $request){
           $userid = Auth::id();
           $id= $request['dish_id'];
           $date=Carbon::now();
           $ndate=explode(" ",$date);
           $userorder=UserOrder::where('dish_id', $id)
                                  ->where('user_id', $userid)
                                  ->get();
          //IF NAKA ORDER NA SYA
             if(!$userorder->isEmpty()){
              foreach($userorder as $uo){
                 $new = Ratings::create(['comment' => $request['review'],
                                    'rating'  => $request['rating'],
                                    'date_rated'=>$ndate[0],
                                    'uorder_id'=>$uo->uo_id,
                                    'dish_id'=>$id
                                  ]);
               }
         //GET ALL THE RATINGS OF THE DISH
            $rate=Ratings::where('dish_id', $id)
                        ->get();
        //CALCULATE AVERAGE
              $avg=0;
              $average=0;
              $tempwhole=0;
              $r=count($rate);
              for($i=0; $i<$r; $i++){
                $avg+=$rate[$i]->rating/$r;
              }

               $average=round($avg, 1);
               $tempavg=$average;
               $tempwhole=floor($tempavg);
               $tempdec=$tempavg-$tempwhole;
               // dd($tempdec);
                if($tempdec==0.0){
                $average=$average;
                // dd($average);
               }
               else if($tempdec<=0.5 || $tempdec>=0.5){
                $tempdec=0.5;
                $average=$tempwhole + $tempdec;
                  // dd($average);
               }                     

              $averagedish = DishAverage::where('dish_id', $id)->get();
              // dd($averagedish);
              //if wala pay average ang dish
              if($averagedish->isEmpty()) {
                // dd("hello");
                $avg= DishAverage::create(['average'=>$average,
                                      'dr_id'=>0,
                                      'dish_id'=>$id
                                      ]);
              }
              //else if naa na ang ish sa dish average
              else{
              $avgrate= DishAverage::where('dish_id', $id)
                                    ->update(['average'=>$average]);
                                  }

             }
         //ELSE IF WA PA SYA KA ORDER
            else{
                return Redirect::back()->withErrors(["Sorry! you're not allowed to rate this this dish. You must order first"]);
              }
            

         $cook = Dish::join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                         ->where('did', $id)->get();
  
         return view('user.cookrevrating', compact('id', 'cook', 'delivering'));
    }

      public function storeRating3(Request $request){
                  $userid = Auth::id();
           $id= $request['dish_id'];
           $date=Carbon::now();
           $ndate=explode(" ",$date);
           $userorder=UserOrder::where('dish_id', $id)
                                  ->where('user_id', $userid)
                                  ->get();
           foreach($userorder as $uo){
            $uo_id=$uo->uo_id;
           }
          //IF NAKA ORDER NA SYA
             if(!$userorder->isEmpty()){
    
                 $new = Ratings::create(['comment' => $request['review'],
                                    'rating'  => $request['rating'],
                                    'date_rated'=>$ndate[0],
                                    'uorder_id'=>$uo_id,
                                    'dish_id'=>$id
                                  ]);
               
         //GET ALL THE RATINGS OF THE DISH
            $rate=Ratings::where('dish_id', $id)
                        ->get();
        //CALCULATE AVERAGE
              $avg=0;
              $average=0;
              $tempwhole=0;
              $r=count($rate);
              for($i=0; $i<$r; $i++){
                $avg+=$rate[$i]->rating/$r;
              }

               $average=round($avg, 1);
               $tempavg=$average;
               $tempwhole=floor($tempavg);
               $tempdec=$tempavg-$tempwhole;
               // dd($tempdec);
                if($tempdec==0.0){
                $average=$average;
                // dd($average);
               }
               else if($tempdec<=0.5 || $tempdec>=0.5){
                $tempdec=0.5;
                $average=$tempwhole + $tempdec;
                  // dd($average);
               }                     

              $averagedish = DishAverage::where('dish_id', $id)->get();
              // dd($averagedish);
              //if wala pay average ang dish
              if($averagedish->isEmpty()) {
                // dd("hello");
                $avg= DishAverage::create(['average'=>$average,
                                      'dr_id'=>0,
                                      'dish_id'=>$id
                                      ]);
              }
              //else if naa na ang ish sa dish average
              else{
              $avgrate= DishAverage::where('dish_id', $id)
                                    ->update(['average'=>$average]);
                                  }

             }
         //ELSE IF WA PA SYA KA ORDER
            else{
                return Redirect::back()->withErrors(["Sorry! you're not allowed to rate this this dish. You must order first"]);
              }
                     
            
         $cook = Dish::join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                         ->where('did', $id)->get();
  
         return view('user.pmcookrevrating', compact('id', 'cook', 'delivering'));
    }


   public function storeCookR(Request $request){
      $userid = Auth::id();
      $date=Carbon::now();
      $ndate=explode(" ",$date);
            $id= $request['cook_id'];
            $did=$request['dish_id'];
            // dd($id, $did);
        $userorder=UserOrder::where('dish_id', $did)
                            ->where('user_id', $userid)
                                  ->get();
      // dd($userorder);
        foreach($userorder as $uo){
            $dishes = CookRating::create(['comment' => $request['review'],
                                    'rating'  => $request['rating'],
                                    'date_rate' =>$ndate[0],
                                    'uorder_id'=>$uo->uo_id,
                                    'dish_id'=>$uo->dish_id,
                                    'cook_id'=>$id
                                  ]);
        }
            $rate=CookRating::where('cook_id', $request['cook_id'])->get();
            // dd($rate);
              $avg=0;
              $average=0;
              $tempwhole=0;
              $r=count($rate);
              for($i=0; $i<$r; $i++){
                $avg+=$rate[$i]->rating/$r;
              }

               $average=round($avg, 1);
               $tempavg=$average;
               $tempwhole=floor($tempavg);
               $tempdec=$tempavg-$tempwhole;
               // dd($tempdec);
                if($tempdec==0.0){
                $average=$average;
                // dd($average);
               }
               else if($tempdec<=0.5 || $tempdec>=0.5){
                $tempdec=0.5;
                $average=$tempwhole + $tempdec;
                // dd($average, "hello");
               }
             $averagedish = CookAverage::where('cook_id', $request['cook_id'])->get();
             // dd($averagedish);
            if($averagedish->isEmpty()) {
            $avg= CookAverage::create(['average'=>$average,
                                      'cook_id'=>$request['cook_id']
                                      ]);
          } 
          else{
              $avgrate= CookAverage::where('cook_id', $request['cook_id'])
                                    ->update(['average'=>$average]);
          }       
            
            $delivering= UserOrder::where('dish_id', $did)->where('user_id', $userid)->get();
            // dd($delivering);
            return view('user.userconfirm', compact('delivering'));
   }
    public function storeCookR2(request $request){
      $userid = Auth::id();
      $date=Carbon::now();
      $ndate=explode(" ",$date);
            $id= $request['cook_id'];
            $did=$request['dish_id'];
            // dd($id, $did);
        $userorder=UserOrder::where('dish_id', $did)
                            ->where('user_id', $userid)
                                  ->get();
      // dd($userorder);
        foreach($userorder as $uo){
            $dishes = CookRating::create(['comment' => $request['review'],
                                    'rating'  => $request['rating'],
                                    'date_rate' =>$ndate[0],
                                    'uorder_id'=>$uo->uo_id,
                                    'dish_id'=>$uo->dish_id,
                                    'cook_id'=>$id
                                  ]);
        }
            $rate=CookRating::where('cook_id', $request['cook_id'])->get();
            // dd($rate);
              $avg=0;
              $average=0;
              $tempwhole=0;
              $r=count($rate);
              for($i=0; $i<$r; $i++){
                $avg+=$rate[$i]->rating/$r;
              }

               $average=round($avg, 1);
               $tempavg=$average;
               $tempwhole=floor($tempavg);
               $tempdec=$tempavg-$tempwhole;
               // dd($tempdec);
                if($tempdec==0.0){
                $average=$average;
                // dd($average);
               }
               else if($tempdec<=0.5 || $tempdec>=0.5){
                $tempdec=0.5;
                $average=$tempwhole + $tempdec;
                // dd($average, "hello");
               }
             $averagedish = CookAverage::where('cook_id', $request['cook_id'])->get();
             // dd($averagedish);
            if($averagedish->isEmpty()) {
            $avg= CookAverage::create(['average'=>$average,
                                      'cook_id'=>$request['cook_id']
                                      ]);
          } 
          else{
              $avgrate= CookAverage::where('cook_id', $request['cook_id'])
                                    ->update(['average'=>$average]);
          }       
            
            $delivering= UserOrder::where('dish_id', $did)->where('user_id', $userid)->get();
            // dd($delivering);
            return view('user.pmuserconfirm', compact('delivering'));
   }
      
   public function showRate(Request $request){
    $id=$request['dish_id'];
    $dishes = Dish::where('did', $id)->get();
    return view('user.reviewrating', compact('dishes'));
   }

  public function showRatepm(Request $request){
    $id=$request['dish_id'];
    $dishes = Dish::where('did', $id)->get();
    return view('user.pmrevrating', compact('dishes'));
   }

   public function showCookRate(Request $request){
    $userid=Auth::id();
    $id=$request['dish_id'];
    $cook=$request['cook_id'];
    $cook = Dish::where('did', $id)->get();
      return view('user.cookrevrating', compact('cook'));
   }

      public function showCookRate2(Request $request){
    $userid=Auth::id();
    $id=$request['dish_id'];
    $cook=$request['cook_id'];
    $cook = Dish::where('did', $id)->get();
      return view('user.pmcookrevrating', compact('cook'));
   }

   public function showConfirm(Request $request){
    $userid=Auth::id();
    $did=$request['dish_id'];
      $delivering= UserOrder::where('dish_id', $did)->where('user_id', $userid)->get();
      // dd($delivering);
    return view('user.userconfirm', compact('delivering'));
   }

   public function showConfirmpm(Request $request){
     $userid=Auth::id();
    $did=$request['dish_id'];
      $delivering= UserOrder::where('dish_id', $did)->where('user_id', $userid)->get();
       // dd($delivering);
    return view('user.pmuserconfirm', compact('delivering'));
   }
   


}
