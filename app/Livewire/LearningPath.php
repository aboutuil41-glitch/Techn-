<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\LearningPath as LearningPathModel;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class LearningPath extends Component
{
    public LearningPathModel $path;

    public function mount(LearningPathModel $path): void
    {
        $this->path = $path;
    }

    public function render()
    {
        $userId = Auth::id();

        $modules = $this->path->modules()->with(['lessons.userProgress' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])->orderBy('id')->get();

        $modules = $modules->map(function ($module) use ($userId) {
            $module->is_unlocked = $module->isUnlockedFor($userId);

            $module->lessons = $module->lessons->map(function ($lesson) use ($userId) {
                $progress            = $lesson->userProgress->first();
                $lesson->is_completed = $progress?->completed ?? false;
                return $lesson;
            });

            $totalLessons          = $module->lessons->count();
            $completedLessons      = $module->lessons->where('is_completed', true)->count();
            $module->progress      = $totalLessons > 0
                ? round(($completedLessons / $totalLessons) * 100)
                : 0;

            return $module;
        });

        $overallRate = $this->path->getCompletionRate($userId);

        return view('livewire.learning-path', [
            'modules'     => $modules,
            'overallRate' => $overallRate,
        ]);
    }
}