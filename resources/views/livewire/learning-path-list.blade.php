<div class="mx-auto max-w-7xl px-4 py-10 font-[Jost] space-y-8">

    <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_20px_50px_rgba(192,57,43,0.08)]">
        <div class="relative bg-[linear-gradient(145deg,#2C2060_0%,#3D1C5C_45%,#5A1C3C_100%)] px-6 py-12 text-white lg:px-10">
            <div class="absolute inset-y-0 right-0 w-1/3 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.12),transparent_60%)]"></div>

            <div class="relative flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <p class="text-xs uppercase tracking-[0.22em] text-[#F4D4D9]">Collection</p>
                    <h1 class="mt-3 font-[Cormorant_Garamond] text-5xl font-medium tracking-tight lg:text-6xl">
                        Learning Paths
                    </h1>
                    <p class="mt-4 text-sm leading-7 text-white/72 lg:text-base">
                        Explore structured journeys, deepen your skills, and move through lessons with a clear sense of direction.
                    </p>
                </div>

                <div class="inline-flex w-fit items-center rounded-full border border-white/18 bg-white/10 px-5 py-3 text-sm text-white/85 backdrop-blur">
                    {{ $paths->count() }} path{{ $paths->count() !== 1 ? 's' : '' }}
                </div>
            </div>
        </div>
    </section>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($paths as $path)
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

                    <div class="absolute left-4 top-4 rounded-full bg-[#FFFCFA]/92 px-3 py-1 text-xs font-medium text-[#A62F24] shadow-sm">
                        Learning Path
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-start justify-between gap-3">
                        <h2 class="font-[Cormorant_Garamond] text-3xl font-medium text-[#1C1020] group-hover:text-[#A62F24]">
                            {{ $path->name }}
                        </h2>

                        <span class="rounded-full bg-[#F7F0EA] px-3 py-1 text-xs font-medium text-[#8A7090]">
                            {{ $path->modules->count() }} modules
                        </span>
                    </div>

                    @if ($path->description)
                        <p class="mt-4 line-clamp-3 text-sm leading-7 text-[#8A7090]">
                            {{ $path->description }}
                        </p>
                    @endif

                    <div class="mt-6 flex items-center justify-between border-t border-[#F1E5E8] pt-4">
                        <span class="text-sm text-[#A58A99]">Curated journey</span>
                        <span class="text-sm font-medium text-[#C0392B]">View path →</span>
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

</div>