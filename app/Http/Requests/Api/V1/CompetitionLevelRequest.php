<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;

class CompetitionLevelRequest extends FormRequest
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
//        dd($this);
        $nameArRegex = "/^[\s\p{Arabic}]+$/iu";
        $nameEnRegex = "/^[a-zA-Z\s]+$/iu";
        $validation = [

            "name.ar" => ['required','min:1','max:255', 'regex:'.$nameArRegex],
            "name.en" => ['required','min:1','max:255', 'regex:'.$nameEnRegex],
            "controlName.*" => ['required','min:1','max:255', 'regex:'.$nameArRegex],
            "other_controls.*"=>['in:other,good_reading,tagweed_provisions'],
            "winners_count"=>['required','numeric' ,'min:0'],
            "save_amount"=>['required','in:the_hole_quran,ayah,surah,guz'],
            "fromSurahOption"=>['required_if:save_amount,ayah'],
            "toSurahOption"=>['required_if:save_amount,ayah'],
            "fromAyah"=>['required_if:save_amount,ayah'],
            "toAyah"=>['required_if:save_amount,ayah'],
            "fromSurah"=>['required_if:save_amount,surah'],
            "toSurah"=>['required_if:save_amount,surah'],
            "from"=>['required_if:save_amount,guz','required_if:save_amount,guz'],
            "to"=>['required_if:save_amount,guz','required_if:save_amount,guz'],
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
            'name.ar' => __('competition_levels.name_ar'),
            'name.en' => __('competition_levels.name_en'),
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
