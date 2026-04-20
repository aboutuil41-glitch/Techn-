<?php

namespace App\Livewire\Admin\Modules;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Module;
use App\Models\LearningPath;

class ModuleIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public $pathFilter = '';
    public bool $showModal = false;
    public ?int $editingId = null;

    protected $listeners = [
        'module-saved' => 'closeModal',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPathFilter(): void
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
        Module::find($id)?->delete();
        session()->flash('success', 'Module deleted successfully.');
    }

    public function render()
    {
        $modules = Module::with('learningPath')
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->pathFilter, fn ($q) => $q->where('learning_path_id', $this->pathFilter))
            ->latest()
            ->paginate(10);

        $paths = LearningPath::latest()->get();

        return view('livewire.admin.modules.module-index', compact('modules', 'paths'));
    }
}