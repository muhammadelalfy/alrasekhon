<?php

namespace App\Repositories\SQL;

use App\Models\File;
use App\Repositories\Contracts\FileContract;
use App\Traits\FileUploadTrait;

class FileRepository extends BaseRepository implements FileContract
{

    use FileUploadTrait;

    /**
     * FileRepository constructor.
     * @param File $model
     */
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    public function saveUploads($request): bool|File|array|null
    {
        $file = $request->file('attachment');
        if ($request->hasFile('attachment') && !is_array($request->file('attachment'))){
            $uploaded = $this->upload($file, $request->type);
        }elseif($request->hasFile('attachment') && is_array($request->file('attachment'))){
            $uploaded = $this->uploadMany($file, $request->type);
        }else{
            $uploaded = null;
        }
        return $uploaded;
    }

    /**
     * Check if model has relations with any other tables
     * @param File $model
     * @return int
     */
    public function relatedData(File $model): int
    {
        return 0;
    }

}
