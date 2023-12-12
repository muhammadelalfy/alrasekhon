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


class Reading extends Model
{
    use HasFactory,ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = ['name', 'status'];
    protected array $filters = [ 'keyword', 'methodId'];
    protected array $searchable = ['name'];
    protected array $translatable = ['name'];

    public function arbitrators(): BelongsToMany
    {
        return $this->belongsToMany(Arbitrator::class, 'arbitrator_reading')->withPivot('method_id');
    }

    public function methods()
    {
        return $this->belongsToMany(Method::class, 'method_reading');
    }

    public function scopeOfMethodId(Builder $query, $value): Builder
    {
        return $query->whereHas('methods', function ($query) use ($value){
            $query->where('method_id', $value);
        });
    }

}
