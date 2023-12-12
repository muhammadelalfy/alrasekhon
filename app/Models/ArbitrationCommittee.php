<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class ArbitrationCommittee extends Model
{
    use HasFactory,ModelTrait, SearchTrait,HasTranslations;

    protected $fillable = [
        'name',
        'competition_id',
        'committee_chairman_id',
        'vice_committee_chairman_id',
        'arbitrators_number'
    ];

    protected array $filters = ['keyword'];
    protected array $searchable = ['name'];
    public $translatable = ['name'];


    public function competitionLevel(): BelongsToMany
    {
        return $this->belongsToMany(CompetitionLevel::class, 'arbitration_committee_competition_level');
    }
    public function stage(): BelongsToMany
    {
        return $this->belongsToMany(Stage::class, 'arbitration_committee_stage');
    }
    public function committeeMember(): BelongsToMany
    {
        return $this->belongsToMany(CommitteeMember::class, 'arbitration_committee_committee_member');
    }
    public function committeeChairman(): BelongsTo
    {
        return $this->belongsTo(CommitteeChairman::class);
    }
    public function viceCommitteeChairman(): BelongsTo
    {
        return $this->belongsTo(ViceCommitteeChairman::class);
    }

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }


}
