<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\NotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Repositories\Contracts\NotificationContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class NotificationController extends BaseApiController
{

    /**
     * NotificationController constructor.
     * @param NotificationContract $repository
     */
    public function __construct(NotificationContract $repository)
    {
        parent::__construct($repository, NotificationResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NotificationRequest $request
     *
     * @return Response
     */
    public function store(NotificationRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param Notification $notification
    *
    */
   public function show(Notification $notification)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Notification $notification
     *
     */
    public function edit(Notification $notification)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NotificationRequest $request
     * @param Notification $notification
     *
     */
    public function update(NotificationRequest $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Notification $notification
     *
     * @return JsonResponse
     */
    public function destroy(Notification $notification)
    {
        //
    }

}
