<?php

namespace App\Livewire\Admin\Quizzes;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Lesson;

class QuizForm extends Component
{
    public ?int $quizId = null;
    public string $title = '';
    public int $passing_score = 70;
    public $lesson_id = '';

    public function mount(?int $quizId = null): void
    {
        $this->quizId = $quizId;

        if ($this->quizId) {
            $quiz = Quiz::findOrFail($this->quizId);
            $this->title = $quiz->title;
            $this->passing_score = $quiz->passing_score;
            $this->lesson_id = $quiz->lesson_id;
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'passing_score' => ['required', 'integer', 'min:0', 'max:100'],
            'lesson_id' => ['required', 'exists:lessons,id'],
        ]);

        if ($this->quizId) {
            Quiz::findOrFail($this->quizId)->update($validated);
            session()->flash('success', 'Quiz updated successfully.');
        } else {
            Quiz::create($validated);
            session()->flash('success', 'Quiz created successfully.');
        }

        $this->dispatch('quiz-saved');
    }

    public function render()
    {
        return view('livewire.admin.quizzes.quiz-form', [
            'lessons' => Lesson::latest()->get(),
        ]);
    }
}