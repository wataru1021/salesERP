<?php

namespace App\Http\Requests\Sales\LoginChangePassword;

use Illuminate\Foundation\Http\FormRequest;

class LoginChangePasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'password' => [
                'required',
                'min:8',
                'max:15',
            ],
            'repassword' => [
                'required',
                'same:password'
            ]
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'パスワードを入力してください',
            'password.min' => '8文字以上のパスワードを入力してください。',
            'password.max' => '15文字以内のパスワードを入力してください。',
            'repassword.required' => 'パスワード （確認）を入力してください。',
            'repassword.same' => 'パスワード が入力されたものと異なります。',
        ];
    }
}
