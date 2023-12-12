<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\MethodRequest;
use App\Http\Resources\MethodResource;
use App\Models\Method;
use App\Repositories\Contracts\MethodContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class MethodController extends BaseApiController
{

    /**
     * MethodController constructor.
     * @param MethodContract $repository
     */
    public function __construct(MethodContract $repository)
    {
        parent::__construct($repository, MethodResource::class);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param MethodRequest $request
     *
     * @return Response
     */
    public function store(MethodRequest $request)
    {
        $method = $this->repository->create($request->validated());
        return $this->respondWithModel($method);
    }

   /**
    * Display the specified resource.
    *
    * @param Method $method
    *
    */
   public function show(Method $method)
   {

   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Method $method
     *
     */
    public function edit(Method $method)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MethodRequest $request
     * @param Method $method
     *
     */
    public function update(MethodRequest $request, Method $method)
    {
        $method = $this->repository->update($method, $request->validated());
        return $this->respondWithModel($method);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Method $method
     *
     * @return JsonResponse
     */
    public function destroy(Method $method)
    {
        $this->repository->remove($method);
        return $this->respondWithSuccess(__('general.Country Deleted Successfully'));
    }

    public function toggle(){
        $this->repository->toggleField(request()->id , 'status');
        return $this->respondWithSuccess(__('general.Status Changed Successfully'));
    }

}
