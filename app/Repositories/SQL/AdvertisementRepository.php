<?php

namespace App\Repositories\SQL;

use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use App\Models\File;
use App\Repositories\Contracts\AdvertisementContract;
use App\Traits\BaseApiResponseTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AdvertisementRepository extends BaseRepository implements AdvertisementContract
{

    use FileUploadTrait, BaseApiResponseTrait;

    /**
     * AdvertisementRepository constructor.
     * @param Advertisement $model
     */
    public function __construct(Advertisement $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Advertisement $model
     * @return int
     */
     public function relatedData(Advertisement $model)
     {
        return 0;
     }

    public function create(array $attributes = []) :mixed
    {

        $model =  parent::create($attributes);

        $fileData['fileable_type'] = 'Advertisement';
        $fileData['fileable_id'] = $model->id;

        if ($attributes['ready_sample_id']){
            File::find($attributes['ready_sample_id'])->update($fileData);
        }

        return AdvertisementResource::make($model);
    }

    public function update(Model $model, array $attributes = []): mixed
    {

        $fileData['fileable_type'] = 'Advertisement';
        $fileData['fileable_id'] = $model->id;

        if ($attributes['ready_sample_id'] ?? null){
            $oldFile = $model->file;
            if ($oldFile && $oldFile->id != $attributes['ready_sample_id']){
                $this->deleteFile($oldFile);
            }
            File::find($attributes['ready_sample_id'])->update($fileData);

        }
        return parent::update($model, $attributes);
    }


    public function uploadFile($request) :File|bool|JsonResponse|null
    {

        $rules = [];
        if ($request->advertise_sample_attach){
            $rules['advertise_sample_attach'] = ['required', 'mimes:jpg,jpeg,png,mp4', 'max:51200'];
        }

        $validator = Validator::make($request->all(), $rules, [], [
            'advertise_sample_attach' => __('advertisements.advertise_sample_attach'),
        ]);

        if ($validator->fails()){
            return $this->respondWithError($validator->errors()->first());
        }

        $uploaded = null;
        $file = $request->file($request->type);
        if ($request->hasFile($request->type) && !is_array($request->file($request->type))){
            $uploaded = $this->upload($file, ($request->type ?? 'Basic'), $request->type.'/');
        }
        return $uploaded;
    }

}
