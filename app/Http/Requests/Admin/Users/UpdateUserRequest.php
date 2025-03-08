<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{

    public $id;

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
        $rules = [
            'name' => 'required',
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $this->route('id')],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->route('id')],
            'secret_question' => 'nullable|string',
            'secret_answer' => 'nullable|string',
            'auto_withdrawal' => 'required',
            'status' => 'required',
        ];

        if ($this->request->has('password') && 0 == strlen($this->request->get('password'))) {
            $this->request->remove('password');
        } else {
            $rules['password'] = 'bail|required|min:8';
        }

        return $rules;
    }
}
