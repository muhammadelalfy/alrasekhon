<?php

namespace App\Repositories\SQL;

use App\Http\Resources\SampleResource;
use App\Models\File;
use App\Models\Sample;
use App\Repositories\Contracts\SampleContract;
use App\Traits\BaseApiResponseTrait;
use App\Traits\FileUploadTrait;

class SampleRepository extends BaseRepository implements SampleContract
{

    use FileUploadTrait, BaseApiResponseTrait;

    /**
     * SampleRepository constructor.
     * @param Sample $model
     */
    public function __construct(Sample $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Sample $model
     * @return int
     */
     public function relatedData(Sample $model)
     {
        return 0;
     }

    public function uploadFile($request): bool|File|array|null
    {
        $file = $request->file('attachment');
        if ($request->hasFile('attachment') && !is_array($request->file('attachment'))){
            $uploaded = $this->upload($file, ($request->type ?? 'Basic'), 'contract_sample');
        }elseif($request->hasFile('attachment') && is_array($request->file('attachment'))){
            $uploaded = $this->uploadMany($file, ($request->type ?? 'Basic'), 'contract_sample');
        }else{
            $uploaded = null;
        }
        return $uploaded;
    }



    public function create(array $attributes = []) :mixed
     {
         $model =  parent::create($attributes);
         $attributes['fileable_type'] = 'Sample';
         $attributes['fileable_id'] = $model->id;
         $fileId = $attributes['fileId'];
         File::find($fileId)->update($attributes);
         return SampleResource::make($model);
     }


}
