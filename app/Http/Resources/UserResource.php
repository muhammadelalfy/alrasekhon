<?php

namespace App\Http\Resources;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
//        dd($this);

//        dd($this->id, $this->file);
        $now = Carbon::now();

        $lastUpdates = [
            'minutes' => $now->diffInMinutes($this->updated_at),
            'hours' => $now->diffInHours($this->updated_at),
            'days' => $now->diffInDays($this->updated_at),
            'weeks' => $now->diffInWeeks($this->updated_at),
            'months' => $now->diffInMonths($this->updated_at),
            'years' => $now->diffInYears($this->updated_at),
        ];

        $lastUpdate = ' Now';
        foreach ($lastUpdates as $key => $value) {

            if ($value && $key == 'minutes' && $lastUpdates['minutes'] > 1) {
                $lastUpdate = $value . ' ' . ucfirst($key) . ' Ago';

            }
            if ($value && $key == 'hours' && $lastUpdates['minutes'] > 60) {
                $lastUpdate = $value . ' ' . ucfirst($key);
                if (($lastUpdates['minutes'] % 24)) {
                    $lastUpdate .= ' And ' . ($lastUpdates['minutes'] % 60) . ' Minutes ago';
                }
            }
            if ($value && $key == 'days' && $lastUpdates['hours'] > 24) {
                $lastUpdate = $value . ' ' . ucfirst($key);
                if (($lastUpdates['hours'] % 24)) {
                    $lastUpdate .= ' And ' . ($lastUpdates['hours'] % 24) . ' Hours ago';
                }
            }
            if ($value && $key == 'weeks' && $lastUpdates['days'] > 7) {
                $lastUpdate = $value . ' ' . ucfirst($key);
                if (($lastUpdates['days'] % 7)) {
                    $lastUpdate .= ' And ' . ($lastUpdates['days'] % 7) . ' Days ago';
                }
            }
            if ($value && $key == 'months' && $lastUpdates['weeks'] > 4) {
                $lastUpdate = $value . ' ' . ucfirst($key);
                if (($lastUpdates['weeks'] % 4)) {
                    $lastUpdate .= ' And ' . ($lastUpdates['weeks'] % 4) . ' Weeks ago';
                }
            }
            if ($value && $key == 'years' && $lastUpdates['months'] > 12) {
                $lastUpdate = $value . ' ' . ucfirst($key);
                if (($lastUpdates['months'] % 12)) {
                    $lastUpdate .= ' And ' . ($lastUpdates['months'] % 12) . ' Months ago';
                }
            }
        }
        $this->micro = [
            'id' => $this->id,
            'first_name' => $this->first_name ?? '',
            'second_name' => $this->second_name,
            'last_name' => $this->last_name,
            'last_update' => $lastUpdate,
            'created_at' => $this->created_at,
        ];
        $this->mini = [
            'birth_date' => $this->birth_date,
            'identity_proof' => $this->identity_proof,
            'national_id' => $this->national_id,
            'passport' => $this->passport,
            'gender' => $this->gender,
            'gender_localized' => __('users.' . $this->gender),
            'nationality' => $this->nationality,
            'email' => $this->email,
            'email_status' => $this->email_status==true ?__('general.active'):__('general.notActive') ,
            'phone' => $this->phone,
            'phone_status' => $this->phone_status,
            'status' => $this->status,
            'status_localized' => $this->status ? __('contestants.active') : __('contestants.not_active'),
            'lang' => $this->lang,
            'lang_localized' => $this->lang === 'ar' ? __('users.lang.ar') : __('users.lang.en'),
            'qualifications' => $this->qualifications,
            'main_job' => $this->main_job,
            'country_id' => $this->city->governorate->country_id ?? null,
            'country' => $this->city->governorate->country->name ?? '-',
            'governorate_id' => $this->city->governorate_id ?? null,
            'governorate' => $this->city->governorate->name ?? '-',
            'city_id' => $this->city_id,
            'city' => $this->city->name ?? null,
            'address' => $this->address,
            'alternative_address' => $this->alternative_address,
            'step_no' => $this->step_no,
            'file_url' => $this->file ? Storage::url($this->file->url) : null,
            'file_name' => $this->file ? $this->file->name : null,
        ];
        $this->full = [];

        /*        $this->relations = [
                    'levels' => implode(',', $this->levels()->pluck('name')->toArray())
                ];*/
        $this->relations = [
            'roles' => implode(' ,', $this->getRoleNames()->toArray()),
            'roles_ids' => $this->getRoleIds(),
            'role_id' => $this->getRoleIds()[0] ?? null,
            'permissions' => $this->formatPermsForCASL()
        ];
        return $this->getResource();

    }

    protected function formatPermsForCASL(): array
    {
        if (in_array(Role::DEFAULT_ROLE_SUPER_ADMIN, $this->getRoleNames()->toArray())) {
            return [[
                'action' => 'manage',
                'subject' => 'all',
            ]];
        }
        $output = [];
        foreach ($this->getAllPermissions() as $permission) {
            $subject = $permission->model;
            if (!in_array($permission->name, Permission::ADDITIONAL_PERMISSIONS)) {
                $action = explode('_', $permission->name)[0];
            } else {
                $action = $permission->name;
            }
            $output[] = [
                'action' => $action,
                'subject' => $subject,
            ];
        }
        return $output;
    }

    public function getRoleIds()
    {
        return $this->whenLoaded('roles', function () {
            return $this->roles->sortByDesc('id')->pluck('id')->toArray();
        });
    }

}
