<?php

namespace App\Livewire\Admin\Options;

use App\Models\Option;
use App\Models\Question;
use Livewire\Component;

class OptionManager extends Component
{
    public int $questionId;

    public string $text = '';
    public bool $is_correct = false;

    public ?int $editingId = null;

    public function mount(int $questionId): void
    {
        $this->questionId = $questionId;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'text' => ['required', 'string', 'max:255'],
            'is_correct' => ['boolean'],
        ]);

        $question = Question::findOrFail($this->questionId);

        if ($validated['is_correct']) {
            Option::where('question_id', $this->questionId)->update(['is_correct' => false]);
        }

        if ($this->editingId) {
            $option = Option::findOrFail($this->editingId);
            $option->update([
                'text' => $validated['text'],
                'is_correct' => $validated['is_correct'],
            ]);
        } else {
            Option::create([
                'question_id' => $this->questionId,
                'text' => $validated['text'],
                'is_correct' => $validated['is_correct'],
            ]);
        }

        $correctOption = Option::where('question_id', $this->questionId)
            ->where('is_correct', true)
            ->first();

        $question->update([
            'correct_answer' => $correctOption?->text ?? '',
        ]);

        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $option = Option::findOrFail($id);

        $this->editingId = $option->id;
        $this->text = $option->text;
        $this->is_correct = (bool) $option->is_correct;
    }

    public function delete(int $id): void
    {
        $option = Option::findOrFail($id);
        $wasCorrect = $option->is_correct;
        $option->delete();

        if ($wasCorrect) {
            Question::findOrFail($this->questionId)->update([
                'correct_answer' => '',
            ]);
        }

        $this->resetForm();
    }

    public function resetForm(): void
    {
        $this->editingId = null;
        $this->text = '';
        $this->is_correct = false;
    }

    public function render()
    {
        $question = Question::with('options')->findOrFail($this->questionId);

        return view('livewire.admin.options.option-manager', [
            'question' => $question,
            'options' => $question->options()->latest()->get(),
        ]);
    }
}