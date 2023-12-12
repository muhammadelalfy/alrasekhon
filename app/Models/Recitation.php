<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recitation extends Model
{
    use HasFactory,ModelTrait, SearchTrait;

    protected $guarded=[];
    public $timestamps = true;
    protected array $filters = [
        'keyword',

    ];
    protected array $searchable = ['name'];


    public function way(){
        return $this->belongsTo(Reading::class);
    }

}
