<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Submission;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'submission_id',
    ];

    // --- Relationships ---

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}