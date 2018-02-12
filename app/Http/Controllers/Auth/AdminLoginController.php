<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminLoginController extends Controller
{
	public function __construct() 
	{
		$this->middleware('guest:admin', ['except' => ['logout']]);
	}

    public function username()
    {
        return 'username';
    }

    public function imp($username)
    {
        Auth::login($username);
    }
    
    public function show() {
    	return view('auth.admin-login');
    }

    public function login(Request $request)
    {

    	//ATTEMPT TO LOG USER IN
    	if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember))
    	{	                                         
    		// SUCCESS, REDIRECT TO INTENDED LOCATION
    		return redirect()->intended(route('admin.home'));
    	}

    	// NOT, REDIRECT BACK TO LOGIN
    	return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/');
    }
}
