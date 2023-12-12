<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\AreaRequest;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use App\Repositories\Contracts\AreaContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class AreaController extends BaseApiController
{

    /**
     * AreaController constructor.
     * @param AreaContract $repository
     */
    public function __construct(AreaContract $repository)
    {
        parent::__construct($repository, AreaResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AreaRequest $request
     *
     * @return Response
     */
    public function store(AreaRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param Area $area
    *
    */
   public function show(Area $area)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Area $area
     *
     */
    public function edit(Area $area)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AreaRequest $request
     * @param Area $area
     *
     */
    public function update(AreaRequest $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Area $area
     *
     * @return JsonResponse
     */
    public function destroy(Area $area)
    {
        //
    }

}
