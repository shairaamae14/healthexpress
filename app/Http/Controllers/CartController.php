<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Cart;
use App\Dish;
use Auth;
use App\User;
use App\OrderMode;
use App\Cook;
class CartController extends Controller
{
public function cart() {
    if (Request::isMethod('post')) {
        $dish_id = Request::get('dish_id');
        $dishes = Dish::where('did', $dish_id)->get();
        $subtotal=Cart::subtotal();
        $note=Request::get('sidenote');
       foreach($dishes as $d){
          $fname=$d->cook['first_name'];
          $lname=$d->cook['last_name'];
          $cookname=$fname.' '.$lname;

        Cart::add(array('id' => $d->did, 'cook_id'=>$d->authorCook_id, 'cookname'=>$cookname, 'name' => $d->dish_name, 'qty' => 1, 'price' => $d->sellingPrice, 'sidenote' =>$note));

            }
            // dd(Cart::Content());   
    }
   return redirect()->route('user.index');
}

public function updateCart(){
    //increment the quantity
  if (Request::get('dish_id') && (Request::get('increment')) == 1) {
      $item = Cart::search(function($key, $value) { 
        return $key->id == Request::get('dish_id'); 
         })->first();
      Cart::update($item->rowId, $item->qty + 1);
    }
    //decrement the quantity
  else if (Request::get('dish_id') && (Request::get('decrease')) == 1) {
    $item = Cart::search(function($key, $value) { 
      return $key->id == Request::get('dish_id');
       })->first();
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
        // $cook=Request::get('cook_name');
        foreach($dishes as $dc){
            $fname=$dc->cook['first_name'];
          $lname=$dc->cook['last_name'];
          $cook=$fname.' '.$lname;
          // dd($cookname);
        }
    
        foreach($dishes as $d){
        
        Cart::add(array('id' => $d->did, 'cook_id'=>$d->authorCook_id, 'cookname'=>$cook, 'name' => $d->dish_name, 'qty' => 1, 'price' => $d->sellingPrice, 'sidenote' =>$note));
        // dd($cartgroup);
  
            }
               $cartgroup=Cart::content();
               $cartitems=$cartgroup->groupBy('cookname');
               // $cartitems=toArray();
                    dd($cartitems);
          }
   return redirect()->route('home.details', compact('dish', 'cartitems'));
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

public function setDetails(Request $request){
  $user = Auth::id();
  // $dish=Input::get('dish');
  $cook_id=Input::get('cook_id');
  $mode = OrderMode::find(1);
  $cooks=array();
for($i=0; $i<count($cook_id); $i++){
   $cooks[$i]=Cook::where('id', $cook_id[$i])->get();
  }
  $cooks=array_unique($cooks);


  $customer= User::where('id', $user)->get();
  return view('user.eorderdetails', compact('customer', 'dishes', 'cooks', 'mode'));
}
 
}



