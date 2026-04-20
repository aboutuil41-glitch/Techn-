<form wire:submit="save" class="space-y-6 font-[Jost]">
    <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FDF8F6] p-5">
        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Learning Path</p>
        <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
            {{ $pathId ? 'Edit Path' : 'Create Path' }}
        </h3>
        <p class="mt-2 text-sm text-[#8A7090]">Set the title, description, and visual identity of this path.</p>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Path Name</label>
        <input
            type="text"
            wire:model="name"
            placeholder="Enter path name..."
            class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] focus:border-[#C0392B] focus:ring-0"
        >
        @error('name') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Description</label>
        <textarea
            wire:model="description"
            rows="5"
            placeholder="Enter description..."
            class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] focus:border-[#C0392B] focus:ring-0"
        ></textarea>
        @error('description') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Thumbnail</label>
        <input
            type="file"
            wire:model="thumbnail"
            class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] focus:border-[#C0392B] focus:ring-0"
        >
        @error('thumbnail') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
    </div>

    @if ($thumbnail)
        <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FDF8F6] p-4">
            <p class="mb-3 text-sm font-medium text-[#4A3050]">Preview</p>
            <img src="{{ $thumbnail->temporaryUrl() }}" class="h-48 w-full rounded-[1.4rem] object-cover">
        </div>
    @elseif ($existingThumbnail)
        <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FDF8F6] p-4">
            <p class="mb-3 text-sm font-medium text-[#4A3050]">Current Thumbnail</p>
            <img src="{{ asset('storage/' . $existingThumbnail) }}" class="h-48 w-full rounded-[1.4rem] object-cover">
        </div>
    @endif

    <div class="flex items-center justify-end gap-3 border-t border-[#E8D7DB] pt-5">
        <button
            type="submit"
            class="inline-flex items-center justify-center rounded-[1.3rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white transition hover:-translate-y-0.5"
        >
            {{ $pathId ? 'Update Path' : 'Create Path' }}
        </button>
    </div>
</form>