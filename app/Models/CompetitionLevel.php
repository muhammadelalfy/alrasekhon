<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class CompetitionLevel extends Model
{

    use HasFactory, ModelTrait, SearchTrait, HasTranslations;

    protected $guarded =[] ;
    protected $translatable = ['name'];
    protected $casts = ['name'=>'json',  'controlName' =>'json' , 'other_controls' =>'json'   ];


    protected array $searchable = ['name'];
    protected $table = 'competition_level';
    protected array $filters = ['keyword','competition'];

    public function scopeOfCompetition(Builder $query, $value): Builder
    {
        return $query->whereIn('competition_id', (array)$value);
    }

    public function stages(): BelongsToMany
    {
        return $this->belongsToMany(Stage::class);
    }

    public function competition(){
        return $this->belongsTo(Competition::class,'competition_id');
    }

}
