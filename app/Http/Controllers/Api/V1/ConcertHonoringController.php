<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\ConcertHonoringRequest;
use App\Http\Resources\ConcertHonoringResource;
use App\Models\ConcertHonoring;
use App\Repositories\Contracts\ConcertHonoringContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class ConcertHonoringController extends BaseApiController
{

    /**
     * ConcertHonoringController constructor.
     * @param ConcertHonoringContract $repository
     */
    public function __construct(ConcertHonoringContract $repository)
    {
        parent::__construct($repository, ConcertHonoringResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ConcertHonoringRequest $request
     *
     * @return Response
     */
    public function store(ConcertHonoringRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param ConcertHonoring $concertHonoring
    *
    */
   public function show(ConcertHonoring $concertHonoring)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ConcertHonoring $concertHonoring
     *
     */
    public function edit(ConcertHonoring $concertHonoring)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConcertHonoringRequest $request
     * @param ConcertHonoring $concertHonoring
     *
     */
    public function update(ConcertHonoringRequest $request, ConcertHonoring $concertHonoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ConcertHonoring $concertHonoring
     *
     * @return JsonResponse
     */
    public function destroy(ConcertHonoring $concertHonoring)
    {
        //
    }

}
