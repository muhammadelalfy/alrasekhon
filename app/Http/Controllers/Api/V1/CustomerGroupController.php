<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\CustomerGroupRequest;
use App\Http\Resources\CustomerGroupResource;
use App\Models\CustomerGroup;
use App\Repositories\Contracts\CustomerGroupContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class CustomerGroupController extends BaseApiController
{

    /**
     * CustomerGroupController constructor.
     * @param CustomerGroupContract $repository
     */
    public function __construct(CustomerGroupContract $repository)
    {
        parent::__construct($repository, CustomerGroupResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerGroupRequest $request
     *
     * @return JsonResponse
     */
    public function store(CustomerGroupRequest $request): JsonResponse
    {
        $customerGroup = $this->repository->create($request->validated());
        return $this->respondWithModel($customerGroup);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CustomerGroupRequest $request
     * @param CustomerGroup $customerGroup
     * @return JsonResponse
     */
    public function update(CustomerGroupRequest $request, CustomerGroup $customerGroup): JsonResponse
    {
        $customerGroup = $this->repository->update($customerGroup, $request->validated());
        return $this->respondWithModel($customerGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CustomerGroup $customerGroup
     *
     * @return JsonResponse
     */
    public function destroy(CustomerGroup $customerGroup): JsonResponse
    {
        $this->repository->remove($customerGroup);
        return $this->respondWithSuccess(__('Driver Deleted Successfully'));
    }

}
