<div class="space-y-8 font-[Jost]">

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($stats as $label => $value)
            <div class="group relative overflow-hidden rounded-[1.7rem] border border-[#E8D7DB] bg-[#FFFCFA] p-6 shadow-[0_14px_38px_rgba(192,57,43,0.06)] transition hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(192,57,43,0.10)]">
                <div class="absolute -right-5 -top-5 h-20 w-20 rounded-full bg-[#FAEAEA] blur-2xl"></div>

                <div class="relative flex items-start justify-between">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#A58A99]">{{ $label }}</p>
                        <h3 class="mt-4 font-[Cormorant_Garamond] text-5xl font-medium tracking-tight text-[#1C1020]">
                            {{ number_format($value) }}
                        </h3>
                    </div>

                    <div class="rounded-full border border-[#E8D7DB] bg-[#FDF8F6] px-3 py-1.5 text-[11px] font-medium uppercase tracking-[0.14em] text-[#8A7090]">
                        Live
                    </div>
                </div>

                <div class="mt-6 h-2.5 w-full overflow-hidden rounded-full bg-[#F0DDE0]">
                    <div class="h-full w-2/3 rounded-full bg-[linear-gradient(90deg,#C0392B,#E8A0A8)]"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_16px_42px_rgba(192,57,43,0.07)]">
        <div class="flex flex-col gap-4 border-b border-[#E8D7DB] bg-[#FDF8F6] px-6 py-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#A58A99]">Recent activity</p>
                <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium tracking-tight text-[#1C1020]">Latest Learning Paths</h3>
                <p class="mt-2 text-sm text-[#8A7090]">Recently created paths and their module counts.</p>
            </div>

            <div class="rounded-[1.3rem] border border-[#E8D7DB] bg-[#FFFDFC] px-4 py-3 text-sm text-[#67516C]">
                {{ $recentPaths->count() }} recent item{{ $recentPaths->count() !== 1 ? 's' : '' }}
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px]">
                <thead class="bg-[#FFFDFC]">
                    <tr class="border-b border-[#E8D7DB] text-left">
                        <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#A58A99]">Path</th>
                        <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#A58A99]">Modules</th>
                        <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#A58A99]">Creator</th>
                        <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#A58A99]">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentPaths as $path)
                        <tr class="border-b border-[#F5E8EA] text-[#4A3050] transition hover:bg-[#FDF8F6]">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-[1.2rem] border border-[#E8D7DB] bg-[#F7F0EA] text-lg text-[#C0392B]/60">
                                        ✿
                                    </div>
                                    <div>
                                        <div class="font-medium text-[#1C1020]">{{ $path->name }}</div>
                                        <div class="text-xs text-[#A58A99]">Learning path</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="rounded-full bg-[#FAEAEA] px-3 py-1 text-xs font-medium text-[#A62F24]">
                                    {{ $path->modules_count }} module{{ $path->modules_count !== 1 ? 's' : '' }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-[#67516C]">
                                {{ $path->creator->name ?? '—' }}
                            </td>

                            <td class="px-6 py-4 text-sm text-[#8A7090]">
                                {{ $path->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-14 text-center text-[#A58A99]">
                                No recent learning paths found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>