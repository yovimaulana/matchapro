<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;

class AuthController extends Controller
{
    protected function username()
    {
        return 'username'; // Use the 'username' field instead of 'email'
    }
    //
    public function index(Request $request)
    {
      if (Auth::check()) {
        
        return redirect()->route('home');
    }

    $pageConfigs = ['blankPage' => true];

    return view('/matchapro/authentication/auth-login-basic', ['pageConfigs' => $pageConfigs]);
      
      
    }
  

    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password_default'),
        ];
        
        
          if (Auth::attempt($credentials)) {
              return redirect()->intended('home');
          }
          
          return back()->withErrors([
              'username' => 'The provided credentials do not match our records.',
          ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
