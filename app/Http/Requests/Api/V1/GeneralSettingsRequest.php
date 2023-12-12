<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $nameArRegex = "/^[٠-٩\s\p{Arabic}]+$/iu";
        $nameEnRegex = "/^[0-9a-zA-Z\s]+$/iu";

        return [
            'keys..*_ar$' =>['required', 'min:1', 'max:200' , 'regex:'.$nameArRegex],
            'keys..*_en$' =>['required', 'min:1', 'max:200' , 'regex:'.$nameEnRegex],
            'keys.facebook' => 'url',
            'keys.twitter' => 'url',
            'keys.instagram' => 'url',
            'keys.telegram' => 'url',
            'keys.whatsapp' => 'url',
        ];

    }
    public function attributes()
    {
        return [
            'keys.who_are_we_ar' => __('general.who_are_we'),
            'keys.who_are_we_en' => __('general.who_are_we'),
            'keys.address_ar' => __('general.address'),
            'keys.address_en' => __('general.address'),
            'keys.help_ar' => __('general.help'),
            'keys.help_en' => __('general.help'),
            'keys.terms_ar' => __('general.terms'),
            'keys.terms_en' => __('general.terms'),
            'keys.privacy_ar' => __('general.privacy'),
            'keys.privacy_en' => __('general.privacy'),
            'keys.instagram' => __('general.instagram'),
            'keys.telegram' => __('general.telegram'),
            'keys.whatsapp' => __('general.whatsapp'),
            'keys.facebook' => __('general.facebook'),
            'keys.twitter' => __('general.twitter'),

        ];
    }
    public function messages()
    {
        return [
        ];
    }
}
