<form wire:submit="save" class="space-y-6 font-[Jost]">
    <div class="rounded-[1.55rem] border border-[#E8D7DB] bg-[linear-gradient(180deg,#FDF8F6,#FFFDFC)] p-5 shadow-[0_8px_24px_rgba(192,57,43,0.04)]">
        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Module</p>
        <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
            {{ $moduleId ? 'Edit Module' : 'Create Module' }}
        </h3>
        <p class="mt-2 text-sm leading-7 text-[#8A7090]">Organize lessons within a learning path.</p>
    </div>

    <div class="grid gap-6">
        <div>
            <label class="mb-2 block text-sm font-medium text-[#4A3050]">Module Title</label>
            <input
                type="text"
                wire:model="title"
                placeholder="Enter module title"
                class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] shadow-sm focus:border-[#C0392B] focus:ring-0"
            >
            @error('title') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-[#4A3050]">Learning Path</label>
            <select
                wire:model="learning_path_id"
                class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 text-[#2E1C30] shadow-sm focus:border-[#C0392B] focus:ring-0"
            >
                <option value="">Select a path</option>
                @foreach ($paths as $path)
                    <option value="{{ $path->id }}">{{ $path->name }}</option>
                @endforeach
            </select>
            @error('learning_path_id') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-[#4A3050]">Description</label>
            <textarea
                wire:model="description"
                rows="6"
                placeholder="Write a short description for this module..."
                class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] shadow-sm focus:border-[#C0392B] focus:ring-0"
            ></textarea>
            @error('description') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="flex items-center justify-end gap-3 border-t border-[#E8D7DB] pt-5">
        <button
            type="submit"
            class="inline-flex items-center justify-center rounded-[1.35rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white shadow-[0_10px_22px_rgba(192,57,43,0.18)] transition hover:-translate-y-0.5"
        >
            {{ $moduleId ? 'Update Module' : 'Create Module' }}
        </button>
    </div>
</form>