<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Models\Lesson;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'passing_score',
    ];

    // --- Relationships ---

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // --- Helpers ---

    public function attempt(int $userId): ?QuizAttempt
    {
        return $this->attempts()->where('user_id', $userId)->latest()->first();
    }
}