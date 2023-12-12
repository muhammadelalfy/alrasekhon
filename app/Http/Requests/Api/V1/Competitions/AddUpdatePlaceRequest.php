<?php

namespace App\Http\Requests\Api\V1\Competitions;

use App\Traits\JsonValidationTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddUpdatePlaceRequest extends FormRequest
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
            'country_id' => ['required', 'exists:countries,id'],
            'governorate_id' => ['required', 'exists:governorates,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'competition_address' => ['required', 'min:1', 'max:200', 'regex:'.$regex],
            'location' => ['required', 'min:1', 'max:200', 'regex:'.$regex],

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
            'country_id' => __('competitions.country_id'),
            'governorate_id' => __('competitions.governorate_id'),
            'city_id' => __('competitions.city_id'),
            'competition_address' => __('competitions.competition_address'),
            'location' => __('competitions.location'),
            'competition_photo_id' => __('competitions.competition_photo_id'),
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
