<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;

class GovernorateRequest extends FormRequest
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
             'country_id' => "required|exists:countries,id",
             "name.ar" => ['required','min:1','max:255', 'regex:'.$nameArRegex],
             "name.en" => ['required','min:1','max:255', 'regex:'.$nameEnRegex],
             "rows.*.ar" => ['required','min:1','max:255', 'regex:'.$nameArRegex],
             "rows.*.en" => ['required','min:1','max:255', 'regex:'.$nameEnRegex],
             "status" => ['required'],
        ];

        return $validation;
    }

    public function attributes()
    {
        return [
            'country_id' => __('governorates.country_id'),
            'name.ar' => __('governorates.name_ar'),
            'name.en' => __('governorates.name_en'),
        ];
    }


}
