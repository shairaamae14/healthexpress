<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('livesearch');
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
        $search = $request->id;
        $all = searches::all();

        if (is_null($search))
        {
           return view('cook.adddish');        
        }
        else
        {
            $ingreds = searches::where('product_name','LIKE',"%{$search}%")->get();
            // var_dump($ingreds);
            return view('cook.livesearchajax', compact('ingreds'));
        }
    }
    public function search(Request $request) {
            $search_text = $request->q;
            if ($search_text==NULL) {
                $data= searches::all();
            } else {
                $data=searches::where('product_name','LIKE', '%'.$search_text.'%')->get();
            }
            return view('results')->with('results',$data);
        }

    // public function search($text)
    // {
    //     $results = Search::where('name', 'LIKE', '%'.$text.'%')->get();
    //     return view('livesearch', compact('results'));
    // }
        // public function search($search = null) {
        //     $search_text = $search;
        //     if ($search_text==NULL) {
        //         $data= Search::all();
        //         return view('livesearch', compact('data'));
        //     } else {
        //         $data=Search::where('name','LIKE', '%'.$search_text.'%')->get();
        //         return view('livesearch', compact('data'));
        //     }
            
        // }

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
