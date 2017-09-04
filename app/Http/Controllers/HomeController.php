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
    
    public function express() {
        $user = Auth::id();
        $allergies = UserAllergen::join('allergens', 'allergens.allergen_id', '=', 'user_allergens.allergen_id')
                                ->where('user_id', $user)->get();
       
        if($allergies) {
          foreach($allergies as $all)
          {
              if($all->allergen_name == 'Eggs') {
                  $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->join('dish_ingredients', 'dishes.did', '=', 'dish_ingredients.dish_id')
                            ->get();
              }
          }
        }
        $uDish = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->get();
        foreach($uDish as $dish) {
            $start = strtotime($dish->preparation_time);
            $end = strtotime($dish->prep_end);
            $diff = abs($end - $start);
           
//            if($diff < 61) {
//                 $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
//                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
//                            ->get();
//                 
//            }
            
        } 
        return view('user.u_express', compact('dishes'));
    }
    public function showBfast() {
        $bfast = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('besteaten_at.be_id', 1)
                            ->get();
        return view('user.breakfast', compact('bfast'));
    }
    
    public function showLunch() {
        $lunch = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('besteaten_at.be_id', 2)
                            ->get();
        return view('user.lunch', compact('lunch'));
    }
    
    public function showDinner() {
        $dinner = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                            ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                            ->where('besteaten_at.be_id', 3)
                            ->get();
        return view('user.dinner', compact('dinner'));
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
}
