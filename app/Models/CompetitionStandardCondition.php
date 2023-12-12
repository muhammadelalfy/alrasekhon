<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompetitionStandardCondition extends Model
{
    use HasFactory;


    protected $fillable = ['standard_condition_description', 'competition_id'];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }
}
