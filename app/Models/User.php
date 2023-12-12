<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, ModelTrait, SearchTrait, HasRoles;

    protected $casts = ['status' => 'boolean' , 'email_status' => 'boolean'];
    protected array $filters = ['keyword', 'role', 'status'];

    protected array $searchable = ['first_name', 'second_name', 'last_name', 'email', 'phone', 'status', 'city_id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'second_name', 'last_name',
        'email', 'password', 'email_status',
        'phone', 'phone_status', 'address',
        'alternative_address', 'main_job', 'birth_date',
        'status', 'attendance_status', 'lang',
        'gender', 'type', 'identity',
        'city_id', 'second_name',
        'qualifications', 'national_id', 'identity_proof', 'passport'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = date('Y-m-d', strtotime($value));
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function level()
    {

        return $this->belongsTo(Level::class);
    }

    public function prize()
    {
        return $this->hasOne(Prize::class);
    }

    public function scopeOfRole($query, $value)
    {
        return $query->whereHas('roles', function ($query) use ($value) {
            $query->whereIn('id', (array)$value);
        });
    }

    public function scopeOfStatus($query, $value)
    {

        return $query->when($value === 'all', function ($query) {
            $query->whereIn('status', [0, 1]);
        })->when($value === 0 , function ($query) {
                $query->where('status', 0);
            })->when($value === 1 , function ($query) {
            $query->where('status', 1);
        });
    }


    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
