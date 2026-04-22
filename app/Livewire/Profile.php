<?php

namespace App\Livewire;

use App\Models\LearningPath;
use Livewire\Component;
use App\Services\GamificationService;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Profile extends Component
{
    public $user;
    public int $xpForCurrentLevel;
    public int $xpNeededForNextLevel;
    public float $xpProgressPercent;
    public string $nextTitle;

    public function mount()
    {
        $this->user = auth()->user()->load([
            'certificates.learningPath',
            'submissions.artBattle',
            'progress',
            'quizAttempts',
        ]);

        $this->computeXpProgress();
    }

    private function computeXpProgress(): void
    {
        $service  = new GamificationService();
        $level    = $this->user->level;
        $totalXp  = $this->user->xp;

        $required   = 100;
        $accumulated = 0;

        for ($l = 1; $l < $level; $l++) {
            $accumulated += $required;
            $required    += 50;
        }

        $this->xpForCurrentLevel    = $totalXp - $accumulated;
        $this->xpNeededForNextLevel = $required;
        $this->xpProgressPercent    = $required > 0
            ? round(($this->xpForCurrentLevel / $required) * 100, 1)
            : 100;

        $this->nextTitle = $service->getTitle($level + 1);
    }

    public function render()
    {

        $learningPaths = LearningPath::with(['modules.lessons'])
            ->whereHas('modules.lessons.userProgress', function ($q) {
                $q->where('user_id', $this->user->id);
            })
            ->orWhereHas('certificates', function ($q) {
                $q->where('user_id', $this->user->id);
            })
            ->get()
            ->map(function ($path) {
                $totalLessons     = $path->modules->flatMap->lessons->count();
                $completedLessons = $this->user->progress
                    ->whereIn('lesson_id', $path->modules->flatMap->lessons->pluck('id'))
                    ->where('completed', true)
                    ->count();

                return [
                    'name'      => $path->name,
                    'total'     => $totalLessons,
                    'completed' => $completedLessons,
                    'percent'   => $totalLessons > 0
                        ? round(($completedLessons / $totalLessons) * 100)
                        : 0,
                    'certified' => $this->user->certificates
                        ->where('learning_path_id', $path->id)
                        ->isNotEmpty(),
                ];
            });

        $submissions = $this->user->submissions()
            ->with('artBattle')
            ->latest()
            ->get();

        $certificates = $this->user->certificates()
            ->with('learningPath')
            ->latest()
            ->get();


        $stats = [
            'lessons_done'    => $this->user->progress->where('completed', true)->count(),
            'battles_joined'  => $submissions->count(),
            'quiz_attempts'   => $this->user->quizAttempts->count(),
            'certificates'    => $certificates->count(),
        ];

        return view('livewire.profile', compact(
            'learningPaths',
            'submissions',
            'certificates',
            'stats',
        ));
    }
}