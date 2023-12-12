<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory,ModelTrait, SearchTrait;

    protected $guarded=[];
    public $timestamps = true;
    protected array $filters = [
        'keyword',

    ];
    protected array $searchable = ['name'];


    public function sample(){
        return $this->belongsTo(Sample::class);
    }

    public function levels(){
        return $this->belongsToMany(Level::class);
    }
}
