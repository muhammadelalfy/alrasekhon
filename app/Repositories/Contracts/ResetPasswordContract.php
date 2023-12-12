<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface ResetPasswordContract extends BaseContract
{
    public function relatedData(User $model);
    public function sendLink(Request $request);
    public function changePassword(Request $request);

}

