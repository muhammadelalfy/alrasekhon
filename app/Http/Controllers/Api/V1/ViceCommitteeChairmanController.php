<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\ViceCommitteeChairmanRequest;
use App\Http\Resources\ViceCommitteeChairmanResource;
use App\Models\ViceCommitteeChairman;
use App\Repositories\Contracts\ViceCommitteeChairmanContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class ViceCommitteeChairmanController extends BaseApiController
{

    /**
     * ViceCommitteeChairmanController constructor.
     * @param ViceCommitteeChairmanContract $repository
     */
    public function __construct(ViceCommitteeChairmanContract $repository)
    {
        parent::__construct($repository, ViceCommitteeChairmanResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ViceCommitteeChairmanRequest $request
     *
     * @return Response
     */
    public function store(ViceCommitteeChairmanRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param ViceCommitteeChairman $viceCommitteeChairman
    *
    */
   public function show(ViceCommitteeChairman $viceCommitteeChairman)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ViceCommitteeChairman $viceCommitteeChairman
     *
     */
    public function edit(ViceCommitteeChairman $viceCommitteeChairman)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ViceCommitteeChairmanRequest $request
     * @param ViceCommitteeChairman $viceCommitteeChairman
     *
     */
    public function update(ViceCommitteeChairmanRequest $request, ViceCommitteeChairman $viceCommitteeChairman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ViceCommitteeChairman $viceCommitteeChairman
     *
     * @return JsonResponse
     */
    public function destroy(ViceCommitteeChairman $viceCommitteeChairman)
    {
        //
    }

}
