<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'=>'required|max:200|alpha',
            'last_name'=>'required|max:200|alpha',
            'username'=>'required|max:200|alpha|unique:users',
            'email' => 'required|unique:users|max:200|email',
            'password' => 'required |min:5|confirmed',

        ];
    }
    public function messages()
    {
        return [
            'first_name.alpha'=> 'A first name should be text only ',
            'first_name.required'=> 'A first name is required',
            'last_name.alpha'=> 'A last name should be text only ',
            'last_name.required'=> 'A last name is required',
            'username.alpha'=> 'A username should be text only ',
            'username.required'=> 'A username is required',
            'email.email'=> 'Enter a valid email',
            'email.required'=> 'A email is required',
            'email.unique'=> 'The email has already been taken. Try another title.',
            'password.required'=> 'A password is required',
            'password.confirmed'=> 'A password confirmation required',
        ];
    }
}
