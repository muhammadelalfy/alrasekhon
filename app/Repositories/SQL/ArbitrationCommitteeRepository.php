<?php

namespace App\Repositories\SQL;

use App\Http\Resources\ArbitrationCommitteeResource;
use App\Models\ArbitrationCommittee;
use App\Repositories\Contracts\ArbitrationCommitteeContract;
use Illuminate\Database\Eloquent\Model;

class ArbitrationCommitteeRepository extends BaseRepository implements ArbitrationCommitteeContract
{
    /**
     * ArbitrationCommitteeRepository constructor.
     * @param ArbitrationCommittee $model
     */
    public function __construct(ArbitrationCommittee $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param ArbitrationCommittee $model
     * @return int
     */
     public function relatedData(ArbitrationCommittee $model)
     {
        return 0;
     }

     public function create(array $attributes = []): mixed
     {
         $arbitrationCommittee = parent::create($attributes);

         $arbitrationCommittee->competitionLevel()->attach($attributes['competition_level_ids']);
         $arbitrationCommittee->stage()->attach($attributes['stage_ids']);
         $arbitrationCommittee->committeeMember()->attach($attributes['committee_member_ids']);

         $stepsNumbers = $arbitrationCommittee->competition->steps_numbers;

         // Check if step is added before or not
         if (!in_array(5, $stepsNumbers)){
             $stepsNumbers[] = 5;
             $arbitrationCommittee->competition->update(['steps_numbers' => $stepsNumbers]);
         }

         return ArbitrationCommitteeResource::make($arbitrationCommittee);
     }

     public function update(Model $model, array $attributes = []): mixed
     {
         $arbitrationCommittee = parent::update($model, $attributes);

         $arbitrationCommittee->competitionLevel()->sync($attributes['competition_level_ids']);
         $arbitrationCommittee->stage()->sync($attributes['stage_ids']);
         $arbitrationCommittee->committeeMember()->sync($attributes['committee_member_ids']);

         return ArbitrationCommitteeResource::make($arbitrationCommittee);
     }

}
