<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;

class CountryRequest extends FormRequest
{
    use JsonValidationTrait;

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

        $nameArRegex = "/^[\s\p{Arabic}]+$/iu";
        $nameEnRegex = "/^[a-zA-Z\s]+$/iu";

         $validation = [
            "name.ar" => ['required','min:1','max:255', 'regex:'.$nameArRegex],
            "name.en" => ['required','min:1','max:255', 'regex:'.$nameEnRegex],
             "status" => ['boolean']
        ];

        return $validation;
    }

    public function attributes()
    {
        return [
            'name.ar' => __('countries.name_ar'),
            'name.en' => __('countries.name_en'),
        ];
    }


}
