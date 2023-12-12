<?php

namespace App\Http\Requests\Api\V1\Competitions;

use App\Traits\JsonValidationTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddUpdateConditionRequest extends FormRequest
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

        $regex = "/^[0-9a-zA-Z\p{Arabic}\s!@#$%^&*()_\-+.,'<>\/]+$/iu";
        $validation = [
            'standard_condition_description' => ['required', 'min:1', 'regex:'.$regex],
        ];

        $stripedDescription = strip_tags(request('standard_condition_description'));

        if ($stripedDescription == ''){
            $validation['standard_condition_description_validation'] = ['required', 'min:1', 'regex:'.$regex];
        }

        return $validation;
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes()
    {
        return [
            'standard_condition_description' => __('competitions.standard_condition_description'),
            'standard_condition_description_validation' => __('competitions.standard_condition_description'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
