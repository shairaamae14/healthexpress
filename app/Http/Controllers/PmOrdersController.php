<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserOrder;
use Auth;
use App\User;
use App\PaymentMethod;
use Braintree_ClientToken;
use Braintree_Transaction;
use Braintree_CreditCard;
use Braintree_Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class PmOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $id = Auth::id();
    
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

        $items = UserOrder::join('dishes', 'user_orders.dish_id', '=', 'dishes.did')
                            ->where('user_id', $id)
                            ->where('order_status', 'Initial')
                            ->get();

        $total = $request->total;
        $allcost = $request->allcost;
        $delfee = $request->delfee;

      return view('user.pmealpayment', compact('items', 'clientToken', 'option', 'total', 'allcost', 'delfee'));
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
        $user = Auth::user();
        $orders = collect();
        $user_order = collect();
        $status = 'Pending';
        $dish = $request['uo_id'];
        // dd($dish);
        if($request['payment_mode'] == 'COD') {
            for ($index = 0; $index < count($dish); $index++) {
              $user_order = UserOrder::where('user_id', $user->id)->where('uo_id',$request['uo_id'][$index])
                    ->update([
                        'payment_id' => 1, 
                        'order_date' => \Carbon\Carbon::now(), 
                        'order_status' => $status
                ]);
            }
        }
      return redirect()->route('pmorder.showallorders');
    }

    public function payment(Request $request){
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
                for ($index = 0; $index < count($request->uo_id); $index++) {
                    $user_order = UserOrder::where('user_id', $user->id)->where('uo_id',$request['uo_id'][$index])
                    ->update([
                        'payment_id' => 1,   
                        'order_date' => \Carbon\Carbon::now(), 
                        'order_status' => $status
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
                for ($index = 0; $index < count($request->uo_id); $index++) {
                    $user_order = UserOrder::where('user_id', $user->id)->where('uo_id',$request['uo_id'][$index])
                    ->update([
                        'payment_id' => 1,   
                        'order_date' => \Carbon\Carbon::now(), 
                        'order_status' => $status
                ]);
                }   
            }
        }
        return redirect()->route('order.orderhistory');
    }


 public function showPm(){
    $user = Auth::user();
  // dd($user)
        $orders = UserOrder::where('user_id', $user->id)->where('om_id', 2)->orderBy('order_date', 'desc')->get();
        $pending = UserOrder::where('user_id', $user->id)
                            ->where('om_id', 2)
                            ->where('order_status', 'Pending')
                            ->where('mode_delivery', "Delivery")
                            ->orderBy('order_date', 'desc')->get();
        $cooking = UserOrder::where('user_id', $user->id)
                            ->where('om_id', 2)
                            ->where('mode_delivery', "Delivery")
                            ->where('order_status', 'Cooking')
                            ->orderBy('order_date', 'desc')->get();
       $delivering = UserOrder::where('user_id', $user->id)
                              ->where('om_id', 2)
                              ->where('mode_delivery', "Delivery")
                              ->where('order_status', 'Delivering')
                              ->orderBy('order_date', 'desc')->get();
        $datetoday = Carbon::now('Asia/Manila')->format('Y-m-d');
        $completed = UserOrder::where('user_id', $user->id)->where('order_status', 'Completed')
                            ->where('order_date', $datetoday)->where('om_id', 2)->orderBy('order_date', 'desc')->get();
        $pickup= UserOrder::where('user_id', $user->id)
                              ->where('om_id', 2)
                              ->where('mode_delivery', "Pickup")
                              ->where('order_status', '!=', 'Completed')
                              ->where('order_date', $datetoday)
                              ->orderBy('order_date', 'desc')->get(); 
        foreach($pickup as $p){
            if($p->order_date!=$datetoday){
                 $com= UserOrder::where('uo_id', $p->uo_id)
                ->update(['order_status'=>"Completed"]);
            }
        }
      return view('user.pmorderhistory', compact('pending', 'cooking', 'delivering', 'completed', 'pickup'));
    }

      public function pmchangeToReceived($id){
          $status='Completed';      
             $completed= UserOrder::where('uo_id', $id)
                ->update(['order_status'=>$status]);
                // dd($id);
          return redirect()->route('pmorder.orderhistory');
    }

    public function pmpastOrders(){
               $uid = Auth::id();
           $done= UserOrder::where('user_id', $uid)
                ->groupBy('uo_id')
                ->orderBy('order_date', 'desc')
                ->where('om_id', 2)
                ->where('order_status', '=', 'Completed')
                ->get();
                
                 return view('user.pmpastorders', compact('done'));
               
    }
}
