<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\StageRequest;
use App\Http\Resources\StageResource;
use App\Models\Stage;
use App\Repositories\Contracts\StageContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

class StageController extends BaseApiController
{

    /**
     * StageController constructor.
     * @param StageContract $repository
     */
    public function __construct(StageContract $repository)
    {
        parent::__construct($repository, StageResource::class);
    }



    public function index(): mixed
    {
        if (request('competition_id')){
            $stages = Stage::where(['competition_id' => \request('competition_id')])->cursor();
            return StageResource::collection($stages);
        }
        return parent::index();
    }

//    public function index(): mixed
//    {
////        dd(App::getLocale());
//        $page = 1;
//        $limit = 0;
//        $order = $this->order;
//        $filters = request()->all();
//        // dd($filters);
//        if (request()->has('page')) $page = request('page');
//        if (request()->has('limit')) $limit = request('limit');
//        if (request()->has('order')) $order = request('order');
//        $relations = request()->has('embed') ?? explode(',', request('embed')) ;
//        $models = $this->repository
//            ->search($filters, [] , $order, $page, $limit,'id','desc'/*,['has'=>['team','user']]*/);
////        dd($models)
//        return $this->respondWithCollection($models);
//
//    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StageRequest $request
     *
     * @return Response
     */
    public function store(StageRequest $request)
    {
//        dd($request->all());
        $Stage = $this->repository->create($request->all());
        return $this->respondWithModel($Stage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StageRequest $request
     * @param Stage $Stage
     *
     */
    public function update(StageRequest $request, Stage $Stage)
    {
        $stage = $this->repository->update($Stage, $request->validated());
        return $this->respondWithModel($stage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Stage $Stage
     *
     * @return JsonResponse
     */
    public function destroy(Stage $Stage)
    {
        $this->repository->remove($Stage);
        return $this->respondWithSuccess(__('stage Deleted Successfully'));
    }

    public function toggle(){
        $this->repository->toggleField(request()->id , 'status');
        return $this->respondWithSuccess(__('general.Status Changed Successfully'));
    }

}
