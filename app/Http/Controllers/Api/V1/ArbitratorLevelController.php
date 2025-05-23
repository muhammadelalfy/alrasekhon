<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\ArbitratorLevelRequest;
use App\Http\Resources\ArbitratorLevelResource;
use App\Models\ArbitratorLevel;
use App\Repositories\Contracts\ArbitratorLevelContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class ArbitratorLevelController extends BaseApiController
{

    /**
     * ArbitratorLevelController constructor.
     * @param ArbitratorLevelContract $repository
     */
    public function __construct(ArbitratorLevelContract $repository)
    {
        parent::__construct($repository, ArbitratorLevelResource::class);
    }

    public function index(): mixed
    {
        if (request('list_all_without_pagination')){
            return  ArbitratorLevelResource::collection(ArbitratorLevel::cursor());
        }
        return parent::index(); // TODO: Change the autogenerated stub
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArbitratorLevelRequest $request
     *
     * @return Response
     */
    public function store(ArbitratorLevelRequest $request)
    {
        $arbitratorLevel = $this->repository->create($request->validated());
        return $this->respondWithModel($arbitratorLevel);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ArbitratorLevelRequest $request
     * @param ArbitratorLevel $arbitratorLevel
     *
     */
    public function update(ArbitratorLevelRequest $request, ArbitratorLevel $arbitratorLevel)
    {
        $arbitratorLevel = $this->repository->update($arbitratorLevel, $request->validated());
        return $this->respondWithModel($arbitratorLevel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ArbitratorLevel $arbitratorLevel
     *
     * @return JsonResponse
     */
    public function destroy(ArbitratorLevel $arbitratorLevel)
    {
        $this->repository->remove($arbitratorLevel);
        return $this->respondWithSuccess(__('Arbitration level Deleted Successfully'));
    }

    /**
     * Toggle level status
     * @param Request $request
     * @return JsonResponse
     */
    public function toggle(){
        $this->repository->toggleField(request()->id , 'status');
        return $this->respondWithSuccess(__('general.Status Changed Successfully'));
    }

}
