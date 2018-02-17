<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Dish;
use App\Orders;
use App\UserOrder;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\OrderMode;
use App\PaymentMethod;
use Braintree_ClientToken;
use Braintree_Transaction;
use Braintree_CreditCard;
use Braintree_Customer;
use Cart;
use Session;
use Illuminate\Support\Facades\Input;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function checkout(Request $request){
        $user=Auth::user();
        $lat=0;
        $long=0;
        $distance=0;
        $delcharge=0;
        $totaldelfee=0;
        $address;
        $contactnum;

        $cooklat=Input::get('cooklat');
        $cooklng=Input::get('cooklng');
        $dish_id=Input::get('dish');
        $sidenote=Input::get('sidenote');
        $name=Input::get('name');
        $totalqty=Input::get('qty');
        $om_id=1;
        $mode_delivery="Delivery";
        $order_status="Pending";

        if($request['address']=="default"){
          $lat=$request['cLat'];
          $long=$request['cLng'];
          $address=$request['userlocation'];
          $contactnum=$request['contact_no'];
         // dd($lat, $long);
        }
        else if($request['address']=="new"){
          $lat=$request['cityLat'];
          $long=$request['cityLng'];
          $address=$request['location'];
          $contactnum=$request['contact_num'];
          // dd($lat, $long, $address, $contactnum);
        }
        // dd($address,$contactnum);

        for($i=0; $i<count($cooklat); $i++){
            $cooklatt[$i]=$request['cooklat'][$i];
            $cooklngg[$i]=$request['cooklng'][$i];     
     //calculate  
     
            $distance=array();
            $theta=array();
            $dist=array();
            $distacos=array();
            $miles=array();
            $distance=[];
            $delcharge=array();
            $theta[$i] = $cooklng[$i] - $long;
            $dist[$i]= sin(deg2rad($cooklatt[$i])) * sin(deg2rad($lat)) +  cos(deg2rad($cooklatt[$i])) * cos(deg2rad($lat)) * cos(deg2rad($theta[$i]));
            $distacos[$i] = acos($dist[$i]);
            $distrad[$i] = rad2deg($distacos[$i]);
            $miles[$i] = $distrad[$i] * 60 * 1.1515;
             $distance[$i]=$miles[$i] * 1.609344;
             $distance[$i]=round($distance[$i],2);
                   if($distance[$i]>5.00){
                   $delcharge[$i]=40.00+(2.50*($distance[$i]-5));
                      // dd($delcharge);
                   $totaldelfee+=$delcharge[$i];
                  }
                  else if ($distance[$i]<=5.00){
                   $delcharge[$i]=40.00;
                   $totaldelfee+=$delcharge[$i];
                   }
                  
                  // dd($totaldelfee);
              //    $distance[$i] = collect();
              // Session::push('distance', $distance); 
              // dd($distance[0]);
         }
        
     


        $option = $request->option;
        $user = Auth::user();
        if(!$user->braintree_id) {
           $clientToken = Braintree_ClientToken::generate(); 
        }
        else {
            $clientToken = Braintree_ClientToken::generate([
                'customerId' => $user->braintree_id
            ]); 
        }
        
        if($option == 'Delivery') {
            $service = $option;
       

        }
        else {
            $service = $option;
        }

        $userorder=UserOrder::join('users', 'users.id', '=', 'user_orders.user_id')
                            ->where('om_id', 1)
                            ->where('order_status', 'Pending')
                            ->where('user_id', $user->id)
                            ->groupBy('user_id')
                            ->get();
        $userorder1=UserOrder::where('om_id', 1)->where('user_id', $user->id)->where('order_status', 'Pending')->get();
                    // $totaldelfee=0;
                    // $subtotal=0;
                // dd($totaldelfee);

              $subtotal=Cart::subtotal();
              $alltotal=$subtotal+$totaldelfee;
        return view('user.paymentmethod', compact('option', 'clientToken', 'userorder', 'totaldelfee', 'alltotal','lat','long','mode_delivery','address','contactnum', 'distance'));
    }   
    
    public function index()
    {
         
        return view('user.paymentmethod');
        
    }

    
    public function order(Request $request) {
        $order = new Order();
        $order->m_id = $request['mode_id'];
        $order->save();
        
        return $order;
    }
    
    
    public function payment(Request $request) {
        $customer = Auth::user();
        $user = User::find($customer->id);
        $status = 'Pending';
        $sidenote = $request->sidenote;
        $total_amount = $request['amount'];
        $nonce = $request['payment_method_nonce'];
        
        $transactionStatuses = [
            Braintree_Transaction::AUTHORIZED,
            Braintree_Transaction::AUTHORIZING,
            Braintree_Transaction::SETTLED,
            Braintree_Transaction::SETTLING,
            Braintree_Transaction::SETTLEMENT_CONFIRMED,
            Braintree_Transaction::SETTLEMENT_PENDING,
            Braintree_Transaction::SUBMITTED_FOR_SETTLEMENT,
        ];
        if(!$customer->braintree_id) {
            $cust = Braintree_Customer::create([
                    'paymentMethodNonce' => $nonce,
                    'creditCard' => [
                        'billingAddress' => [
                          'firstName' => $customer->fname,
                          'lastName' => $customer->lname,
                          'streetAddress' => $customer->location

                        ],
                        'options' => [
                            'verifyCard' => true
                        ]
                    ]
            ]);
           
            $user->braintree_id = $cust->customer->id;
            $user->card_brand = $cust->customer->creditCards[0]->cardType;
            $user->card_last_four = $cust->customer->creditCards[0]->last4;
            $user->save();
            
            $result = Braintree_Transaction::sale([
                'amount' => $total_amount,
                'customerId' => $user->braintree_id,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
            $transaction = Braintree_Transaction::find($result->transaction->id);
            if(in_array($transaction->status, $transactionStatuses)) {
                for ($index = 0; $index < count($request->dish); $index++) {
                    $user_order = UserOrder::create(['user_id' => $user->id, 
                'payment_id' => 1, 
                'order_date' => \Carbon\Carbon::now(),
                'totalQty' => $request['qty'][$index], 
                 'totalAmount' => $request['total'][$index], 
                 'order_status' => $status,
                  'sidenote' => $request['sidenote'][$index], 
                  'om_id' => 1, 
                  'dish_id' => $request['dish'][$index],
                  'address' =>$request['address'], 
                  'contact_no' => $request['contact'],
                  'mode_delivery' => $request['mode_delivery'], 
                  'delivery_fee' => $request['delivery_fee'],
                  'distance' => $request['distance'][$index],
                  'latitude' =>$request['lat'],
                  'longitude' =>$request['long']
                ]);
                }   
                Cart::destroy();
            }
        }
        else {
            $result = Braintree_Transaction::sale([
                'amount' => $request->amount,
                'customerId' => $customer->braintree_id,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
            $transaction = Braintree_Transaction::find($result->transaction->id);
            if(in_array($transaction->status, $transactionStatuses)) {
                for ($index = 0; $index < count($request->dish); $index++) {
                    $user_order = UserOrder::create(['user_id' => $user->id, 
                'payment_id' => 1, 
                'order_date' => \Carbon\Carbon::now(),
                'totalQty' => $request['qty'][$index], 
                 'totalAmount' => $request['total'][$index], 
                 'order_status' => $status,
                  'sidenote' => $request['sidenote'][$index], 
                  'om_id' => 1, 
                  'dish_id' => $request['dish'][$index],
                  'address' =>$request['address'], 
                  'contact_no' => $request['contact'],
                  'mode_delivery' => $request['mode_delivery'], 
                  'delivery_fee' => $request['delivery_fee'],
                  'distance' => $request['distance'][$index],
                  'latitude' =>$request['lat'],
                  'longitude' =>$request['long']
                ]);
                }   
                Cart::destroy();
            }
        }
        return redirect()->route('order.orderhistory');
    }
    
    public function orderStatus($id, Request $request,$user) {
        $transaction = Braintree_Transaction::find($id);
        $status = 'Pending';
        $sidenote = $request->sidenote;

        $transactionStatuses = [
            Braintree_Transaction::AUTHORIZED,
            Braintree_Transaction::AUTHORIZING,
            Braintree_Transaction::SETTLED,
            Braintree_Transaction::SETTLING,
            Braintree_Transaction::SETTLEMENT_CONFIRMED,
            Braintree_Transaction::SETTLEMENT_PENDING,
            Braintree_Transaction::SUBMITTED_FOR_SETTLEMENT,
        ];
        
        if(in_array($transaction->status, $transactionStatuses)) {
          
        }
    
    }
    
    public function initCustomer(Request $request) {
        $customer = Auth::user();
        if(!$customer->braintree_id) {
            $result = Braintree_Customer::create([
                        'firstName' => $customer->fname,
                        'lastName' => $customer->lname
                
            ]);
            
        }
        
        return $result;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $orders = collect();
        $user_order = collect();
        $status = 'Pending';
        $dish = $request['dish'];
        // dd($dish);
        if($request['payment_mode'] == 'COD') {
            for ($index = 0; $index < count($dish); $index++) {
              $user_order = UserOrder::create(['user_id' => $user->id, 
                'payment_id' => 1, 
                'order_date' => \Carbon\Carbon::now(),
                'totalQty' => $request['qty'][$index], 
                 'totalAmount' => $request['total'][$index], 
                 'order_status' => $status,
                  'sidenote' => $request['sidenote'][$index], 
                  'om_id' => 1, 
                  'dish_id' => $request['dish'][$index],
                  'address' =>$request['address'], 
                  'contact_no' => $request['contact'],
                  'mode_delivery' => $request['mode_delivery'], 
                  'delivery_fee' => $request['delivery_fee'],
                  'distance' => $request['distance'][$index],
                  'latitude' =>$request['lat'],
                  'longitude' =>$request['long']
                ]);
            }
        }
        Cart::destroy();
        return redirect()->route('order.orderhistory');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */ 
    public function show(Orders $orders)
    {
        $user = Auth::user();

        $orders = UserOrder::where('user_id', $user->id)->orderBy('order_date', 'desc')->get();

        $pending = UserOrder::where('user_id', $user->id)->where('order_status', 'Pending')
                            ->orderBy('order_date', 'desc')->get();
        $cooking = UserOrder::where('user_id', $user->id)->where('order_status', 'Cooking')
                            ->orderBy('order_date', 'desc')->get();
        $delivering = UserOrder::where('user_id', $user->id)->where('order_status', 'Delivering')
                            ->orderBy('order_date', 'desc')->get();
        $datetoday = Carbon::now('Asia/Manila')->format('Y-m-d');
        $completed = UserOrder::where('user_id', $user->id)->where('order_status', 'Completed')
                            ->where('order_date', $datetoday)->orderBy('order_date', 'desc')->get();
                // $pending= UserOrder::join('dishes' , 'dishes.did', '=' , 'user_orders.dish_id')
                // ->join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                // ->where('user_id', $id)
                // ->groupBy('dish_id')
                // ->orderBy('order_date', 'desc')
                //  ->where('order_status', '=', 'Pending')
                // ->get();

                // $cooking= UserOrder::join('dishes' , 'dishes.did', '=' , 'user_orders.dish_id')
                // ->join('cooks', 'cooks.id', '=', 'dishes.authorCook_id')
                // ->where('user_id', $id)
                // ->groupBy('dish_id')
                // ->orderBy('order_date', 'desc')
                // ->where('order_status', '=', 'Cooking')
                // ->get();

                // $delivering= UserOrder::join('dishes' , 'dishes.did', '=' , 'user_orders.dish_id')
                // ->where('user_id', $id)
                //  ->groupBy('dish_id')
                //  ->orderBy('order_date', 'desc')
                //  ->where('order_status', '=', 'Delivering')
                // ->get();

                // $datetoday=Carbon::now('Asia/Manila')->format('Y-m-d');
                // $completed= UserOrder::join('dishes' , 'dishes.did', '=' , 'user_orders.dish_id')
                // ->where('user_id', $id)
                // ->groupBy('dish_id')
                // ->orderBy('order_date', 'desc')
                // ->where('order_status', '=', 'Completed')
                //  ->where('order_date', '=', $datetoday)
                // ->get();
               
               return view('user.orderhistory', compact('orders','pending', 'cooking', 'delivering', 'completed', 'done'));
         
    }


    public function changeToReceived($id){
          $status='Completed';      
             $completed= UserOrder::where('uo_id',$id)
                ->update(['order_status'=>$status]);           
          return redirect()->route('order.orderhistory');
    }

    public function changeToDone($id){
        $datetoday=Carbon::now('Asia/Manila')->format('Y-m-d');
          $status=''; 

        return redirect()->route('order.pastorders');
    }



    public function pastOrders(){
            $uid = Auth::id();
           $done= UserOrder::where('user_id', $uid)
                ->groupBy('uo_id')
                ->orderBy('order_date', 'desc')
                ->where('order_status', '=', 'Completed')
                ->get();
                 return view('user.pastorders', compact('done'));
               
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        // if ma cancel ang order pwede ra sguro diri
    }


}
