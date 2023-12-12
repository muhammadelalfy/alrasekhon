<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Repositories\Contracts\CountryContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;
use PhpParser\Node\Stmt\Return_;

class CountryController extends BaseApiController
{


    public function __construct(CountryContract $repository)
    {
        parent::__construct($repository, CountryResource::class);
    }

    public function index(): mixed
    {

        if (request('list_all_without_pagination')){
            return  CountryResource::collection(Country::cursor());
        }
//        dd(1111);
        $page = 1;
        $limit = 20;
        $filters = request()->all();
        if (request()->has('page')) $page = request('page');
        if (request()->has('limit')) $limit = request('limit');
        if (request()->has('order')) $order = request('order');
        $relations = request()->has('embed') ? explode(',', request('embed')) : [''];
        $models = $this->repository
            ->search($filters, [], true, $page, $limit, 'id', 'desc');
        return $this->respondWithCollection($models);
    }

    public function store(CountryRequest $request): JsonResponse
    {
        $Country = $this->repository->create($request->validated());
        return $this->respondWithModel($Country);
    }

    public function update(CountryRequest $request, Country $Country): JsonResponse
    {
        $Country = $this->repository->update($Country, $request->validated());
        return $this->respondWithModel($Country);
    }

    public function destroy(Country $Country): JsonResponse
    {
        $this->repository->remove($Country);
        return $this->respondWithSuccess(__('general.data_deleted_successfully'));
    }


    public function toggle()
    {
        $this->repository->toggleField(request()->id, 'status');
        return $this->respondWithSuccess(__('general.Status Changed Successfully'));
    }

}
