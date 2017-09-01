<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\HealthGoals;
use App\Lifestyles;
use App\Allergens;
use App\MedicalConditions;
use App\UserAllergen;
use App\UserHGoals;
use App\UserLifestyle;
use App\UserMCondition;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
    protected function create(array $data)
    {
       
        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'contact_no' => $data['contact_no'],
            'weight' => $data['weight'],
            'height' => $data['height'],
            'birthday' => $data['bday'],
            'gender' => $data['gender'],
            'location' => $data['location'],
            'longitude' => $data['cityLat'],
            'latitude' => $data['cityLng'],
            'status' => 1
        ]);
        
        $goal = UserHGoals::create(['hg_id' => $data['goal'],
                                    'user_id' => $user->id,
                                    'date_started' => $data['dateStarted'],
                                    'status' => 1]);
        
        $lifestyle= UserLifestyle::create(['user_id' => $user->id,
                                            'lifestyle_id' =>$data['lifestyle'],
                                            'status' => 1 ]);
        for($i =0; $i < count($data['allergen']); $i++) {
            $allergen = UserAllergen::create(['user_id' => $user->id,
                                           'allergen_id' => $data['allergen'][$i],
                                           'tolerance_level' => $data['tolerance'],
                                            'status' => 1]);
        }
        for($j = 0; $j < count($data['med_condition']); $j++) {
            $condition = UserMCondition::create(['user_id' => $user->id,
                                             'medcon_id' => $data['med_condition'][$j],
                                             'status' => 1]);
        }
       

        return $user;
    }
    
    public function index() {
        $goals = HealthGoals::all();
        $lifestyles = Lifestyles::all();
        $allergens = Allergens::all();
        $mconditions = MedicalConditions::all();
        return view('auth.register', compact('goals', 'lifestyles', 'allergens', 'mconditions'));
    }

}
