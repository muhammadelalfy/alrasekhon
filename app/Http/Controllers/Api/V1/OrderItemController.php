<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\OrderItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class OrderItemController extends BaseApiController
{

    /**
     * OrderItemController constructor.
     * @param OrderItemContract $repository
     */
    public function __construct(OrderItemContract $repository)
    {
        parent::__construct($repository, OrderItemResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderItemRequest $request
     *
     * @return Response
     */
    public function store(OrderItemRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param OrderItem $orderItem
    *
    */
   public function show(OrderItem $orderItem)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param OrderItem $orderItem
     *
     */
    public function edit(OrderItem $orderItem)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderItemRequest $request
     * @param OrderItem $orderItem
     *
     */
    public function update(OrderItemRequest $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OrderItem $orderItem
     *
     * @return JsonResponse
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }

}
