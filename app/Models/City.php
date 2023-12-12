<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory,ModelTrait, SearchTrait,HasTranslations;
    protected $casts = ['status' => 'boolean'];
    protected $fillable = ['name', 'governorate_id', 'country_id', 'status'];
    public $timestamps = true;
    protected array $filters = ['keyword','governorate', 'country'];
    protected array $searchable = ['name'];
    public $translatable = ['name'];

    public function scopeOfGovernorate(Builder $query, $value): Builder
    {
        return $query->whereIn('governorate_id', (array)$value);
    }

    public function scopeOfCountry(Builder $query, $value): Builder
    {
        return $query->whereIn('country_id', (array)$value);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

}
