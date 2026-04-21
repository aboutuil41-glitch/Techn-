<?php

namespace App\Livewire;

use App\Services\GamificationService;
use App\Models\Lesson as LessonModel;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Lesson extends Component
{
    public LessonModel $lesson;

    public ?Quiz $quiz = null;
    public bool $quizStarted = false;
    public bool $quizSubmitted = false;
    public array $answers = [];
    public int $score = 0;
    public bool $passed = false;

    public function mount(LessonModel $lesson): void
    {
        $this->lesson = $lesson;
        $this->quiz = $lesson->quizzes()->with('questions.options')->first();
    }

    public function startQuiz(): void
    {
        $this->quizStarted = true;
        $this->quizSubmitted = false;
        $this->answers = [];
        $this->score = 0;
        $this->passed = false;
    }

    public function submitQuiz(GamificationService $gamification): void
    {
        if (! $this->quiz) {
            return;
        }

        $totalQuestions = $this->quiz->questions->count();
        $correctAnswers = 0;

        foreach ($this->quiz->questions as $question) {
            $userAnswer = $this->answers[(string) $question->id] ?? null;

            if ($userAnswer && $question->isCorrect($userAnswer)) {
                $correctAnswers++;
            }
        }

        $this->score = $totalQuestions > 0
            ? (int) round(($correctAnswers / $totalQuestions) * 100)
            : 0;

        $this->passed = $this->score >= $this->quiz->passing_score;

        $alreadyPassed = QuizAttempt::where('user_id', Auth::id())
                        ->where('quiz_id', $this->quiz->id)
                        ->where('passed', true)
                        ->exists();
        
        QuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $this->quiz->id,
            'score' => $this->score,
            'passed' => $this->passed,
            'attempted_at' => now(),
        ]);

        if ($this->passed) {
            $this->lesson->markComplete(Auth::id());

            $gamification->awardXp(Auth::user(), 20);
            $gamification->earnCertificate(Auth::user(), $this->lesson->module->learningPath);

            if (! $alreadyPassed) {
                $gamification->passQuiz(Auth::user());
            }
        }

        $this->quizSubmitted = true;
    }

    public function retakeQuiz(): void
    {
        $this->quizStarted = true;
        $this->quizSubmitted = false;
        $this->answers = [];
        $this->score = 0;
        $this->passed = false;
    }

    public function markDone(GamificationService $gamification): void
    {
        $this->lesson->markComplete(Auth::id());
        $gamification->awardXp(Auth::user(), 20);
        $gamification->earnCertificate(Auth::user(), $this->lesson->module->learningPath);
        
        $this->redirect(route('learning-path.show', $this->lesson->module->learning_path_id));
    }

    public function render()
    {
        $userId = Auth::id();

        $isCompleted = $this->lesson->isCompletedBy($userId);
        $module = $this->lesson->module()->with('learningPath')->first();
        $lastAttempt = $this->quiz ? $this->quiz->attempt($userId) : null;

        $siblingIds = LessonModel::where('module_id', $this->lesson->module_id)
            ->orderBy('id')
            ->pluck('id')
            ->toArray();

        $currentIndex = array_search($this->lesson->id, $siblingIds);

        $prevLesson = $currentIndex > 0
            ? LessonModel::find($siblingIds[$currentIndex - 1])
            : null;

        $nextLesson = ($currentIndex !== false && $currentIndex < count($siblingIds) - 1)
            ? LessonModel::find($siblingIds[$currentIndex + 1])
            : null;

        return view('livewire.lesson', [
            'isCompleted' => $isCompleted,
            'module' => $module,
            'lastAttempt' => $lastAttempt,
            'prevLesson' => $prevLesson,
            'nextLesson' => $nextLesson,
        ]);
    }
}