<?php

namespace App\Http\Controllers;


use App\User;
use App\Dish;
use App\BestEaten;
use App\DishBestEaten;
use Illuminate\Http\Request;
use App\Cook;
use Validator;
use App\IngredientList;
use App\UnitMeasurement;
use App\DishIngredient;
use App\Preparation;
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
                        ->get();  
        foreach($dishes as $dish) {
            $dbestEaten = DishBestEaten::join('besteaten_at' , 'besteaten_at.be_id', '=' , 'dish_besteaten.be_id')
                                        ->where('dish_id', $dish->did)->get();
        }               
        
        
      return view('cook.dishes', compact('dishes', 'dbestEaten'));
    
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
            $bestEaten = DishBestEaten::create(['dish_id' => $dish->id,
                                            'be_id' => $request['best'][$i],
                                            'status' => 1]);
        }
        // $um = Input::get('unit');
        // $prep = Input::get('preparation');
        // for($j = 0 ; $j < count($request['unit']); $j++) {
        //     $ingredients = DishIngredient::create(['um_id'=> $um,
        //         'dish_id' => $dish->id,
        //         'quantity' => $request['quantity'],
        //         'preparation' => $prep,
        //         'status' => 1
        //         ]);
        // }
        $ingred = Input::get('ingredients');
        $quan = Input::get('quantity');
        $prep = Input::get('preparation');
        $um = Input::get('um');

        for($i=0; $i<count($ingred);$i++)
        {
            
            $ing = DishIngredient::create([
                'um_id' => $um[$i],
                'dish_id' => $dish->id,
                'quantity' => $request['quantity'][$i],
                'preparation' => $prep[$i],
                'status' => 1

                ]);
        }   
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
        return view('cook.viewdet', compact('dishes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dishes = Dish::where('did',$id)->get();
        $list = IngredientList::all();
        $units = UnitMeasurement::all();
        $preps = Preparation::all();
        return view('cook.editdish',compact('dishes', 'list', 'units', 'preps'));
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

       $dishes = Dish::where('did', $id)
                       ->where('authorCook_id', $cook)
                       ->update(['dish_name' => $request->dish_name,
                                 'basePrice' => $request->price,
                                 'sellingPrice' => $sPrice,
                                 'dish_desc' => $request->dish_desc,
                                 'dish_img' =>  $img,
                                 'preparation_time' => $request->duration,
                                 'no_of_servings' => $request->serving]);
     
        for($i= 0; $i < count($request['best']) ; $i++) {
        $dishes = DishBestEaten::where('dish_id', $dishes)
            ->update(['be_id' => $request['best'][$i]]);
        }
      
        return redirect()->route('cook.dishes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
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


   public function viewrating(){
    return view('cook.reviews');
   }

}
