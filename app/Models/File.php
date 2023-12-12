<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class File extends Model
{
    use HasFactory, ModelTrait, HasTranslations;

    protected $fillable = [
        "name",
        "ext",
        "url",
        "type",
        "width",
        "height",
        "mime",
        "fileable_type",
        "fileable_id",
        "duration",
        "user_id",
        "custom_name",
        'notes'
    ];

    protected array $translatable = ['name'];


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the owning fileable model.
     */

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('all', function (Builder $builder) {
            $builder->orderBy('id','Desc');
        });

        static::deleting(function ($file) { // before delete() method call this
            if(isset($file->url)){
                if (Storage::exists($file->url)) {
                    Storage::delete($file->url);
                }
            }
        });
    }

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
