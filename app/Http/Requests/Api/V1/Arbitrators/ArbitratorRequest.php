<?php

namespace App\Http\Requests\Api\V1\Arbitrators;

use App\Traits\JsonValidationTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ArbitratorRequest extends FormRequest
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

        $minDateValidate = Carbon::now()->addYears(-10)->format('Y-m-d');
        $nameRegex = "/^[a-zA-Z\p{Arabic}\s]+$/iu";
        $emailRegex = "/^[A-Za-z0-9@!#\$%&\'\*\+\-\/=\?\^_`\{\|\}~]+(\.[A-Za-z0-9@!#\$%&\'\*\+\-\/=\?\^_`\{\|\}~]+)*@[A-Za-z0-9\-\.]+[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*$/iu";
        $phoneRegex = "/^[0-9]{10}+$/iu";
        $codeRegex = "/[00|+][\d]{2,5}/iu";
        $passwordRegex = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,200}$/iu";

        $validation = [
            'first_name' => ['required', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'second_name' => ['required', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'last_name' => ['required', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'birth_date' => ['required', 'date', 'before_or_equal:'.$minDateValidate],
            'identity_proof' => ['required', 'in:national_id,passport'],
            'national_id' => ['nullable', 'required_if:identity_proof,national_id', 'digits_between:1,18'],
            'passport' => ['nullable', 'required_if:identity_proof,passport', 'digits_between:6,15'],
            'gender' => ['required', 'in:male,female'],
            'arbitrator_level_ids' => ['required', 'array', 'exists:arbitrator_levels,id'],
            'nationality' => ['required', 'string', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'country_code' => ['required', 'regex:'.$codeRegex],
            'email' => ['required', 'email', 'min:1', 'max:200', 'regex:'.$emailRegex, 'unique:arbitrators,email,'.$this->id],
            'phone' => ['required', 'numeric', 'digits:10', 'regex:'.$phoneRegex, 'unique:arbitrators,email,'.$this->id],

        ];

        if ($this->method() == 'POST'){
            $validation['password'] = ['required', 'confirmed', 'min:8', 'max:200', 'regex:'.$passwordRegex];
            $validation['password_confirmation'] = ['same:password'];
        }else{
            $validation['password'] = ['nullable', 'confirmed', 'min:8', 'max:200', 'regex:'.$passwordRegex];
            $validation['password_confirmation'] = ['same:password'];
        }

        $validation['status'] = ['nullable'];
        $validation['profile_photo_id'] = ['nullable', 'exists:files,id'];
        $validation['contract_attachment_id'] = ['nullable', 'exists:files,id'];
        $validation['file_type'] = ['nullable', 'array'];
        $validation['step_no'] = ['nullable'];

//        return [];
        return $validation;
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes()
    {
        return [
            'first_name' => __('arbitrators.first_name'),
            'second_name' => __('arbitrators.second_name'),
            'last_name' => __('arbitrators.last_name'),
            'birth_date' => __('arbitrators.birth_date'),
            'identity_proof' => __('arbitrators.identity_proof'),
            'national_id' => __('arbitrators.national_id'),
            'passport' => __('arbitrators.passport'),
            'gender' => __('arbitrators.gender'),
            'arbitrator_level_ids' => __('arbitrators.arbitrator_level_ids'),
            'nationality' => __('arbitrators.nationality'),
            'email' => __('arbitrators.email'),
            'country_code' => __('arbitrators.country_code'),
            'phone' => __('arbitrators.phone'),
            'password' => __('arbitrators.password'),
            'password_confirmation' => __('arbitrators.password_confirmation'),
            'status' => __('arbitrators.status'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'national_id.required_if' => __('arbitrators.national_id_required_if'),
            'passport.required_if' => __('arbitrators.passport_required_if'),
            'password.regex' => __('arbitrators.password_regex'),
            'password_confirmation.regex' => __('arbitrators.password_confirmation_regex'),
        ];
    }
}
