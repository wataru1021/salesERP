<?php

namespace App\Http\Requests\Sales\Password;

use Illuminate\Foundation\Http\FormRequest;

class ForgotRequest extends FormRequest
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
                'email_address' => 'required|email|max:255',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'email_address.required' => 'メールアドレスを入力してください。',
            'email_address.max' => 'メールアドレスは255文字以内で入力してください。',
            'email_address.email' => 'メールアドレス形式は正しくありません。',
        ];
    }
}
