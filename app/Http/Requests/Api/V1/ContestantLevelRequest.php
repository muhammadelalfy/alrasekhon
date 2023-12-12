<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;

class ContestantLevelRequest extends FormRequest
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

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes()
    {
        return [
            'name.ar' => __('contestant_levels.name_ar'),
            'name.en' => __('contestant_levels.name_en'),
            'description.ar' => __('contestant_levels.description_ar'),
            'description.en' => __('contestant_levels.description_en'),
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
