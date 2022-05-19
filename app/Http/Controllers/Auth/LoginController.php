<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
     * @return \Illuminate\Http\JsonResponse
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public function login(Request $request){

        $rules = array(
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "errors" => $validator->getMessageBag()->toArray()
            ]);
        }

        $verified = User::where([
            ['email', $request->email],
            ['verified', 1],
        ])->first();

        if(!$verified){
            return response()->json([
                "success" => false,
                "message" => "Unverified account, click on the verification link to proceed"
            ]);
        }

        if(Auth::guard()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ],
            $request->get('remember'))) {
            return response()->json([
                'success' => true,
            ], 200);
        }

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
        Auth::guard()->logout();
        return response()->json([
            'success' => true,
        ], 200);
    }

}
