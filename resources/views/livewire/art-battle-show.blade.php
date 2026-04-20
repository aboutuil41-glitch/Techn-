<div class="space-y-8 font-[Jost]">

    @if (session()->has('success'))
        <div class="rounded-[1.4rem] border border-[#C5E7D5] bg-[#EBF7F1] px-5 py-4 text-[#2D8A5C] shadow-[0_10px_30px_rgba(192,57,43,0.06)]">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="rounded-[1.4rem] border border-[#F5CDD2] bg-[#FEF2F3] px-5 py-4 text-[#B04352] shadow-[0_10px_30px_rgba(192,57,43,0.06)]">
            {{ session('error') }}
        </div>
    @endif

    <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_20px_50px_rgba(192,57,43,0.08)]">
        <div class="relative bg-[linear-gradient(145deg,#2C2060_0%,#3D1C5C_45%,#5A1C3C_100%)] px-6 py-12 text-white lg:px-10">
            <div class="absolute right-0 top-0 h-full w-1/3 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.10),transparent_60%)]"></div>

            <div class="relative flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                <div class="max-w-3xl">
                    <p class="text-xs uppercase tracking-[0.22em] text-[#F4D4D9]">Battle Theme</p>
                    <h1 class="mt-3 font-[Cormorant_Garamond] text-5xl font-medium tracking-tight lg:text-6xl">
                        {{ $battle->theme }}
                    </h1>
                    <p class="mt-4 text-sm leading-7 text-white/72 lg:text-base">
                        {{ $battle->description ?: 'No description added for this battle yet.' }}
                    </p>
                </div>

                <span class="inline-flex w-fit rounded-full px-4 py-2 text-sm font-semibold
                    @if($battle->status === 'active') bg-emerald-100 text-[#2D8A5C]
                    @elseif($battle->status === 'finished') bg-rose-100 text-[#B04352]
                    @else bg-amber-100 text-[#A56A33]
                    @endif">
                    {{ ucfirst($battle->status) }}
                </span>
            </div>
        </div>

        <div class="grid gap-4 px-6 py-6 md:grid-cols-2 lg:grid-cols-3 lg:px-10">
            <div class="rounded-[1.45rem] border border-[#E8D7DB] bg-[#FFFDFC] p-5">
                <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">Start Time</p>
                <p class="mt-3 text-sm font-medium leading-6 text-[#4A3050]">
                    {{ \Carbon\Carbon::parse($battle->start_time)->format('M d, Y - H:i') }}
                </p>
            </div>

            <div class="rounded-[1.45rem] border border-[#E8D7DB] bg-[#FFFDFC] p-5">
                <p class="text-[11px] uppercase tracking-[0.18em] text-[#A58A99]">End Time</p>
                <p class="mt-3 text-sm font-medium leading-6 text-[#4A3050]">
                    {{ \Carbon\Carbon::parse($battle->end_time)->format('M d, Y - H:i') }}
                </p>
            </div>

            <div class="rounded-[1.45rem] border border-[#F0DDE0] bg-[#FAEAEA] p-5">
                <p class="text-[11px] uppercase tracking-[0.18em] text-[#D97786]">Status</p>
                <p class="mt-3 text-sm font-semibold text-[#A62F24]">
                    {{ ucfirst($battle->status) }}
                </p>
            </div>
        </div>
    </section>

    @auth
        @if ($userSubmission)
            <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_16px_45px_rgba(192,57,43,0.07)]">
                <div class="border-b border-[#EFE1E4] bg-[#FDF8F6] px-6 py-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-[#C0392B]">My Submission</p>
                            <h3 class="mt-3 font-[Cormorant_Garamond] text-4xl font-medium text-[#1C1020]">
                                {{ $userSubmission->title }}
                            </h3>
                        </div>

                        <span class="rounded-full bg-[#EBF7F1] px-4 py-2 text-sm font-medium text-[#2D8A5C]">
                            Submitted
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <img src="{{ asset('storage/' . $userSubmission->image_path) }}"
                         alt="{{ $userSubmission->title }}"
                         class="h-80 w-full rounded-[1.9rem] object-cover shadow-[0_14px_40px_rgba(192,57,43,0.07)]">

                    <div class="mt-5 flex flex-wrap gap-3">
                        <span class="rounded-full bg-[#F7F0EA] px-4 py-2 text-sm font-medium text-[#4A3050]">
                            {{ $userSubmission->like_count }} likes
                        </span>

                        <span class="rounded-full bg-[#F7F0EA] px-4 py-2 text-sm font-medium text-[#4A3050]">
                            {{ $userSubmission->created_at->format('M d, Y - H:i') }}
                        </span>
                    </div>
                </div>
            </section>
        @elseif ($battle->status === 'active')
            <section class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_16px_45px_rgba(192,57,43,0.07)]">
                <div class="border-b border-[#EFE1E4] bg-[#FDF8F6] px-6 py-6">
                    <p class="text-xs uppercase tracking-[0.18em] text-[#A58A99]">Submit Artwork</p>
                    <h3 class="mt-3 font-[Cormorant_Garamond] text-4xl font-medium text-[#1C1020]">
                        Join this battle
                    </h3>
                    <p class="mt-3 text-sm leading-7 text-[#8A7090]">
                        You can submit one artwork for this battle. Make it count.
                    </p>
                </div>

                <form wire:submit="save" class="space-y-6 p-6">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Artwork Title</label>
                        <input
                            type="text"
                            wire:model="title"
                            placeholder="Enter your artwork title..."
                            class="w-full rounded-[1.45rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] focus:border-[#C0392B] focus:ring-0"
                        >
                        @error('title') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Artwork Image</label>
                        <input
                            type="file"
                            wire:model="image"
                            class="w-full rounded-[1.45rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 text-[#2E1C30] focus:border-[#C0392B] focus:ring-0"
                        >
                        @error('image') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    @if ($image)
                        <div class="rounded-[1.55rem] border border-[#E8D7DB] bg-[#FDF8F6] p-4">
                            <p class="mb-3 text-sm font-medium text-[#4A3050]">Preview</p>
                            <img src="{{ $image->temporaryUrl() }}"
                                 class="h-80 w-full rounded-[1.45rem] object-cover">
                        </div>
                    @endif

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-[#8A7090]">
                            Your artwork will appear in the gallery after submission.
                        </p>

                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-full bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-6 py-3 text-sm font-medium text-white shadow-[0_12px_24px_rgba(192,57,43,0.22)] transition hover:-translate-y-0.5">
                            Submit Artwork
                        </button>
                    </div>
                </form>
            </section>
        @endif
    @endauth

    @if ($battle->status === 'finished' && $winners->count())
        <section class="space-y-5">
            <div class="rounded-[1.9rem] border border-[#E8D7DB] bg-[#FFFCFA] p-6 shadow-[0_14px_40px_rgba(192,57,43,0.06)]">
                <p class="text-xs uppercase tracking-[0.18em] text-[#A58A99]">Results</p>
                <h3 class="mt-3 font-[Cormorant_Garamond] text-4xl font-medium text-[#1C1020]">
                    Top Winners
                </h3>
                <p class="mt-3 text-sm leading-7 text-[#8A7090]">
                    The most liked submissions in this battle.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($winners as $index => $winner)
                    <article class="overflow-hidden rounded-[1.9rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_14px_40px_rgba(192,57,43,0.06)]">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $winner->image_path) }}"
                                 alt="{{ $winner->title }}"
                                 class="h-80 w-full object-cover">

                            <div class="absolute left-4 top-4 rounded-full px-4 py-1.5 text-sm font-semibold text-white
                                {{ $index === 0 ? 'bg-[#C4996B]' : ($index === 1 ? 'bg-[#8A7090]' : 'bg-[#C0392B]') }}">
                                {{ $index + 1 }}{{ $index === 0 ? 'st' : ($index === 1 ? 'nd' : 'rd') }} Place
                            </div>
                        </div>

                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-[#1C1020]">{{ $winner->title }}</h4>
                            <p class="mt-2 text-sm text-[#8A7090]">
                                by {{ $winner->user->name ?? $winner->user->username }}
                            </p>

                            <div class="mt-5 inline-flex rounded-full bg-[#FAEAEA] px-3 py-1 text-sm font-medium text-[#A62F24]">
                                {{ $winner->like_count }} likes
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <livewire:submission-gallery :battleId="$battle->id" :key="'gallery-' . $battle->id" />
</div>