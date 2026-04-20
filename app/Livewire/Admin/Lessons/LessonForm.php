<?php

namespace App\Livewire\Admin\Lessons;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class LessonForm extends Component
{
    use WithFileUploads;

    public $video;
    public ?string $existingVideoPath = null;

    public ?int $lessonId = null;
    public string $title = '';
    public string $content = '';
    public $module_id = '';

    public function mount(?int $lessonId = null): void
    {
        $this->lessonId = $lessonId;

        if ($this->lessonId) {
            $lesson = Lesson::findOrFail($this->lessonId);

            $this->title = $lesson->title;
            $this->content = $lesson->content ?? '';
            $this->module_id = $lesson->module_id;
            $this->existingVideoPath = $lesson->video_path;
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'module_id' => ['required', 'exists:modules,id'],
            'video' => ['nullable', 'file', 'mimes:mp4', 'max:51200'],
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'module_id' => $validated['module_id'],
        ];

        if ($this->video) {
            if ($this->existingVideoPath && Storage::disk('public')->exists($this->existingVideoPath)) {
                Storage::disk('public')->delete($this->existingVideoPath);
            }

            $data['video_path'] = $this->video->store('lessons/videos', 'public');
        }

        if ($this->lessonId) {
            Lesson::findOrFail($this->lessonId)->update($data);
            session()->flash('success', 'Lesson updated successfully.');
        } else {
            Lesson::create($data);
            session()->flash('success', 'Lesson created successfully.');
        }

        $this->dispatch('lesson-saved');
    }

    public function render()
    {
        return view('livewire.admin.lessons.lesson-form', [
            'modules' => Module::latest()->get(),
        ]);
    }
}