<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\AreaTenantRequest;
use App\Http\Resources\AreaTenantResource;
use App\Models\AreaTenant;
use App\Repositories\Contracts\AreaTenantContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class AreaTenantController extends BaseApiController
{

    /**
     * AreaTenantController constructor.
     * @param AreaTenantContract $repository
     */
    public function __construct(AreaTenantContract $repository)
    {
        parent::__construct($repository, AreaTenantResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AreaTenantRequest $request
     *
     * @return Response
     */
    public function store(AreaTenantRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param AreaTenant $areaTenant
    *
    */
   public function show(AreaTenant $areaTenant)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AreaTenant $areaTenant
     *
     */
    public function edit(AreaTenant $areaTenant)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AreaTenantRequest $request
     * @param AreaTenant $areaTenant
     *
     */
    public function update(AreaTenantRequest $request, AreaTenant $areaTenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AreaTenant $areaTenant
     *
     * @return JsonResponse
     */
    public function destroy(AreaTenant $areaTenant)
    {
        //
    }

}
