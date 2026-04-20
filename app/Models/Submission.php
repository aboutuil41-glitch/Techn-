<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArtBattle;
use App\Models\User;
use App\Models\Like;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'art_battle_id',
        'title',
        'image_path',
        'like_count',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'like_count'   => 'integer',
    ];

    // --- Relationships ---

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artBattle()
    {
        return $this->belongsTo(ArtBattle::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}