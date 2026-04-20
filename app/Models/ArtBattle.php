<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Submission;

class ArtBattle extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        'description',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];

    // --- Relationships ---

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

}