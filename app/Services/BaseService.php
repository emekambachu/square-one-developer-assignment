<?php

namespace App\Services;

use App\Models\User;

/**
 * Class BaseService.
 */
class BaseService
{
    public static function user(){
        return new User();
    }

    //Generate email verification token
    public static function generateToken($length = 15){
        $characters = '0123456789ABCDEFGHIJ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
