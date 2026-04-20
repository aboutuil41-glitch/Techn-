<div class="space-y-6 font-[Jost]">
    @if (session()->has('success'))
        <div class="rounded-[1.3rem] border border-[#C5E7D5] bg-[#EBF7F1] px-5 py-4 text-[#2D8A5C]">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_16px_42px_rgba(192,57,43,0.07)]">
        <div class="flex flex-col gap-5 border-b border-[#E8D7DB] bg-[#FDF8F6] px-6 py-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Collection</p>
                <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium tracking-tight text-[#1C1020]">Learning Paths</h3>
                <p class="mt-2 text-sm text-[#8A7090]">Create, search, and manage all learning paths.</p>
            </div>

            <button wire:click="create"
                class="inline-flex items-center justify-center rounded-[1.3rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-5 py-3 font-medium text-white transition hover:-translate-y-0.5">
                + New Path
            </button>
        </div>

        <div class="p-6">
            <div class="mb-6 grid gap-4 lg:grid-cols-[1fr_auto]">
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#A58A99]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"/>
                        </svg>
                    </span>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search learning paths..."
                        class="w-full rounded-[1.3rem] border border-[#E3D0D4] bg-[#FFFCFA] py-3 pl-12 pr-4 text-[#2E1C30] placeholder:text-[#A58A99] focus:border-[#C0392B] focus:ring-0"
                    >
                </div>

                <div class="rounded-[1.3rem] border border-[#E8D7DB] bg-[#FFFDFC] px-4 py-3 text-sm text-[#67516C]">
                    {{ $paths->total() }} total
                </div>
            </div>

            <div class="space-y-4">
                @forelse ($paths as $path)
                    <div class="rounded-[1.55rem] border border-[#E8D7DB] bg-[#FFFDFC] p-5 shadow-[0_8px_24px_rgba(192,57,43,0.04)]">
                        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-[1.25rem] border border-[#E8D7DB] bg-[#F7F0EA] text-lg text-[#C0392B]/60">
                                    ✿
                                </div>

                                <div class="max-w-2xl">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h4 class="font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">{{ $path->name }}</h4>
                                        <span class="rounded-full bg-[#FAEAEA] px-3 py-1 text-xs font-medium text-[#A62F24]">
                                            {{ $path->modules_count }} module{{ $path->modules_count !== 1 ? 's' : '' }}
                                        </span>
                                    </div>

                                    <p class="mt-3 text-sm leading-7 text-[#67516C]">
                                        {{ \Illuminate\Support\Str::limit($path->description ?: 'No description yet.', 120) }}
                                    </p>

                                    <p class="mt-3 text-xs uppercase tracking-[0.16em] text-[#A58A99]">
                                        Created {{ $path->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <button wire:click="edit({{ $path->id }})"
                                    class="rounded-[1.3rem] border border-[#F2D3AE] bg-[#FFF7ED] px-4 py-2 text-sm font-medium text-[#A56A33] transition hover:bg-[#FCEBCC]">
                                    Edit
                                </button>

                                <button wire:click="delete({{ $path->id }})"
                                    class="rounded-[1.3rem] border border-[#F5CDD2] bg-[#FEF2F3] px-4 py-2 text-sm font-medium text-[#B04352] transition hover:bg-[#FBE1E5]">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FFFDFC] px-6 py-14 text-center text-[#A58A99]">
                        No learning paths found.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $paths->links() }}
            </div>
        </div>
    </div>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#1C1020]/45 p-4">
            <div class="w-full max-w-2xl overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_24px_60px_rgba(28,16,32,0.28)]">
                <div class="flex items-center justify-between border-b border-[#E8D7DB] bg-[#FDF8F6] px-6 py-5">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Path editor</p>
                        <h4 class="mt-2 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
                            {{ $editingId ? 'Edit Path' : 'Create Path' }}
                        </h4>
                    </div>

                    <button wire:click="closeModal"
                        class="flex h-11 w-11 items-center justify-center rounded-[1.3rem] bg-[#F7F0EA] text-[#8A7090] transition hover:bg-[#EEDFE2]">
                        ✕
                    </button>
                </div>

                <div class="p-6">
                    <livewire:admin.paths.path-form
                        :pathId="$editingId"
                        :key="'path-form-' . ($editingId ?? 'new')" />
                </div>
            </div>
        </div>
    @endif
</div>