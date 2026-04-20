<?php

namespace App\Livewire\Admin\Questions;

use App\Models\Question;
use Livewire\Component;

class QuestionForm extends Component
{
    public int $quizId;
    public ?int $questionId = null;
    public string $question_text = '';

    public function mount(int $quizId, ?int $questionId = null): void
    {
        $this->quizId = $quizId;
        $this->questionId = $questionId;

        if ($this->questionId) {
            $question = Question::findOrFail($this->questionId);
            $this->question_text = $question->question_text;
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'question_text' => ['required', 'string'],
        ]);

        $validated['quiz_id'] = $this->quizId;

        if ($this->questionId) {
            Question::findOrFail($this->questionId)->update($validated);
            session()->flash('success', 'Question updated successfully.');
        } else {
            Question::create([
                ...$validated,
                'correct_answer' => '',
            ]);
            session()->flash('success', 'Question created successfully.');
        }

        $this->dispatch('question-saved');
    }

    public function render()
    {
        return view('livewire.admin.questions.question-form');
    }
}