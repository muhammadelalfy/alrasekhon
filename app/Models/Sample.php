<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Translatable\HasTranslations;

class Sample extends Model
{
    use HasFactory, ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = ['name', 'contract_category'];
    protected array $translatable = ['name'];
    protected array $searchable = ['name'];
    protected array $filters = ['keyword','SearchDate', 'category'];


    public function competitions(): HasMany
    {
        return $this->hasMany(Competition::class);
    }
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
    public function arbitrator(): BelongsTo
    {
        return $this->belongsTo(Arbitrator::class);
    }
    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(Level::class);
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function scopeOfSearchDate(Builder  $query, $value): Builder
    {
        $startDate = $value[0] ?? null;
        $endDate = $value[1] ?? null;
        $startDate = trim($startDate, '"');
        $endDate = trim($endDate, '"');
        return $query->whereBetween('created_at', [$startDate, $endDate]);

    }

    public function scopeOfCategory(Builder  $query, $value): Builder
    {
        return $query->where(['contract_category' => $value]);
    }


}
