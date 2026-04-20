<div class="mx-auto max-w-6xl px-4 py-10 space-y-8 font-[Jost]">

    <a href="{{ route('list') }}"
       class="inline-flex items-center gap-2 text-sm font-medium text-[#C0392B] hover:text-[#A62F24]">
        ← All Paths
    </a>

    <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_20px_50px_rgba(192,57,43,0.08)]">
        <div class="relative bg-[linear-gradient(145deg,#2C2060_0%,#3D1C5C_45%,#5A1C3C_100%)] px-6 py-10 text-white lg:px-10">
            <div class="absolute right-0 top-0 h-full w-1/3 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.10),transparent_60%)]"></div>

            <div class="relative grid gap-8 lg:grid-cols-[1fr_320px] lg:items-end">
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-[#F4D4D9]">Learning Path</p>
                    <h1 class="mt-3 font-[Cormorant_Garamond] text-5xl font-medium leading-tight lg:text-6xl">
                        {{ $path->name }}
                    </h1>

                    @if ($path->description)
                        <p class="mt-4 max-w-3xl text-sm leading-7 text-white/72 lg:text-base">
                            {{ $path->description }}
                        </p>
                    @endif
                </div>

                <div class="rounded-[1.6rem] border border-white/12 bg-white/10 p-5 backdrop-blur-md">
                    <p class="text-xs uppercase tracking-[0.18em] text-[#F4D4D9]">Overall Progress</p>
                    <p class="mt-3 font-[Cormorant_Garamond] text-5xl text-white">{{ $overallRate }}%</p>

                    <div class="mt-5 h-2.5 overflow-hidden rounded-full bg-white/15">
                        <div class="h-full rounded-full bg-[linear-gradient(90deg,#F4D4D9,#FFFFFF)]" style="width: {{ $overallRate }}%"></div>
                    </div>

                    <p class="mt-3 text-sm text-white/70">
                        Move module by module until the full path is complete.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="space-y-5">
        @foreach ($modules as $module)
            <section class="overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_12px_35px_rgba(192,57,43,0.05)] {{ ! $module->is_unlocked ? 'opacity-80' : '' }}">
                <div class="border-b border-[#EFE1E4] bg-[#FDF8F6] px-6 py-5">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <div class="flex flex-wrap items-center gap-3">
                                <h2 class="font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020]">
                                    {{ $module->title }}
                                </h2>

                                @if (! $module->is_unlocked)
                                    <span class="rounded-full bg-[#F7F0EA] px-3 py-1 text-xs font-medium text-[#A58A99]">
                                        Locked
                                    </span>
                                @else
                                    <span class="rounded-full bg-[#EBF7F1] px-3 py-1 text-xs font-medium text-[#2D8A5C]">
                                        Unlocked
                                    </span>
                                @endif
                            </div>

                            <p class="mt-2 text-sm text-[#8A7090]">
                                {{ $module->progress }}% complete in this module
                            </p>
                        </div>

                        <div class="w-full max-w-xs">
                            <div class="h-2.5 overflow-hidden rounded-full bg-[#F0DDE0]">
                                <div class="h-full rounded-full bg-[linear-gradient(90deg,#C0392B,#E8A0A8)]" style="width: {{ $module->progress }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-[#F3E7E9]">
                    @foreach ($module->lessons as $lesson)
                        <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-start gap-4">
                                @if ($lesson->is_completed)
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#EBF7F1] text-base font-semibold text-[#2D8A5C]">
                                        ✓
                                    </span>
                                @else
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#F7F0EA] text-base font-semibold text-[#A58A99]">
                                        ○
                                    </span>
                                @endif

                                <div>
                                    <p class="text-base font-medium text-[#4A3050]">{{ $lesson->title }}</p>

                                    <div class="mt-2 flex flex-wrap items-center gap-2">
                                        @if ($lesson->video_path)
                                            <span class="rounded-full bg-[#FAEAEA] px-2.5 py-1 text-[11px] font-medium text-[#A62F24]">
                                                Video lesson
                                            </span>
                                        @endif

                                        @if ($lesson->is_completed)
                                            <span class="rounded-full bg-[#F7F0EA] px-2.5 py-1 text-[11px] font-medium text-[#8A7090]">
                                                Completed
                                            </span>
                                        @else
                                            <span class="rounded-full bg-[#F7F0EA] px-2.5 py-1 text-[11px] font-medium text-[#8A7090]">
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div>
                                @if ($module->is_unlocked)
                                    <a href="{{ route('lesson.show', $lesson) }}"
                                       class="inline-flex items-center rounded-full bg-[#1C1020] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#C0392B]">
                                        {{ $lesson->is_completed ? 'Review lesson' : 'Start lesson' }}
                                    </a>
                                @else
                                    <span class="text-sm text-[#A58A99]">Complete previous modules first</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>

</div>