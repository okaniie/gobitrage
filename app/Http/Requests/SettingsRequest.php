<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'password' => 'required|string|password',
            'min_withdrawal' => 'nullable|numeric|min:1',
            'pay_referral' => 'nullable|numeric',
            'google_track_id' => 'nullable|string',
            'header_code' => 'nullable|string',
            'footer_code' => 'nullable|string',
        ];
    }
}
