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

      $provider = new \JKD\SSO\Client\Provider\Keycloak([
        'authServerUrl'         => 'https://sso.bps.go.id',
        'realm'                 => 'pegawai-bps',
        'clientId'              => '03100-matcha-kj7',
        'clientSecret'          => '90024b9a-0b19-4cb0-9e4e-6238043f3786',
        'redirectUri'           => route('login')
      ]);

      $authUrl = null;
      if(!isset($_GET['code'])) {
        $authUrl = $provider->getAuthorizationUrl();        
      } else {
        try {            
            $token = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);            
            $userSSO = $provider->getResourceOwner($token);
            session(['sso_token' => $token, 'userSSO' => $userSSO]);                        
            return redirect()->route('home');
          } catch (Exception $e) {
            return redirect()->route('login');
          }
      }          

    $pageConfigs = ['blankPage' => true];

    return view('/matchapro/authentication/auth-login-basic', ['pageConfigs' => $pageConfigs, 'authUrl' => $authUrl ]);
      
      
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
