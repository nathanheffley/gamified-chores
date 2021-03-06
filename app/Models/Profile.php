<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
    ];

    public const PHOTO_OPTIONS = [
        'Happy',
        'Sad',
        'Surprised',
        'Glasses',
    ];

    public function getPhotoPathAttribute(): string
    {
        return '/imgs/profiles/' . $this->photo . '.png';
    }
}
