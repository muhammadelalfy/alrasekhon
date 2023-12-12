<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class ConcertHonoring extends Model
{
    use HasFactory,ModelTrait, SearchTrait;

    protected $fillable = ['date', 'city_id', 'location', 'competition_place', 'competition_id'];
    public $timestamps = true;
    protected array $filters = [
        'keyword',
    ];
    protected array $searchable = ['name'];


    public function city(){
        return $this->belongsTo(City::class);
    }
    public function competition(){
        return $this->belongsTo(Competition::class);
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }
}
