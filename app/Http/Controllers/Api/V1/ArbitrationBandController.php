<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\ArbitrationBandRequest;
use App\Http\Resources\ArbitrationBandResource;
use App\Models\ArbitrationBand;
use App\Repositories\Contracts\ArbitrationBandContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

class ArbitrationBandController extends BaseApiController
{

    /**
     * ArbitrationBandController constructor.
     * @param ArbitrationBandContract $repository
     */
    public function __construct(ArbitrationBandContract $repository)
    {
        parent::__construct($repository, ArbitrationBandResource::class);
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
        $relations = request()->has('embed') ? explode(',', request('embed')) : ['arbitration_type'];
        $models = $this->repository
            ->search($filters, $relations , $order, $page, $limit,'id','desc',['has'=>['team','user']]);
//        dd($models)
        return $this->respondWithCollection($models);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param ArbitrationBandRequest $request
     *
     * @return Response
     */
    public function store(ArbitrationBandRequest $request)
    {
        $arbitration_type = $this->repository->create($request->all());
        return $this->respondWithModel($arbitration_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArbitrationBandRequest $request
     * @param ArbitrationBand $arbitrationBand
     *
     */
    public function update(ArbitrationBandRequest $request, ArbitrationBand $arbitrationBand)
    {
        $arbitrationType = $this->repository->update($arbitrationBand, $request->validated());
        return $this->respondWithModel($arbitrationType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ArbitrationBand $arbitrationBand
     *
     * @return JsonResponse
     */
    public function destroy(ArbitrationBand $arbitrationBand)
    {
        $this->repository->remove($arbitrationBand);
        return $this->respondWithSuccess(__('arbitration type Deleted Successfully'));
    }

    public function toggle(){
        $this->repository->toggleField(request()->id , 'status');
        return $this->respondWithSuccess(__('general.Status Changed Successfully'));
    }

}
