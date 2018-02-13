<?php

namespace App\Http\Controllers;


use App\User;
use App\Dish;
use App\BestEaten;
use App\DishBestEaten;
use Illuminate\Http\Request;
use App\Cook;
use App\NutritionFacts;
use Validator;
use App\IngredientList;
use App\UnitMeasurement;
use App\DishIngredient;
use App\Preparation;
use App\CookCatalog;
use App\Event;
use App\CookPlan;
use App\Pmealdishes;
use App\Ratings;
use App\DishAverage;
use Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:cook');
    }
     
    public function index()
    {
        $id = Auth::id();
        
        $dishes = Dish::where('authorCook_id', $id)
                        ->paginate(10);  
        foreach($dishes as $dish) {
            $dbestEaten = DishBestEaten::join('besteaten_at' , 'besteaten_at.be_id', '=' , 'dish_besteaten.be_id')
                                        ->where('dish_id', $dish->did)->get();
        }               
        
        
      return view('cook.dishes', compact('dishes', 'dbestEaten'));
    
    }

       public function pmindex()
    {
        $id = Auth::id();

        $pmdishes = Dish::where('authorCook_id', $id)
                        ->where('dish_type','Planned')
                        ->paginate(10);  
        foreach($pmdishes as $dish) {
            $dbestEaten = DishBestEaten::join('besteaten_at' , 'besteaten_at.be_id', '=' , 'dish_besteaten.be_id')
                                        ->where('dish_id', $dish->did)->get();
        }   

        
      return view('cook.pmdishes', compact('pmdishes', 'dbestEaten','ratings','average'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ini_set('memory_limit', '2048M');
        $beaten = BestEaten::all();
        $list = IngredientList::all();
        $units = UnitMeasurement::all();
        $preps = Preparation::all();
      
        return view('cook.adddish' , compact('beaten', 'list', 'units', 'preps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::id();
      
       $validator =  Validator::make($request->all(), [
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
       if($validator->fails())
       {
        return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();

       }
    
        $file = $request->file('img');
        
        $image = $this->uploadImage($file);
        
        $additional = $request['price'] * .10;
        $sPrice = $request['price'] + $additional;
       
        $dish = Dish::create(['authorCook_id' => $id,
            'dish_name' => $request['dish_name'],
            'basePrice' => $request['price'],
            'sellingPrice' => $sPrice,
            'dish_desc' => $request['dish_desc'],   
            'dish_img' => $image,
            'preparation_time' => $request['duration'],
            'no_of_servings' => $request['serving'],
            'status' => 1
            ]);

        for($i = 0 ; $i < count($request['best']); $i++) {
            $bestEaten = DishBestEaten::create(['dish_id' => $dish->did,
                                            'be_id' => $request['best'][$i],
                                            'status' => 1]);
        }
        
        $catalog = CookCatalog::create(['cook_id' => $dish->authorCook_id,
                                        'dish_id' => $dish->did,
                                        'isSignatureDish' => $request->signDish,
                                        'status' => 1]);
        
        $ingred = Input::get('ingid');
        $quan = Input::get('qtyy');
        $prep = Input::get('prepp');
        $um = Input::get('umm');

        for($i=0; $i<count($ingred);$i++)
        {
            
            $ing = DishIngredient::create([
                'um_id' => $um[$i],
                'dish_id' => $dish->did,
                'ing_id' => $ingred[$i],
                'quantity' => $quan[$i],
                'preparation' => $prep[$i],
                'status' => 1
                ]);
        }   
        

        $dish_ing = DishIngredient::join('unit_measurements', 'unit_measurements.um_id','=','dish_ingredients.um_id')
                            ->join('ingredient_list','ingredient_list.id','=','dish_ingredients.ing_id')
                            ->where('dish_ingredients.dish_id', $dish->did)
                            ->get();

        // dd($dish_ing->ding_id);
        $energy = 0;
        $protein = 0;
        $total_fat=0;
        $carbs=0;
        $fibre=0;
        $sodium=0;
        $sat_fat=0;
        $cholesterol=0;

        foreach ($dish_ing as $dishi) {
            $energy+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Energ_Kcal))/100;
            $protein+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Protein_g))/100;
            $total_fat+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Lipid_Tot_g))/100;
            $carbs+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Carbohydrt_g))/100;
            $fibre+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Fiber_TD_g))/100;
            $sodium+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Sodium_mg))/100;
            $sat_fat+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->FA_Sat_g))/100;
            $cholesterol+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Cholestrl_mg))/100;
        }
        $energy/=$request['serving'];
        $protein/=$request['serving'];
        $total_fat/=$request['serving'];
        $carbs/=$request['serving'];
        $fibre/=$request['serving'];
        $sodium/=$request['serving'];
        $sat_fat/=$request['serving'];
        $cholesterol/=$request['serving'];

            $nutrifacts = NutritionFacts::create([
                            'ding_id' => $dish->did,
                            'gram_weight' => '123',
                            'calories' => $energy,
                            'protein' => $protein,
                            'total_fat' => $total_fat,
                            'carbohydrate' => $carbs,
                            'fibre' => $fibre,
                            'sodium' => $sodium,
                            'sat_fat' => $sat_fat,
                            'cholesterol' => $cholesterol  

            ]);


        return redirect()->route('cook.dishes');
        // dd($cook);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dishes = Dish::where('did', $id)->get();
        $dish_ingredients = DishIngredient::where('did', $id)->join('dishes', 'dishes.did', '=', 'dish_ingredients.dish_id')
                    ->join('ingredient_list', 'ingredient_list.id', '=', 'dish_ingredients.ing_id')
                    ->join('unit_measurements', 'unit_measurements.um_id', '=', 'dish_ingredients.um_id')
                    ->join('preparations', 'preparations.p_id', '=', 'dish_ingredients.preparation')
                    ->get();

        $nutritional = NutritionFacts::where('ding_id', $id)->get();
        return view('cook.viewdet', compact('dishes', 'dish_ingredients','nutritional'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beaten = BestEaten::all();
        $dishes = Dish::where('did',$id)
                ->join('dish_besteaten', 'dish_besteaten.dish_id','=','dishes.did')
                ->join('besteaten_at', 'besteaten_at.be_id','=','dish_besteaten.be_id')
                ->join('cook_dishcatalog', 'cook_dishcatalog.dish_id', '=','dishes.did')
                ->get();
        $list = IngredientList::all();
        $units = UnitMeasurement::all();
        $preps = Preparation::all();
        $dish_ingredients = DishIngredient::where('did', $id)->join('dishes', 'dishes.did', '=', 'dish_ingredients.dish_id')
                    ->join('ingredient_list', 'ingredient_list.id', '=', 'dish_ingredients.ing_id')
                    ->join('unit_measurements', 'unit_measurements.um_id', '=', 'dish_ingredients.um_id')
                    ->join('preparations', 'preparations.p_id', '=', 'dish_ingredients.preparation')
                    ->get();

        
        return view('cook.editdish',compact('dishes', 'list', 'units', 'preps', 'beaten', 'dish_ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cook = Auth::id();


        $file = $request->file('img');
        $file2 = $request->input('img');
        // dd($request);
        if($file != null)
        {
         
            $img = $this->uploadImage($file);

        }
        else 
        {

            $img = $file2;
        }
        
        $additional = $request['price'] * .10;
        $sPrice = $request['price'] + $additional;

       $duration = $request->duration;
        $cduration = $request->cduration;
        $hrs = $request['hours'];
        $mins = $request['mins'];

        // dd($duration);

        $split = explode(",",$duration);
        $hour = rtrim($split[0],"h");
        $min = rtrim($split[1],"m");


        // $regex ="/^[0-9]+$/";
        // dd($duration);

        if($hour == 0 && $min == 0 ){
          $dishes = Dish::where('did', $id)
                       ->where('authorCook_id', $cook)
                       ->update(['dish_name' => $request->dish_name,
                                 'basePrice' => $request->price,
                                 'sellingPrice' => $sPrice,
                                 'dish_desc' => $request->dish_desc,
                                 'dish_img' =>  $img,
                                 'preparation_time' => $cduration,
                                 'no_of_servings' => $request->serving]);
        }
        else if($hour == 0){
            $ndur = $hrs.'h,'.$split[1];

            $dishes = Dish::where('did', $id)
                       ->where('authorCook_id', $cook)
                       ->update(['dish_name' => $request->dish_name,
                                 'basePrice' => $request->price,
                                 'sellingPrice' => $sPrice,
                                 'dish_desc' => $request->dish_desc,
                                 'dish_img' =>  $img,
                                 'preparation_time' => $ndur,
                                 'no_of_servings' => $request->serving]);
        }
        else if($min == 0){
            $ndur = $split[0].','.$mins.'m';

            $dishes = Dish::where('did', $id)
                       ->where('authorCook_id', $cook)
                       ->update(['dish_name' => $request->dish_name,
                                 'basePrice' => $request->price,
                                 'sellingPrice' => $sPrice,
                                 'dish_desc' => $request->dish_desc,
                                 'dish_img' =>  $img,
                                 'preparation_time' => $ndur,
                                 'no_of_servings' => $request->serving]);
        }
        else{
          $dishes = Dish::where('did', $id)
                       ->where('authorCook_id', $cook)
                       ->update(['dish_name' => $request->dish_name,
                                 'basePrice' => $request->price,
                                 'sellingPrice' => $sPrice,
                                 'dish_desc' => $request->dish_desc,
                                 'dish_img' =>  $img,
                                 'preparation_time' => $duration,
                                 'no_of_servings' => $request->serving]);
        }
     
        for($i= 0; $i < count($request['best']) ; $i++) {
        $dishes = DishBestEaten::where('dish_id', $dishes)
            ->update(['be_id' => $request['best'][$i]]);
        }


        $ingred = Input::get('ingid');
        $quan = Input::get('qtyy');
        $prep = Input::get('prepp');
        $um = Input::get('umm');

        $quann = Input::get('qtyys');
        $prepp = Input::get('prepps');
        $umm = Input::get('umms');

        $dingid = Input::get('ding_id');


                if($dingid){
                  for($i=0; $i<count($dingid); $i++){
                    $ings = DishIngredient::where('ding_id', $dingid[$i])
                                            ->update(['quantity'=>$quann[$i],
                                                      'preparation'=>$prepp[$i],
                                                      'um_id'=>$umm[$i]]);
                  }
                }
                else{
                  for($i=0; $i<count($ingred);$i++){
                    $ingredients = DishIngredient::create([
                            'um_id' => $um[$i],
                            'dish_id' => $id,
                            'ing_id' => $ingred[$i],
                            'quantity' => $quan[$i],
                            'preparation' => $prep[$i],
                            'status' => 1

                    ]);
                  }
                }




                $dish_ing = DishIngredient::join('unit_measurements', 'unit_measurements.um_id','=','dish_ingredients.um_id')
                            ->join('ingredient_list','ingredient_list.id','=','dish_ingredients.ing_id')
                            ->where('dish_ingredients.dish_id', $id)
                            ->get();

        // dd($dish_ing->ding_id);
        $energy = 0;
        $protein = 0;
        $total_fat=0;
        $carbs=0;
        $fibre=0;
        $sodium=0;
        $sat_fat=0;
        $cholesterol=0;

        foreach ($dish_ing as $dishi) {
            $energy+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Energ_Kcal))/100;
            $protein+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Protein_g))/100;
            $total_fat+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Lipid_Tot_g))/100;
            $carbs+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Carbohydrt_g))/100;
            $fibre+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Fiber_TD_g))/100;
            $sodium+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Sodium_mg))/100;
            $sat_fat+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->FA_Sat_g))/100;
            $cholesterol+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Cholestrl_mg))/100;
        }

        // foreach($dish_ing as $disho){
            // var_dump($dishi->ding_id);

        $energy/=$request->serving;
        $protein/=$request->serving;
        $total_fat/=$request->serving;
        $carbs/=$request->serving;
        $fibre/=$request->serving;
        $sodium/=$request->serving;
        $sat_fat/=$request->serving;
        $cholesterol/=$request->serving;


            $nutrifacts = NutritionFacts::where('ding_id', $id)
                            ->update([
                            'gram_weight' => '123',
                            'calories' => $energy,
                            'protein' => $protein,
                            'total_fat' => $total_fat,
                            'carbohydrate' => $carbs,
                            'fibre' => $fibre,
                            'sodium' => $sodium,
                            'sat_fat' => $sat_fat,
                            'cholesterol' => $cholesterol  

            ]);




      
        return redirect()->route('cook.dishes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function removeIng(Request $request){
        
        $id = $request->id;
        $ingred = DishIngredient::where('ding_id', $id)->delete();
        // $ingred->delete();

        return redirect()->route('cook.dishes.edit');
        // return Redirect::back();
    }

    public function destroy($id)
    {
//        $dish = Dish::where('did', $id)->get();
//        $dish->update('status' => 0);        
//        $dish->delete();
        $dish = Dish::where('did', $id)->delete();


        return redirect()->route('cook.dishes');
    }


    public function uploadImage($file)
    {

       if($file != null)
        { 
            $destination_path = public_path(). '/dish_imgs';
            $filename = $file->getClientOriginalName();
            $file->move($destination_path, $filename);
                
            $img = $filename;
        }
            
   

        return $img;
    }


   
   public function addCatalog() {
       return view('cook.catalog');
   }
   
   public function createCatalog(Request $request) {
       $cook = Auth::id();
       $id = $request->dish_id;
       $dishes = Dish::where('did', $id)->get();
       
       $checkCatalog = CookCatalog::where('cook_id', $cook)->where('dish_id', $id)->get();

       if($checkCatalog->isEmpty()) {
         foreach($dishes as $dish) {
            $catalog = CookCatalog::create([
                    'cook_id' => $cook,
                    'dish_id' => $dish->did,
                    'isSignatureDish' => $request->signDish,
                    'status' => 1
                ]);   
         }
           
           
           
         return redirect()->route('cook.dishes'); 
           
       }
       else {
        
         return redirect()->back()->with('error', 'Dish already exists in catalog.');
       }
       
       
       
   }
   
   public function searchDishes(Request $request) {
       
        $term = $request->term;
        $lists = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                    ->where('dishes.dish_name', 'LIKE', $term.'%')
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
    
    public function previewDish($id) {
//        $id = $request->input('id');
        $dishes = Dish::join('dish_besteaten','dishes.did', '=', 'dish_besteaten.dish_id')
                    ->join('besteaten_at', 'dish_besteaten.be_id' , '=', 'besteaten_at.be_id')
                    ->where('dishes.did', $id)
                    ->get(); 
        
        return $dishes;
    }
    
    public function searchIngredient(Request $request) {
        $term = $request->term;
        $items = IngredientList::where('Shrt_Desc', 'LIKE', '%'.$term.'%')->get()->take(10);
        

        // if(count($items) == 0)
        // {
        //     $result[] = 'Not Found';

        // }
        // else
        // {
        //     foreach($items as $key => $value){
                
        //             $result[] = $value->id;
        //             $result[] = $value->Shrt_Desc;
        //     }
        // }
        // return $result;


        if(count($items) == 0) {
            $result[] = 'No dishes found';
        }
        else {
            foreach($items as $key => $value)
            {
   
                $result[] = $value;
            }
        }
       
        return $result;





    }

    public function viewPlan(){
      $id=Auth::id();
      $dishes=Dish::where('authorCook_id', $id)->where('no_of_servings' , 1)->where('dish_type','Planned')->get();
      
      
      return view('cook.makeplan', compact('dishes'));
    }
    

    public function storePlan(Request $request){
      $cook = Auth::user();
      $dish_id= Input::get('dish_id');
      
      $dish = Dish::findOrFail($dish_id);
      // dd($dish[1]);
      // abort(403, 'Unauthorized action.');
      // $pmeal = Pmealdishes::where('dish_id',$dish_id);
      // dd($pmeal);

        

        $pdishes = Pmealdishes::all();

        return redirect()->route('cook.pmdishes', compact('pdishes'));
     }

     public function viewrating($id){
    // dd($id);
    $rate=Ratings::join('user_orders', 'user_orders.uo_id', '=', 'dish_ratings.uorder_id')
                  ->join('dishes', 'dishes.did', '=', 'dish_ratings.dish_id')
                  ->where('dishes.did', $id)->paginate(6);
    $avg=Dish::where('did', $id)->get();
   
    return view('cook.reviews', compact('rate', 'avg'));
   }

   public function createPlan()
   {

    $beaten = BestEaten::all();
        $list = IngredientList::all();
        $units = UnitMeasurement::all();
        $preps = Preparation::all();

    return view('cook.plancreatedish', compact('beaten', 'list', 'units', 'preps'));
   }

   public function makePlan(Request $request)
   {
      $cook = Auth::user();
        $validator =  Validator::make($request->all(), [
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
       if($validator->fails())
       {
        return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();

       }
    
        $file = $request->file('img');
        
        $image = $this->uploadImage($file);
        $additional = $request['price'] * .10;
        $sPrice = $request['price'] + $additional;

        $dish = Dish::create(['authorCook_id' => $cook->id, 
            'dish_name' => $request['dish_name'],
            'basePrice' => $request['price'],
            'sellingPrice' => $sPrice,
            'dish_desc' => $request['dish_desc'],   
            'dish_img' => $image,
            'preparation_time' => $request['duration'],
            'no_of_servings' => $request['serving'],
            'status' => 1,
            'dish_type' => 'Planned'
          ]);

        for($i = 0 ; $i < count($request['best']); $i++) {
            $bestEaten = DishBestEaten::create(['dish_id' => $dish->did,
                                            'be_id' => $request['best'][$i],
                                            'status' => 1]);
        }


        $ingred = Input::get('ingid');
        $quan = Input::get('qtyy');
        $prep = Input::get('prepp');
        $um = Input::get('umm');

        for($i=0; $i<count($ingred);$i++)
        {
            
            $ing = DishIngredient::create([
                'um_id' => $um[$i],
                'dish_id' => $dish->did,
                'ing_id' => $ingred[$i],
                'quantity' => $quan[$i],
                'preparation' => $prep[$i],
                'status' => 1
                ]);
        }   
        

        $dish_ing = DishIngredient::join('unit_measurements', 'unit_measurements.um_id','=','dish_ingredients.um_id')
                            ->join('ingredient_list','ingredient_list.id','=','dish_ingredients.ing_id')
                            ->where('dish_ingredients.dish_id', $dish->did)
                            ->get();

        // dd($dish_ing->ding_id);
        $energy = 0;
        $protein = 0;
        $total_fat=0;
        $carbs=0;
        $fibre=0;
        $sodium=0;
        $sat_fat=0;
        $cholesterol=0;

        foreach ($dish_ing as $dishi) {
            $energy+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Energ_Kcal))/100;
            $protein+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Protein_g))/100;
            $total_fat+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Lipid_Tot_g))/100;
            $carbs+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Carbohydrt_g))/100;
            $fibre+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Fiber_TD_g))/100;
            $sodium+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Sodium_mg))/100;
            $sat_fat+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->FA_Sat_g))/100;
            $cholesterol+= (($dishi->quantity*$dishi->unit_grams)*floatval($dishi->Cholestrl_mg))/100;
        }
        $energy/=$request['serving'];
        $protein/=$request['serving'];
        $total_fat/=$request['serving'];
        $carbs/=$request['serving'];
        $fibre/=$request['serving'];
        $sodium/=$request['serving'];
        $sat_fat/=$request['serving'];
        $cholesterol/=$request['serving'];

            $nutrifacts = NutritionFacts::create([
                            'ding_id' => $dish->did,
                            'gram_weight' => '123',
                            'calories' => $energy,
                            'protein' => $protein,
                            'total_fat' => $total_fat,
                            'carbohydrate' => $carbs,
                            'fibre' => $fibre,
                            'sodium' => $sodium,
                            'sat_fat' => $sat_fat,
                            'cholesterol' => $cholesterol  

            ]);

            return redirect()->route('cook.view.plan');
   }
}
