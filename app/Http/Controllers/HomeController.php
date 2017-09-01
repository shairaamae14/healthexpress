<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\User;
use Auth;   
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
        
        $sortDishes = Dish::join('dish_details','dishes.id', '=', 'dish_details.dish_id')
                        ->join('dish_categories', 'dish_details.dcat_id', '=', 'dish_categories.id')
                        ->get();
        if(!$request->input('category')) {
 
            if($request->input('category') == 'Breakfast') {
                 $sortDishes = Dish::join('dish_details','dishes.id', '=', 'dish_details.dish_id')
                        ->join('dish_categories', 'dish_details.dcat_id', '=', 'dish_categories.id')
                        ->where('dish_details.dcat_id', 1)
                        ->get();
            }      
            else if($request->input('category') == 'Lunch') {
                $sortDishes = Dish::join('dish_details','dishes.id', '=', 'dish_details.dish_id')
                        ->join('dish_categories', 'dish_details.dcat_id', '=', 'dish_categories.id')
                        ->where('dish_details.dcat_id', 2)
                        ->get();
            }
            else {
                $sortDishes = Dish::join('dish_details','dishes.id', '=', 'dish_details.dish_id')
                        ->join('dish_categories', 'dish_details.dcat_id', '=', 'dish_categories.id')
                        ->where('dish_details.dcat_id', 3)
                        ->get();
            }
        }
        else {
            if($request->input('category') == 'Breakfast') {
                 $sortDishes = Dish::join('dish_details','dishes.id', '=', 'dish_details.dish_id')
                        ->join('dish_categories', 'dish_details.dcat_id', '=', 'dish_categories.id')
                        ->where('dish_details.dcat_id', 1)
                        ->get();
//                 dd($dishes);
            }      
            else if($request->input('category') == 'Lunch') {
                $sortDishes = Dish::join('dish_details','dishes.id', '=', 'dish_details.dish_id')
                        ->join('dish_categories', 'dish_details.dcat_id', '=', 'dish_categories.id')
                        ->where('dish_details.dcat_id', 2)
                        ->get();
            }
            else {
                $sortDishes = Dish::join('dish_details','dishes.id', '=', 'dish_details.dish_id')
                        ->join('dish_categories', 'dish_details.dcat_id', '=', 'dish_categories.id')
                        ->where('dish_details.dcat_id', 3)
                        ->get();
            }
        }
         
//        dd($allergens);
         return view('user.home', compact('user', 'dishes', 'sortDishes'));
    }

}
