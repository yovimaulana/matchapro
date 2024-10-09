<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AutoLoginSSO
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {        
        if(Auth::check()){
            return $next($request);
        }
        
        $provider = new \JKD\SSO\Client\Provider\Keycloak([
            'authServerUrl'         => 'https://sso.bps.go.id',
            'realm'                 => 'pegawai-bps',
            'clientId'              => '03100-matcha-kj7',
            'clientSecret'          => '90024b9a-0b19-4cb0-9e4e-6238043f3786',
            // 'redirectUri'           => route('login')
        ]); 

        
        try {
            $token = session('sso_token');                      
            if($token && !$token->hasExpired()) {
                $userSSO = $provider->getResourceOwner($token);
                $userDB = User::where('username', $userSSO->getUsername())->first();

                if($userDB) {
                    Auth::login($userDB);
                    return $next($request); 
                }
            }
        } catch (Exception $e) {
            return redirect()->route('login');
        }

        return redirect()->route('login');

    }
}


// $authUrl = $provider->getAuthorizationUrl();  
// dd($authUrl);

    // https://sso.bps.go.id/auth/realms/pegawai-bps/protocol/openid-connect/auth?state=35d6f30c954ea90ee475d59213523131&scope=profile-pegawai%2Cemail&response_type=code&approval_prompt=auto&redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Flogin&client_id=03100-matcha-kj7
    // $authUrl = $provider->getAuthorizationUrl();              
    // $_SESSION['oauth2state'] = $provider->getState(); // 78a6bfbbfbf1d96bde2b22a9418786b9
    // header('Location: '.$authUrl);
    // exit;        

    // $token = $provider->getAccessToken('authorization_code', [
    //     'code' => $_GET['code']
    // ]);
    // dd($token);

    // League\OAuth2\Client\Token\AccessToken {#367 ▼
    //     #accessToken: "eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJrYzNDRXU4VU01aUpCdnp6dmdadi03Y3hGSkxyMk1NcmhVMHk3XzRmYUU0In0.eyJqdGkiOiI5ZWMwODY5My0wZjUyLTQxMzYtOGNmOC02MzAyMGZkMGRjODQiLCJleHAiOjE3Mjg1NTIxMjQsIm5iZiI6MCwiaWF0IjoxNzI4Mzc5MzI0LCJpc3MiOiJodHRwczovL3Nzby5icHMuZ28uaWQvYXV0aC9yZWFsbXMvcGVnYXdhaS1icHMiLCJhdWQiOiJhY2NvdW50Iiwic3ViIjoiMmZmNTU2NjUtNzMyOC00MDM3LThiYzctMjNiZTEzM2FkMjBmIiwidHlwIjoiQmVhcmVyIiwiYXpwIjoiMDMxMDAtbWF0Y2hhLWtqNyIsImF1dGhfdGltZSI6MTcyODM3NzYzNywic2Vzc2lvbl9zdGF0ZSI6IjUxOGVhMDRjLWJhNTUtNDI4My04NjM4LTM3ZTIwOWFhODMzMSIsImFjciI6IjAiLCJhbGxvd2VkLW9yaWdpbnMiOlsiaHR0cHM6Ly9tYXRjaGEuYnBzLmdvLmlkIiwiaHR0cDovL2xvY2FsaG9zdC8iLCJodHRwczovL21hdGNoYS1kZXYuYnBzLmdvLmlkIl0sInJlYWxtX2FjY2VzcyI6eyJyb2xlcyI6WyJwZWdhd2FpIl19LCJyZXNvdXJjZV9hY2Nlc3MiOnsiYWNjb3VudCI6eyJyb2xlcyI6WyJtYW5hZ2UtYWNjb3VudCIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoicHJvZmlsZS1wZWdhd2FpIiwibmlwIjoiMTk5NDA0MDcyMDE4MDIxMDAyIiwiZm90byI6Imh0dHBzOi8vY29tbXVuaXR5LmJwcy5nby5pZC9pbWFnZXMvYXZhdGFyLzM0MDA1ODExOF8yMDE4MDQwMjA3NDcxNi5qcGciLCJvcmdhbmlzYXNpIjoiMDAwMDAwMDMxMDAwIiwiamFiYXRhbiI6IlByYW5hdGEgS29tcHV0ZXIgQWhsaSBQZXJ0YW1hIERpcmVrdG9yYXQgUGVuZ2VtYmFuZ2FuIE1ldG9kb2xvZ2kgU2Vuc3VzIGRhbiBTdXJ2ZWkiLCJnb2xvbmdhbiI6IklJSS9iIiwibmFtZSI6IllvdmkgTWF1bGFuYSBOdWdyYWhhIFNTVCIsImVzZWxvbiI6Ii0iLCJuaXAtbGFtYSI6IjM0MDA1ODExOCIsImZpcnN0LW5hbWUiOiJZb3ZpIiwiZW1haWwiOiJ5b3ZpLm1hdWxhbmFAYnBzLmdvLmlkIiwibGFzdC1uYW1lIjoiTWF1bGFuYSBOdWdyYWhhIiwidXNlcm5hbWUiOiJ5b3ZpLm1hdWxhbmEifQ.PNmaPwQtjlO4gPR2-05TrWlXSdLvw6Q3VffjGO-TxFRyfSYC746_r4UqznbVVLCNT_fXW5TcVkJ7xCJbwrzDRM2MHgnnHn4U6LXu19q0wRikOLDi6CtkzIF38NUJVih0UN-WY7yJGC9pXWTEa-TKLl6TSX7lqdqzSzgaSCVRMg2sag20495P9qyemsOqXh5rJ08NNn98ESUUKA1DKUqzm8-NCD3-i7qVum4BS2aiFnBrFSUoRIXw9rLU-XnUF_LmbIa_F7VxtMoh-_FUjfBIvrTo5wcMyrexhh6-iHt9eAuZVqgryT9mhxmpCOUUm9ZPvraCBmksuk_SkcDOwVL4_Q"
    //     #expires: 1728552125
    //     #refreshToken: "eyJhbGciOiJIUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICIwNjFhZmJjYS1iNTE5LTQ0NmEtYWE2NC1jMzRiYmU4ODRjYjEifQ.eyJqdGkiOiI1MmZlODZhOS0xZWY3LTRkNWUtOTRhZC01NTFmMzNjYzI4N ▶"
    //     #resourceOwnerId: null
    //     #values: array:5 [▼
    //       "refresh_expires_in" => 28800
    //       "token_type" => "bearer"
    //       "not-before-policy" => 1728377441
    //       "session_state" => "518ea04c-ba55-4283-8638-37e209aa8331"
    //       "scope" => "profile-pegawai"
    //     ]
    //   }

    // $user = $provider->getResourceOwner('eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJrYzNDRXU4VU01aUpCdnp6dmdadi03Y3hGSkxyMk1NcmhVMHk3XzRmYUU0In0.eyJqdGkiOiI5ZWMwODY5My0wZjUyLTQxMzYtOGNmOC02MzAyMGZkMGRjODQiLCJleHAiOjE3Mjg1NTIxMjQsIm5iZiI6MCwiaWF0IjoxNzI4Mzc5MzI0LCJpc3MiOiJodHRwczovL3Nzby5icHMuZ28uaWQvYXV0aC9yZWFsbXMvcGVnYXdhaS1icHMiLCJhdWQiOiJhY2NvdW50Iiwic3ViIjoiMmZmNTU2NjUtNzMyOC00MDM3LThiYzctMjNiZTEzM2FkMjBmIiwidHlwIjoiQmVhcmVyIiwiYXpwIjoiMDMxMDAtbWF0Y2hhLWtqNyIsImF1dGhfdGltZSI6MTcyODM3NzYzNywic2Vzc2lvbl9zdGF0ZSI6IjUxOGVhMDRjLWJhNTUtNDI4My04NjM4LTM3ZTIwOWFhODMzMSIsImFjciI6IjAiLCJhbGxvd2VkLW9yaWdpbnMiOlsiaHR0cHM6Ly9tYXRjaGEuYnBzLmdvLmlkIiwiaHR0cDovL2xvY2FsaG9zdC8iLCJodHRwczovL21hdGNoYS1kZXYuYnBzLmdvLmlkIl0sInJlYWxtX2FjY2VzcyI6eyJyb2xlcyI6WyJwZWdhd2FpIl19LCJyZXNvdXJjZV9hY2Nlc3MiOnsiYWNjb3VudCI6eyJyb2xlcyI6WyJtYW5hZ2UtYWNjb3VudCIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoicHJvZmlsZS1wZWdhd2FpIiwibmlwIjoiMTk5NDA0MDcyMDE4MDIxMDAyIiwiZm90byI6Imh0dHBzOi8vY29tbXVuaXR5LmJwcy5nby5pZC9pbWFnZXMvYXZhdGFyLzM0MDA1ODExOF8yMDE4MDQwMjA3NDcxNi5qcGciLCJvcmdhbmlzYXNpIjoiMDAwMDAwMDMxMDAwIiwiamFiYXRhbiI6IlByYW5hdGEgS29tcHV0ZXIgQWhsaSBQZXJ0YW1hIERpcmVrdG9yYXQgUGVuZ2VtYmFuZ2FuIE1ldG9kb2xvZ2kgU2Vuc3VzIGRhbiBTdXJ2ZWkiLCJnb2xvbmdhbiI6IklJSS9iIiwibmFtZSI6IllvdmkgTWF1bGFuYSBOdWdyYWhhIFNTVCIsImVzZWxvbiI6Ii0iLCJuaXAtbGFtYSI6IjM0MDA1ODExOCIsImZpcnN0LW5hbWUiOiJZb3ZpIiwiZW1haWwiOiJ5b3ZpLm1hdWxhbmFAYnBzLmdvLmlkIiwibGFzdC1uYW1lIjoiTWF1bGFuYSBOdWdyYWhhIiwidXNlcm5hbWUiOiJ5b3ZpLm1hdWxhbmEifQ.PNmaPwQtjlO4gPR2-05TrWlXSdLvw6Q3VffjGO-TxFRyfSYC746_r4UqznbVVLCNT_fXW5TcVkJ7xCJbwrzDRM2MHgnnHn4U6LXu19q0wRikOLDi6CtkzIF38NUJVih0UN-WY7yJGC9pXWTEa-TKLl6TSX7lqdqzSzgaSCVRMg2sag20495P9qyemsOqXh5rJ08NNn98ESUUKA1DKUqzm8-NCD3-i7qVum4BS2aiFnBrFSUoRIXw9rLU-XnUF_LmbIa_F7VxtMoh-_FUjfBIvrTo5wcMyrexhh6-iHt9eAuZVqgryT9mhxmpCOUUm9ZPvraCBmksuk_SkcDOwVL4_Q');
    // dd($user);
    // $userDB = User::where('username', $user->getUsername())->first();
    // Auth::login($userDB);