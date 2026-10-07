<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mix extends Model
{
    /** @use HasFactory<\Database\Factories\MixFactory> */
    use HasFactory;
    
    public const GENRES = [
        'Jungle',
        'Drum & Bass',
        'Hardgroove Techno',
        'Hypnotic Techno',
        'Dub Techno',
        'Detroit Techno',
        'Bass Music',
        'Breakbeat',
        'Ambient',
        'Electro',
        'Hardcore',
        'Bouncy Trance',
        'Hardtrance',
        'Chicago House',
        'Speed House',
        'Hardhouse',
        'Groove House',
        'Italo Disco',
        'UK Garage',
    ];
        protected $fillable = ['user_id', 'title', 'audio_path', 'genre', 'description', 'image_path', 'bpm'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
