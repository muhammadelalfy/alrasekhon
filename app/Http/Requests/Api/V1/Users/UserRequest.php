<?php

namespace App\Http\Requests\Api\V1\Users;

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

        $validation = [
            'first_name' => ['required', 'min:1', 'max:200', 'regex:' . $nameRegex],
            'second_name' => ['nullable', 'min:1', 'max:200', 'regex:' . $nameRegex],
            'last_name' => ['required', 'min:1', 'max:200', 'regex:' . $nameRegex],
            'birth_date' => ['required', 'date', 'before_or_equal:' . $minDateValidate],
            'identity_proof' => ['required', 'in:national_id,passport'],
            'national_id' => ['nullable', 'required_if:identity_proof,national_id', 'digits_between:5,18'],
            'passport' => ['nullable', 'required_if:identity_proof,passport', 'digits_between:6,15'],
            'gender' => ['required', 'in:male,female'],
//            'nationality' => ['required', 'string', 'min:1', 'max:200', 'regex:' . $nameRegex],
            'email' => ['required', 'email', 'min:1', 'max:200', 'regex:' . $emailRegex, 'unique:users,email,' . $this->id],
            "email_status" => ['required', 'in:0,1'],
            'main_job' => ['required', 'string', 'min:1', 'max:200', 'regex:' . $nameRegex],
            'phone' => ['required', 'numeric', 'digits:10', 'regex:' . $phoneRegex, 'unique:users,phone,' . $this->id],
            "phone_status" => ['required', 'in:0,1'],
            "lang" => ['required', 'in:ar,en'],
            'qualifications' => ['required', 'string', 'min:1', 'max:200', 'regex:'.$nameRegex],
        ];
        $validation['password'] = ['required', 'confirmed', 'min:8', 'max:200']; //, 'regex:'.$passwordRegex
        $validation['password_confirmation'] = ['same:password','required'];
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
            'first_name' => __('users.first_name'),
            'second_name' => __('users.second_name'),
            'last_name' => __('users.last_name'),
            'birth_date' => __('users.birth_date'),
            'identity_proof' => __('users.identity_proof'),
            'national_id' => __('users.national_id'),
            'passport' => __('users.passport'),
            'gender' => __('users.gender'),
            'user_level_ids' => __('users.user_level_ids'),
            'nationality' => __('users.nationality'),
            'email' => __('users.email'),
            'qualification' => __('users.qualification'),
            'job' => __('users.job'),
            'country_code' => __('users.country_code'),
            'phone' => __('users.phone'),
            'main_address' => __('users.main_address'),
            'additional_address' => __('users.additional_address'),
            'password' => __('users.password'),
            'password_confirmation' => __('users.password_confirmation'),
            'status' => __('users.status'),
            'country_id' => __('contestants.country_id'),
            'governorate_id' => __('contestants.governorate_id'),
            'city_id' => __('contestants.city_id'),
            'address' => __('contestants.main_address'),
            'alternative_address' => __('contestants.additional_address'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'national_id.required_if' => __('users.national_id_required_if'),
            'passport.required_if' => __('users.passport_required_if'),
            'password.regex' => __('users.password_regex'),
            'password_confirmation.regex' => __('users.password_confirmation_regex'),
        ];
    }
}
