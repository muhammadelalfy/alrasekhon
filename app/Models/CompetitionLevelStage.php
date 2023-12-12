<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionLevelStage extends Model
{
    use HasFactory,ModelTrait, SearchTrait;

    protected $guarded=[];
    public $timestamps = true;
    protected array $filters = [
        'keyword',

    ];
    protected array $searchable = ['name'];


    public function committee(){
        return $this->belongsTo(Committee::class);
    }
}
