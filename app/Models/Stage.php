<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Stage extends Model
{
    use HasFactory, ModelTrait;

    protected $fillable = ['name', 'competition_id'];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(Level::class);
    }

    public function committees(): BelongsToMany
    {
        return $this->belongsToMany(Committee::class);
    }

    public function arbitrators(): BelongsToMany
    {
        return $this->belongsToMany(Arbitrator::class);
    }

    public function scopeOfName(Builder $query, $value): Builder
    {
        return $query->where('name', $value);
    }
}
