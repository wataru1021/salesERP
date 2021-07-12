<?php

namespace App\Http\Requests\Sales\Password;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
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
        $rules = [];
        if ($this->isMethod('POST')) {
            $rules = [
                'password' => 'required|min:8|max:15',
                'password_confirm' => 'required|same:password',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'password.required' => 'パスワードを入力してください。',
            'password.max' => '15文字以内のパスワードを入力してください。',
            'password.min' => '8文字以上のパスワードを入力してください。',
            'password_confirm.required' => 'パスワード を入力してください。',
            'password_confirm.same' => 'パスワード が入力されたものと異なります。',
        ];
    }
}
