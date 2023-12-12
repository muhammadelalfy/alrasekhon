<?php

namespace App\Http\Requests\Api\V1\Competitions;

use App\Traits\JsonValidationTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CompetitionRequest extends FormRequest
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


        $competitionStartDateValidate = Carbon::now()->addMonths(2)->format('Y-m-d');
        $competitionStartRegisterDateValidate = Carbon::now()->addMonth()->format('Y-m-d');
        $regex = "/^[0-9a-zA-Z\p{Arabic}\s!@#$%^&*()_+.,']+$/iu";

        $validation = [
            'name' => ['required', 'min:1', 'max:200', 'regex:'.$regex],
            'competition_type_id' => ['required', 'exists:competition_types,id'],
            'competition_date.0' => ['required', 'date', 'after_or_equal:'.$competitionStartDateValidate],
            'competition_date.1' => ['required', 'date', 'after:competition_date.0'],
            'registration_date.0' => ['required', 'date', 'after_or_equal:'.$competitionStartRegisterDateValidate],
            'registration_date.1' => ['required', 'date', 'after_or_equal:registration_date.0'],
            'competitors_max_num' => ['required', 'integer', 'gt:0'],
            'competition_budget' => ['required', 'integer', 'gt:0'],
            'age_group' => ['required', 'array'],
            'age_from' => ['required', 'array'],
            'age_to' => ['required', 'array'],
            'competition_photo_id' => ['nullable', 'exists:files,id'],

        ];

        if (count(request('age_group') ?? [])){
            foreach (request('age_group') as $item) {
                preg_match($regex, $item, $match);
                if (mb_strlen($item) < 1 || mb_strlen($item) > 200 || !count($match)){
                    $validation['age_group_validation'] = ['required', 'min:1', 'max:200', 'regex:'.$regex];
                }
            }
        }
        if (count(request('age_from') ?? [])){
            foreach (request('age_from') as $item) {
                if ($item <= 0 || !is_numeric($item)){
                    $validation['age_from_validation'] = ['required'];
                }

            }
        }
        if (count(request('age_to') ?? [])){
            foreach (request('age_to') as $item) {
                if ($item <= 0 || !is_numeric($item)){
                    $validation['age_to_validation'] = ['required'];
                }
            }
        }

        if (request('request_action') && request('request_action') == 'update_place'){
            $validation['country_id'] = ['required', 'exists:countries,id'];
            $validation['governorate_id'] = ['required', 'exists:governorates,id'];
            $validation['city_id'] = ['required', 'exists:cities,id'];
            $validation['competition_address'] = ['required', 'min:1', 'max:200', 'regex:'.$regex];
            $validation['location'] = ['required', 'min:1', 'max:200', 'regex:'.$regex];

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
            'name' => __('competitions.name'),
            'competition_type_id' => __('competitions.competition_type_id'),
            'competition_date' => __('competitions.competition_date'),
            'registration_date' => __('competitions.registration_date'),
            'competition_date.0' => __('competitions.competition_start_date'),
            'competition_date.1' => __('competitions.competition_end_date'),
            'registration_date.0' => __('competitions.registration_start_date'),
            'registration_date.1' => __('competitions.registration_end_date'),
            'competitors_max_num' => __('competitions.competitors_max_num'),
            'competition_budget' => __('competitions.competition_budget'),
            'age_group' => __('competitions.age_group'),
            'age_from' => __('competitions.age_from'),
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
        return [
            'age_group_validation.required' => __('competitions.age_group_validation'),
            'age_from_validation.required' => __('competitions.age_from_validation'),
            'age_to_validation.required' => __('competitions.age_to_validation'),
        ];
    }
}
