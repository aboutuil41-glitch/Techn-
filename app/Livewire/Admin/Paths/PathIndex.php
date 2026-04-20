<?php

namespace App\Livewire\Admin\Paths;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LearningPath;

class PathIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showModal = false;
    public ?int $editingId = null;

    protected $listeners = [
        'path-saved' => 'closeModal',
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
        LearningPath::find($id)?->delete();
        session()->flash('success', 'Learning path deleted successfully.');
    }

    public function render()
    {
        $paths = LearningPath::withCount('modules')
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.paths.path-index', compact('paths'));
    }
}