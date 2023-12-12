<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\ArbitrationTypeRequest;
use App\Http\Resources\ArbitrationTypeResource;
use App\Models\ArbitrationType;
use App\Repositories\Contracts\ArbitrationTypeContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class ArbitrationTypeController extends BaseApiController
{

    /**
     * ArbitrationTypeController constructor.
     * @param ArbitrationTypeContract $repository
     */
    public function __construct(ArbitrationTypeContract $repository)
    {
        parent::__construct($repository, ArbitrationTypeResource::class);
    }

    public function index(): mixed
    {
//        dd(App::getLocale());
        $page = 1;
        $limit = 0;
        $order = $this->order;
        $filters = request()->all();
        // dd($filters);
        if (request()->has('page')) $page = request('page');
        if (request()->has('limit')) $limit = request('limit');
        if (request()->has('order')) $order = request('order');
        $relations = request()->has('embed') ? explode(',', request('embed')) : [''];
        $models = $this->repository
            ->search($filters, [] , $order, $page, $limit,'id','desc',['has'=>['team','user']]);
//        dd($models)
        return $this->respondWithCollection($models);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArbitrationTypeRequest $request
     *
     * @return Response
     */
    public function store(ArbitrationTypeRequest $request)
    {
        $arbitration_type = $this->repository->create($request->all());
        return $this->respondWithModel($arbitration_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArbitrationTypeRequest $request
     * @param ArbitrationType $arbitrationType
     *
     */
    public function update(ArbitrationTypeRequest $request, ArbitrationType $arbitrationType)
    {
        $arbitrationType = $this->repository->update($arbitrationType, $request->validated());
        return $this->respondWithModel($arbitrationType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ArbitrationType $arbitrationType
     *
     * @return JsonResponse
     */
    public function destroy(ArbitrationType $arbitrationType)
    {
        $this->repository->remove($arbitrationType);
        return $this->respondWithSuccess(__('arbitration type Deleted Successfully'));
    }

    public function toggle(){
        $this->repository->toggleField(request()->id , 'status');
        return $this->respondWithSuccess(__('general.Status Changed Successfully'));
    }

}
