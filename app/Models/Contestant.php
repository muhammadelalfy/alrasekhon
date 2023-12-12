<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Contestant extends Model
{
    use HasFactory,ModelTrait, SearchTrait;

    protected $casts = ['status' => 'boolean'];

    protected $fillable=[
        'first_name', 'second_name', 'last_name', 'birth_date',
        'identity_proof', 'national_id', 'passport', 'gender', 'nationality',
        'email', 'country_code', 'phone', 'status', 'qualification',
        'job', 'country_id', 'governorate_id', 'city_id', 'main_address',
        'additional_address', 'step_no', 'password',
    ];

    protected array $filters = ['keyword', 'level', 'country', 'city', 'status'];
    protected array $searchable = ['first_name', 'second_name', 'last_name', 'email', 'phone', 'status', 'country_id', 'city_id'];


    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(ContestantLevel::class, 'contestant_level');
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = date('Y-m-d', strtotime($value));
    }

    public function country() :BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function governorate():BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    public function city():BelongsTo
    {
        return $this->belongsTo(City::class);
    }


    public function scopeOfCountry(Builder  $query, $value): Builder
    {
        return $query->whereIn('country_id', $value);
    }

    public function scopeOfCity(Builder  $query, $value): Builder
    {
        return $query->whereIn('city_id', $value);
    }

    public function scopeOfStatus(Builder  $query, $value): Builder
    {
        return $query->where(['status' => $value]);
    }

    public function scopeOfLevel(Builder  $query, $value): Builder
    {
        return $query->whereHas('levels', function ($query) use ($value){
            $query->whereIn('contestant_level_id', $value);
        });
    }
}
