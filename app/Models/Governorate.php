<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Governorate extends Model
{
    use ModelTrait, SearchTrait, HasTranslations, HasFactory;

    protected $casts = ['status' => 'boolean'];
    protected $fillable = ['name', 'country_id', 'status'];
    public $translatable = ['name'];
    protected array $filters = ['keyword', 'country'];
    protected array $searchable = ['name'];


    public function scopeOfCountry(Builder $query, $value): Builder
    {
        return $query->whereIn('country_id', (array)$value);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }





}
