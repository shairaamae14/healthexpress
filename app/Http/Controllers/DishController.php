<?php

namespace App\Http\Controllers;


use App\User;
use App\Dish;
use App\DishDetail;
use App\DishCategories;
use Illuminate\Http\Request;
use App\Cook;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        
        $dishes = Dish::where('cook_id', $id)
                        ->get();
                        
          
       
        //dd($dish_details);
//        foreach($category as $cat) {
//            $dcategories = DishCategories::where('id',$cat)->get();
//            
//        }
     
//        dd($dcategories);
        
      return view('cook.dishes', compact('dishes', 'dish_details', 'image', 'dcategories'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cook.adddish');
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
        
        $cat = $request['dish_cat'];
        $dish = Dish::create(['cook_id' => $id,
            'dish_name' => $request['dish_name'],
            'status' => 1
            ]);
        
        for($i= 0; $i < count($cat) ; $i++) {
 
            $details = DishDetail::create([
            'dish_id' => $dish->id,
            'dcat_id' => $cat[$i],
            'dish_price' => $request['price'],
            'dish_desc' => $request['dish_desc'],
            'dish_img' => $image,
            'dish_leadTime' => $request['lead_time'],
            'serving_size' => $request['serving'],       
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
        $dish = Dish::findOrFail($id);
        
        return view('cook.viewdish', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = Dish::find($id);
        return view('cook.editdish',compact('dish'));
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
        
        
       $cat = $request['dish_cat'];
       $dishes = Dish::where('id', $id)
                       ->where('cook_id', $cook)
                       ->update(['dish_name' => $request->dish_name,]);
        for($i= 0; $i < count($cat) ; $i++) {
        $dishes = DishDetail::where('dish_id', $id)
            ->update([
                      'dcat_id' => $cat[$i],
                      'dish_price' => $request->price,
                      'dish_desc' => $request->dish_desc,
                      'dish_img' => $img,
                      'dish_leadTime' => $request->lead_time,
                      'serving_size' => $request->serving
                    ]);
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
        $dish = Dish::findOrFail($id);
        $dish->delete();

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
