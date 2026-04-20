<?php

namespace App\Livewire;

use App\Models\ArtBattle;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ArtBattleList extends Component
{
    public function render()
    {
        $battles = ArtBattle::withCount('submissions')
            ->latest()
            ->get();

        return view('livewire.art-battle-list', [
            'battles' => $battles,
        ]);
    }
}