<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
// use Illuminate\Support\Facades\Auth\Cook;
use App\Cook;
class CookLoginController extends Controller
{
	public function __construct() 
	{
		$this->middleware('guest:cook', ['except' => ['logout']]);
        // $this->middleware('auth:cook');
	}
    public function show() {
    	return view('auth.cook-login');
    }

    public function login(Request $request)
    {
    	//VALIDATE FORM DATA
    

    	//ATTEMPT TO LOG USER IN

	if(Auth::guard('cook')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
	{	
         $cid  = Auth::guard('cook')->id();
         $cook = Cook::where('id',  $cid)->update(['cook_status' => "Accepting"]);
		// SUCCESS, REDIRECT TO INTENDED LOCATION
		return redirect()->intended(route('cook.dashboard'));
	}

    	// NOT, REDIRECT BACK TO LOGIN
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    	

    	
    }

    public function logout()
    {
        $cid  = Auth::guard('cook')->id();
         // dd($cid);s
         $cook = Cook::where('id',  $cid)->update(['cook_status' => "NotAccepting"]);
        Auth::guard('cook')->logout();
        return redirect('/');
    }
}
