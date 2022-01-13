<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use LdapRecord\Laravel\Auth\ListensForLdapBindFailure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, ListensForLdapBindFailure;
    
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/arquivos';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function username()
    {
        return 'username';
    }
    

     
    protected function credentials(Request $request)
    {
        

        return [
            'samaccountname' => $request->username,
            'password' => $request->password,
        ];
    }

    public function __construct()
    {

        $this->middleware('guest')->except('logout');
        $this->listenForLdapBindFailure();
    }
}
