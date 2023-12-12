<?php

namespace App\Models;

use App\Http\Resources\CompetitionResource;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;
use function Amp\Promise\rethrow;

class Competition extends Model
{
    use HasFactory,ModelTrait, SearchTrait,HasTranslations;

    protected $fillable = [
        'name',
        'advertisement_id',
        'competition_type_id',
        'competition_date',
        'registration_date',
        'age_group',
        'age_from',
        'age_to',
        'competitors_max_num',
        'competition_budget',
        'country_id',
        'governorate_id',
        'city_id',
        'competition_address',
        'location',
        'steps_numbers',
        'is_announced',
    ];

    protected $casts = [
        'competition_date' => 'array',
        'registration_date' => 'array',
        'age_group' => 'array',
        'age_from' => 'array',
        'age_to' => 'array',
        'steps_numbers' => 'array',
        'status' => 'boolean',
        'is_announced' => 'boolean',
    ];

    protected array $filters = ['keyword',
        'competition_ids',
        'concert_honoring',
        'competition_level_ids',
        'competition_type_ids',
        'country_id',
        'governorate_ids',
        'city_ids',
        'competition_place',
        'status',
        'competition_start_date',
        'competition_end_date',
    ];
    protected array $searchable = ['name', 'competition_address', 'location', 'status'];
    public $translatable = ['name'];

    public function scopeOfCompetition_ids(Builder  $query, $value)
    {
        return $query->whereIn('id',  $value);
    }

    public function scopeOfconcert_honoring(Builder  $query, $value)
    {
        $competitionsIds = ConcertHonoring::where('competition_place', 'LIKE', "%$value%")->pluck('competition_id')->toArray();
        return $query->whereIn('id', $competitionsIds);
    }

    public function scopeOfCompetition_level_ids(Builder  $query, $value)
    {
        $competitionsIds = CompetitionLevel::whereIn('id', $value)->pluck('competition_id')->toArray();
        return $query->whereIn('id', $competitionsIds);
    }

    public function scopeOfCompetition_type_ids(Builder  $query, $value)
    {
        return $query->whereIn('competition_type_id', $value);
    }

    public function scopeOfCountry_id(Builder  $query, $value): Builder
    {
        return $query->where('country_id', $value);
    }

    public function scopeOfGovernorate_ids(Builder  $query, $value): Builder
    {
        return $query->whereIn('governorate_id', $value);
    }

    public function scopeOfCity_ids(Builder  $query, $value): Builder
    {
        return $query->whereIn('city_id', $value);
    }

    public function scopeOfCompetition_place(Builder  $query, $value): Builder
    {
        return $this->where('competition_address', 'LIKE', "%$value%")
            ->orWhere('location', 'LIKE', "%$value%");
    }

    public function scopeOfStatus(Builder  $query, $value): Builder
    {

        $date = Carbon::now();
        if ($value == 'draft'){

            return $query->where(DB::raw("JSON_LENGTH(steps_numbers)"), '!=', 9)
                ->where('is_announced', '=', 0)
                ->where(DB::raw("JSON_EXTRACT(competition_date, '$[0]')"), '>=', $date)
                ->where(DB::raw("JSON_EXTRACT(competition_date, '$[1]')"), '>=', $date);
        }
        if ($value == 'announced'){
            return $query->where(DB::raw("JSON_LENGTH(steps_numbers)"), '=', 9)
                ->where('is_announced', '=', 1)
                ->where(DB::raw("JSON_EXTRACT(competition_date, '$[0]')"), '>=', $date)
                ->where(DB::raw("JSON_EXTRACT(competition_date, '$[1]')"), '>=', $date);
        }
        if ($value == 'in_progress'){
            return $query->where(DB::raw("JSON_LENGTH(steps_numbers)"), '=', 9)
                ->where('is_announced', '=', 1)
                ->where(DB::raw("JSON_EXTRACT(competition_date, '$[0]')"), '<=', $date)
                ->where(DB::raw("JSON_EXTRACT(competition_date, '$[1]')"), '>=', $date);
        }

        if ($value == 'finished'){
            return $query->where(DB::raw("JSON_LENGTH(steps_numbers)"), '=', 9)
                ->where('is_announced', '=', 1)
                ->where(DB::raw("JSON_EXTRACT(competition_date, '$[0]')"), '<=', $date)
                ->where(DB::raw("JSON_EXTRACT(competition_date, '$[1]')"), '<=', $date);
        }
    }

    public function scopeOfCompetition_start_date(Builder  $query, $value): Builder
    {
        $startDate = $value[0] ?? null;
        $endDate = $value[1] ?? null;
//        $startDate = trim($startDate, '"');
//        $endDate = trim($endDate, '"');
        return $query->whereBetween(DB::raw("JSON_EXTRACT(competition_date, '$[0]')"), [$startDate, $endDate]);

    }

    public function scopeOfCompetition_end_date(Builder  $query, $value): Builder
    {
        $startDate = $value[0] ?? null;
        $endDate = $value[1] ?? null;
//        $startDate = trim($startDate, '"');
//        $endDate = trim($endDate, '"');
        return $query->whereBetween(DB::raw("JSON_EXTRACT(competition_date, '$[1]')"), [$startDate, $endDate]);

    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function concert_honoring(){
        return $this->hasOne(ConcertHonoring::class);
    }
    public function sample(){
        return $this->belongsTo(Sample::class);
    }
    public function advertisement(){
        return $this->belongsTo(Advertisement::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    public function prize(){
        return $this->hasOne(Prize::class);
    }
    public function competitionType(): BelongsTo
    {
        return $this->belongsTo(CompetitionType::class);
    }

    public function levels(){
        return $this->hasMany(CompetitionLevel::class , 'competition_id');
    }

    public function arbitrationCommittee(): HasMany
    {
        return $this->hasMany(ArbitrationCommittee::class);
    }

    public function stages(): HasMany
    {
        return $this->hasMany(Stage::class);
    }

    public function standardCondition(): HasOne
    {
        return $this->hasOne(CompetitionStandardCondition::class);
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function competitionPhoto(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where(['type' => 'competition_photo']);
    }

}
