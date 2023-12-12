<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CompetitionTypeRequest extends FormRequest
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
        $nameArRegex = "/^[٠-٩\p{Arabic}\s]+$/iu";
        $nameEnRegex = "/^[0-9a-zA-Z\s]+$/iu";
        $descArRegex = "/^[٠-٩a-zA-Z\p{Arabic}\s !@#$%^&*().,\/<>]+$/iu";
        $descEnRegex = "/^[0-9a-zA-Z\s !@#$%^&*().,\/<>]+$/iu";

        $validation = [
            'name.ar' => ["required", "min:1", "max:200", "regex:".$nameArRegex],
            'name.en' => ["required", "min:1", "max:200", "regex:".$nameEnRegex],
            'description.ar' => ["nullable", "min:1", "max:200", "regex:".$descArRegex],
            'description.en' => ["nullable", "min:1", "max:200", "regex:".$descEnRegex],
        ];

        return $validation;
    }

    public function attributes()
    {
        return [
            'name.ar' => __('competition_types.name_ar'),
            'name.en' => __('competition_types.name_en'),
            'description.ar' => __('competition_types.description_ar'),
            'description.en' => __('competition_types.description_en'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }

}
