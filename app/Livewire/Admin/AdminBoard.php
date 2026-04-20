<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class AdminBoard extends Component
{
    public string $section = 'dashboard';

    public function setSection(string $section): void
    {
        $this->section = $section;
    }

    public function render()
    {
        return view('livewire.admin.admin-board');
    }
}