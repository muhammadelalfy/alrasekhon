<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\ContestantLevelRequest;
use App\Http\Resources\ContestantLevelResource;
use App\Models\ContestantLevel;
use App\Repositories\Contracts\ContestantLevelContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class ContestantLevelController extends BaseApiController
{

    /**
     * ContestantLevelController constructor.
     * @param ContestantLevelContract $repository
     */
    public function __construct(ContestantLevelContract $repository)
    {
        parent::__construct($repository, ContestantLevelResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContestantLevelRequest $request
     *
     * @return Response
     */
    public function store(ContestantLevelRequest $request)
    {
        $contestantLevel = $this->repository->create($request->all());
        return $this->respondWithModel($contestantLevel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContestantLevelRequest $request
     * @param ContestantLevel $contestantLevel
     *
     */
    public function update(ContestantLevelRequest $request, ContestantLevel $contestantLevel)
    {
        $contestantLevel = $this->repository->update($contestantLevel, $request->validated());
        return $this->respondWithModel($contestantLevel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContestantLevel $contestantLevel
     *
     * @return JsonResponse
     */
    public function destroy(ContestantLevel $contestantLevel)
    {
        $this->repository->remove($contestantLevel);
        return $this->respondWithSuccess(__('Contestant level deleted successfully'));
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
