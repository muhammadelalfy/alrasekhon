<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Committee extends Model
{
    use HasFactory , ModelTrait, SearchTrait , HasTranslations;

    protected $fillable=['name' , 'status' , 'chairman_id' , 'city_id'];
    public $timestamps = true;
    protected array $filters = [
        'keyword',

    ];
    protected array $searchable = ['name'];


    public function arbitrators()
    {
        return  $this->hasMany(Arbitrator::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function compitition_level_stages()
    {
        return  $this->hasMany(CompetitionLevelStage::class);
    }

    public function levels(){
        return $this->belongsToMany(Level::class);
    }

    public function stages(){
        return $this->belongsToMany(Stage::class);
    }
}
