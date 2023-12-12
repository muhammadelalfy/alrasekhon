<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\SampleRequest;
use App\Http\Resources\SampleResource;
use App\Models\Sample;
use App\Repositories\Contracts\SampleContract;
use App\Traits\FileUploadTrait;
use \Illuminate\Http\JsonResponse;

class SampleController extends BaseApiController
{

    use FileUploadTrait;
    /**
     * SampleController constructor.
     * @param SampleContract $repository
     */
    public function __construct(SampleContract $repository)
    {
        parent::__construct($repository, SampleResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SampleRequest $request
     *
     */
    public function store(SampleRequest $request)
    {
        if ($request->attachment && is_file($request->attachment)){
            try {
                $uploaded = $this->repository->uploadFile($request);
                if (is_array($uploaded)){
                    return $this->respondWithCollection($uploaded);
                }elseif(!empty($uploaded)){
                    return $uploaded;
                }else{
                    return $this->respondWithError(__('something went wrong when upload files'));
                }
            }catch (\Exception $e) {
                return $this->respondWithError($e->getMessage());
            }
        }
        $sample = $this->repository->create($request->all());
        return $this->respondWithModel($sample);
    }


   /**
    * Display the specified resource.
    *
    * @param Sample $sample
    *
    */
   public function show(Sample $sample)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sample $sample
     *
     */
    public function edit(Sample $sample)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SampleRequest $request
     * @param Sample $sample
     *
     */
    public function update(SampleRequest $request, Sample $sample)
    {
        if ($request->attachment && is_file($request->attachment)){
            try {
                if ($sample->file){
                    $this->deleteFile($sample->file);
                }
                $uploaded = $this->repository->uploadFile($request);
                if (is_array($uploaded)){
                    return $this->respondWithCollection($uploaded);
                }elseif(!empty($uploaded)){
                    return $uploaded;
                }else{
                    return $this->respondWithError(__('something went wrong when upload files'));
                }
            }catch (\Exception $e) {
                return $this->respondWithError($e->getMessage());
            }
        }
        $sample = $this->repository->update($sample, $request->validated());
        return $this->respondWithModel($sample);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sample $sample
     *
     * @return JsonResponse
     */
    public function destroy(Sample $sample)
    {
        if ($sample->file){
            $this->deleteFile($sample->file);
        }
        $this->repository->remove($sample);
        return $this->respondWithSuccess(__('Contract sample Deleted Successfully'));
    }

}
