<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class AddBonusRequest extends FormRequest
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
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'currency_code' => 'required|string',
            'plan_id' => 'nullable|numeric',
            'pay_referral' => 'nullable',
            'notify' => 'nullable',
        ];
    }
}
