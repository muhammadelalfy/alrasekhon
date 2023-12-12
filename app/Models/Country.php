<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    protected $casts = ['status' => 'boolean'];
    use HasFactory,ModelTrait, SearchTrait,HasTranslations;
    protected $fillable=['id' , 'name' ,'status', 'created_at' , 'updated_at'];
    public $timestamps = true;
    protected array $filters = [
        'keyword',
    ];
    protected array $searchable = ['name'];
//    protected array $searchable = ["JSON_EXTRACT(name, '$.ar')", "JSON_EXTRACT(name, '$.en')"];

    public $translatable = ['name'];

    public function governorates(){
        return $this->hasMany(Governorate::class);
    }
}
