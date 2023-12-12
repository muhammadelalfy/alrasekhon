<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\TenantRequest;
use App\Http\Resources\TenantResource;
use App\Models\Tenant;
use App\Repositories\Contracts\TenantContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class TenantController extends BaseApiController
{

    /**
     * TenantController constructor.
     * @param TenantContract $repository
     */
    public function __construct(TenantContract $repository)
    {
        parent::__construct($repository, TenantResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TenantRequest $request
     *
     * @return Response
     */
    public function store(TenantRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param Tenant $tenant
    *
    */
   public function show(Tenant $tenant)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tenant $tenant
     *
     */
    public function edit(Tenant $tenant)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TenantRequest $request
     * @param Tenant $tenant
     *
     */
    public function update(TenantRequest $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tenant $tenant
     *
     * @return JsonResponse
     */
    public function destroy(Tenant $tenant)
    {
        //
    }

}
