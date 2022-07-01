<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\UserRegistrationService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function create(RegisterRequest $request){

        try{
            $user = UserRegistrationService::createUser($request);
            UserRegistrationService::sendEmail($user);
            return response()->json([
                'success' => true,
                'message' => 'Registration complete, click on the verification link sent to your email'
            ]);

        }catch(\Exception $error) {
            return response()->json([
                "success" => false,
                "message" => $error->getMessage()
            ]);
        }
    }

    public function emailVerify($token){

        try{
            UserRegistrationService::verifyUserEmail($token);
            return view('auth.login');
        }catch(\Exception $error){
            return $error->getMessage();
        }
    }
}
