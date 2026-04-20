<div class="space-y-6 font-[Jost]">
    @if (session()->has('success'))
        <div class="rounded-[1.3rem] border border-[#C5E7D5] bg-[#EBF7F1] px-5 py-4 text-[#2D8A5C]">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-[1.6rem] border border-[#E8D7DB] bg-[#FDF8F6] p-6">
        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Quiz</p>
        <div class="mt-3 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h3 class="font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">{{ $quiz->title }}</h3>
                <p class="mt-2 text-sm text-[#8A7090]">
                    {{ $questions->count() }} question{{ $questions->count() !== 1 ? 's' : '' }}
                </p>
            </div>

            <button wire:click="create"
                class="inline-flex items-center justify-center rounded-[1.3rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white transition hover:-translate-y-0.5">
                + New Question
            </button>
        </div>
    </div>

    <div class="space-y-4">
        @forelse ($questions as $question)
            <div class="overflow-hidden rounded-[1.6rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_12px_32px_rgba(192,57,43,0.06)]">
                <div class="border-b border-[#E8D7DB] bg-[#FFFDFC] px-5 py-5">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-3xl">
                            <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Question</p>
                            <h4 class="mt-3 text-xl font-medium text-[#1C1020]">{{ $question->question_text }}</h4>
                            <p class="mt-2 text-sm text-[#8A7090]">
                                {{ $question->options_count }} option{{ $question->options_count !== 1 ? 's' : '' }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <button wire:click="edit({{ $question->id }})"
                                class="rounded-[1.3rem] border border-[#F2D3AE] bg-[#FFF7ED] px-4 py-2 text-sm font-medium text-[#A56A33]">
                                Edit
                            </button>

                            <button wire:click="$set('managingOptionsFor', {{ $question->id }})"
                                class="rounded-[1.3rem] border border-[#E8C7CD] bg-[#FAEAEA] px-4 py-2 text-sm font-medium text-[#A62F24]">
                                Options
                            </button>

                            <button wire:click="delete({{ $question->id }})"
                                class="rounded-[1.3rem] border border-[#F5CDD2] bg-[#FEF2F3] px-4 py-2 text-sm font-medium text-[#B04352]">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <div class="px-5 py-5">
                    @if ($question->options->count())
                        <div class="grid gap-3 md:grid-cols-2">
                            @foreach ($question->options as $option)
                                <div class="rounded-[1.25rem] border {{ $option->is_correct ? 'border-[#C5E7D5] bg-[#EBF7F1]' : 'border-[#E8D7DB] bg-[#FDF8F6]' }} px-4 py-4">
                                    <div class="flex items-center justify-between gap-4">
                                        <span class="{{ $option->is_correct ? 'text-[#2D8A5C]' : 'text-[#4A3050]' }}">
                                            {{ $option->text }}
                                        </span>

                                        @if ($option->is_correct)
                                            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-[#2D8A5C]">
                                                Correct
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-[#A58A99]">No options added yet.</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FFFCFA] px-6 py-14 text-center text-[#A58A99]">
                No questions found for this quiz.
            </div>
        @endforelse
    </div>

    @if ($showFormModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#1C1020]/45 p-4">
            <div class="w-full max-w-2xl overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_24px_60px_rgba(28,16,32,0.28)]">
                <div class="flex items-center justify-between border-b border-[#E8D7DB] bg-[#FDF8F6] px-6 py-5">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Question editor</p>
                        <h4 class="mt-2 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
                            {{ $editingId ? 'Edit Question' : 'Create Question' }}
                        </h4>
                    </div>

                    <button wire:click="closeFormModal"
                        class="flex h-11 w-11 items-center justify-center rounded-[1.3rem] bg-[#F7F0EA] text-[#8A7090] transition hover:bg-[#EEDFE2]">
                        ✕
                    </button>
                </div>

                <div class="p-6">
                    <livewire:admin.questions.question-form
                        :quizId="$quizId"
                        :questionId="$editingId"
                        :key="'question-form-' . ($editingId ?? 'new')" />
                </div>
            </div>
        </div>
    @endif

    @if ($managingOptionsFor)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#1C1020]/45 p-4">
            <div class="w-full max-w-3xl overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_24px_60px_rgba(28,16,32,0.28)]">
                <div class="flex items-center justify-between border-b border-[#E8D7DB] bg-[#FDF8F6] px-6 py-5">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Options manager</p>
                        <h4 class="mt-2 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
                            Manage Options
                        </h4>
                    </div>

                    <button wire:click="$set('managingOptionsFor', null)"
                        class="flex h-11 w-11 items-center justify-center rounded-[1.3rem] bg-[#F7F0EA] text-[#8A7090] transition hover:bg-[#EEDFE2]">
                        ✕
                    </button>
                </div>

                <div class="p-6 max-h-[80vh] overflow-y-auto">
                    <livewire:admin.options.option-manager
                        :questionId="$managingOptionsFor"
                        :key="'option-manager-' . $managingOptionsFor" />
                </div>
            </div>
        </div>
    @endif
</div>