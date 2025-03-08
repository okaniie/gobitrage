<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HyipInstallerRequest extends FormRequest
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
            // 'INSTALLER_PASSWORD' => 'required|string',
            // 'LICENSE_KEY' => 'required|string',
            'APP_ENV' => 'required|string',
            'APP_DEBUG' => 'required|string',
            'APP_TIMEZONE' => 'required|string',
            'DB_CONNECTION' => 'required|string',
            'DB_HOST' => 'required|string',
            'DB_PORT' => 'required|string',
            'DB_DATABASE' => 'required|string',
            'DB_USERNAME' => 'required|string',
            'DB_PASSWORD' => 'required|string',
            'MAIL_MAILER' => 'required|string',
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|string',
            'MAIL_USERNAME' => 'required|string',
            'MAIL_PASSWORD' => 'required|string',
            'MAIL_ENCRYPTION' => 'required|string',
            'MAIL_FROM_ADDRESS' => 'required|string',
            'MAIL_FROM_NAME' => 'required|string',
            'ACTIVE_THEME' => 'required|string',
            'SITE_NAME' => 'required|string',
            'SITE_DESCRIPTION' => 'nullable|string',
            'SITE_EMAIL' => 'nullable|string',
            'SITE_ADDRESS' => 'nullable|string',
            'SITE_PHONE1' => 'nullable|string',
            'SITE_PHONE2' => 'nullable|string',
        ];
    }
}
