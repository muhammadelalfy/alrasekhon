<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\GovernorateRequest;
use App\Http\Resources\GovernorateResource;
use App\Models\Governorate;
use App\Repositories\Contracts\GovernorateContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class GovernorateController extends BaseApiController
{
    public function __construct(GovernorateContract $repository)
    {
        parent::__construct($repository, GovernorateResource::class);
    }

    public function index(): mixed
    {

        if (request('list_all_without_pagination') && request('country')){
            return  GovernorateResource::collection(Governorate::ofCountry(request('country'))->cursor());
        }
        if (request('list_all_without_pagination')){
            return  GovernorateResource::collection(Governorate::cursor());
        }
        return parent::index();
    }


    public function store(GovernorateRequest $request): JsonResponse
    {
        $governorates = $this->repository->createRowOrMultiRow($request->validated() , 'country');
        $collection =  GovernorateResource::collection($governorates);
        return $this->respondWithCollection($collection);
    }

    public function update(GovernorateRequest $request, Governorate $governorate): JsonResponse
    {
        $governorate = $this->repository->update($governorate, $request->validated());
        return $this->respondWithModel($governorate);
    }

    public function destroy(Governorate $governorate): JsonResponse
    {
        $this->repository->remove($governorate);
        return $this->respondWithSuccess(__('Governorate Deleted Successfully'));
    }

    public function toggle(){
        $this->repository->toggleField(request()->id , 'status');
        return $this->respondWithSuccess(__('general.Status Changed Successfully'));
    }

}
