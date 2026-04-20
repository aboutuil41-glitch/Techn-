<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use App\Models\User;
use App\Models\Certificate;
use App\Models\UserProgress;

class LearningPath extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'creator_id',
    ];

    // --- Relationships ---

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    // --- Helpers ---

    public function getCompletionRate(int $userId): float
    {
        $totalLessons = $this->modules()->withCount('lessons')->get()->sum('lessons_count');

        if ($totalLessons === 0) {
            return 0.0;
        }

        $learningPathId = $this->id;
        $completedLessons = UserProgress::whereHas('lesson.module', function ($q) use ($learningPathId) {
            $q->where('learning_path_id', $learningPathId);
        })->where('user_id', $userId)->where('completed', true)->count();

        return round(($completedLessons / $totalLessons) * 100, 2);
    }

}