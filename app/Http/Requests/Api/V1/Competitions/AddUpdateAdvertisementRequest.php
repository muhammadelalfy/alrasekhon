<?php

namespace App\Http\Requests\Api\V1\Competitions;

use App\Traits\JsonValidationTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddUpdateAdvertisementRequest extends FormRequest
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

        $validation = [
            'advertisement_id' => ['required', 'exists:advertisements,id'],
            'is_announced' => ['nullable'],
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
            'advertisement_id' => __('competitions.advertisement_id'),
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
