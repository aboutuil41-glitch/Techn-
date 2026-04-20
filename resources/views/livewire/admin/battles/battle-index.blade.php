<div class="space-y-6 font-[Jost]">
    @if (session()->has('success'))
        <div class="rounded-[1.3rem] border border-[#C5E7D5] bg-[#EBF7F1] px-5 py-4 text-[#2D8A5C]">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-[1.6rem] border border-[#E8D7DB] bg-[#FDF8F6] p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Art Battles</p>
                <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">Manage Battles</h3>
                <p class="mt-2 text-sm text-[#8A7090]">
                    {{ $battles->total() }} battle{{ $battles->total() !== 1 ? 's' : '' }} found
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Search battles..."
                    class="rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] focus:border-[#C0392B] focus:ring-0"
                >

                <button
                    wire:click="create"
                    class="inline-flex items-center justify-center rounded-[1.3rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white transition hover:-translate-y-0.5"
                >
                    + New Battle
                </button>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        @forelse ($battles as $battle)
            <div class="overflow-hidden rounded-[1.6rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_12px_32px_rgba(192,57,43,0.06)]">
                <div class="border-b border-[#E8D7DB] bg-[#FFFDFC] px-5 py-5">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-3xl">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="rounded-full
                                    @if($battle->status === 'active') bg-emerald-100 text-[#2D8A5C]
                                    @elseif($battle->status === 'finished') bg-rose-100 text-[#B04352]
                                    @else bg-amber-100 text-[#A56A33]
                                    @endif
                                    px-3 py-1 text-xs font-medium uppercase tracking-[0.14em]">
                                    {{ ucfirst($battle->status) }}
                                </span>

                                <span class="rounded-full bg-[#F7F0EA] px-3 py-1 text-xs font-medium text-[#8A7090]">
                                    {{ $battle->submissions_count }} submission{{ $battle->submissions_count !== 1 ? 's' : '' }}
                                </span>
                            </div>

                            <h4 class="mt-4 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">{{ $battle->theme }}</h4>
                            <p class="mt-3 text-sm leading-7 text-[#67516C]">
                                {{ $battle->description ?: 'No description added.' }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <button
                                wire:click="edit({{ $battle->id }})"
                                class="rounded-[1.3rem] border border-[#F2D3AE] bg-[#FFF7ED] px-4 py-2 text-sm font-medium text-[#A56A33]"
                            >
                                Edit
                            </button>

                            <button
                                wire:click="delete({{ $battle->id }})"
                                class="rounded-[1.3rem] border border-[#F5CDD2] bg-[#FEF2F3] px-4 py-2 text-sm font-medium text-[#B04352]"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4 px-5 py-5 md:grid-cols-3">
                    <div class="rounded-[1.3rem] border border-[#E8D7DB] bg-[#FDF8F6] px-4 py-4">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Starts</p>
                        <p class="mt-2 text-sm text-[#4A3050]">{{ $battle->start_time }}</p>
                    </div>

                    <div class="rounded-[1.3rem] border border-[#E8D7DB] bg-[#FDF8F6] px-4 py-4">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Ends</p>
                        <p class="mt-2 text-sm text-[#4A3050]">{{ $battle->end_time }}</p>
                    </div>

                    <div class="rounded-[1.3rem] border border-[#E8D7DB] bg-[#FDF8F6] px-4 py-4">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Description</p>
                        <p class="mt-2 text-sm text-[#4A3050]">
                            {{ $battle->description ?: 'No description added.' }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FFFCFA] px-6 py-14 text-center text-[#A58A99]">
                No battles found.
            </div>
        @endforelse
    </div>

    <div>
        {{ $battles->links() }}
    </div>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#1C1020]/45 p-4">
            <div class="w-full max-w-2xl overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_24px_60px_rgba(28,16,32,0.28)]">
                <div class="flex items-center justify-between border-b border-[#E8D7DB] bg-[#FDF8F6] px-6 py-5">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Battle editor</p>
                        <h4 class="mt-2 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
                            {{ $editingId ? 'Edit Battle' : 'Create Battle' }}
                        </h4>
                    </div>

                    <button
                        wire:click="closeModal"
                        class="flex h-11 w-11 items-center justify-center rounded-[1.3rem] bg-[#F7F0EA] text-[#8A7090] transition hover:bg-[#EEDFE2]"
                    >
                        ✕
                    </button>
                </div>

                <div class="p-6">
                    <livewire:admin.battles.battle-form
                        :battleId="$editingId"
                        :key="'battle-form-' . ($editingId ?? 'new')" />
                </div>
            </div>
        </div>
    @endif
</div>