<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanUpdateRequest extends FormRequest
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
            'plan_category_id' => 'required|numeric',
            'title' => 'required|string',
            'ordering' => 'nullable|numeric',
            'has_badge' => 'nullable|numeric',
            'minimum' => 'required|numeric|min:1',
            'maximum' => 'nullable|numeric',
            'percentage' => 'required|numeric',
            'referral_percentage' => 'nullable|numeric',
            'duration_type' => 'required|string',
            'profit_frequency' => 'required|string',
            'duration' => 'required|numeric',
            'status' => 'nullable|numeric',
        ];
    }
}
