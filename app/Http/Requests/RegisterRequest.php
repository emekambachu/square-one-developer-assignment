<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name' => 'required|min:8',
            'email' => 'required|email|min:8|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'email.unique' => 'User already exists!',
            'password.required' => 'Password is required!',
            'password.confirmed' => 'Confirm password!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // return errors in json object/array
        if($this->wantsJson()){
            $response = response()->json([
                "success" => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
        }

//        if($this->wantsJson()) {
//            $response = response()->json([
//                'success' => false,
//                'message' => 'Ops! Some errors occurred',
//                'errors' => $validator->errors()
//            ]);
//        }else{
//            $response = redirect()
//                ->route('yaedp.forgot-password')
//                ->with('message', 'Ops! Some errors occurred')
//                ->withErrors($validator);
//        }

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
