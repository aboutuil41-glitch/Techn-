<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserProgress;
use App\Models\LearningPath;
use App\Models\Lesson;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_path_id',
        'title',
        'description',
    ];

    // --- Relationships ---

    public function learningPath()
    {
        return $this->belongsTo(LearningPath::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // --- Helpers ---

    public function isUnlockedFor(int $userId): bool
    {
        // First module is always unlocked; others require previous module completion
        $previousModule = Module::where('learning_path_id', $this->learning_path_id)
            ->where('id', '<', $this->id)
            ->orderByDesc('id')
            ->first();

        if (! $previousModule) {
            return true;
        }

        $totalLessons     = $previousModule->lessons()->count();
        $completedLessons = UserProgress::whereIn('lesson_id', $previousModule->lessons()->pluck('id'))
            ->where('user_id', $userId)
            ->where('completed', true)
            ->count();

        return $completedLessons >= $totalLessons;
    }
}