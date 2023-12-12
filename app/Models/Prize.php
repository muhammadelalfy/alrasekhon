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
class Prize extends Model
{
    use HasFactory, ModelTrait, SearchTrait;

    protected $fillable = [
        'competition_id',
        'prize_data',
//        'level_id',
//        'user_id',
//        'competition_levels_names',
//        'winners_rankings',
//        'financials_awards_values',
//        'certificates_and_honors',
    ];

    protected $casts = ['prize_data' => 'array'];

//    protected array $filters = ['keyword'];
//    protected array $searchable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competititon()
    {
        return $this->belongsTo(Competition::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

}
