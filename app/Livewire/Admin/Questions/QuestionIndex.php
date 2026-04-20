<?php

namespace App\Livewire\Admin\Questions;

use App\Models\Quiz;
use App\Models\Question;
use Livewire\Component;

class QuestionIndex extends Component
{
    public int $quizId;
    public bool $showFormModal = false;
    public ?int $editingId = null;
    public ?int $managingOptionsFor = null;

    protected $listeners = [
        'question-saved' => 'closeFormModal',
    ];

    public function mount(int $quizId): void
    {
        $this->quizId = $quizId;
    }

    public function create(): void
    {
        $this->editingId = null;
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $this->editingId = $id;
        $this->showFormModal = true;
    }

    public function closeFormModal(): void
    {
        $this->showFormModal = false;
        $this->editingId = null;
    }

    public function delete(int $id): void
    {
        Question::find($id)?->delete();
        session()->flash('success', 'Question deleted successfully.');
    }

    public function render()
    {
        $quiz = Quiz::findOrFail($this->quizId);

        $questions = Question::withCount('options')
            ->with('options')
            ->where('quiz_id', $this->quizId)
            ->latest()
            ->get();

        return view('livewire.admin.questions.question-index', compact('quiz', 'questions'));
    }
}