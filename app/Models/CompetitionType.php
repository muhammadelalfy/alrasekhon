<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CompetitionType extends Model
{
    use HasFactory,ModelTrait,SearchTrait, HasTranslations;

    protected $casts = ['status' => 'boolean'];
    protected $fillable = ['name', 'description', 'status'];
    protected $translatable = ['name', 'description'];
    protected array $searchable = ['name', 'description'];
    protected array $filters = ['keyword',];

    public function competition(){
        return $this->belongsTo(Competition::class);
    }}
