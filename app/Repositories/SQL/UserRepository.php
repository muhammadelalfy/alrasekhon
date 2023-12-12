<?php

namespace App\Repositories\SQL;

use App\Http\Resources\ContestantResource;
use App\Http\Resources\UserResource;
use App\Models\File;
use App\Models\User;
use App\Repositories\Contracts\RoleContract;
use App\Repositories\Contracts\UserContract;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class UserRepository extends BaseRepository implements UserContract
{
    use FileUploadTrait;
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param User $model
     * @return int
     */
     public function relatedData(User $model)
     {
        return 0;
     }


    public function create(array $attributes = []) :mixed
    {
        $attributes['type'] = 2;
        $model =  parent::create($attributes);
        if ($attributes['file_id'] && $attributes['file_type']){
            $attributes['fileable_type'] = 'User';
            $attributes['fileable_id'] = $model->id;
            $fileId = $attributes['file_id'];
            File::find($fileId)->update($attributes);
        }

        return UserResource::make($model);
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

        return parent::update($model, $attributes);
    }
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



}
