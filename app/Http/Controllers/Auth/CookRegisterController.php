<?php

namespace App\Http\Controllers\Auth;

use App\Cook;
use App\CookContact;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class CookRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/cook';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:cook');
    }

    public function index()
    {
        return view('auth.cook-register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {
        $cook= Cook::create([
            'first_name' => $data['fname'],
            'last_name' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'location' => $data['location'],
            'longitude' => $data['cityLng'],
            'latitude' => $data['cityLat'],
            'cook_status' => 'Offline',
            'status' => 1
        ]);
        
        $contact = CookContact::create(['cook_id' => $cook->id,
                                        'contact_number' => $data['cnumber'],
                                        'contact_detail' => $data['detail'],
                                        'isPrimary' => 1,
                                        'status' => 1]);

            

         return redirect()->route('cook.login');    
    }

}
