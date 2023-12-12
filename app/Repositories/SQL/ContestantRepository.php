<?php

namespace App\Repositories\SQL;

use App\Http\Resources\ContestantResource;
use App\Models\Contestant;
use App\Models\File;
use App\Repositories\Contracts\ContestantContract;
use App\Traits\BaseApiResponseTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ContestantRepository extends BaseRepository implements ContestantContract
{
    use FileUploadTrait, BaseApiResponseTrait;

    /**
     * ContestantRepository constructor.
     * @param Contestant $model
     */
    public function __construct(Contestant $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Contestant $model
     * @return int
     */
     public function relatedData(Contestant $model)
     {
        return 0;
     }


    /**
     * @param $request
     * @return File|bool|JsonResponse|null
     */
    public function uploadFile($request) :File|bool|JsonResponse|null
    {
        $validator = Validator::make($request->all(), [
            'profile_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ], [], [
            'profile_photo' => __('contestants.profile_photo')
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

    public function create(array $attributes = []) :mixed
    {

        $model =  parent::create($attributes);

        if ($attributes['file_id'] && $attributes['file_type']){
            $attributes['fileable_type'] = 'Contestant';
            $attributes['fileable_id'] = $model->id;
            $fileId = $attributes['file_id'];
            File::find($fileId)->update($attributes);
        }

        $model->levels()->sync($attributes['contestant_level_ids']);

        return ContestantResource::make($model);
    }

    public function update(Model $model, array $attributes = []): mixed
    {
        if (($attributes['file_id'] ?? null) && ($attributes['file_type'] ?? null)){

            // Delete old file
            if ($model->file){
                if ($model->file->id != $attributes['file_id']){
                    $this->deleteFile($model->file);
                }
            }

            $attributes['fileable_type'] = 'Contestant';
            $attributes['fileable_id'] = $model->id;
            $fileId = $attributes['file_id'];
            File::find($fileId)->update($attributes);
        }

        if ($attributes['contestant_level_ids'] ?? null){
            $model->levels()->sync($attributes['contestant_level_ids']);
        }


        return parent::update($model, $attributes);
    }

}
