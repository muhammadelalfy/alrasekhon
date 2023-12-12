<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;

class ArbitrationCommitteeRequest extends FormRequest
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
        $nameArRegex = "/^[0-9٠-٩\s\p{Arabic}]+$/iu";
        $nameEnRegex = "/^[0-9a-zA-Z\s]+$/iu";

        $validation = [
            'name.ar' => ["required", "min:1", "max:200", "regex:".$nameArRegex],
            'name.en' => ["required", "min:1", "max:200", "regex:".$nameEnRegex],
            'competition_level_ids' => ["required", "array"],
            'stage_ids' => ["required", "array"],
            'arbitrators_number' => ["required", "numeric", "gt:0"],
            'committee_member_ids' => ["required", "array"],
            'committee_chairman_id' => ["required", "exists:committee_chairmen,id"],
            'vice_committee_chairman_id' => ["required", "exists:vice_committee_chairmen,id"],
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
            'name.ar' => __('arbitration_committees.name_ar'),
            'name.en' => __('arbitration_committees.name_en'),
            'competition_level_ids' => __('arbitration_committees.competition_level_ids'),
            'stage_ids' => __('arbitration_committees.stage_ids'),
            'arbitrators_number' => __('arbitration_committees.arbitrators_number'),
            'committee_member_ids' => __('arbitration_committees.committee_member_ids'),
            'committee_chairman_id' => __('arbitration_committees.committee_chairman_id'),
            'vice_committee_chairman_id' => __('arbitration_committees.vice_committee_chairman_id'),
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
