<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;

class SampleRequest extends FormRequest
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
        $nameArRegex = "/^[٠-٩\s\p{Arabic}]+$/iu";
        $nameEnRegex = "/^[0-9a-zA-Z\s]+$/iu";
        $validation = [];

        if (request()->attachment && is_file(request()->attachment)){
            $validation['attachment'] = ['required', 'file', 'mimes:doc,docx,pdf', 'max:5120'];
        } else{
            $validation = [
                'name.ar' => ["required", "min:1", "max:200", "regex:".$nameArRegex],
                'name.en' => ["required", "min:1", "max:200", "regex:".$nameEnRegex],
                'contract_category' => ["required", "in:arbitrator,sponsor,service_provider"],
                'fileId' => ['required', 'exists:files,id'],
                'attachment' => ['required', 'in:attached'],
            ];
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
            'name.ar' => __('samples.name_ar'),
            'name.en' => __('samples.name_en'),
            'contract_category' => __('samples.contract_category'),
            'fileId' => __('samples.attachment'),
            'attachment' => __('samples.attachment'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'attachment.max' => __('samples.attache_max')
        ];
    }
}
