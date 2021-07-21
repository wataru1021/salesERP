<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportStoreRequest extends FormRequest
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
            'ping_pong_num' => 'required|numeric',
            'meet_num' => 'required|numeric',
            'deal_num' => 'required|numeric',
            'acquisitions_num' => 'required|numeric',
            'sale_time' => 'required',
            'conscious_point' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ping_pong_num.required' => 'ピンポン数を入力してください',
            'ping_pong_num.numeric' => '数字で入力してください。',
            'meet_num.required' => '対面数を入力してください',
            'meet_num.numeric' => '数字で入力してください。',
            'deal_num.required' => '商談率を入力してください',
            'deal_num.numeric' => '数字で入力してください。',
            'acquisitions_num.required' => '獲得数を入力してください',
            'acquisitions_num.numeric' => '数字で入力してください。',
            'sale_time.required' => '稼働時間を入力してください',
            'conscious_point.required' => '今日意識した点を入力してください',

        ];
    }
}
