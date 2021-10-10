<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chore extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'points',
        'photo',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(ChoreTask::class);
    }
}
