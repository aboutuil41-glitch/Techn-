<div class="space-y-6 font-[Jost]">
    @if (session()->has('success'))
        <div class="rounded-[1.3rem] border border-[#C5E7D5] bg-[#EBF7F1] px-5 py-4 text-[#2D8A5C]">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_16px_42px_rgba(192,57,43,0.07)]">
        <div class="flex flex-col gap-5 border-b border-[#E8D7DB] bg-[#FDF8F6] px-6 py-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Assessment</p>
                <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium tracking-tight text-[#1C1020]">Quizzes</h3>
                <p class="mt-2 text-sm text-[#8A7090]">Manage quiz difficulty, structure, and lesson mapping.</p>
            </div>

            <button wire:click="create"
                class="inline-flex items-center justify-center rounded-[1.3rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white transition hover:-translate-y-0.5">
                + New Quiz
            </button>
        </div>

        <div class="p-6">
            <div class="mb-6 grid gap-4 lg:grid-cols-3">
                <div class="relative lg:col-span-2">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#A58A99]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"/>
                        </svg>
                    </span>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search quizzes..."
                        class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] py-3 pl-12 pr-4 text-[#2E1C30] placeholder:text-[#A58A99] focus:border-[#C0392B] focus:ring-0"
                    >
                </div>

                <select
                    wire:model.live="lessonFilter"
                    class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] focus:border-[#C0392B] focus:ring-0"
                >
                    <option value="">All Lessons</option>
                    @foreach ($lessons as $lesson)
                        <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-4">
                @forelse ($quizzes as $quiz)
                    <div class="rounded-[1.55rem] border border-[#E8D7DB] bg-[#FFFDFC] p-5 shadow-[0_8px_24px_rgba(192,57,43,0.04)] transition hover:shadow-[0_14px_30px_rgba(192,57,43,0.08)]">
                        <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                            <div class="max-w-2xl">
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="rounded-full bg-[#FAEAEA] px-3 py-1 text-[11px] font-medium uppercase tracking-[0.14em] text-[#A62F24]">
                                        Quiz
                                    </span>
                                    <span class="rounded-full bg-[#EBF7F1] px-3 py-1 text-[11px] font-medium uppercase tracking-[0.14em] text-[#2D8A5C]">
                                        {{ $quiz->passing_score }}% pass
                                    </span>
                                </div>

                                <h4 class="mt-4 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">{{ $quiz->title }}</h4>

                                <div class="mt-4 flex flex-wrap items-center gap-3 text-sm text-[#8A7090]">
                                    <span>Lesson: <span class="font-medium text-[#4A3050]">{{ $quiz->lesson->title ?? '—' }}</span></span>
                                    <span>•</span>
                                    <span>{{ $quiz->questions_count }} question{{ $quiz->questions_count !== 1 ? 's' : '' }}</span>
                                    <span>•</span>
                                    <span>{{ $quiz->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <button wire:click="edit({{ $quiz->id }})"
                                    class="rounded-[1.3rem] border border-[#F2D3AE] bg-[#FFF7ED] px-4 py-2 text-sm font-medium text-[#A56A33] transition hover:bg-[#FCEBCC]">
                                    Edit
                                </button>

                                <button wire:click="$set('managingQuestionsFor', {{ $quiz->id }})"
                                    class="rounded-[1.3rem] border border-[#E8C7CD] bg-[#FAEAEA] px-4 py-2 text-sm font-medium text-[#A62F24] transition hover:bg-[#F4D4D9]">
                                    Questions
                                </button>

                                <button wire:click="delete({{ $quiz->id }})"
                                    class="rounded-[1.3rem] border border-[#F5CDD2] bg-[#FEF2F3] px-4 py-2 text-sm font-medium text-[#B04352] transition hover:bg-[#FBE1E5]">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FFFDFC] px-6 py-14 text-center text-[#A58A99]">
                        No quizzes found.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#1C1020]/45 p-4">
            <div class="w-full max-w-2xl overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_24px_60px_rgba(28,16,32,0.28)]">
                <div class="flex items-center justify-between border-b border-[#E8D7DB] bg-[#FDF8F6] px-6 py-5">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Editor</p>
                        <h4 class="mt-2 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
                            {{ $editingId ? 'Edit Quiz' : 'Create Quiz' }}
                        </h4>
                    </div>

                    <button wire:click="closeModal"
                        class="flex h-11 w-11 items-center justify-center rounded-[1.3rem] bg-[#F7F0EA] text-[#8A7090] transition hover:bg-[#EEDFE2]">
                        ✕
                    </button>
                </div>

                <div class="p-6">
                    <livewire:admin.quizzes.quiz-form
                        :quizId="$editingId"
                        :key="'quiz-form-' . ($editingId ?? 'new')" />
                </div>
            </div>
        </div>
    @endif

    @if ($managingQuestionsFor)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#1C1020]/45 p-4">
            <div class="w-full max-w-6xl overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_24px_60px_rgba(28,16,32,0.28)]">
                <div class="flex items-center justify-between border-b border-[#E8D7DB] bg-[#FDF8F6] px-6 py-5">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Question manager</p>
                        <h4 class="mt-2 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
                            Manage Questions
                        </h4>
                    </div>

                    <button wire:click="$set('managingQuestionsFor', null)"
                        class="flex h-11 w-11 items-center justify-center rounded-[1.3rem] bg-[#F7F0EA] text-[#8A7090] transition hover:bg-[#EEDFE2]">
                        ✕
                    </button>
                </div>

                <div class="p-6 max-h-[80vh] overflow-y-auto">
                    <livewire:admin.questions.question-index
                        :quizId="$managingQuestionsFor"
                        :key="'question-index-' . $managingQuestionsFor" />
                </div>
            </div>
        </div>
    @endif
</div>