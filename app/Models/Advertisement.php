<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Advertisement extends Model
{
    use HasFactory,ModelTrait, SearchTrait;
    protected $fillable=['name', 'description', 'media_type', 'url'];
    protected array $filters = ['keyword'];
    protected array $searchable = ['name', 'description'];


    public function competitions(){
        return  $this->hasMany(Competition::class);
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function readySample(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where(['type' => 'sample_attach']);
    }

//    public function setDescriptionAttribute(): string
//    {
//        return strip_tags($this->description);
//    }
}
