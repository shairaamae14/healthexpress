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
use Illuminate\Support\Facades\Input;
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
        
        $bday = date('Y-m-d', strtotime($data['bday']));
        $birth = date('Y', strtotime($data['bday']));
        $age = date('Y') - $birth;
        if($data['gender'] == 'Male') {
            $bmr = 88.362 + (13.397 * $data['weight']) + (4.799 * $data['height']) - (5.677 * $age);
        }
        else if($data['gender'] == 'Female'){
            $bmr = 447.593 + (9.247 * $data['weight']) + (3.098 * $data['height']) - (4.330 * $age);
        }
        
        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'contact_no' => $data['contact_no'],
            'weight' => $data['weight'],
            'height' => $data['height'],
            'birthday' => $bday,
            'gender' => $data['gender'],
            'location' => $data['location'],
            'longitude' => $data['cityLng'],
            'latitude' => $data['cityLat'],
            'status' => 1,
            'age' => $age,
            'bmr' => $bmr
        ]);
        
        $goal = UserHGoals::create(['hg_id' => $data['goal'],
                                    'user_id' => $user->id,
                                    'date_started' => $data['dateStarted'],
                                    'status' => 1]);
        $usergoal = HealthGoals::findOrFail($data['goal']);
        $lifestyle= UserLifestyle::create(['user_id' => $user->id,
                                            'lifestyle_id' =>$data['lifestyle'],
                                            'status' => 1 ]);
        $getUserLifestyle = $user->lifestyle;
        foreach($getUserLifestyle as $lf) {
            $pal_value = $lf->pal_value;
        }

        

        switch($usergoal->hgoal_name)
        {
            case 'Lose Weight':
                $init = ($bmr * $pal_value) * 0.15;
                $dcr = ($bmr * $pal_value) + $init;
            break;
            case 'Maintain Weight':
                $dcr = $bmr * $pal_value;
            break;
            case 'Gain Weight':
                $dcr = $bmr * $pal_value + 500;
            break;
        }

        $updateUser = User::where('id', $user->id)->update(['dcr' => $dcr]);

        $allergen = Input::get('allergen');
        if($allergen != null) {
        for($i =0; $i < count($data['allergen']); $i++) {
            $allergen = UserAllergen::create(['user_id' => $user->id,
                                           'allergen_id' => $data['allergen'][$i],
                                           'tolerance_level' => $data['tolerance'],
                                            'status' => 1]);
        }
        }

        $med = Input::get('med_condition');
        if($med != null) {
        for($j = 0; $j < count($data['med_condition']); $j++) {
            $condition = UserMCondition::create(['user_id' => $user->id,
                                             'medcon_id' => $data['med_condition'][$j],
                                             'status' => 1]);
        }
        }
       

        return $user;
    }
    
    public function showRegistrationForm() {
        $goals = HealthGoals::all();
        $lifestyles = Lifestyles::all();
        $allergens = Allergens::all();
        $mconditions = MedicalConditions::all();
        return view('auth.register', compact('goals', 'lifestyles', 'allergens', 'mconditions'));
    }

}
