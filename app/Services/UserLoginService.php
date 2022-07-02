<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserLoginService.
 */
class UserLoginService extends BaseService
{
    public static function loginUser($request){

        $verified = User::where([
            ['email', $request->email],
            ['verified', 1],
        ])->first();

        if(!$verified){
            return response()->json([
                "success" => false,
                "message" => "Unverified account, click on the verification link in your email to proceed."
            ]);
        }

        if(Auth::guard()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ],
            $request->get('remember'))) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Incorrect login details",
        ]);
    }
}
