<?php

namespace App\Livewire\Admin\Battles;

use Livewire\Component;
use App\Models\ArtBattle;

class BattleForm extends Component
{
    public ?int $battleId = null;

    public string $theme = '';
    public string $description = '';
    public $start_time;
    public $end_time;
    public string $status = 'upcoming';

    public function mount(?int $battleId = null): void
    {
        $this->battleId = $battleId;

        if ($this->battleId) {
            $battle = ArtBattle::findOrFail($this->battleId);

            $this->theme = $battle->theme;
            $this->description = $battle->description ?? '';
            $this->start_time = $battle->start_time;
            $this->end_time = $battle->end_time;
            $this->status = $battle->status;
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'theme' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'status' => ['required', 'in:upcoming,active,finished'],
        ]);

        if ($this->battleId) {
            ArtBattle::findOrFail($this->battleId)->update($validated);
            session()->flash('success', 'Battle updated successfully.');
        } else {
            ArtBattle::create($validated);
            session()->flash('success', 'Battle created successfully.');
        }

        $this->dispatch('battle-saved');
    }

    public function render()
    {
        return view('livewire.admin.battles.battle-form');
    }
}