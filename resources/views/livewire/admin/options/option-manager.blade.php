<div class="space-y-6 font-[Jost]">
    <div class="rounded-[1.55rem] border border-[#E8D7DB] bg-[linear-gradient(180deg,#FDF8F6,#FFFDFC)] p-5 shadow-[0_8px_24px_rgba(192,57,43,0.04)]">
        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Question</p>
        <h3 class="mt-3 text-xl font-medium text-[#1C1020]">{{ $question->question_text }}</h3>
        <p class="mt-2 text-sm leading-7 text-[#8A7090]">
            Add answer choices and mark exactly one as correct.
        </p>
    </div>

    <form wire:submit="save" class="space-y-5 rounded-[1.6rem] border border-[#E8D7DB] bg-[#FFFCFA] p-5 shadow-[0_12px_32px_rgba(192,57,43,0.06)]">
        <div>
            <label class="mb-2 block text-sm font-medium text-[#4A3050]">Option Text</label>
            <input
                type="text"
                wire:model="text"
                placeholder="Enter option text"
                class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] shadow-sm focus:border-[#C0392B] focus:ring-0"
            >
            @error('text') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-3 rounded-[1.35rem] border border-[#E8D7DB] bg-[#FDF8F6] px-4 py-4 text-[#4A3050]">
            <input type="checkbox" wire:model="is_correct" class="rounded border-[#E3D0D4] text-[#C0392B] focus:ring-[#C0392B]">
            <span>Mark this as the correct answer</span>
        </label>

        <div class="flex items-center justify-end gap-3 border-t border-[#E8D7DB] pt-5">
            @if ($editingId)
                <button type="button" wire:click="resetForm"
                    class="rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFCFA] px-5 py-3 font-medium text-[#67516C] transition hover:bg-[#FDF8F6]">
                    Cancel
                </button>
            @endif

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-[1.35rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white shadow-[0_10px_22px_rgba(192,57,43,0.18)] transition hover:-translate-y-0.5"
            >
                {{ $editingId ? 'Update Option' : 'Add Option' }}
            </button>
        </div>
    </form>

    <div class="overflow-hidden rounded-[1.6rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_12px_32px_rgba(192,57,43,0.06)]">
        <div class="border-b border-[#E8D7DB] bg-[#FFFDFC] px-5 py-4">
            <h4 class="text-lg font-medium text-[#1C1020]">Options</h4>
        </div>

        <div class="divide-y divide-[#F1E5E8]">
            @forelse ($options as $option)
                <div class="flex flex-col gap-4 px-5 py-4 md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-[1.2rem] border {{ $option->is_correct ? 'border-[#C5E7D5] bg-[#EBF7F1]' : 'border-[#E8D7DB] bg-[#FDF8F6]' }}">
                            @if ($option->is_correct)
                                <span class="text-[#2D8A5C]">✓</span>
                            @else
                                <span class="text-[#A58A99]">•</span>
                            @endif
                        </div>

                        <div>
                            <div class="{{ $option->is_correct ? 'text-[#2D8A5C]' : 'text-[#4A3050]' }}">
                                {{ $option->text }}
                            </div>
                            <div class="text-xs text-[#A58A99]">
                                {{ $option->is_correct ? 'Correct answer' : 'Regular option' }}
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button wire:click="edit({{ $option->id }})"
                            class="rounded-[1.25rem] border border-[#F2D3AE] bg-[#FFF7ED] px-4 py-2 text-sm font-medium text-[#A56A33] transition hover:bg-[#FCEBCC]">
                            Edit
                        </button>

                        <button wire:click="delete({{ $option->id }})"
                            class="rounded-[1.25rem] border border-[#F5CDD2] bg-[#FEF2F3] px-4 py-2 text-sm font-medium text-[#B04352] transition hover:bg-[#FBE1E5]">
                            Delete
                        </button>
                    </div>
                </div>
            @empty
                <div class="px-5 py-12 text-center text-[#A58A99]">
                    No options added yet.
                </div>
            @endforelse
        </div>
    </div>
</div>