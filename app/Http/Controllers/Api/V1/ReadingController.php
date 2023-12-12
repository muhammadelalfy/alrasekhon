<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\ReadingRequest;
use App\Http\Resources\ReadingResource;
use App\Models\Reading;
use App\Repositories\Contracts\ReadingContract;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class ReadingController extends BaseApiController
{

    /**
     * ReadingController constructor.
     * @param ReadingContract $repository
     */
    public function __construct(ReadingContract $repository)
    {
        parent::__construct($repository, ReadingResource::class);
    }

   public function index(): mixed
   {
       $methodId = request('methodId');
       if ($methodId){
           $readings = Reading::ofMethodId($methodId)->get();
           return ReadingResource::collection($readings);
       }
       return parent::index();
   }


    /**
     * Store a newly created resource in storage.
     *
     * @param ReadingRequest $request
     *
     * @return Response
     */
    public function store(ReadingRequest $request)
    {
        $reading = $this->repository->create($request->validated());
        return $this->respondWithModel($reading);
    }

   /**
    * Display the specified resource.
    *
    * @param Reading $reading
    *
    */
   public function show(Reading $reading)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Reading $reading
     *
     */
    public function edit(Reading $reading)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReadingRequest $request
     * @param Reading $reading
     *
     */
    public function update(ReadingRequest $request, Reading $reading)
    {
        $reading = $this->repository->update($reading, $request->validated());
        return $this->respondWithModel($reading);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reading $reading
     *
     * @return JsonResponse
     */
    public function destroy(Reading $reading)
    {
        $this->repository->remove($reading);
        return $this->respondWithSuccess(__('general.Country Deleted Successfully'));
    }

    public function toggle(){
        $this->repository->toggleField(request()->id , 'status');
        return $this->respondWithSuccess(__('general.Status Changed Successfully'));
    }

}
