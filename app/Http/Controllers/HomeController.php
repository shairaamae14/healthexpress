<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;   
use App\UserAllergen;
use App\Allergen;
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
        
        $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->get();

         return view('user.home', compact('user', 'dishes', 'sortDishes'));
    }
    
    public function express(Request $request) {
        $this->allergyFilter();

        if(!$request->sortOption) {

            $dishes = Dish::join('dish_besteaten','dish_besteaten.dish_id', '=', 'dishes.did')
                            ->join('besteaten_at', 'besteaten_at.be_id' , '=', 'dish_besteaten.be_id')
                            ->get();
        }
        else {
            
         if($request->sortOption == 'Breakfast') {
            $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 1)
                            ->get();
            }
        else if($request->sortOption == 'Lunch') {
            $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 2)
                            ->get();
            
        }
        else if($request->sortOption == 'Dinner'){
            $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('dish_besteaten.be_id', 3)
                            ->get();
        }
        }
        
        return view('user.u_express', compact('dishes'));
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
    
    public function search() {
        $dishNames = [];
        $dish = Dish::join('dish_besteaten','dish_besteaten.dish_id', '=', 'dishes.did')
                ->join('besteaten_at', 'besteaten_at.be_id' , '=', 'dish_besteaten.be_id')
                ->get();
        foreach($dish as $d) {
            array_push($dishNames, $d->dish_name);
        }
        $dishes = json_encode($dishNames);
        return $dishes;
    }
    
    public function allergyFilter() {
        $uid = Auth::id();
        $allergies = UserAllergen::join('allergens', 'allergens.allergen_id', '=', 'user_allergens.allergen_id')
                                ->where('user_id', $uid)->get();
        if($allergies) 
        {
            foreach($allergies as $allergy)
            {
                if($allergy->allergen_name == 'None') {
                  $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                    ->get();   
                }
                else {
                  $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                    ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                    ->join('ingredient_list', 'dish_ingredients.ing_id', '=', 'ingredient_list.id')
                    ->whereNotIn('ingredient_list.Shrt_Desc', 'LIKE', "%".$allergy->allergen_name."%")
                    ->get();   
                }
                
               
            }
        }
        else {
            $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                    ->get(); 
        }
        
        return $dishes;
        
    }
    
  public function showDetails($id){
        $det = Dish::where('did', $id)->get();

        return view('user.details', compact('det'));
    }

}
