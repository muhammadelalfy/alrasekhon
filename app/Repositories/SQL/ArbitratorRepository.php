<?php

namespace App\Repositories\SQL;

use App\Http\Resources\ArbitratorResource;
use App\Models\Arbitrator;
use App\Models\File;
use App\Repositories\Contracts\ArbitratorContract;
use App\Traits\BaseApiResponseTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ArbitratorRepository extends BaseRepository implements ArbitratorContract
{
    use FileUploadTrait, BaseApiResponseTrait;

    /**
     * ArbitratorRepository constructor.
     * @param Arbitrator $model
     */
    public function __construct(Arbitrator $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Arbitrator $model
     * @return int
     */
     public function relatedData(Arbitrator $model)
     {
        return 1;
     }

    /**
     * Create new arbitrator
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes = []) :mixed
    {

        $model =  parent::create($attributes);

        $fileData['fileable_type'] = 'Arbitrator';
        $fileData['fileable_id'] = $model->id;

        if ($attributes['profile_photo_id']){
            File::find($attributes['profile_photo_id'])->update($fileData);
        }
        if ($attributes['contract_attachment_id']){
            File::find($attributes['contract_attachment_id'])->update($fileData);
        }

        $model->levels()->sync($attributes['arbitrator_level_ids']);

        return ArbitratorResource::make($model);
    }

    /**
     * Update arbitrator
     * @param Model $model
     * @param array $attributes
     * @return mixed
     */
    public function update(Model $model, array $attributes = []): mixed
    {

        $fileData['fileable_type'] = 'Arbitrator';
        $fileData['fileable_id'] = $model->id;

        if ($attributes['profile_photo_id'] ?? null){
            $oldFile = $model->profilePhoto;
            if ($oldFile && $oldFile->id != $attributes['profile_photo_id']){
                $this->deleteFile($oldFile);
            }
            File::find($attributes['profile_photo_id'])->update($fileData);

        }
        if ($attributes['contract_attachment_id'] ?? null){
            $oldFile = $model->contractAttachment;
            if ($oldFile && $oldFile->id != $attributes['contract_attachment_id']){
                $this->deleteFile($oldFile);
            }
            File::find($attributes['contract_attachment_id'])->update($fileData);

        }

        if ($attributes['vocation_bonds_attaches'] ?? null){
            $oldFiles = $model->vacationsAndBondsAttachment->whereNotIn('id', $attributes['vocation_bonds_attaches']);
            if (count($oldFiles)){
                $this->deleteFiles($oldFiles);
            }
            File::whereIn('id', $attributes['vocation_bonds_attaches'])->update($fileData);

        }

        if (count($attributes['arbitrator_level_ids'] ?? [])){
            $model->levels()->sync($attributes['arbitrator_level_ids']);
        }

        return parent::update($model, $attributes);
    }

    /**
     * Add new work experience
     * @param Model $model
     * @param array $attributes
     * @return ArbitratorResource
     */
    public function addWorkExperience(Model $model, array $attributes = []) :ArbitratorResource
    {

        $fileData['fileable_type'] = 'Arbitrator';
        $fileData['fileable_id'] = $model->id;

        // Only add new work place proof attachment file
            if ($attributes['work_place_proof_attach_id']){
            File::find($attributes['work_place_proof_attach_id'])->update($fileData);
        }
        $oldWorkExperiences = $model->work_experiences ?? [];


        $workExperiencesIndex = $attributes['work_experiences_index'];

        // Update work experience by index
        if ($workExperiencesIndex != ''){
            $oldWorkExperiences[$workExperiencesIndex] = $attributes;
        }
        // Add new work experience
        else {
            $oldWorkExperiences[] = $attributes;
        }

        $attributes['work_experiences'] = $oldWorkExperiences;
        parent::update($model, $attributes);
        return ArbitratorResource::make($model);

    }

    /**
     * Delete  work experience
     * @param Model $model
     * @param array $attributes
     * @return ArbitratorResource
     */
    public function deleteWorkExperience(Model $model, array $attributes = []) :ArbitratorResource
    {
        parent::update($model, $attributes);
        return ArbitratorResource::make($model);
    }



    /**
     * @param $request
     * @return File|bool|JsonResponse|null
     */
    public function uploadFile($request) :File|bool|JsonResponse|null
    {

        $rules = [];
        if ($request->profile_photo){
            $rules['profile_photo'] = ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'];
        }
        if ($request->contract_attachment){
            $rules['contract_attachment'] = ['required', 'mimes:jpg,jpeg,png,pdf', 'max:52400'];
        }

        if ($request->work_place_proof_attachment){
            $rules['work_place_proof_attachment'] = ['required', 'mimes:jpg,jpeg,png,pdf', 'max:52400'];
        }

        if ($request->vocation_bonds_attaches){
            $rules['vocation_bonds_attaches'] = ['required', 'mimes:jpg,jpeg,png,pdf', 'max:52400'];
        }

        $validator = Validator::make($request->all(), $rules, [], [
            'profile_photo' => __('arbitrators.profile_photo'),
            'contract_attachment' => __('arbitrators.contract_attachment'),
            'work_place_proof_attachment' => __('arbitrators.work_place_proof_attachment'),
            'vocation_bonds_attaches' => __('arbitrators.vocation_bonds_attaches'),
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
