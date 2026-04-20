<form wire:submit.prevent="save" class="space-y-6 font-[Jost]">
    <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FDF8F6] p-5">
        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Lesson</p>
        <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
            {{ $lessonId ? 'Edit Lesson' : 'Create Lesson' }}
        </h3>
        <p class="mt-2 text-sm text-[#8A7090]">Add lesson content, module mapping, and media.</p>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Lesson Title</label>
        <input
            type="text"
            wire:model="title"
            class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] focus:border-[#C0392B] focus:ring-0"
        >
        @error('title')
            <p class="mt-2 text-sm text-[#C0392B]">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Module</label>
        <select wire:model="module_id" class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] focus:border-[#C0392B] focus:ring-0">
            <option value="">Select a module</option>
            @foreach ($modules as $module)
                <option value="{{ $module->id }}">{{ $module->title }}</option>
            @endforeach
        </select>
        @error('module_id')
            <p class="mt-2 text-sm text-[#C0392B]">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Content</label>
        <textarea
            wire:model="content"
            rows="8"
            class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] focus:border-[#C0392B] focus:ring-0"
        ></textarea>
        @error('content')
            <p class="mt-2 text-sm text-[#C0392B]">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Lesson Video (MP4)</label>
        <input
            type="file"
            wire:model="video"
            accept="video/mp4"
            class="w-full rounded-[1.35rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3"
        >

        <div wire:loading wire:target="video" class="mt-2 text-sm text-[#8A7090]">
            Uploading...
        </div>

        @error('video')
            <p class="mt-2 text-sm text-[#C0392B]">{{ $message }}</p>
        @enderror

        @if ($existingVideoPath)
            <div class="mt-4 rounded-[1.5rem] border border-[#E8D7DB] bg-[#FDF8F6] p-4">
                <p class="mb-3 text-sm text-[#67516C]">Current video</p>
                <video controls class="w-full rounded-[1.35rem] border border-[#E8D7DB]">
                    <source src="{{ asset('storage/' . $existingVideoPath) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif
    </div>

    <div class="border-t border-[#E8D7DB] pt-5">
        <button
            type="submit"
            class="inline-flex items-center justify-center rounded-[1.3rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white transition hover:-translate-y-0.5"
        >
            {{ $lessonId ? 'Update Lesson' : 'Create Lesson' }}
        </button>
    </div>
</form>