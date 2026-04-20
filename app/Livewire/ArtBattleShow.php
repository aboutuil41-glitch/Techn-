<?php

namespace App\Livewire;

use App\Models\ArtBattle;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class ArtBattleShow extends Component
{
    use WithFileUploads;

    public ArtBattle $battle;

    public string $title = '';
    public $image;

    public function mount(ArtBattle $battle): void
    {
        $this->battle = $battle;
    }

    public function save(): void
    {
        if (! Auth::check()) {
            return;
        }

        if ($this->battle->status !== 'active') {
            session()->flash('error', 'This battle is not active.');
            return;
        }

        $alreadySubmitted = Submission::where('user_id', Auth::id())
            ->where('art_battle_id', $this->battle->id)
            ->exists();

        if ($alreadySubmitted) {
            session()->flash('error', 'You already submitted artwork for this battle.');
            return;
        }

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        Submission::create([
            'user_id' => Auth::id(),
            'art_battle_id' => $this->battle->id,
            'title' => $validated['title'],
            'image_path' => $this->image->store('submissions', 'public'),
        ]);

        $this->reset(['title', 'image']);

        session()->flash('success', 'Artwork submitted successfully.');

        $this->dispatch('submission-created');
    }

    public function render()
    {
        $userSubmission = null;

        if (Auth::check()) {
            $userSubmission = Submission::where('user_id', Auth::id())
                ->where('art_battle_id', $this->battle->id)
                ->first();
        }

        $winners = collect();

        if ($this->battle->status === 'finished') {
            $winners = Submission::with('user')
                ->where('art_battle_id', $this->battle->id)
                ->orderByDesc('like_count')
                ->take(3)
                ->get();
        }

        return view('livewire.art-battle-show', [
            'userSubmission' => $userSubmission,
            'winners' => $winners,
        ]);
    }
}