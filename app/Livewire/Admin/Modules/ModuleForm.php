<?php

namespace App\Livewire\Admin\Modules;

use Livewire\Component;
use App\Models\Module;
use App\Models\LearningPath;

class ModuleForm extends Component
{
    public ?int $moduleId = null;
    public string $title = '';
    public string $description = '';
    public $learning_path_id = '';

    public function mount(?int $moduleId = null): void
    {
        $this->moduleId = $moduleId;

        if ($this->moduleId) {
            $module = Module::findOrFail($this->moduleId);
            $this->title = $module->title;
            $this->description = $module->description ?? '';
            $this->learning_path_id = $module->learning_path_id;
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'learning_path_id' => ['required', 'exists:learning_paths,id'],
        ]);

        if ($this->moduleId) {
            Module::findOrFail($this->moduleId)->update($validated);
            session()->flash('success', 'Module updated successfully.');
        } else {
            Module::create($validated);
            session()->flash('success', 'Module created successfully.');
        }

        $this->dispatch('module-saved');
    }

    public function render()
    {
        return view('livewire.admin.modules.module-form', [
            'paths' => LearningPath::latest()->get(),
        ]);
    }
}