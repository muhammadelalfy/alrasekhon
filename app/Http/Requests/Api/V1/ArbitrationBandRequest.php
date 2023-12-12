<?php

namespace App\Http\Requests\Api\V1;

use App\Traits\JsonValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ArbitrationBandRequest extends FormRequest
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
//        dd($this->arbitration_type_id);
        $validation = [
            'name.ar' => "required|string|min:1|max:200",
            'name.en' => "required|string|min:1|max:200",
            'description.ar' => "required|string|min:1|max:200",
            'description.en' => "required|string|min:1|max:200",
            'arbitration_type_id' => "exists:arbitration_types,id"
        ];

        return $validation;
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
