<?php

namespace App\Http\Requests\Api\V1\Competitions;

use App\Traits\JsonValidationTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddUpdateStagesRequest extends FormRequest
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

        $regex = "/^[0-9a-zA-Z\p{Arabic}\s!@#$%^&*()_\-+.,']+$/iu";
        $validation = [
            'stages' => ['required', 'array'],
            'stages.*.name' => ['required', 'min:1', 'max:200', 'regex:'.$regex],
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
            'stages' => __('competitions.stages'),
            'stages.*.name' => __('competitions.stage'),
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
