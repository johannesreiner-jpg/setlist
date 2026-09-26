<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mix extends Model
{
    /** @use HasFactory<\Database\Factories\MixFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'audio_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
