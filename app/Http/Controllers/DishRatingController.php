<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Ratings;
use App\Dish;
use App\UserOrder;
use App\CookRating;
use App\PlannedMeals;

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
            $dishes = Ratings::create(['user_id' => $userid,
                                    'dish_id' => $request['dish_id'],
                                    'comment' => $request['review'],
                                    'rating'  => $request['rating']
                                  ]);
          
            // $avgrate=0;
            // $count=1;
           
         // dd($id);
               // $average = $rate->rating->sum('aggregate') / count($rate->rating);
           
 		 return redirect()->route('home.details', compact('id'));
    }

        public function storeRating2(Request $request){
            $userid = Auth::id();
            $id= $request['dish_id'];
            // dd($request['review']);
            $dishes = Ratings::create(['user_id' => $userid,
                                    'dish_id' => $request['dish_id'],
                                    'comment' => $request['review'],
                                    'rating'  => $request['rating']
                                  ]);
          
            // $avgrate=0;
            // $count=1;
           
         // dd($id);
               // $average = $rate->rating->sum('aggregate') / count($rate->rating);
         $cook = Dish::join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                         ->where('did', $id)->get();
  
         return view('user.cookrevrating', compact('id', 'cook', 'delivering'));
    }

      public function storeRating3(Request $request){
            $userid = Auth::id();
            $id= $request['dish_id'];
            // dd($request['review']);
            $dishes = Ratings::create(['user_id' => $userid,
                                    'dish_id' => $request['dish_id'],
                                    'comment' => $request['review'],
                                    'rating'  => $request['rating']
                                  ]);
          
            // $avgrate=0;
            // $count=1;
           
         // dd($id);
               // $average = $rate->rating->sum('aggregate') / count($rate->rating);
         $cook = Dish::join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                         ->where('did', $id)->get();
  
         return view('user.pmcookrevrating', compact('id', 'cook', 'delivering'));
    }


   public function storeCookR(request $request){
      $userid = Auth::id();
       $date=Carbon::now();
        // dd($request['review']);
            // $id= $request['cook_id'];
            // dd($request['review'], $request['cook_id'], $request['rating'], $id);
            $dishes = CookRating::create(['user_id' => $userid,
                                    'cook_id' => $request['cook_id'],
                                    'comment' => $request['review'],
                                    'rating'  => $request['rating'],
                                    'date_rate' =>$date
                                  ]);
            $delivering= UserOrder::all();
            return view('user.userconfirm', compact('delivering'));
   }
    public function storeCookR2(request $request){
      $userid = Auth::id();
       $date=Carbon::now();
        // dd($request['review']);
            // $id= $request['cook_id'];
            // dd($request['review'], $request['cook_id'], $request['rating'], $id);
            $dishes = CookRating::create(['user_id' => $userid,
                                    'cook_id' => $request['cook_id'],
                                    'comment' => $request['review'],
                                    'rating'  => $request['rating'],
                                    'date_rate' =>$date
                                  ]);
            $delivering= UserOrder::all();
            return view('user.pmuserconfirm', compact('delivering'));
   }
      
   public function showRate($id){
    $dishes = Dish::where('did', $id)->get();
    // $cook = Dish::join('cooks', 'cooks.id', '=', ' dishes.authorCook_id')->where('did', $dishes->did)->get();
    // dd($dishes);
    return view('user.reviewrating', compact('dishes'));
   }

  public function showRatepm($id){
    $dishes = Dish::where('did', $id)->get();
    // $cook = Dish::join('cooks', 'cooks.id', '=', ' dishes.authorCook_id')->where('did', $dishes->did)->get();
    // dd($dishes);
    return view('user.pmrevrating', compact('dishes'));
   }

   public function showCookRate($id){
    $cook = Dish::join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                         ->where('did', $id)->get();
      return view('user.cookrevrating', compact('cook'));
   }

      public function showCookRate2($id){
    $cook = Dish::join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                         ->where('did', $id)->get();
    // $pm=PlannedMeals::all();
      return view('user.pmcookrevrating', compact('cook', 'pm'));
   }

   public function showConfirm(){
       $delivering= UserOrder::all();
    return view('user.userconfirm', compact('delivering'));
   }

   public function showConfirmpm(){
       $delivering= PlannedMeals::all();
       // dd($delivering);
    return view('user.pmuserconfirm', compact('delivering'));
   }


}