<?php

namespace App;


class Cart
{
    public $items= null;
    public $totalQty=0;
    public $totalPrice=0;
    public $AllTotal=0;
    public $deliveryFee=40;

    
    public function __construct($oldCart){
    	if($oldCart){
    		$this->items= $oldCart->items;
    		$this->totalQty= $oldCart->totalQty;
            $this->AllTotal=$oldCart->AllTotal;
             $this->deliveryFee=$oldCart->deliveryFee;


    	} 
    }

  
 public function addCart($item, $id, $price){
// $dish=Dish::where('did', $id)->get();
      $storedItem=['qty'=>0, 'price1'=>$price, 'item'=>$item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem= $this->items[$id];
              
            }
        }
        $storedItem['qty']++;
        $storedItem['price1'] = $price * $storedItem['qty'];
        $this->items[$id]= $storedItem;
        $this->totalQty++;
        $tempprice = $storedItem['price1'];
         $this->totalPrice+= $tempprice+$price;
        // $this->AllTotal +=$storedItem['delfee'];
         $this->AllTotal =$this->totalPrice +40;


   }

    
}
