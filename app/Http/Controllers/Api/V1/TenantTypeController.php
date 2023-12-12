<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\TenantTypeRequest;
use App\Http\Resources\TenantTypeResource;
use App\Models\TenantType;
use App\Repositories\Contracts\TenantTypeContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class TenantTypeController extends BaseApiController
{

    /**
     * TenantTypeController constructor.
     * @param TenantTypeContract $repository
     */
    public function __construct(TenantTypeContract $repository)
    {
        parent::__construct($repository, TenantTypeResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TenantTypeRequest $request
     *
     * @return Response
     */
    public function store(TenantTypeRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param TenantType $tenantType
    *
    */
   public function show(TenantType $tenantType)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TenantType $tenantType
     *
     */
    public function edit(TenantType $tenantType)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TenantTypeRequest $request
     * @param TenantType $tenantType
     *
     */
    public function update(TenantTypeRequest $request, TenantType $tenantType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TenantType $tenantType
     *
     * @return JsonResponse
     */
    public function destroy(TenantType $tenantType)
    {
        //
    }

}
