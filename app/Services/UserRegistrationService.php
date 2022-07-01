<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

/**
 * Class UserRegistrationService.
 */
class UserRegistrationService extends BaseService
{
    public static function createUser($request){

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'verification_token' => self::generateToken(),
        ]);

    }

    public static function sendEmail($user){
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
    }

    public static function verifyUserEmail($token){

        $user = self::user();
        $verify = $user->where('verification_token', $token)->first();

        if($verify){
            $verify->verified = 1;
            $verify->save();
            Session::flash('success-verify', "Email verified, please login");
        }else{
            Session::flash('warning-verify', "Incorrect token");
        }

    }
}
