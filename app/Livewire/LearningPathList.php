<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\LearningPath;

#[Layout('layouts.app')]
class LearningPathList extends Component
{
    public function render()
    {
        $paths = LearningPath::latest()->get();

        return view('livewire.learning-path-list', [
            'paths' => $paths,
        ]);
    }
}