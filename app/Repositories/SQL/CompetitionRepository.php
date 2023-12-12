<?php

namespace App\Repositories\SQL;

use App\Http\Requests\Api\V1\ConcertHonoringRequest;
use App\Http\Resources\CompetitionLevelResource;
use App\Http\Resources\CompetitionResource;
use App\Http\Resources\ConcertHonoringResource;
use App\Http\Resources\PrizeResource;
use App\Models\Competition;

use App\Models\CompetitionLevel;

use App\Models\ConcertHonoring;

use App\Models\File;
use App\Models\Prize;
use App\Models\Stage;
use App\Repositories\Contracts\CompetitionContract;
use App\Traits\BaseApiResponseTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CompetitionRepository extends BaseRepository implements CompetitionContract
{

    use FileUploadTrait, BaseApiResponseTrait;

    /**
     * CompetitionRepository constructor.
     * @param Competition $model
     */
    public function __construct(Competition $model)
    {
        parent::__construct($model);
    }


    /**
     * Check if model has relations with any other tables
     * @param Competition $model
     * @return int
     */
    public function relatedData(Competition $model)
    {
        return 0;
    }

    public function create(array $attributes = []): mixed
    {

        $model = parent::create($attributes);
        $fileData['fileable_type'] = 'Competition';
        $fileData['fileable_id'] = $model->id;

        if ($attributes['competition_photo_id']) {
            File::find($attributes['competition_photo_id'])->update($fileData);
        }

        return CompetitionResource::make($model);
    }

    public function addUpdateStages(Model $model, array $attributes = []): CompetitionResource
    {
        $oldStages = $model->stages();
        if ($oldStages->count()) {
            $oldStages->delete();
        }
        $attributes = array_map(function ($value) use ($model) {
            return array_merge($value, ['competition_id' => $model->id]);
        }, $attributes['stages']);

        $model->stages()->insert($attributes);

        $this->updateStepsNumbers($model, 3);

        return CompetitionResource::make($model);
    }

    public function addUpdatePlace(Model $model, array $attributes = [])
    {
        $this->updateStepsNumbers($model, 4);

        return parent::update($model, $attributes);
    }

    public function addUpdateAdvertisement(Model $model, array $attributes = [])
    {
        $model = parent::update($model, $attributes);
        $this->updateStepsNumbers($model, 9);
        return CompetitionResource::make($model);
    }

    public function addUpdatePrizes(Model $model, array $attributes = []): CompetitionResource
    {

        $oldPrize = $model->prize;
        if ($oldPrize){
            $oldPrize->update(['prize_data' => $attributes]);
        } else {
            Prize::create(['competition_id' => $model->id, 'prize_data' => $attributes]);
        }

        $this->updateStepsNumbers($model, 7);
        return CompetitionResource::make($model);
    }

    public function addUpdateCondition(Model $model, array $attributes = [])
    {
        $model->standardCondition()->update($attributes);

        $this->updateStepsNumbers($model, 8);
        return CompetitionResource::make($model);
    }

    public function addUpdateConcertHonoring(Model $model, array $attributes): ConcertHonoringResource
    {
        $oldConcernHonoring = $model->concert_honoring;
        if ($oldConcernHonoring){
            $oldConcernHonoring->update($attributes);
        } else {
            ConcertHonoring::create($attributes);
        }

        $this->updateStepsNumbers($model, 6);

        return ConcertHonoringResource::make($model);
    }

    public function update_competition_level(Model $model, $attributes)
    {
        $this->updateStepsNumbers($model, 2);
        if (request()->id) {
            $model->levels()->where('id', request()->id)->update($attributes->validated());
            $model = CompetitionLevel::find(request()->id);
        } else {
            $model = $model->levels()->create($attributes->validated())->fresh();
        }

        return $model;
    }

    public function updateStepsNumbers(Model $model, int $stepNumber)
    {
        $stepsNumbers = $model->steps_numbers;
        // Check if step is added before or not
        if (!in_array($stepNumber, $stepsNumbers)){
            $stepsNumbers[] = $stepNumber;
            $model->update(['steps_numbers' => $stepsNumbers]);
        }
    }
    /**
     * @param $request
     * @return File|bool|JsonResponse|null
     */
    public function uploadFile($request): File|bool|JsonResponse|null
    {

        $rules = [];
        if ($request->competition_photo) {
            $rules['competition_photo'] = ['required', 'mimes:jpg,jpeg,png,gif', 'max:52400'];
        }

        $validator = Validator::make($request->all(), $rules, [], [
            'competition_photo' => __('competitions.competition_photo'),
        ]);

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors()->first());
        }

        $uploaded = null;
        $file = $request->file($request->type);
        if ($request->hasFile($request->type) && !is_array($request->file($request->type))) {
            $uploaded = $this->upload($file, ($request->type ?? 'Basic'), $request->type . '/');
        }
        return $uploaded;
    }


}
