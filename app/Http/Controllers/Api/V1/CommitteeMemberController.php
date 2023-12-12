<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\CommitteeMemberRequest;
use App\Http\Resources\CommitteeMemberResource;
use App\Models\CommitteeMember;
use App\Repositories\Contracts\CommitteeMemberContract;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class CommitteeMemberController extends BaseApiController
{

    /**
     * CommitteeMemberController constructor.
     * @param CommitteeMemberContract $repository
     */
    public function __construct(CommitteeMemberContract $repository)
    {
        parent::__construct($repository, CommitteeMemberResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommitteeMemberRequest $request
     *
     * @return Response
     */
    public function store(CommitteeMemberRequest $request)
    {
       //
    }

   /**
    * Display the specified resource.
    *
    * @param CommitteeMember $committeeMember
    *
    */
   public function show(CommitteeMember $committeeMember)
   {
      //
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CommitteeMember $committeeMember
     *
     */
    public function edit(CommitteeMember $committeeMember)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommitteeMemberRequest $request
     * @param CommitteeMember $committeeMember
     *
     */
    public function update(CommitteeMemberRequest $request, CommitteeMember $committeeMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommitteeMember $committeeMember
     *
     * @return JsonResponse
     */
    public function destroy(CommitteeMember $committeeMember)
    {
        //
    }

}
