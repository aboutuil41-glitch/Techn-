<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\UserProgress;
use App\Models\Module;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'content',
        'video_path',
    ];

    // --- Relationships ---

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    // --- Helpers ---

    public function markComplete(int $userId): void
    {
        UserProgress::updateOrCreate(
            ['user_id' => $userId, 'lesson_id' => $this->id],
            ['completed' => true, 'completed_at' => now()]
        );
    }

    public function isCompletedBy(int $userId): bool
    {
        return $this->userProgress()
            ->where('user_id', $userId)
            ->where('completed', true)
            ->exists();
    }
}