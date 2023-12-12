<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;

class AdvertisementRequest extends FormRequest
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

        $regex = "/^[0-9a-zA-Z\p{Arabic}\s!@#$%^&*()_\-+.,'<>\/]+$/iu";
        $youtubeRegex = '/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        $imageRegex = '/\.(jpe?g|png)$/i';
        $videoRegex = '/\.mp4$/';



        $validation = [
            'name' => ['required', 'min:1', 'max:200', 'regex:'.$regex],
            'media_type' => ['required', 'in:video,link,image'],
        ];

        if (request('media_type') == 'link'){
            $validation['url'] = ['required', 'regex:'.$youtubeRegex];
        }
        if (request('media_type') == 'image'){
            $validation['url'] = ['required', 'regex:'.$imageRegex];
        }
        if (request('media_type') == 'video'){
            $validation['url'] = ['required', 'regex:'.$videoRegex];
        }

        $validation['description'] = ['required', 'min:1', 'max:200', 'regex:'.$regex];
        $validation['ready_sample_id'] = ['nullable', 'exists:files,id'];

        return $validation;
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes()
    {

        $url = '';

        if (request('media_type') == 'image'){
            $url = __('advertisements.image');
        }
        if (request('media_type') == 'link'){
            $url = __('advertisements.link');
        }
        if (request('media_type') == 'video'){
            $url = __('advertisements.video');
        }

        return [
            'name' => __('advertisements.name'),
            'media_type' => __('advertisements.media_type'),
            'url' => $url,
            'description' => __('advertisements.description'),
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
