<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\JuzRequest;
use App\Http\Resources\JuzResource;
use App\Models\Juz;
use App\Repositories\Contracts\JuzContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class JuzController extends BaseApiController
{

    /**
     * JuzController constructor.
     * @param JuzContract $repository
     */
    public function __construct(JuzContract $repository)
    {
        parent::__construct($repository, JuzResource::class);
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
        $models = $this->repository->search($filters, $this->relations, $order, $page, 30, $orderBy , 'asc');
//       dd($models);
        return $this->respondWithCollection($models);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JuzRequest $request
     *
     * @return Response
     */
    public function store(JuzRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param Juz $juz
    *
    */
   public function show(Juz $juz)
   {

   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Juz $juz
     *
     */
    public function edit(Juz $juz)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JuzRequest $request
     * @param Juz $juz
     *
     */
    public function update(JuzRequest $request, Juz $juz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Juz $juz
     *
     * @return JsonResponse
     */
    public function destroy(Juz $juz)
    {
        //
    }

}
