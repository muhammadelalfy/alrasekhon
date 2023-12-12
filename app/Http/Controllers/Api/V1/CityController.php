<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Repositories\Contracts\CityContract;
use \Illuminate\Http\JsonResponse;

class CityController extends BaseApiController
{
    public function __construct(CityContract $repository)
    {
        parent::__construct($repository, CityResource::class);
    }

    public function index(): mixed
    {

        if (request('list_all_without_pagination') && request('governorate')){
            return  CityResource::collection(City::ofGovernorate(request('governorate'))->cursor());
        }
//        dd(request('embed'));
        $page = 1;
        $limit = 10;
        $filters = request()->all();
        // dd($filters);
        if (request()->has('page')) $page = request('page');
        if (request()->has('limit')) $limit = request('limit');
        if (request()->has('order')) $order = request('order');
        $relations = request()->has('embed') ? explode(',', request('embed')) : [''];
//        dd($relations);
        $models = $this->repository
            ->search($filters, [], true, $page, $limit, 'id', 'desc');
//        dd($models);

        return $this->respondWithCollection($models);
    }

    public function store(CityRequest $request): JsonResponse
    {
        $Cities = $this->repository->createRowOrMultiRow($request->validated(), 'governorate');
        $collection = CityResource::collection($Cities);
        return $this->respondWithCollection($collection);

    }

    public function update(CityRequest $request, City $city): JsonResponse
    {
        $citty = $this->repository->update($city, $request->validated());
        return $this->respondWithModel($citty);
    }

    public function destroy(City $citty): JsonResponse
    {
        $this->repository->remove($citty);
        return $this->respondWithSuccess(__('general.City Deleted Successfully'));
    }

    public function toggle()
    {
        $this->repository->toggleField(request()->id, 'status');
        return $this->respondWithSuccess(__('general.Status Changed Successfully'));
    }
    public function show(City $city){
        $governorate = $city->gevrnorate;
        dd($governorate);
        return $this->respondWithModel();
    }

}
