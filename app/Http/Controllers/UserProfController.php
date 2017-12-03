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
use Validator;
use Carbon\Carbon;  
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;

class UserProfController extends Controller
{
    // 
     public function __construct()
    {
        $this->middleware('auth');
    }

public function getAgeAttribute(){
  $birthday=Auth::user()->birthday;
  // $datenow=Carbon::now();
  return Carbon::parse($this->attributes['birthday'])->age();
}

 public function show($id){
  $userid=Auth::id();
  $user=User::find($userid);     
     
            $userhealthgoals = UserHGoals::join('health_goals' , 'health_goals.hg_id', '=' , 'user_healthgoals.hg_id')->where('user_id', $user->id)->get();
            $userlifestyle = UserLifestyle::join('lifestyles', 'lifestyles.lifestyle_id', '=', 'user_lifestyle.lifestyle_id')->where('user_id', $user->id)->get();
            $userallergens = UserAllergen::join('allergens', 'allergens.allergen_id', '=', 'user_allergens.allergen_id')->where('user_id', $user->id)->get();
            $usermedcons = UserMCondition::join('medical_conditions', 'medical_conditions.medcon_id', '=', 'user_medcondition.medcon_id')->where('user_id', $user->id)->get();
  
// $age= $user->getAgeAttribute();

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




   return view('user.userprof', compact('user', 'userhealthgoals', 'userlifestyle', 'userallergens', 'usermedcons', 'healthgoals', 'selectedGoal', 'lifestyles', 'selectedLifestyle', 'allergies', 'selectedAllergens', 'medcons', 'selectedMedCons', 'tolerance', 'selectedTolerance', 'selectedGender'));
    }






 public function rules() {
    return [
        'email' => 'required|email|unique:users,email,'.$this->id

    ];
}


public function storeUserImg(Request $request){
  $id=Auth::user()->id;
  $user=User::find($id);
    $file = $request->file('img');
        $file2 = $request->input('img');
        // dd($request);
        if($file != null)
        {
         
            $img = $this->uploadImage($file);

        }
        else 
        {

            $img = $file2;
        }
        $image = User::where('id', $id)
                       ->update(['profpic' =>  $img]);
     return redirect()->route('user.profile', compact('id', 'user'));
}
 public function uploadImage($file)
    {

       if($file != null)
        {  
            $destination_path =  base_path().'/public/user_imgs';
            // $destination_path = public_path(). '/user_imgs';
            $filename = $file->getClientOriginalName();
            $file->move($destination_path, $filename);
                
            $img = $filename;
        }
            
   

        return $img;
    }

public function storeAllergen(Request $request){
  // $tolerance="Low";

  $id=Auth::user()->id;
  $user=User::find($id);
           for($i =0; $i < count($request['allergen']); $i++) {
                $allergen=UserAllergen::create(['user_id' =>$id,
                                                'allergen_id' => $request['allergen'][$i],
                                                'tolerance_level' =>$request['tolerance'][$i],
                                                'status' => 1]);
        }
     // dd($id);
         return redirect()->route('user.profile', compact('id', 'user'));

     
      }

public function storeMedcon(Request $request, $id){
$id=Auth::user()->id;
  $user=User::find($id);
  
           for($j = 0; $j < count($request['medcon']); $j++) {
            $condition = UserMCondition::create(['user_id' => $id,
                                             'medcon_id' => $request['medcon'][$j],
                                             'status' => 1]);
        }
        return redirect()->route('user.profile', compact('id', 'user'));

     
      }

// 


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

         

        $user = UserHGoals::where('user_id', $id)
            ->update(['hg_id' => $request['hgoal']]);

         $user = UserLifestyle::where('user_id', $id)
            ->update(['lifestyle_id' => $request['lifestyle']]);
 
      
        return redirect()->route('user.profile', compact('id', 'user'));
    }
     

// public function update2(Request $request, $id){
//        $userid = Auth::id();
//         $user = User::find($id);
//   for($j = 0; $j < count($request['tolerance']); $j++) {
//              $user = UserAllergen::where('ua_id',$request['ua_id'])
//                                  ->where('user_id', $user)
//                                  ->update(['tolerance_level' => $request['tolerance'][$j]]);
//             // dd($request['ua_id'],$request['tolerance'][$j]);
//           }

//  return redirect()->route('user.profile', compact('id', 'user'));
// }

public function destroyM(Request $request){
  $id=Auth::user()->id;
  // $uaid=UserAllergen::where('ua_id', $request['ua_id'])->get();

   $m = $request['medcon'];
   foreach ($m as $mid) {
        UserMCondition::where("umedconID",$mid)->delete();  
   }
   

 return redirect()->route('user.profile', compact('user', 'id'));
}

public function update2(Request $request, $id){
    $user = Auth::id();
     
     $uid = Input::get('ua_id');
     $tol = Input::get('tolerance');
     $aller = Input::get('allergen');

     // dd($tol);
     // dd($uid);

      for($i=0; $i<count($tol);$i++)
      {

        $datas = UserAllergen::where([
            ['user_id', '=', $user], 
            ['ua_id', '=', $uid[$i]]
         ])
            ->update([
                'tolerance_level'=> $tol[$i]
              ]);
      }

     return redirect()->route('user.profile', compact('id', 'user'));
}

public function destroyA(Request $request){
  $id=Auth::user()->id;
  // $uaid=UserAllergen::where('ua_id', $request['ua_id'])->get();

   $checked = $request['allergen'];
   foreach ($checked as $uid) {
        UserAllergen::where("ua_id",$uid)->delete(); //Assuming you have a Todo model. 
   }
  // dd('hello');


 return redirect()->route('user.profile', compact('user', 'id'));
}

}