<?php

namespace App\Livewire\Admin\Lessons;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Lesson;
use App\Models\Module;

class LessonIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public $moduleFilter = '';
    public bool $showModal = false;
    public ?int $editingId = null;

    protected $listeners = [
        'lesson-saved' => 'closeModal',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingModuleFilter(): void
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
        Lesson::find($id)?->delete();
        session()->flash('success', 'Lesson deleted successfully.');
    }

    public function render()
    {
        $lessons = Lesson::with('module')
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->moduleFilter, fn ($q) => $q->where('module_id', $this->moduleFilter))
            ->latest()
            ->paginate(10);

        $modules = Module::latest()->get();

        return view('livewire.admin.lessons.lesson-index', compact('lessons', 'modules'));
    }
}