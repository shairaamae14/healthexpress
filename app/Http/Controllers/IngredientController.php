<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cook.addingred');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id = Auth::id();
        $ingredient = Ingredient::create(['dish_id' => $id,
            'ing_name' => $request['Ingname'],
            'quantity' => $request['quantity'],
            'unit_of_measure' => $request['uom']
            ]);
        $ingredient->save();

            return redirect()->route('cook.viewdish');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $ingredient = Ingredient::findOrFail($id);
        
        return view('dish.viewingredients', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ingredient = Ingredient::find($id);
        return view('dish.editingredient',compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $dish = Auth::id();
        $ingredient = Ingredient::where('id', $id)
            ->where('dish_id', $dish)
            ->update(['quantity' => $request->quantity,
                      'unit_of_measure' => $request->uom
                    ]);
      
        return redirect()->route('dish.ingredient');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();

        return redirect()->route('dish.ingredients');
    }
}
