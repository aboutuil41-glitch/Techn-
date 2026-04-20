<form wire:submit="save" class="space-y-6 font-[Jost]">
    <div class="rounded-[1.55rem] border border-[#E8D7DB] bg-[linear-gradient(180deg,#FDF8F6,#FFFDFC)] p-5 shadow-[0_8px_24px_rgba(192,57,43,0.04)]">
        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Assessment</p>
        <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
            {{ $quizId ? 'Edit Quiz' : 'Create Quiz' }}
        </h3>
        <p class="mt-2 text-sm leading-7 text-[#8A7090]">Set the lesson, title, and passing score for this assessment.</p>
    </div>

    <div class="grid gap-6">
        <div>
            <label class="mb-2 block text-sm font-medium text-[#4A3050]">Quiz Title</label>
            <input
                type="text"
                wire:model="title"
                placeholder="Enter quiz title"
                class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] shadow-sm focus:border-[#C0392B] focus:ring-0"
            >
            @error('title') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-[#4A3050]">Lesson</label>
            <select
                wire:model="lesson_id"
                class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 text-[#2E1C30] shadow-sm focus:border-[#C0392B] focus:ring-0"
            >
                <option value="">Select a lesson</option>
                @foreach ($lessons as $lesson)
                    <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                @endforeach
            </select>
            @error('lesson_id') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-[#4A3050]">Passing Score</label>
            <div class="relative">
                <input
                    type="number"
                    wire:model="passing_score"
                    min="0"
                    max="100"
                    placeholder="70"
                    class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 pr-12 text-[#2E1C30] placeholder:text-[#A58A99] shadow-sm focus:border-[#C0392B] focus:ring-0"
                >
                <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-sm text-[#A58A99]">%</span>
            </div>
            @error('passing_score') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="flex items-center justify-end gap-3 border-t border-[#E8D7DB] pt-5">
        <button
            type="submit"
            class="inline-flex items-center justify-center rounded-[1.35rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white shadow-[0_10px_22px_rgba(192,57,43,0.18)] transition hover:-translate-y-0.5"
        >
            {{ $quizId ? 'Update Quiz' : 'Create Quiz' }}
        </button>
    </div>
</form>