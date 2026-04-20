<div class="space-y-8 font-[Jost]">

    <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_20px_50px_rgba(192,57,43,0.08)]">
        <div class="relative bg-[linear-gradient(145deg,#2C2060_0%,#3D1C5C_45%,#5A1C3C_100%)] px-6 py-12 text-white lg:px-10">
            <div class="absolute right-0 top-0 h-full w-1/3 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.12),transparent_60%)]"></div>

            <div class="relative max-w-3xl">
                <p class="text-xs uppercase tracking-[0.22em] text-[#F4D4D9]">Technē Battles</p>
                <h1 class="mt-3 font-[Cormorant_Garamond] text-5xl font-medium tracking-tight lg:text-6xl">
                    Creative Art Challenges
                </h1>
                <p class="mt-4 text-sm leading-7 text-white/72 lg:text-base">
                    Practice what you learn through themed battles, showcase your creativity, and explore the work of the community.
                </p>
            </div>
        </div>
    </section>

    <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($battles as $battle)
            <a href="{{ route('battles.show', $battle) }}"
               class="group block overflow-hidden rounded-[1.85rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_14px_40px_rgba(192,57,43,0.06)] transition hover:-translate-y-1.5 hover:shadow-[0_24px_55px_rgba(192,57,43,0.12)]">
                <div class="border-b border-[#EFE1E4] bg-[#FDF8F6] px-6 py-5">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Theme</p>
                            <h3 class="mt-3 font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020] transition group-hover:text-[#A62F24]">
                                {{ $battle->theme }}
                            </h3>
                        </div>

                        <span class="rounded-full px-3 py-1 text-xs font-semibold
                            @if($battle->status === 'active') bg-emerald-100 text-[#2D8A5C]
                            @elseif($battle->status === 'finished') bg-rose-100 text-[#B04352]
                            @else bg-amber-100 text-[#A56A33]
                            @endif">
                            {{ ucfirst($battle->status) }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <p class="min-h-[84px] text-sm leading-7 text-[#8A7090]">
                        {{ $battle->description ?: 'No description added for this battle yet.' }}
                    </p>

                    <div class="mt-6 grid gap-3">
                        <div class="rounded-[1.35rem] border border-[#E8D7DB] bg-[#FFFDFC] p-4">
                            <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Starts</p>
                            <p class="mt-2 text-sm font-medium leading-6 text-[#4A3050]">
                                {{ \Carbon\Carbon::parse($battle->start_time)->format('M d, Y - H:i') }}
                            </p>
                        </div>

                        <div class="rounded-[1.35rem] border border-[#E8D7DB] bg-[#FFFDFC] p-4">
                            <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Ends</p>
                            <p class="mt-2 text-sm font-medium leading-6 text-[#4A3050]">
                                {{ \Carbon\Carbon::parse($battle->end_time)->format('M d, Y - H:i') }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between rounded-[1.35rem] border border-[#F0DDE0] bg-[#FAEAEA] p-4">
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.18em] text-[#D97786]">Submissions</p>
                                <p class="mt-2 text-sm font-semibold text-[#A62F24]">
                                    {{ $battle->submissions_count }} submission{{ $battle->submissions_count !== 1 ? 's' : '' }}
                                </p>
                            </div>

                            <span class="text-sm font-medium text-[#C0392B]">Enter →</span>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full rounded-[1.9rem] border border-[#E8D7DB] bg-[#FFFCFA] px-6 py-16 text-center shadow-[0_14px_40px_rgba(192,57,43,0.06)]">
                <p class="font-[Cormorant_Garamond] text-3xl font-medium text-[#8A7090]">
                    No battles found.
                </p>
            </div>
        @endforelse
    </section>

</div>