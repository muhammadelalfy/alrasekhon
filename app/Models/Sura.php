<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sura extends Model
{
    use HasFactory, ModelTrait;
    protected $guarded = [];
    protected $table = 'suras';
}
