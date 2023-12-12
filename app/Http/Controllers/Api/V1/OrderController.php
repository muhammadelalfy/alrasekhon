<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Contracts\OrderContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class OrderController extends BaseApiController
{

    /**
     * OrderController constructor.
     * @param OrderContract $repository
     */
    public function __construct(OrderContract $repository)
    {
        parent::__construct($repository, OrderResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     *
     * @return Response
     */
    public function store(OrderRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param Order $order
    *
    */
   public function show(Order $order)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     *
     */
    public function edit(Order $order)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param Order $order
     *
     */
    public function update(OrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     *
     * @return JsonResponse
     */
    public function destroy(Order $order)
    {
        //
    }

}
