<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserHGoals;
use App\HealthGoals;
use App\UserLifestyle;
use App\UserAllergen;
use App\ UserMCondition;
use App\Lifestyles;
use App\MedicalConditions;
use App\Allergens;

use Illuminate\Support\Facades\Auth;

class UserProfController extends Controller
{
    // 
     public function __construct()
    {
        $this->middleware('auth');
    }

   

 public function show($id){
  
       $userid= Auth::id();
       $users=User::where('id', $userid)->get(); 
        foreach($users as $user) {
            $userhealthgoals = UserHGoals::join('health_goals' , 'health_goals.hg_id', '=' , 'user_healthgoals.hg_id')->where('user_id', $user->id)->get();
            $userlifestyle = UserLifestyle::join('lifestyles', 'lifestyles.lifestyle_id', '=', 'user_lifestyle.lifestyle_id')->where('user_id', $user->id)->get();
            $userallergens = UserAllergen::join('allergens', 'allergens.allergen_id', '=', 'user_allergens.allergen_id')->where('user_id', $user->id)->get();
            $usermedcons = UserMCondition::join('medical_conditions', 'medical_conditions.medcon_id', '=', 'user_medcondition.medcon_id')->where('user_id', $user->id)->get();
  }
  
  $healthgoals = HealthGoals::all();
  $selectedGoal = UserHGoals::first()->hg_id;

  $lifestyles= Lifestyles::all();
  $selectedLifestyle=UserLifestyle::first()->lifestyle_id;

  $allergies= Allergens::all();
  
  $selectedAllergens = UserAllergen::first()->allergen_id;

  $tolerance=UserAllergen::all();
  $selectedTolerance= UserAllergen::first()->user_id;
 
  $medcons= MedicalConditions::all();
  $selectedMedCons= UserMCondition::first()->medcon_id;

  $selectedGender= User::first()->id;




   return view('user.userprof', compact('users', 'userhealthgoals', 'userlifestyle', 'userallergens', 'usermedcons', 'healthgoals', 'selectedGoal', 'lifestyles', 'selectedLifestyle', 'allergies', 'selectedAllergens', 'medcons', 'selectedMedCons', 'tolerance', 'selectedTolerance', 'selectedGender'));
    }






 public function rules() {
    return [
        'email' => 'required|email|unique:users,email,'.$this->id

    ];
}





    public function update(Request $request, $id){
      $id = Auth::id();

   // $email=Auth::User()->email;

     
   $user = User::where('id', $id)
                           ->update(['lname' => $request->lname,
                                 'fname' => $request->fname,
                                 'email' => $request->email,
                                 'contact_no' => $request->contact_no,
                                 'weight' =>  $request->weight,
                                 'height' => $request->height,
                                 'birthday' => $request->birthday,
                                 'gender' => $request->gender,
                                 'location'=>$request->location, 
                                  'longitude' =>$request->long,
                                  'latitude' => $request->lat  ]);

        
        $user = UserHGoals::where('user_id', $user)
            ->update(['hg_id' => $request['hgoal']]);

         $user = UserLifestyle::where('user_id', $user)
            ->update(['lifestyle_id' => $request['lifestyle']]);
 
      
        return redirect()->route('user.profile', compact('id', 'user'));
    }
     

// public function store(array $data){
//  for($i =0; $i < count($data['allergen']); $i++) {
//             $allergen = UserAllergen::create(['user_id' => $user->id,
//                                            'allergen_id' => $data['allergen'][$i],
//                                            'tolerance_level' => $data['tolerance'],
//                                             'status' => 1]);
//         }
//         for($j = 0; $j < count($data['med_condition']); $j++) {
//             $condition = UserMCondition::create(['user_id' => $user->id,
//                                              'medcon_id' => $data['med_condition'][$j],
//                                              'status' => 1]);
//         }
//         return redirect()->route('user.profile', compact('id', 'allergen', 'condition'));

     
//       }
// }


}