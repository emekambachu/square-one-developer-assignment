<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
    protected function create(Request $request){

        //Generate email verification token
        function verificationToken($length = 11){
            $characters = '0123456789ABCDEFG';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $rules = array(
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6'
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "errors" => $validator->getMessageBag()->toArray()
            ]);
        }

        try{
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'verification_token' => verificationToken(),
            ]);

            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->verification_token,
            ];

            Mail::send('emails.verification', $data, static function ($message) use ($data) {
                $message->from('testemail@xeddtechnology.com', 'Square1 Dev Assignment');
                $message->to($data['email'], $data['name']);
                $message->replyTo('testemail@xeddtechnology.com', 'Square1 Dev Assignment');
                $message->subject('Account verification');
            });

        }catch(\Exception $error) {
            return response()->json([
                "success" => false,
                "message" => $error->getMessage()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Registration complete, click on the verification link sent to your email'
        ]);
    }

    public function emailVerify($token){

        $user = new User();
        $verify = $user->where('verification_token', $token)->first();

        if($verify){
            $verify->verified = 1;
            $verify->save();
            Session::flash('success', "Email verified, please login");
        }else{
            Session::flash('warning', "Incorrect token");
        }
        return view('auth.login');
    }
}
