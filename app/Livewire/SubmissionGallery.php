<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubmissionGallery extends Component
{
    public int $battleId;

    protected $listeners = [
        'submission-created' => '$refresh',
    ];

    public function like(int $submissionId): void
    {
        $submission = Submission::findOrFail($submissionId);

        if ($submission->user_id === Auth::id()) {
            return;
        }

        $exists = Like::where('user_id', Auth::id())
            ->where('submission_id', $submissionId)
            ->first();

        if ($exists) {
            $exists->delete();
            $submission->decrement('like_count');
            return;
        }

        Like::create([
            'user_id' => Auth::id(),
            'submission_id' => $submissionId,
        ]);

        $submission->increment('like_count');
    }


    public function render()
    {
        $submissions = Submission::with('user')
            ->where('art_battle_id', $this->battleId)
            ->orderByDesc('like_count')
            ->latest()
            ->get();

        return view('livewire.submission-gallery', [
            'submissions' => $submissions,
        ]);
    }
}