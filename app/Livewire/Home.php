<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ArtBattle;
use App\Models\LearningPath;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Home extends Component
{
    public function render()
    {
        $userId = Auth::id();

        $latestPaths = LearningPath::withCount('modules')
            ->latest()
            ->take(3)
            ->get();

        $inProgressPaths = LearningPath::whereHas('modules.lessons.userProgress', function ($q) use ($userId) {
                $q->where('user_id', $userId)->where('completed', true);
            })
            ->with(['modules'])
            ->get()
            ->filter(function ($path) use ($userId) {
                return $path->getCompletionRate($userId) < 100;
            });

        $activeBattle = ArtBattle::latest()
            ->where('status', 'active')
            ->first();

        return view('livewire.home', [
            'latestPaths'     => $latestPaths,
            'inProgressPaths' => $inProgressPaths,
            'activeBattle'    => $activeBattle,
        ]);
    }
}