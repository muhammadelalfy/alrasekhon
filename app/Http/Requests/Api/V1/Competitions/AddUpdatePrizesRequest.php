<?php

namespace App\Http\Requests\Api\V1\Competitions;

use App\Traits\JsonValidationTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddUpdatePrizesRequest extends FormRequest
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


        $validation = [];

//        $regex = "/^[0-9a-zA-Z\p{Arabic}\s!@#$%^&*()_\-+.,']+$/iu";

        if (count(request()->all())){
            foreach (request()->all() as $key => $item) {
                if (is_array($item)){
                    $minMax = $item['winners_counts'];

                    if (mb_strlen($item['competition_levels_names']) <= 0 || mb_strlen($item['competition_levels_names']) > 200){
                        $validation['competition_levels_names.'.$key] = ['required'];
                    }


                    if (!count($item['winners_rankings']) || count($item['winners_rankings']) < $minMax){
                        $validation['winners_ranking.'.$key] = ['required'];
                    }

                    if (!count($item['financials_awards_values']) || count($item['financials_awards_values']) < $minMax){
                        $validation['financials_awards_value.'.$key] = ['required'];
                    }

                    if (!count($item['certificates_and_honors']) || count($item['certificates_and_honors']) < $minMax){
                        $validation['certificates_and_honor.'.$key] = ['required'];
                    }

                    foreach ($item['winners_rankings'] as $wrKey => $winners_ranking) {
                        if (mb_strlen($winners_ranking) <= 0 || mb_strlen($winners_ranking) > 200){
                            $validation['winners_ranking.'.$wrKey] = ['required'];
                        }
                    }

                    foreach ($item['financials_awards_values'] as $favKay => $financials_awards_values) {
                        if (mb_strlen($financials_awards_values) <= 0 || mb_strlen($financials_awards_values) > 200){
                            $validation['financials_awards_value.'.$favKay] = ['required'];
                        }
                    }

                    foreach ($item['certificates_and_honors'] as $cahKey => $certificates_and_honors) {
                        if (mb_strlen($certificates_and_honors) <= 0 || mb_strlen($certificates_and_honors) > 200){
                            $validation['certificates_and_honor.'.$cahKey] = ['required'];
                        }
                    }

                }
            }
        } else {
            $validation['competition_prizes'] = 'required';
        }

        return $validation;
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes()
    {
        $attributes = [
            'competition_prizes' => __('competitions.competition_prizes'),
            'winners_rankings' => __('competitions.winners_rankings'),
            'financials_awards_values' => __('competitions.financials_awards_values'),
            'certificates_and_honors' => __('competitions.certificates_and_honors'),
        ];

        foreach ($this->validationData() as $key => $validationData) {
            $attributes["competition_levels_names.$key"] = __('competitions.competition_levels_names');
            $attributes["winners_ranking.$key"] = __('competitions.winners_rankings');
            $attributes["financials_awards_value.$key"] = __('competitions.financials_awards_values');
            $attributes["certificates_and_honor.$key"] = __('competitions.certificates_and_honors');
        }
       return $attributes;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
