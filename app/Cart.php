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
    		$this->totalPrice= $oldCart->totalPrice;
            $this->AllTotal=$oldCart->AllTotal;
             $this->deliveryFee=$oldCart->deliveryFee;


    	} 
    }

  
 public function addCart($item, $id, $price){
// $dish=Dish::where('did', $id)->get();
      $storedItem=['qty'=>0, 'item'=>$item, 'price1'=>$price];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem= $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price1'] = $price * $storedItem['qty'];
        $this->items[$id]= $storedItem;
        $this->totalQty++;
        $this->totalPrice =$storedItem['price1']+ $this->totalPrice;
        // $this->AllTotal +=$storedItem['delfee'];
         $this->AllTotal =$this->totalPrice +40;

   }

    
}
