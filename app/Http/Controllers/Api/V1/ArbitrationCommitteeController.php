<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\ArbitrationCommitteeRequest;
use App\Http\Resources\ArbitrationCommitteeResource;
use App\Models\ArbitrationCommittee;
use App\Repositories\Contracts\ArbitrationCommitteeContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class ArbitrationCommitteeController extends BaseApiController
{

    /**
     * ArbitrationCommitteeController constructor.
     * @param ArbitrationCommitteeContract $repository
     */
    public function __construct(ArbitrationCommitteeContract $repository)
    {
        parent::__construct($repository, ArbitrationCommitteeResource::class);
    }

    public function index(): mixed
    {
        if (request('competition_id')){
            $arbitrationCommittees = ArbitrationCommittee::cursor();
            return ArbitrationCommitteeResource::collection($arbitrationCommittees);
        }
        return parent::index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArbitrationCommitteeRequest $request
     *
     * @return Response
     */
    public function store(ArbitrationCommitteeRequest $request)
    {
        $data = $request->validated();
        $data['competition_id'] = $request->competition_id;
        $arbitrator = $this->repository->create($data);
        return $this->respondWithModel($arbitrator);
    }

   /**
    * Display the specified resource.
    *
    * @param ArbitrationCommittee $arbitrationCommittee
    *
    */
   public function show(ArbitrationCommittee $arbitrationCommittee)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ArbitrationCommittee $arbitrationCommittee
     *
     */
    public function edit(ArbitrationCommittee $arbitrationCommittee)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArbitrationCommitteeRequest $request
     * @param ArbitrationCommittee $arbitrationCommittee
     *
     */
    public function update(ArbitrationCommitteeRequest $request, ArbitrationCommittee $arbitrationCommittee)
    {
        $data = $request->validated();
        $data['competition_id'] = $request->competition_id;
        $arbitrationCommittee = $this->repository->update($arbitrationCommittee, $data);
        return $this->respondWithModel($arbitrationCommittee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ArbitrationCommittee $arbitrationCommittee
     *
     * @return JsonResponse
     */
    public function destroy(ArbitrationCommittee $arbitrationCommittee)
    {
        $this->repository->remove($arbitrationCommittee);
        return $this->respondWithSuccess(__('Arbitration committee deleted successfully'));
    }

}
