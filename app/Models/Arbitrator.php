<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * @property mixed $work_experiences
 */
class Arbitrator extends Model
{
    use HasFactory,ModelTrait, SearchTrait, SoftDeletes;

    protected $casts = [
        'status' => 'boolean',
        'work_experiences' => 'array',
        'practical_experiences' => 'array',
//        'methods' => 'array',
//        'readings' => 'array',
//        'novels' => 'array',
        'authorizations' => 'array',
    ];

    protected $fillable=[
        'first_name', 'second_name', 'last_name', 'birth_date', 'identity_proof', 'national_id', 'passport', 'gender', 'nationality', 'email',
        'country_code', 'phone', 'status', 'qualification', 'job', 'is_teacher', 'work_experiences',
        'practical_experiences', 'authorizations', 'country_id', 'governorate_id', 'city_id', 'main_address',
        'additional_address', 'user_id',  'step_no', 'password',
    ];

    protected array $filters = ['keyword', 'level', 'country', 'governorate', 'city', 'status'];
    protected array $searchable = ['first_name', 'second_name', 'last_name', 'email', 'phone', 'status', 'country_id', 'governorate_id', 'city_id'];


    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function workPlaceAttchementProof(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable')->where(['type' => 'work_place_proof_attachment']);
    }

    public function profilePhoto(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where(['type' => 'profile_photo']);
    }

    public function contractAttachment(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where(['type' => 'contract_attachment']);
    }

    public function vacationsAndBondsAttachment(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable')->where(['type' => 'vocation_bonds_attaches']);
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

    public function governorate() :BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    public function city() :BelongsTo
    {
        return $this->belongsTo(City::class);
    }


    public function scopeOfCountry(Builder  $query, $value): Builder
    {
        return $query->whereIn('country_id', $value);
    }

    public function scopeOfGovernorate(Builder  $query, $value): Builder
    {
        return $query->whereIn('governorate_id', $value);
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
            $query->whereIn('arbitrator_level_id', $value);
        });
    }

    public function competitions() :BelongsToMany
    {
        return $this->belongsToMany(Competition::class, 'arbitrator_competition');
    }

    public function levels() :BelongsToMany
    {
        return $this->belongsToMany(ArbitratorLevel::class, 'arbitrator_level');
    }

    public function readings()
    {
        return $this->belongsToMany(Reading::class, 'arbitrator_reading')->withPivot('method_id');
    }

    public function methods()
    {
        $result = $this->readings()
            ->join('methods', 'methods.id', 'arbitrator_reading.method_id')->select([
                'methods.name'
            ]);
        return $result;
    }


}
