<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngredientListController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('demos.livesearch');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    public function liveSearch(Request $request)
    { 
        \DB::disableQueryLog();
        ini_set('memory_limit', '2048M');
        $search = $request->id;
        $all = Product::all();

        if (is_null($search))
        {
           return view('demos.livesearch');        
        }
        else
        {
            $ingreds = Search::where('product_name','LIKE',"%{$search}%")->get();
            
            return view('demos.livesearchajax', compact('ingreds'));
        }
    }
    // public function search(Request $request) {
    //         $search_text = $request->q;
    //         if ($search_text==NULL) {
    //             $data= Search::all();
    //         } else {
    //             $data=Search::where('product_name','LIKE', '%'.$search_text.'%')->get();
    //         }
    //         return view('results')->with('results',$data);
    //     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }
}
