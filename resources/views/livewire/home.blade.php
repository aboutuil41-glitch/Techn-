<div class="mx-auto max-w-7xl px-4 py-10 space-y-12 font-[Jost]">

    <section class="relative overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_30px_80px_rgba(192,57,43,0.10)]">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(232,160,168,0.24),transparent_24%),radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.12),transparent_20%)]"></div>

        <div class="relative bg-[linear-gradient(135deg,#241947_0%,#36205A_35%,#4E183F_75%,#5C1E33_100%)] px-6 py-14 text-white lg:px-10 lg:py-16">
            <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs uppercase tracking-[0.24em] text-[#F4D4D9] backdrop-blur">
                        <span class="h-2 w-2 rounded-full bg-[#E8A0A8]"></span>
                        Technē Workspace
                    </div>

                    <h1 class="mt-6 font-[Cormorant_Garamond] text-5xl font-medium leading-[0.95] tracking-tight lg:text-7xl">
                        Learn like a ritual. <br>
                        Create like it matters.
                    </h1>

                    <p class="mt-6 max-w-2xl text-sm leading-7 text-white/72 lg:text-base">
                        A refined creative learning space where structured paths, immersive lessons, and live art battles come together.
                        Progress with focus, then step into the community and show what you’ve built.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('list') }}"
                           class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-medium text-[#271B49] transition hover:-translate-y-0.5 hover:shadow-[0_16px_30px_rgba(0,0,0,0.18)]">
                            Explore Learning Paths
                        </a>

                        <a href="{{ route('battles.index') }}"
                           class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/10 px-6 py-3 text-sm font-medium text-white backdrop-blur transition hover:bg-white/18">
                            Enter Art Battles
                        </a>
                    </div>
                </div>

                <div class="grid gap-4">
                    <div class="rounded-[1.6rem] border border-white/12 bg-white/10 p-5 backdrop-blur-md">
                        <p class="text-xs uppercase tracking-[0.18em] text-[#F4D4D9]">Atmosphere</p>
                        <p class="mt-3 font-[Cormorant_Garamond] text-3xl italic text-white">Focused. Elegant. Alive.</p>
                        <p class="mt-3 text-sm leading-6 text-white/70">
                            Move through lessons with clarity, then bring that energy into the gallery and battles.
                        </p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-[1.35rem] border border-white/12 bg-white/10 p-4 text-center backdrop-blur-md">
                            <p class="text-[11px] uppercase tracking-[0.18em] text-[#F4D4D9]">Paths</p>
                            <p class="mt-3 font-[Cormorant_Garamond] text-3xl text-white">{{ $latestPaths->count() }}</p>
                        </div>

                        <div class="rounded-[1.35rem] border border-white/12 bg-white/10 p-4 text-center backdrop-blur-md">
                            <p class="text-[11px] uppercase tracking-[0.18em] text-[#F4D4D9]">Progress</p>
                            <p class="mt-3 font-[Cormorant_Garamond] text-3xl text-white">{{ $inProgressPaths->count() }}</p>
                        </div>

                        <div class="rounded-[1.35rem] border border-white/12 bg-white/10 p-4 text-center backdrop-blur-md">
                            <p class="text-[11px] uppercase tracking-[0.18em] text-[#F4D4D9]">Battle</p>
                            <p class="mt-3 font-[Cormorant_Garamond] text-3xl text-white">{{ $activeBattle ? 'Live' : '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($activeBattle)
        <section class="relative overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_18px_50px_rgba(192,57,43,0.08)]">
            <div class="absolute right-0 top-0 h-40 w-40 rounded-full bg-[#FAEAEA] blur-3xl"></div>

            <div class="relative border-b border-[#EFE1E4] bg-[#FDF8F6] px-6 py-5">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-[#FAEAEA] px-3 py-1 text-[11px] font-medium uppercase tracking-[0.16em] text-[#C0392B]">
                            <span class="h-2 w-2 rounded-full bg-[#C0392B]"></span>
                            Active Battle
                        </div>

                        <h2 class="mt-4 font-[Cormorant_Garamond] text-4xl font-medium text-[#1C1020] lg:text-5xl">
                            {{ $activeBattle->theme }}
                        </h2>

                        <p class="mt-3 max-w-3xl text-sm leading-7 text-[#8A7090]">
                            {{ $activeBattle->description ?: 'A creative challenge is live right now.' }}
                        </p>
                    </div>

                    <div class="inline-flex items-center rounded-full bg-[#EBF7F1] px-4 py-2 text-sm font-medium text-[#2D8A5C]">
                        Accepting submissions
                    </div>
                </div>
            </div>

            <div class="grid gap-4 px-6 py-6 md:grid-cols-3">
                <div class="rounded-[1.4rem] border border-[#E8D7DB] bg-[#FFFDFC] p-5 shadow-[0_8px_20px_rgba(192,57,43,0.04)]">
                    <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Status</p>
                    <p class="mt-3 text-base font-semibold text-[#2D8A5C]">Open now</p>
                </div>

                <div class="rounded-[1.4rem] border border-[#E8D7DB] bg-[#FFFDFC] p-5 shadow-[0_8px_20px_rgba(192,57,43,0.04)]">
                    <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Starts</p>
                    <p class="mt-3 text-sm font-medium leading-6 text-[#4A3050]">
                        {{ \Carbon\Carbon::parse($activeBattle->start_time)->format('M d, Y - H:i') }}
                    </p>
                </div>

                <div class="rounded-[1.4rem] border border-[#E8D7DB] bg-[#FFFDFC] p-5 shadow-[0_8px_20px_rgba(192,57,43,0.04)]">
                    <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Ends</p>
                    <p class="mt-3 text-sm font-medium leading-6 text-[#4A3050]">
                        {{ \Carbon\Carbon::parse($activeBattle->end_time)->format('M d, Y - H:i') }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-4 px-6 pb-6 lg:flex-row lg:items-center lg:justify-between">
                <p class="text-sm text-[#8A7090]">
                    Put your learning into practice and leave your mark in the current challenge.
                </p>

                <a href="{{ route('battles.show', $activeBattle) }}"
                   class="inline-flex items-center justify-center rounded-full bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-6 py-3 text-sm font-medium text-white shadow-[0_12px_24px_rgba(192,57,43,0.24)] transition hover:-translate-y-0.5">
                    Join Battle
                </a>
            </div>
        </section>
    @endif

    @if ($inProgressPaths->isNotEmpty())
        <section class="space-y-5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.18em] text-[#A58A99]">Continue Learning</p>
                    <h2 class="mt-2 font-[Cormorant_Garamond] text-4xl font-medium text-[#1C1020]">
                        Resume your path
                    </h2>
                </div>

                <p class="text-sm text-[#8A7090]">Pick up exactly where you left off.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($inProgressPaths as $path)
                    @php $rate = $path->getCompletionRate(auth()->id()) @endphp

                    <a href="{{ route('learning-path.show', $path) }}"
                       class="group block overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_14px_40px_rgba(192,57,43,0.06)] transition hover:-translate-y-1.5 hover:shadow-[0_24px_55px_rgba(192,57,43,0.12)]">
                        <div class="relative">
                            @if ($path->thumbnail)
                                <img src="{{ asset('storage/' . $path->thumbnail) }}"
                                     alt="{{ $path->name }}"
                                     class="h-48 w-full object-cover transition duration-300 group-hover:scale-[1.02]">
                            @else
                                <div class="flex h-48 w-full items-center justify-center bg-[linear-gradient(145deg,#F6DCE0,#E8A0A8,#FAEAEA)] text-6xl text-[#C0392B]/25">
                                    ✿
                                </div>
                            @endif

                            <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/30 to-transparent"></div>
                            <div class="absolute right-4 top-4 rounded-full bg-[#FAEAEA]/95 px-3 py-1 text-xs font-medium text-[#A62F24] shadow-sm">
                                In progress
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020] group-hover:text-[#A62F24]">
                                    {{ $path->name }}
                                </h3>

                                <span class="rounded-full bg-[#F7F0EA] px-3 py-1 text-xs font-medium text-[#8A7090]">
                                    {{ $rate }}%
                                </span>
                            </div>

                            <div class="mt-5 h-2.5 overflow-hidden rounded-full bg-[#F0DDE0]">
                                <div class="h-full rounded-full bg-[linear-gradient(90deg,#C0392B,#E8A0A8)]" style="width: {{ $rate }}%"></div>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <p class="text-sm text-[#8A7090]">Keep going</p>
                                <p class="text-sm font-medium text-[#C0392B]">Resume →</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <section class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.18em] text-[#A58A99]">Learning</p>
                <h2 class="mt-2 font-[Cormorant_Garamond] text-4xl font-medium text-[#1C1020]">
                    Latest Learning Paths
                </h2>
            </div>

            <a href="{{ route('list') }}"
               class="text-sm font-medium text-[#C0392B] transition hover:text-[#A62F24]">
                View all
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($latestPaths as $path)
                <a href="{{ route('learning-path.show', $path) }}"
                   class="group block overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_14px_40px_rgba(192,57,43,0.06)] transition hover:-translate-y-1.5 hover:shadow-[0_24px_55px_rgba(192,57,43,0.12)]">
                    <div class="relative">
                        @if ($path->thumbnail)
                            <img src="{{ asset('storage/' . $path->thumbnail) }}"
                                 alt="{{ $path->name }}"
                                 class="h-48 w-full object-cover transition duration-300 group-hover:scale-[1.02]">
                        @else
                            <div class="flex h-48 w-full items-center justify-center bg-[linear-gradient(145deg,#F6DCE0,#E8A0A8,#FAEAEA)] text-6xl text-[#C0392B]/25">
                                ✿
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020] group-hover:text-[#A62F24]">
                                {{ $path->name }}
                            </h3>

                            <span class="rounded-full bg-[#FAEAEA] px-3 py-1 text-xs font-medium text-[#A62F24]">
                                New
                            </span>
                        </div>

                        @if ($path->description)
                            <p class="mt-3 line-clamp-3 text-sm leading-7 text-[#8A7090]">
                                {{ $path->description }}
                            </p>
                        @endif

                        <div class="mt-5 flex items-center justify-between border-t border-[#F1E5E8] pt-4">
                            <p class="text-sm text-[#A58A99]">
                                {{ $path->modules_count }} module{{ $path->modules_count !== 1 ? 's' : '' }}
                            </p>

                            <p class="text-sm font-medium text-[#C0392B]">Open path →</p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full rounded-[1.9rem] border border-[#E8D7DB] bg-[#FFFCFA] px-6 py-16 text-center shadow-[0_14px_40px_rgba(192,57,43,0.06)]">
                    <p class="font-[Cormorant_Garamond] text-3xl font-medium text-[#8A7090]">
                        No learning paths yet.
                    </p>
                </div>
            @endforelse
        </div>
    </section>

</div>