<div class="mx-auto max-w-5xl px-4 py-10 space-y-8 font-[Jost]">

    <div class="space-y-4">
        <a href="{{ route('learning-path.show', $lesson->module->learning_path_id) }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-[#C0392B] hover:text-[#A62F24]">
            ← Back to Path
        </a>

        <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_18px_50px_rgba(192,57,43,0.08)]">
            <div class="relative bg-[linear-gradient(145deg,#2C2060_0%,#3D1C5C_45%,#5A1C3C_100%)] px-6 py-10 text-white lg:px-10">
                <div class="absolute right-0 top-0 h-full w-1/3 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.10),transparent_60%)]"></div>

                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-3xl">
                        <p class="text-xs uppercase tracking-[0.22em] text-[#F4D4D9]">Lesson</p>
                        <p class="mt-3 text-sm text-white/70">Module: {{ $module->title }}</p>
                        <h1 class="mt-3 font-[Cormorant_Garamond] text-5xl font-medium leading-tight lg:text-6xl">
                            {{ $lesson->title }}
                        </h1>
                    </div>

                    @if ($quiz)
                        <div class="rounded-[1.5rem] border border-white/12 bg-white/10 px-5 py-4 backdrop-blur-md">
                            <p class="text-xs uppercase tracking-[0.18em] text-[#F4D4D9]">Includes</p>
                            <p class="mt-2 text-sm text-white/85">Video · Reading · Quiz</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>

    @if ($lesson->video_path)
        <section class="overflow-hidden rounded-[2rem] border border-[#1C1020]/10 bg-[#0A060F] shadow-[0_22px_55px_rgba(10,6,15,0.30)]">
            <video controls class="w-full">
                <source src="{{ asset('storage/' . $lesson->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </section>
    @endif

    @if ($lesson->content)
        <section class="rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] p-8 shadow-[0_14px_40px_rgba(192,57,43,0.05)]">
            <div class="mb-5 flex items-center gap-3">
                <span class="h-2 w-2 rounded-full bg-[#C0392B]"></span>
                <p class="text-xs uppercase tracking-[0.18em] text-[#A58A99]">Lesson Content</p>
            </div>

            <div class="whitespace-pre-line font-[Jost] text-[17px] leading-9 text-[#4A3050]">
                {{ $lesson->content }}
            </div>
        </section>
    @endif

    @if ($quiz)
        @if (! $quizStarted && ! $quizSubmitted)
            <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_16px_45px_rgba(192,57,43,0.07)]">
                <div class="bg-[linear-gradient(145deg,#2C2060,#3A1240)] px-6 py-7 text-white">
                    <p class="text-xs uppercase tracking-[0.22em] text-[#F4D4D9]">Lesson Quiz</p>
                    <h2 class="mt-3 font-[Cormorant_Garamond] text-4xl font-medium italic">{{ $quiz->title }}</h2>
                    <p class="mt-3 text-sm text-white/70">
                        {{ $quiz->questions->count() }} question{{ $quiz->questions->count() !== 1 ? 's' : '' }} · Passing score: {{ $quiz->passing_score }}%
                    </p>
                </div>

                <div class="space-y-5 p-6">
                    @if ($lastAttempt)
                        <div class="rounded-[1.4rem] border border-[#E8D7DB] bg-[#FDF8F6] p-5">
                            <p class="text-sm text-[#8A7090]">
                                Last attempt:
                                <span class="font-semibold text-[#1C1020]">{{ $lastAttempt->score }}%</span>
                            </p>
                        </div>
                    @endif

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="max-w-2xl text-sm leading-7 text-[#8A7090]">
                            Pass the quiz to complete this lesson and move forward with confidence.
                        </p>

                        <button type="button"
                                wire:click="startQuiz"
                                class="inline-flex items-center justify-center rounded-full bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-6 py-3 text-sm font-medium text-white shadow-[0_12px_24px_rgba(192,57,43,0.24)] transition hover:-translate-y-0.5">
                            {{ $lastAttempt ? 'Retake Quiz' : 'Start Quiz' }}
                        </button>
                    </div>
                </div>
            </section>
        @endif

        @if ($quizStarted && ! $quizSubmitted)
            <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_16px_45px_rgba(192,57,43,0.07)]">
                <div class="flex flex-col gap-4 bg-[linear-gradient(145deg,#2C2060,#3A1240)] px-6 py-7 text-white lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-[#F4D4D9]">Lesson Quiz</p>
                        <h2 class="mt-3 font-[Cormorant_Garamond] text-4xl font-medium italic">Test your understanding</h2>
                    </div>

                    <div class="rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm backdrop-blur">
                        {{ count($answers) }} / {{ $quiz->questions->count() }} answered
                    </div>
                </div>

                <div class="space-y-6 p-6">
                    @foreach ($quiz->questions as $index => $question)
                        <article class="rounded-[1.6rem] border border-[#E8D7DB] bg-[#FFFCFA] p-6 shadow-[0_8px_20px_rgba(192,57,43,0.03)]">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="rounded-full bg-[#FAEAEA] px-3 py-1 text-[11px] font-medium uppercase tracking-[0.14em] text-[#A62F24]">
                                    Question {{ $index + 1 }}
                                </span>

                                <span class="text-xs uppercase tracking-[0.16em] text-[#A58A99]">
                                    of {{ $quiz->questions->count() }}
                                </span>
                            </div>

                            <p class="mt-4 font-[Cormorant_Garamond] text-3xl font-medium leading-tight text-[#1C1020]">
                                {{ $question->question_text }}
                            </p>

                            <div class="mt-6 space-y-3">
                                @foreach ($question->options as $option)
                                    <label class="group flex cursor-pointer items-center gap-4 rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFDFC] px-5 py-4 transition hover:border-[#E8A0A8] hover:bg-[#FDF8F6]">
                                        <input type="radio"
                                               wire:model.live="answers.{{ $question->id }}"
                                               value="{{ $option->text }}"
                                               class="border-[#C0392B] text-[#C0392B] focus:ring-[#C0392B]">
                                        <span class="text-base text-[#4A3050] transition group-hover:text-[#1C1020]">
                                            {{ $option->text }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </article>
                    @endforeach

                    <div class="flex flex-col gap-4 border-t border-[#F0DDE0] pt-6 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center gap-4">
                            <div class="h-2.5 w-56 overflow-hidden rounded-full bg-[#F0DDE0]">
                                <div class="h-full rounded-full bg-[linear-gradient(90deg,#C0392B,#E8A0A8)]"
                                     style="width: {{ $quiz->questions->count() ? (count($answers) / $quiz->questions->count()) * 100 : 0 }}%">
                                </div>
                            </div>

                            <span class="text-sm font-medium text-[#C0392B]">
                                {{ count($answers) < $quiz->questions->count() ? 'Answer all questions' : 'Ready to submit' }}
                            </span>
                        </div>

                        <button type="button"
                                wire:click="submitQuiz"
                                @if (count($answers) < $quiz->questions->count()) disabled @endif
                                class="inline-flex items-center justify-center rounded-full bg-[#1C1020] px-6 py-3 text-sm font-medium text-white transition hover:bg-[#C0392B] disabled:cursor-not-allowed disabled:opacity-40">
                            Submit Quiz
                        </button>
                    </div>
                </div>
            </section>
        @endif

        @if ($quizSubmitted)
            <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_16px_45px_rgba(192,57,43,0.07)]">
                <div class="bg-[linear-gradient(145deg,#2C2060,#3A1240)] px-6 py-7 text-white">
                    <p class="text-xs uppercase tracking-[0.22em] text-[#F4D4D9]">Quiz Result</p>
                    <h2 class="mt-3 font-[Cormorant_Garamond] text-4xl font-medium italic">
                        {{ $passed ? 'You passed' : 'Try again' }}
                    </h2>
                </div>

                <div class="space-y-7 p-6">
                    <div class="flex flex-col items-center justify-center text-center">
                        <div class="flex h-28 w-28 items-center justify-center rounded-full {{ $passed ? 'bg-[#2D8A5C]' : 'bg-[#C0392B]' }} text-4xl font-semibold text-white shadow-[0_18px_34px_rgba(192,57,43,0.18)]">
                            {{ $score }}%
                        </div>

                        <p class="mt-5 max-w-xl text-sm leading-7 text-[#8A7090]">
                            {{ $passed ? 'Beautiful work. This lesson is now complete and you can continue forward.' : 'Not quite yet. Review the corrections below and try the quiz again.' }}
                        </p>
                    </div>

                    <div class="space-y-4">
                        @foreach ($quiz->questions as $question)
                            @php
                                $userAnswer = $answers[(string) $question->id] ?? null;
                                $isCorrect = $userAnswer !== null && $question->isCorrect($userAnswer);
                            @endphp

                            <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FDF8F6] p-5">
                                <p class="font-medium text-[#1C1020]">{{ $question->question_text }}</p>

                                @if (! $isCorrect && $userAnswer)
                                    <p class="mt-3 text-sm text-[#B04352]">Your answer: {{ $userAnswer }}</p>
                                @endif

                                <p class="mt-2 text-sm text-[#2D8A5C]">Correct answer: {{ $question->correct_answer }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @if (! $passed)
                            <button type="button"
                                    wire:click="retakeQuiz"
                                    class="inline-flex items-center justify-center rounded-full border border-[#E3D0D4] px-5 py-3 text-sm font-medium text-[#4A3050] transition hover:bg-[#FDF8F6]">
                                Try Again
                            </button>
                        @endif

                        @if ($nextLesson && $passed)
                            <a href="{{ route('lesson.show', $nextLesson) }}"
                               class="inline-flex items-center justify-center rounded-full bg-[#1C1020] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#C0392B]">
                                Next Lesson
                            </a>
                        @else
                            <a href="{{ route('learning-path.show', $lesson->module->learning_path_id) }}"
                               class="inline-flex items-center justify-center rounded-full bg-[#1C1020] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#C0392B]">
                                Back to Path
                            </a>
                        @endif
                    </div>
                </div>
            </section>
        @endif
    @else
        <div class="flex flex-wrap gap-3">
            @if (! $isCompleted)
                <button type="button"
                        wire:click="markDone"
                        class="inline-flex items-center justify-center rounded-full bg-[#1C1020] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#C0392B]">
                    Mark as Complete
                </button>
            @else
                @if ($nextLesson)
                    <a href="{{ route('lesson.show', $nextLesson) }}"
                       class="inline-flex items-center justify-center rounded-full bg-[#1C1020] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#C0392B]">
                        Next Lesson
                    </a>
                @else
                    <a href="{{ route('learning-path.show', $lesson->module->learning_path_id) }}"
                       class="inline-flex items-center justify-center rounded-full border border-[#E3D0D4] px-5 py-3 text-sm font-medium text-[#4A3050] transition hover:bg-[#FDF8F6]">
                        Back to Path
                    </a>
                @endif
            @endif
        </div>
    @endif

    <div class="flex justify-between border-t border-[#F0DDE0] pt-6">
        <div>
            @if ($prevLesson)
                <a href="{{ route('lesson.show', $prevLesson) }}"
                   class="text-sm font-medium text-[#C0392B] hover:text-[#A62F24]">
                    ← {{ $prevLesson->title }}
                </a>
            @endif
        </div>

        <div>
            @if ($nextLesson)
                <a href="{{ route('lesson.show', $nextLesson) }}"
                   class="text-sm font-medium text-[#C0392B] hover:text-[#A62F24]">
                    {{ $nextLesson->title }} →
                </a>
            @endif
        </div>
    </div>

</div>