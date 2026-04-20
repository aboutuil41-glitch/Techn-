<?php

namespace App\Livewire\Admin\Battles;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ArtBattle;

class BattleIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showModal = false;
    public ?int $editingId = null;

    protected $listeners = [
        'battle-saved' => 'closeModal',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->editingId = null;
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $this->editingId = $id;
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->editingId = null;
    }

    public function delete(int $id): void
    {
        ArtBattle::find($id)?->delete();
        session()->flash('success', 'Battle deleted successfully.');
    }

    public function render()
    {
        $battles = ArtBattle::withCount('submissions')
            ->when($this->search, fn ($q) => $q->where('theme', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.battles.battle-index', compact('battles'));
    }
}