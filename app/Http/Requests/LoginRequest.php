<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|max:200|email',
            'password' => 'required |min:5|',
        ];
    }

    public function messages()
    {
        return [
            'email.email'=> 'Enter a valid email',
            'email.required'=> 'A email is required',
            'email.unique'=> 'The email has already been taken. Try another title.',
            'password.required'=> 'A password is required',
            'password.confirmed'=> 'A password confirmation required',
        ];
    }
}
