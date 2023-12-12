<?php

namespace App\Repositories\SQL;

use App\Mail\ForgetPasswordMail;
use App\Models\User;
use App\Repositories\Contracts\ResetPasswordContract;
use App\Traits\BaseApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class ResetPasswordRepository extends BaseRepository implements ResetPasswordContract
{
    use BaseApiResponseTrait;

    /**
     * RoleRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param User $model
     * @return int
     */
    public function relatedData(User $model)
    {
        return 0;
    }

    /**
     * Check if model has relations with any other tables
     * @param Request $model
     * @return string
     */
    public function sendLink(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', Rule::exists('users')]
        ]);
        $user = User::whereEmail($data['email'])->first();
//        $link = URL::temporarySignedRoute('reset',now()->addSeconds(20),['email' => $user->email]);
        $link = URL::temporarySignedRoute('vueApp', now()->addMinutes(30), [
            'email' => $user->email,
            'any' => 'reset'
        ]);
        if ($user) {
            Mail::to($user->email)->send(new ForgetPasswordMail($user, $link));
        }
        return $this->errorWrongArgs('Wrong Credentials');
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'pass' => ['required', 'min:1', 'max:200', 'confirmed:pass_confirmation', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
            ],
        ]);
        $user = User::whereEmail($request->email)->first();
        if (!$user) {

            return $this->respondWithError(trans('auth.error_message'));
        }

        $user->update(['password' => bcrypt($data['pass'])]);

        return $this->respondWithSuccess(trans('auth.password_changed'));
    }

}
