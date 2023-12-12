<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class ContestantLevel extends Model
{
    use HasFactory,ModelTrait,SearchTrait, HasTranslations;

    protected $casts = ['status' => 'boolean'];
    protected $fillable = ['name', 'description', 'status'];
    protected array $translatable = ['name', 'description'];
    protected array $searchable = ['name', 'description', 'status'];

    protected array $filters = ['keyword'];

    public function contestants(): BelongsToMany
    {
        return $this->belongsToMany(Contestant::class, 'contestant_level')->withPivot(['contestant_id', 'contestant_level_id']);
    }
}
