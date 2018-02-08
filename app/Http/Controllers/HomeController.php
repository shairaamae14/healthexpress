<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\User;
use App\Cook;
use Illuminate\Support\Facades\DB;
use Auth;   
use App\UserAllergen;
use App\Ratings;
use App\Allergen;
use App\UserMCondition;
use App\MedicalConditions;
use App\Http\Requests;
use App\DishBestEaten;
use App\NutritionFacts;
use App\DishIngredient;
use App\ToleranceValues;
use Session;
use App\CookRating;
use App\DishAverage;
use Illuminate\Session\Store;


// use Request;
// use Illuminate\Routing\Redirector;
// // use Illuminate\Support\Facades\Request;
// use Illuminate\Support\Facades\Redirect;
// use Cart;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $user = Auth::user()->load('conditions.restrictions','allergies.tol_values');
        $dishes = collect();
        $comparisons = ['calories', 'protein', 'total_fat', 'carbohydrate', 'fibre', 'sodium','sat_fat', 'cholesterol'];

        if(!$request->sortOption) {

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
                    })->whereHas('nfacts', function($query) use ($user) {
                        $query->where('calories', '<=', $user->dcr);
                    })->get();

                    $dishes = \App\Dish::whereDoesntHave('ingredients', function($query) use($allergy){
                    $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%');
                    })->whereHas('nfacts', function($query) use ($user) {
                        $query->where('calories', '<=', $user->dcr);
                    })->get();
                }
            }
            else if(!$user->allergies->count() && $user->conditions->count()) {
                $list = \App\Dish::whereHas('nfacts')->whereHas('nfacts', function($query) use ($user) {
                        $query->where('calories', '<=', $user->dcr);
                })->get();
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
                            ->where('Protein_g', '<', $proteinMin)->orWhere('Protein_g', '<=', $proteinMax);
                            break;
                        case 'Low':
                           $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')->where('Protein_g', '<', $protein);
                            break;
                        default:
                            break;
                        }

               })->whereHas('nfacts', function($query) use ($user) {
                        $query->where('calories', '<=', $user->dcr);
                })->get();
               
                $list = \App\Dish::whereDoesntHave('ingredients', function($query) use($allergy){
                    $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%');
                    })->whereHas('nfacts', function($query) use ($user) {
                        $query->where('calories', '<=', $user->dcr);
                    })->get();
                
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
            
            
           
            $title = 'All';
        }
        else {

            switch($request->sortOption)
            {
                case 'Breakfast' : 

                $title = 'Breakfast';
                break;



                case 'Lunch':

                $title = 'Lunch';
                break;


                case 'Dinner':
                $title = 'Dinner';
                break;


                case 'All':
                $title = 'All';
                break;
            }
            
        }
     

         return view('user.home', compact('user', 'dishes', 'title', 'avgrate'));
    }
       
   public function searchDishes(Request $request) {
       
        $term = $request->term;
        $lists = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                    ->where('dishes.dish_name', 'LIKE', '%'.$term.'%')
                    ->get();    
        
        if(count($lists) == 0) {
            $search[] = 'No dishes found';
        }
        else {
            foreach($lists as $key => $value)
            {
   
                $search[] = $value;
            }
        }
       
        return $search;
        
    }
    
    public function showDish(Request $request) {
        $dish_id = $request->id;
        $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                    ->where('dishes.did', $dish_id)->paginate(5);
        $title = $dishes->first()->dish_name;
        
        return view('user.home', compact('dishes', 'title'));
    }

    
public function showDetails($id){
    $userid=Auth::id();
        $dishes = Dish::join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                         ->where('did', $id)->get();
        $dish_ingredients = DishIngredient::where('did', $id)->join('dishes', 'dishes.did', '=', 'dish_ingredients.dish_id')
                    ->join('ingredient_list', 'ingredient_list.id', '=', 'dish_ingredients.ing_id')
                    ->join('unit_measurements', 'unit_measurements.um_id', '=', 'dish_ingredients.um_id')
                    ->join('preparations', 'preparations.p_id', '=', 'dish_ingredients.preparation')
                    ->get();

             $nutritional = NutritionFacts::where('ding_id', $id)->get();
             $ratings = Ratings::where('dish_id', $id)->join('users' , 'users.id', '=' , 'dish_ratings.user_id')->get();

            // $rate=Ratings::where('dish_id', $id)->get();
            $avgrate=DishAverage::where('dish_id', $id)
                                     ->get();

         return view('user.details', compact('dishes', 'nutritional', 'dish_ingredients', 'ratings', 'avgrate'));
    }

    public function showCook($id){
        $cook=Cook::where('id', $id)->get();
        // dd($cook);
            $dishes=Dish::where('authorCook_id', $id)->paginate(12);
              // $dishes = Dish::paginate(12);

              $ratings = CookRating::where('cook_id', $id)->join('users' , 'users.id', '=' , 'cook_ratings.user_id')->get();

            $rate=CookRating::where('cook_id', $id)->get();
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

           // dd($average);
            // dd($cookid);

        return view('user.showcook', compact('cook', 'dishes', 'average', 'ratings'));
    }


public function orderHistory(){

    return view('user.orderhistory');
}


}
