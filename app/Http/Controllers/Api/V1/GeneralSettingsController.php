<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\GeneralSettingsRequest;
use App\Http\Resources\GeneralSettingsResource;
use App\Models\GeneralSettings;
use App\Repositories\Contracts\GeneralSettingsContract;
use App\Traits\BaseApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class GeneralSettingsController extends Controller
{
    use BaseApiResponseTrait;

    public function index(): JsonResponse
    {
        $result = [];
        $availableSettings = config('settings.settings');
        foreach ($availableSettings as $settingClass) {
            $settings = app($settingClass);
            $result[$settings->group()] = $settings->toArray();
        }
        $data=[];
        foreach (request()->params as $res) {
            $data[$res] = $result["general"]["$res"];
        }
        return $this->respondWithJson($data);
    }

    public function update(GeneralSettings $settings , GeneralSettingsRequest $request): JsonResponse
    {
        foreach ($request->keys as $key=>$value){
            $settings->$key = $value;
        }
        $settings->save();
        return $this->respondWithSuccess(__('message.updated_successfully'));
    }
}
