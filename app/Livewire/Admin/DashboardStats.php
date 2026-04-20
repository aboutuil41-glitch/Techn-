<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\{
    User,
    LearningPath,
    Module,
    Lesson,
    UserProgress,
    QuizAttempt
};

class DashboardStats extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard-stats', [
            'stats' => [
                'Users' => User::count(),
                'Paths' => LearningPath::count(),
                'Modules' => Module::count(),
                'Lessons' => Lesson::count(),
                'Completed Lessons' => UserProgress::where('completed', true)->count(),
                'Quiz Attempts' => QuizAttempt::count(),
            ],
            'recentPaths' => LearningPath::withCount('modules')
                ->with('creator')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}