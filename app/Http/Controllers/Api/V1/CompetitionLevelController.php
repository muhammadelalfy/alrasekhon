<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\CompetitionLevelRequest;
use App\Http\Resources\CompetitionLevelResource;
use App\Models\CompetitionLevel;
use App\Repositories\Contracts\CompetitionLevelContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class CompetitionLevelController extends BaseApiController
{

    /**
     * CompetitionLevelController constructor.
     * @param CompetitionLevelContract $repository
     */
    public function __construct(CompetitionLevelContract $repository)
    {
        parent::__construct($repository, CompetitionLevelResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompetitionLevelRequest $request
     *
     * @return Response
     */
    public function store(CompetitionLevelRequest $request)
    {
       $this->repository->storeLevel($request->validated());
    }

   /**
    * Display the specified resource.
    *
    * @param CompetitionLevel $competitionLevel
    *
    */
   public function show(CompetitionLevel $competitionLevel)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CompetitionLevel $competitionLevel
     *
     */
    public function edit(CompetitionLevel $competitionLevel)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompetitionLevelRequest $request
     * @param CompetitionLevel $competitionLevel
     *
     */
    public function update(CompetitionLevelRequest $request, CompetitionLevel $competitionLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CompetitionLevel $competitionLevel
     *
     * @return JsonResponse
     */
    public function destroy(CompetitionLevel $competitionLevel): JsonResponse
    {
        $this->repository->remove($competitionLevel);
        return $this->respondWithSuccess(__('general.CompetitionLevel_deleted'));
    }

}
