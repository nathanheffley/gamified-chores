<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChoreTask extends Model
{
    use HasFactory;

    public function chore(): BelongsTo
    {
        return $this->belongsTo(Chore::class);
    }
}
