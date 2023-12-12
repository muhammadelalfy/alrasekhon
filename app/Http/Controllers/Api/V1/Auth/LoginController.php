<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Traits\BaseApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use BaseApiResponseTrait;

    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email' , 'min:1' , 'max:200'],
            'password' => ['required' , 'min:6' , 'max:20'],
        ]);
        if (Auth::attempt($credentials)) {
            return $this->respondWithSuccess(null, [
                'user' => new UserResource($request->user()),
            ]);
        }
        return $this->errorWrongArgs('Wrong Credentials');
    }
}
