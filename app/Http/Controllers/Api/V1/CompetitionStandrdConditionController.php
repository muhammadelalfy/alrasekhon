<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\CompetitionStandrdConditionRequest;
use App\Http\Resources\CompetitionStandrdConditionResource;
use App\Models\CompetitionStandrdCondition;
use App\Repositories\Contracts\CompetitionStandrdConditionContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class CompetitionStandrdConditionController extends BaseApiController
{

    /**
     * CompetitionStandrdConditionController constructor.
     * @param CompetitionStandrdConditionContract $repository
     */
    public function __construct(CompetitionStandrdConditionContract $repository)
    {
        parent::__construct($repository, CompetitionStandrdConditionResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompetitionStandrdConditionRequest $request
     *
     * @return Response
     */
    public function store(CompetitionStandrdConditionRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param CompetitionStandrdCondition $competitionStandrdCondition
    *
    */
   public function show(CompetitionStandrdCondition $competitionStandrdCondition)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CompetitionStandrdCondition $competitionStandrdCondition
     *
     */
    public function edit(CompetitionStandrdCondition $competitionStandrdCondition)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompetitionStandrdConditionRequest $request
     * @param CompetitionStandrdCondition $competitionStandrdCondition
     *
     */
    public function update(CompetitionStandrdConditionRequest $request, CompetitionStandrdCondition $competitionStandrdCondition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CompetitionStandrdCondition $competitionStandrdCondition
     *
     * @return JsonResponse
     */
    public function destroy(CompetitionStandrdCondition $competitionStandrdCondition)
    {
        //
    }

}
