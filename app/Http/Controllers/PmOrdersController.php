<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPmOrder;
use App\PlannedMeals;
use Auth;
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

      $items = PlannedMeals::join('dishes', 'planned_meals.dish_id', '=', 'dishes.did')
                            ->where('user_id', $id)
                            ->where('order_status', 'not')
                            ->get();

      return view('user.pmealpayment', compact('items', 'clientToken', 'option'));
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
        $user = Auth::id();
//        dd($request);
//        $mode = OrderMode::create(['om_name' => 'Express Meal']);
        
        
         $nonceFromTheClient = $request['payment_method_nonce'];
         $transact = Braintree_Transaction::sale([
                    'amount' => $request['total'],
                    'paymentMethodNonce' => $nonceFromTheClient,
                    'options' => [
                      'submitForSettlement' => True
                    ]
          ]);
         
         
        $transact = Braintree_Transaction::submitForSettlement('the_transaction_id');
        if ($transact->success) {
            $settledTransaction = $transact->transaction;
        } else {
            $errors = $transact->errors;
        }

        $totalAmount=0;
        $amount = Input::get('price');

        for($i=0; $i<count($amount); $i++){
            $totalAmount+=$amount[$i];
        }


        $status = 'Pending';
        if($request['payment_mode'] == 'COD') {
            for ($index = 0; $index < count($request->dish); $index++) {
                $details = UserPmOrder::create(['user_id' => $user,
                'dish_id' => $request['dish'][$index],
                'payment_id' => 1,
                'totalAmount' => $totalAmount,
                'order_status' => $status
            ]); 
            }
        }
        // Cart::destroy();
        return redirect()->route('order.orderhistory');
    }

    public function payment(Request $request){
        $customer = Auth::user();
        $user = User::find($customer->id);
        $nonce = $request['payment_method_nonce'];
        
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
            
            $total_amount=0;
            $amount = Input::get('price');

            for($i=0; $i<count($amount); $i++){
                $total_amount+=$amount[$i];
            }


            $result = Braintree_Transaction::sale([
                'amount' => $total_amount,
                'customerId' => $user->braintree_id,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
            
            $this->orderStatus($result->transaction->id);
        }
        else {
            $result = Braintree_Transaction::sale([
                'amount' => $request->amount,
                'customerId' => $customer->braintree_id,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
        }
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
