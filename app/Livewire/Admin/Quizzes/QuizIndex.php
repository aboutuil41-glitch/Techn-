<?php

namespace App\Livewire\Admin\Quizzes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Quiz;
use App\Models\Lesson;

class QuizIndex extends Component
{
    use WithPagination;

    public ?int $managingQuestionsFor = null;
    public string $search = '';
    public $lessonFilter = '';
    public bool $showModal = false;
    public ?int $editingId = null;

    protected $listeners = [
        'quiz-saved' => 'closeModal',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingLessonFilter(): void
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
        Quiz::find($id)?->delete();
        session()->flash('success', 'Quiz deleted successfully.');
    }

    public function render()
    {
        $quizzes = Quiz::with('lesson')
            ->withCount('questions')
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->lessonFilter, fn ($q) => $q->where('lesson_id', $this->lessonFilter))
            ->latest()
            ->paginate(10);

        $lessons = Lesson::latest()->get();

        return view('livewire.admin.quizzes.quiz-index', compact('quizzes', 'lessons'));
    }
}