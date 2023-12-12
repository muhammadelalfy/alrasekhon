<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{

    use SoftDeletes,HasFactory,ModelTrait, SearchTrait;
    protected $guarded=[];
    public $timestamps = true;
    protected array $filters = [
        'keyword',

    ];

    protected array $searchable = ['name'];

    public function competition(){
        return $this->belongsTo(Competition::class);
    }

    public function samples(){
        return $this->hasMany(Sample::class);
    }

}
