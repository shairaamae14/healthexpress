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
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $allergens = json_decode($user->allergens);
        $dishes = collect();
        $user = Auth::user()->load('conditions.restrictions','allergies.tol_values');
        $comparisons = ['calories', 'protein', 'total_fat', 'carbohydrate', 'fibre', 'sodium','sat_fat', 'cholesterol'];
        // $dishes = $this->filter();
        
        // $dishes = Dish::with('dish_besteaten.besteaten')->get();
   
        if(!$request->sortOption) {
//            $dishes = Dish::join('dish_besteaten','dish_besteaten.dish_id', '=', 'dishes.did')
//                            ->join('besteaten_at', 'besteaten_at.be_id' , '=', 'dish_besteaten.be_id')
//                            ->paginate(12);
//            $dishes = Dish::paginate(3);
           foreach ($user->allergies as $allergy) {
                $list = \App\Dish::whereHas('ingredients', function($query) use($allergy){
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
                $list2 = \App\Dish::whereDoesntHave('ingredients', function($query) use($allergy){
                    $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%');
               })->get();
            }

            if(count($list) !=0 && count($list2) !=0) {
                $first = $list->load('nfacts');
                $second = $list2->load('nfacts');
                for ($i=0; $i < count($first); $i++) { 
                   for ($x=0; $x < count($second); $x++) { 
                        foreach ($user->conditions as $condition) { 
                            foreach ($comparisons as $comparison) {
                                if ($condition->restrictions[0][$comparison] < $first[$i]->nfacts[$comparison] && $condition->restrictions[0][$comparison] < $second[$x]->nfacts[$comparison]) {
                            
                                    $dishes[$i] = $first[$i];
                                    $dishes[$x] = $second[$x];
                                }
                            }
                        }
                   }
               }


            }
            else if(count($list) !=0 && count($list2) == 0) {
                $first = $list->load('nfacts');
                  for ($i=0; $i < count($first); $i++) {  
                        foreach ($user->conditions as $condition) { 
                            foreach ($comparisons as $comparison) {
                                if ($condition->restrictions[0][$comparison] < $first[$i]->nfacts[$comparison]) {
                            
                                    $dishes[$i] = $first[$i];
                                }
                            }
                        }
               }
            }
            else if(count($list2) !=0 && count($list) == 0) {
                $second = $list2->load('nfacts');
                   for ($x=0; $x < count($second); $x++) { 
                        foreach ($user->conditions as $condition) { 
                            foreach ($comparisons as $comparison) {
                                if ( $condition->restrictions[0][$comparison] < $second[$x]->nfacts[$comparison]) {
                                    $dishes[$x] = $second[$x];
                                }
                            }
                        }
                   }     
            }
            
            
           
            $title = 'All';
        }
        else {
            if($request->sortOption == 'Breakfast') {
                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 1)
                            ->paginate(12);
                $title = 'Breakfast';
            }
            
            else if($request->sortOption == 'Lunch') {
                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 2)
                            ->paginate(12);
                $title = 'Lunch';
            }
            else if($request->sortOption == 'Dinner') {
                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 3)
                            ->paginate(12);
                $title = 'Dinner';
            }
            else if($request->sortOption == 'All') {
                $dishes = Dish::join('dish_besteaten','dish_besteaten.dish_id', '=', 'dishes.did')
                            ->join('besteaten_at', 'besteaten_at.be_id' , '=', 'dish_besteaten.be_id')
                            ->paginate(3);
                $title = 'All';
            }
        }

        $ratings = Ratings::where('dish_id', $id)->join('users' , 'users.id', '=' , 'dish_ratings.user_id')->get();

            $rate=Ratings::where('dish_id', $id)->get();
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


        // dd($dishes);
         return view('user.home', compact('user', 'dishes', 'title', 'average'));
    }
    
    public function express(Request $request) {
        // $this->allergyFilter();

        // if(!$request->sortOption) {

            $dishes = Dish::join('dish_besteaten','dish_besteaten.dish_id', '=', 'dishes.did')
                            ->join('besteaten_at', 'besteaten_at.be_id' , '=', 'dish_besteaten.be_id')
                            ->get();
        // }
        // else {
            
         // if($request->sortOption == 'Breakfast') {
            $breakfast = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 1)
                            ->get();
            // }
        // else if($request->sortOption == 'Lunch') {
            $lunch = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 2)
                            ->get();
            
        // }
        // else if($request->sortOption == 'Dinner'){
            $dinner = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 3)
                            ->get();
        // }
        // }
        
        return view('user.u_express', compact('dishes', 'breakfast', 'lunch', 'dinner'));
                            // return redirect()->route('user.index'); 
    }
    public function show() {
        return view('best');
    }
    
    public function create(Request $request) {
        $best = DB::table('besteaten_at')->insert([
            'name' => $request->name,
            'start_time' => $request->stime,
            'end_time' => $request->etime,
            'status' => $request->stat,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return redirect()->back();
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
    public function filter() {
        $uid = Auth::id();
        $allergies = UserAllergen::join('allergens', 'allergens.allergen_id', '=', 'user_allergens.allergen_id')
                                ->where('user_id', $uid)->get();
        $medcon = UserMCondition::join('medical_conditions', 'medical_conditions.medcon_id', '=', 'user_medcondition.medcon_id')
                                ->where('user_id', $uid)->get();
        if($allergies || $medcon) 
        {
            foreach($allergies as $allergy)
            {
                foreach($medcon as $mc) {
                        if($mc->medcon_name == 'Asthma') {
                            if($allergy->allergen_name == 'Peanut' || $allergy->allergen_name == 'Eggs' || $allergy->allergen_name == 'Wheat') {

                                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                                            ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                                            ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                                            ->where('ingredient_list.Shrt_Desc', 'NOT LIKE', "%".$allergy->allergen_name."%")
                                            ->paginate(3);
                            }
                            else {
                                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                                            ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                                            ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                                            ->where('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Peanut%")
                                            ->orWhere('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Eggs%")
                                            ->orWhere('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Wheat%")
                                            ->paginate(3);
                            }
                            
                        }
                        else if($mc->medcon_name == 'High Cholesterol') {
                            if($allergy->allergen_name == 'Shellfish' || $allergy->allergen_name == 'Eggs' || $allergy->allergen_name == 'Milk') {
                                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                                            ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                                            ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                                            ->where('ingredient_list.Shrt_Desc', 'NOT LIKE', "%".$allergy->allergen_name."%")
                                            ->paginate(3);
                            }
                            else {
                                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                                            ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                                            ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                                            ->where('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Shellfish%")
                                            ->orWhere('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Eggs%")
                                            ->orWhere('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Milk%")
                                            ->orWhere('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Beef%")
                                            ->paginate(3);
                            }
                        }
                        else if($mc->medcon_name == 'High Blood Pressure') {
                            if($allergy->allergen_name == 'Shellfish'   ) {
                                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                                            ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                                            ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                                            ->where('ingredient_list.Shrt_Desc', 'NOT LIKE', "%".$allergy->allergen_name."%")
                                            ->paginate(3);
                            }
                            else {
                                
                            }
                        }
                        else if($mc->medcon_name == 'Arthritis') {
                            if($allergy->allergen_name == 'Shellfish' || $allergy->allergen_name == 'Eggs' || $allergy->allergen_name == 'Milk'
                                        || $allergy->allergen_name == 'Wheat') {
                                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                                            ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                                            ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                                            ->where('ingredient_list.Shrt_Desc', 'NOT LIKE', "%".$allergy->allergen_name."%")
                                            ->paginate(3);
                            }
                            else {
                                $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                                            ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                                            ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                                            ->where('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Shellfish%")
                                            ->orWhere('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Eggs%")
                                            ->orWhere('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Milk%")
                                            ->orWhere('ingredient_list.Shrt_Desc', 'NOT LIKE', "%Beef%")
                                            ->paginate(3);
                            }
                        }

 
                }  
            }

                if(!$allergies->isEmpty()){

                    $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                    ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                    ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                    ->where('ingredient_list.Shrt_Desc', 'NOT LIKE', "%".$allergy->allergen_name."%")
                    ->paginate(3); 
                }
                else{
                    $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                    ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                    ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                    ->paginate(3); 
                }
        }
        
        //        $dish = Dish::all();
//        $dish = Dish::with(['dish_besteaten', 'dish_ingredients' => function (HasMany $builder) {
//            $builder->getQuery()->has('besteaten');
//        }])->get();
//        dd($dish);
        
//                                $foods = Dish::all();
//                                foreach($foods as $food) {
//                                    $dishes = DishBestEaten::join('besteaten_at' , 'besteaten_at.be_id', '=' , 'dish_besteaten.be_id')
//                                            ->where('dish_id', $food->did)->get();
//                                    
//                                }      
//        else {
//            $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
//                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
//                    ->get(); 
//        }
        //                $dishes = $dish->transform(function($dish) {
//                    $pm = $dish->dish_besteaten();
//                    return $pm;
//                });
        return $dishes;
        
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

            $rate=Ratings::where('dish_id', $id)->get();
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
         return view('user.details', compact('dishes', 'nutritional', 'dish_ingredients', 'ratings', 'average'));
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
