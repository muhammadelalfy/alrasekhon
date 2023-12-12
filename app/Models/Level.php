<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory,ModelTrait, SearchTrait;

    protected $guarded=[];
    public $timestamps = true;
    protected array $filters = [
        'keyword',

    ];
    protected array $searchable = ['name'];


    public function users(){
        return $this->hasMany(User::class);
    }

    public function prizes(){
        return $this->hasMany(Prize::class);
    }
    public function stage(){
        return $this->belongsTo(Stage::class);
    }
    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function competitions(){
        return $this->belongsToMany(Competition::class);
    }

    public function committees(){
        return $this->belongsToMany(Committee::class);
    }

    public function samples(){
        return $this->belongsToMany(Sample::class);
    }

    public function arbitrators(){
        return $this->belongsToMany(Arbitrator::class);
    }
}
