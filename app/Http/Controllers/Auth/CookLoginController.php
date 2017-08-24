<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class CookLoginController extends Controller
{
	public function __construct() 
	{
		$this->middleware('guest:cook', ['except' => ['logout']]);
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
		// SUCCESS, REDIRECT TO INTENDED LOCATION
		return redirect()->intended(route('cook.dashboard'));
	}

    	// NOT, REDIRECT BACK TO LOGIN
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    	

    	
    }

    public function logout()
    {
        Auth::guard('cook')->logout();

        return redirect('/');
    }
}
