<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Method extends Model
{

    use HasFactory, ModelTrait, SearchTrait, HasTranslations;

    protected $casts = ['status' => 'boolean'];
    protected $fillable = ['name', 'status'];
    protected array $filters = ['keyword'];
    protected array $searchable = ['name'];
    protected array $translatable = ['name'];


    public function readings()
    {
        return $this->belongsToMany(Reading::class, 'method_reading');
    }
}
