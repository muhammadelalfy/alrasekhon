<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\CommitteeChairmanRequest;
use App\Http\Resources\CommitteeChairmanResource;
use App\Models\CommitteeChairman;
use App\Repositories\Contracts\CommitteeChairmanContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class CommitteeChairmanController extends BaseApiController
{

    /**
     * CommitteeChairmanController constructor.
     * @param CommitteeChairmanContract $repository
     */
    public function __construct(CommitteeChairmanContract $repository)
    {
        parent::__construct($repository, CommitteeChairmanResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommitteeChairmanRequest $request
     *
     * @return Response
     */
    public function store(CommitteeChairmanRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param CommitteeChairman $committeeChairman
    *
    */
   public function show(CommitteeChairman $committeeChairman)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CommitteeChairman $committeeChairman
     *
     */
    public function edit(CommitteeChairman $committeeChairman)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommitteeChairmanRequest $request
     * @param CommitteeChairman $committeeChairman
     *
     */
    public function update(CommitteeChairmanRequest $request, CommitteeChairman $committeeChairman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommitteeChairman $committeeChairman
     *
     * @return JsonResponse
     */
    public function destroy(CommitteeChairman $committeeChairman)
    {
        //
    }

}
