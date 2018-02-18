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
        return redirect()->route('order.orderhistory');
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
