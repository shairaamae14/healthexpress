<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Dish;

class CartController extends Controller
{
public function cart() {
    if (Request::isMethod('post')) {
        $dish_id = Request::get('dish_id');
        $dishes = Dish::where('did', $dish_id)->get();
        $delfee=40;
        $subtotal=Cart::subtotal();
      
        $note=Request::get('sidenote');
     
    
        foreach($dishes as $d){
   
        Cart::add(array('id' => $d->did, 'name' => $d->dish_name, 'qty' => 1, 'price' => $d->sellingPrice, 'sidenote' =>$note));
  
            }
    
        


       // dd($alltotal);
    }
   return redirect()->route('user.index');
}

public function updateCart(){
        //increment the quantity
   if (Request::get('dish_id') && (Request::get('increment')) == 1) {
$item = Cart::search(function($key, $value) { return $key->id == Request::get('dish_id'); })->first();
Cart::update($item->rowId, $item->qty + 1);
}
    //decrease

    else if (Request::get('dish_id') && (Request::get('decrease')) == 1) {
$item = Cart::search(function($key, $value) { return $key->id == Request::get('dish_id'); })->first();
Cart::update($item->rowId, $item->qty - 1);
}

 return redirect()->route('user.index');

}

public function destroyCart(){
    Cart::destroy();
    return redirect()->route('user.index');
}

public function removeDish(){
   
if (Request::get('dish_id') && (Request::get('remove')) == 'true') {
$item = Cart::search(function($key, $value){
 return $key->id == Request::get('dish_id'); 
})->first();
 // $item = Cart::get($rowId[0]);
 Cart::remove($item->rowId);
}


return redirect()->route('user.index'); 
}



public function detcart() {
    if (Request::isMethod('post')) {
        $dish = Request::get('dish_id');
        $dishes = Dish::where('did', $dish)->get();
        $delfee=40;
        $subtotal=Cart::subtotal();
      
        $note=Request::get('sidenote');
     
    
        foreach($dishes as $d){
   
        Cart::add(array('id' => $d->did, 'name' => $d->dish_name, 'qty' => 1, 'price' => $d->sellingPrice, 'sidenote' =>$note));
  
            }
    
        


       // dd($alltotal);
    }
   return redirect()->route('home.details', compact('dish'));
}

public function detupdateCart(){
        //increment the quantity
    $dish=Request::get('dish_id');
   if (Request::get('dish_id') && (Request::get('increment')) == 1) {
$item = Cart::search(function($key, $value) { return $key->id == Request::get('dish_id'); })->first();
Cart::update($item->rowId, $item->qty + 1);
}
    //decrease

    else if (Request::get('dish_id') && (Request::get('decrease')) == 1) {
$item = Cart::search(function($key, $value) { return $key->id == Request::get('dish_id'); })->first();
Cart::update($item->rowId, $item->qty - 1);
}

   return redirect()->route('home.details', compact('dish'));

}

public function detdestroyCart(){
         $dish=Request::get('dish_id');
    Cart::destroy();
    return redirect()->route('home.details', compact('dish'));
}

public function detremoveDish(){
   $dish=Request::get('dish_id');
if (Request::get('dish_id') && (Request::get('remove')) == 'true') {
$item = Cart::search(function($key, $value){
 return $key->id == Request::get('dish_id'); 
})->first();
 // $item = Cart::get($rowId[0]);
 Cart::remove($item->rowId);
}


  return redirect()->route('home.details', compact('dish'));
}



}



