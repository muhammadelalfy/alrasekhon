<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Repositories\Contracts\ItemContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class ItemController extends BaseApiController
{

    /**
     * ItemController constructor.
     * @param ItemContract $repository
     */
    public function __construct(ItemContract $repository)
    {
        parent::__construct($repository, ItemResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ItemRequest $request
     *
     * @return Response
     */
    public function store(ItemRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param Item $item
    *
    */
   public function show(Item $item)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     *
     */
    public function edit(Item $item)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ItemRequest $request
     * @param Item $item
     *
     */
    public function update(ItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     *
     * @return JsonResponse
     */
    public function destroy(Item $item)
    {
        //
    }

}
