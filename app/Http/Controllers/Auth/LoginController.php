<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public function showLoginForm(){
        return view('auth.login', ['url' => 'login']);
    }

    public function login(Request $request){

        $rules = array(
            'email' => 'required|exists:realtors,email',
            'password' => 'required|min:6',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "errors" => $validator->getMessageBag()->toArray()
            ]);
        }

        if(Auth::guard('realtor')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ],

            $request->get('remember'))) {
            return response()->json([
                'success' => true,
            ], 200);
        }

        Session::flash('warning', 'Incorrect Login Details');
        return response()->json([
            'success' => false,
            "message" => "Incorrect login details"
        ], 404);
    }

    //add for logout function to work
    use AuthenticatesUsers {
        logout as performLogout;
    }

    //perform logout
    public function logout(){
        Auth::guard('realtor')->logout();
        return response()->json([
            'success' => true,
        ], 200);
    }

}
