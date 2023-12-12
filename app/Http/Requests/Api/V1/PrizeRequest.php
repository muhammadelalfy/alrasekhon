<?php

namespace App\Http\Requests\Api\V1;

use App\Traits\JsonValidationTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PrizeRequest extends FormRequest
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
        $validation = [
            'order' => ['required',],
            'prize_value' => ['integer','required'],
            'certificate_name' => ['required','string','min:1','max:200'],
            'competition_level_name' => ['required','string','min:1','max:200'],
        ];
        return $validation;
    }

}
