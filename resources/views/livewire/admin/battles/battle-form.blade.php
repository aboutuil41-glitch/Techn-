<form wire:submit="save" class="space-y-6 font-[Jost]">
    <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FDF8F6] p-5">
        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Battle</p>
        <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
            {{ $battleId ? 'Edit Battle' : 'Create Battle' }}
        </h3>
        <p class="mt-2 text-sm text-[#8A7090]">Set the theme, timing, and status of the challenge.</p>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Theme</label>
        <input
            type="text"
            wire:model="theme"
            placeholder="Enter battle theme..."
            class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] focus:border-[#C0392B] focus:ring-0"
        >
        @error('theme') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Description</label>
        <textarea
            wire:model="description"
            rows="5"
            placeholder="Enter a short description..."
            class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] focus:border-[#C0392B] focus:ring-0"
        ></textarea>
        @error('description') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-[#4A3050]">Start Time</label>
            <input
                type="datetime-local"
                wire:model="start_time"
                class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] focus:border-[#C0392B] focus:ring-0"
            >
            @error('start_time') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-[#4A3050]">End Time</label>
            <input
                type="datetime-local"
                wire:model="end_time"
                class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] focus:border-[#C0392B] focus:ring-0"
            >
            @error('end_time') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Status</label>
        <select
            wire:model="status"
            class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] focus:border-[#C0392B] focus:ring-0"
        >
            <option value="upcoming">Upcoming</option>
            <option value="active">Active</option>
            <option value="finished">Finished</option>
        </select>
        @error('status') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center justify-end gap-3 border-t border-[#E8D7DB] pt-5">
        <button
            type="submit"
            class="inline-flex items-center justify-center rounded-[1.3rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white transition hover:-translate-y-0.5"
        >
            {{ $battleId ? 'Update Battle' : 'Create Battle' }}
        </button>
    </div>
</form>