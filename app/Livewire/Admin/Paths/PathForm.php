<?php

namespace App\Livewire\Admin\Paths;

use Livewire\Component;
use App\Models\LearningPath;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PathForm extends Component
{
    use WithFileUploads;

    public ?int $pathId = null;
    public string $name = '';
    public string $description = '';
    public $thumbnail;
    public ?string $existingThumbnail = null;

    public function mount(?int $pathId = null): void
    {
        $this->pathId = $pathId;

        if ($this->pathId) {
            $path = LearningPath::findOrFail($this->pathId);
            $this->name = $path->name;
            $this->description = $path->description ?? '';
            $this->existingThumbnail = $path->thumbnail;
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'creator_id' => auth()->id(),
        ];

        if ($this->thumbnail) {
            if ($this->existingThumbnail && Storage::disk('public')->exists($this->existingThumbnail)) {
                Storage::disk('public')->delete($this->existingThumbnail);
            }

            $data['thumbnail'] = $this->thumbnail->store('paths/thumbnails', 'public');
        }

        if ($this->pathId) {
            LearningPath::findOrFail($this->pathId)->update($data);
            session()->flash('success', 'Learning path updated successfully.');
        } else {
            LearningPath::create($data);
            session()->flash('success', 'Learning path created successfully.');
        }

        $this->dispatch('path-saved');
    }

    public function render()
    {
        return view('livewire.admin.paths.path-form');
    }
}