<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\SuraRequest;
use App\Http\Resources\SuraResource;
use App\Models\Sura;
use App\Repositories\Contracts\SuraContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class SuraController extends BaseApiController
{

    /**
     * SuraController constructor.
     * @param SuraContract $repository
     */
    public function __construct(SuraContract $repository)
    {
        parent::__construct($repository, SuraResource::class);
    }
    public function index(): mixed
    {
        $page = 1;
        $order = $this->order;
        $orderBy = $this->orderBy;
        $filters = request()->all();
        if (request()->has('page')) {
            $page = request('page');
        }
        if (request()->has('limit')) {
            $limit = request('limit');
        }
        if (request()->has('order')) {
            $order = request('order');
        }
        if (request()->has('orderBy')) {
            $orderBy= request('orderBy');
        }
        $models = $this->repository->search($filters, $this->relations, $order, $page, 114, $orderBy , 'asc');
        return $this->respondWithCollection($models);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SuraRequest $request
     *
     * @return Response
     */
    public function store(SuraRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param Sura $sura
    *
    */
   public function show(Sura $sura)
   {
      return $this->respondWithModel($sura);
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sura $sura
     *
     */
    public function edit(Sura $sura)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SuraRequest $request
     * @param Sura $sura
     *
     */
    public function update(SuraRequest $request, Sura $sura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sura $sura
     *
     * @return JsonResponse
     */
    public function destroy(Sura $sura)
    {
        //
    }

}
