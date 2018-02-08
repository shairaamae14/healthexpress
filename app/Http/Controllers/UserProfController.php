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
use Illuminate\Support\Facades\Redirect;
use Hash;
use Illuminate\Support\Facades\Auth;

class UserProfController extends Controller
{
    // 
 public function __construct()
 {
  $this->middleware('auth');
}

public function show($id){
  $userid=Auth::id();
  $user=User::find($userid);     

  $userhealthgoals = UserHGoals::join('health_goals' , 'health_goals.hg_id', '=' , 'user_healthgoals.hg_id')->where('user_id', $user->id)->get();
  $userlifestyle = UserLifestyle::join('lifestyles', 'lifestyles.lifestyle_id', '=', 'user_lifestyle.lifestyle_id')->where('user_id', $user->id)->get();
  $userallergens = UserAllergen::join('allergens', 'allergens.allergen_id', '=', 'user_allergens.allergen_id')->where('user_id', $user->id)->get();
  $usermedcons = UserMCondition::join('medical_conditions', 'medical_conditions.medcon_id', '=', 'user_medcondition.medcon_id')->where('user_id', $user->id)->get();
  
// $age= $user->getAgeAttribute();
// $age=getAgeAttribute();
// dd($age);
  $healthgoals = HealthGoals::all();
  $selectedGoal = UserHGoals::first()->hg_id;

  $lifestyles= Lifestyles::all();
  $selectedLifestyle=UserLifestyle::first()->lifestyle_id;

  $allergies= Allergens::all();
  
  $selectedAllergens = UserAllergen::first()->allergen_id;

  $tolerance=UserAllergen::all();
  $selectedTolerance= UserAllergen::first()->user_id;

  $medcons= MedicalConditions::all();
  // $selectedMedCons= UserMCondition::first()->medcon_id;

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
  $id=Auth::user()->id;
    for($k = 0; $k < count($request['allergen']); $k++) {
  $useraller=UserAllergen::where('user_id', $id)->where('allergen_id', $request['allergen'][$k])->get();
  }
  if($useraller->isEmpty()){
           for($i =0; $i < count($request['allergen']); $i++) {
                $allergen=UserAllergen::create(['user_id' =>$id,
                                                'allergen_id' => $request['allergen'][$i],
                                                'tolerance_level' =>$request['tolerance'][$i],
                                                'status' => 1]);
        }
      }
        else {
              return Redirect::back()->withErrors(['Selected allergen/s already exist.']);
        }
         return redirect()->route('user.profile', compact('id', 'user'))->with('success', 'You have succesfully added  allergen/s!');
      }

public function storeMedcon(Request $request, $id){
  $id=Auth::user()->id;
    for($k = 0; $k < count($request['medcon']); $k++) {
  $medcon=UserMCondition::where('user_id', $id)->where('medcon_id', $request['medcon'][$k])->get();
  }
  if($medcon->isEmpty()){
           for($j = 0; $j < count($request['medcon']); $j++) {
            $condition = UserMCondition::create(['user_id' => $id,
                                             'medcon_id' => $request['medcon'][$j],
                                             'status' => 1]);
        }
      }
     else{
       return Redirect::back()->withErrors(['Selected medical condition/s already exist.']);
     }
    
   return redirect()->route('user.profile', compact('id', 'user'))->with('success', 'You have successfully added medical condition/s !');
     
 }



public function update(Request $request, $id){
  $id = Auth::id();

   // $email=Auth::User()->email;
      // dd($request['lifestyle']);
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


  return redirect()->route('user.profile', compact('id', 'user'))->with('success', 'You have successfully saved changes!');;
}


public function destroyM(Request $request){
  $id=Auth::user()->id;
  // $uaid=UserAllergen::where('ua_id', $request['ua_id'])->get();

  $m = $request['medcon'];
  foreach ($m as $mid) {
    UserMCondition::where("umedconID",$mid)->delete();  
  }


  return redirect()->route('user.profile', compact('user', 'id'))->with('success', 'You have successfully deleted medical condition/s!');;
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

  return redirect()->route('user.profile', compact('id', 'user'))->with('success', 'You have successfully added medical condition/s !');;
}

    public function destroyA(Request $request){
    $id=Auth::user()->id;
    // $uaid=UserAllergen::where('ua_id', $request['ua_id'])->get();

    $checked = $request['allergen'];
    foreach ($checked as $uid) {
          UserAllergen::where("ua_id",$uid)->delete(); //Assuming you have a Todo model. 
        }
    // dd('hello');


        return redirect()->route('user.profile', compact('user', 'id'))->with('success', 'You have successfully deleted allergen/s!');;
    }


    public function resetPassword()
    {

      return view('auth.changepass'); 
    }

    public function changePassword(Request $request) 
    {
      $user = Auth::user();
      $old_password = $request->input('passwordold');
      $new_password = $request->input('passwordnew');
      $password_confirm = $request->input('password_confirmation');

      if(Hash::check($old_password, $user->password) &&
       $new_password == $password_confirm)
      {
        $user->password = bcrypt($new_password);
        $user->save();

        return redirect()->route('user.profile', compact('id', 'user'))->with('success', 'You have successfully changed your password!');
      }
      else if($old_password == $new_password) 
      {
        return redirect()->back()->with('error', 'You used this password recently. Please choose a different one. ');
      }
      else
      {
        if(!Hash::check($old_password, $user->password))
          {
            return back()->with('error', 'Old password is incorrect.');
          }
          else
          {
            return back()->with('error', 'Password does not match!');
          }
      }
    }
}
