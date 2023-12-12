<?php

namespace App\Http\Requests\Api\V1;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $addressRegex = "/^[0-9a-zA-Z\p{Arabic} !@#$%^&*()]+$/iu";

        $validation = [
            'first_name' => ['required', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'second_name' => ['required', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'last_name' => ['required', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'birth_date' => ['required', 'date', 'before_or_equal:'.$minDateValidate],
            'identity_proof' => ['required', 'in:national_id,passport'],
            'national_id' => ['nullable', 'required_if:identity_proof,national_id', 'digits_between:1,18'],
            'passport' => ['nullable', 'required_if:identity_proof,passport', 'digits_between:6,15'],
            'gender' => ['required', 'in:male,female'],
            'contestant_level_ids' => ['required', 'array', 'exists:contestant_levels,id'],
            'nationality' => ['required', 'string', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'email' => ['required', 'email', 'min:1', 'max:200', 'regex:'.$emailRegex, 'unique:contestants,email,'.$this->id],
            'qualification' => ['required', 'string', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'job' => ['required', 'string', 'min:1', 'max:200', 'regex:'.$nameRegex],
            'country_code' => ['required', 'regex:'.$codeRegex],
            'phone' => ['required', 'numeric', 'digits:10', 'regex:'.$phoneRegex, 'unique:contestants,email,'.$this->id],
        ];

        if ($this->method() == 'POST'){
            $validation['password'] = ['required', 'confirmed', 'min:8', 'max:200']; //, 'regex:'.$passwordRegex
            $validation['password_confirmation'] = ['same:password'];
        }else{
            $validation['country_id'] = ['required', 'exists:countries,id'];
            $validation['governorate_id'] = ['required', 'exists:governorates,id'];
            $validation['city_id'] = ['required', 'exists:cities,id'];
            $validation['main_address'] = ['required', 'string', 'min:1', 'max:200', 'regex:'.$addressRegex];
            $validation['additional_address'] = ['required', 'string', 'min:1', 'max:200', 'regex:'.$addressRegex];
            $validation['password'] = ['required', 'confirmed', 'min:8', 'max:200']; // , 'regex:'.$passwordRegex
            $validation['password_confirmation'] = ['same:password','required'];
        }

        $validation['status'] = ['nullable'];
        $validation['file_id'] = ['nullable', 'exists:files,id'];
        $validation['file_type'] = ['nullable'];
        $validation['step_no'] = ['nullable'];

        return $validation;
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes()
    {
        return [
            'first_name' => __('contestants.first_name'),
            'second_name' => __('contestants.second_name'),
            'last_name' => __('contestants.last_name'),
            'birth_date' => __('contestants.birth_date'),
            'identity_proof' => __('contestants.identity_proof'),
            'national_id' => __('contestants.national_id'),
            'passport' => __('contestants.passport'),
            'gender' => __('contestants.gender'),
            'contestant_level_ids' => __('contestants.contestant_level_ids'),
            'nationality' => __('contestants.nationality'),
            'email' => __('contestants.email'),
            'qualification' => __('contestants.qualification'),
            'job' => __('contestants.job'),
            'country_code' => __('contestants.country_code'),
            'phone' => __('contestants.phone'),
            'country_id' => __('contestants.country_id'),
            'governorate_id' => __('contestants.governorate_id'),
            'city_id' => __('contestants.city_id'),
            'main_address' => __('contestants.main_address'),
            'additional_address' => __('contestants.additional_address'),
            'password' => __('contestants.password'),
            'password_confirmation' => __('contestants.password_confirmation'),
            'status' => __('contestants.status'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'national_id.required_if' => __('contestants.national_id_required_if'),
            'passport.required_if' => __('contestants.passport_required_if'),
            'password.regex' => __('contestants.password_regex'),
            'password_confirmation.regex' => __('contestants.password_confirmation_regex'),
        ];
    }
}
