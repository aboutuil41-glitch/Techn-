<div class="space-y-8 font-[Jost] px-4 sm:px-6">

    @if (session()->has('success'))
        <div class="flash-banner rounded-[1.4rem] border border-[#C5E7D5] bg-[#EBF7F1] px-5 py-4 text-[#2D8A5C] shadow-[0_10px_30px_rgba(192,57,43,0.06)]">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="flash-banner rounded-[1.4rem] border border-[#F5CDD2] bg-[#FEF2F3] px-5 py-4 text-[#B04352] shadow-[0_10px_30px_rgba(192,57,43,0.06)]">
            {{ session('error') }}
        </div>
    @endif

    {{-- ── Hero ─────────────────────────────────────────────── --}}
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

    {{-- ── My Submission ────────────────────────────────────── --}}
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

                        <span class="inline-flex items-center gap-2 rounded-full bg-[#EBF7F1] px-4 py-2 text-sm font-medium text-[#2D8A5C]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Submitted
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="gallery-card-img-wrap rounded-[1.9rem] overflow-hidden cursor-zoom-in"
                         data-lightbox="{{ asset('storage/' . $userSubmission->image_path) }}"
                         data-caption="{{ $userSubmission->title }}">
                        <img src="{{ asset('storage/' . $userSubmission->image_path) }}"
                             alt="{{ $userSubmission->title }}"
                             class="h-56 w-full object-cover shadow-[0_8px_24px_rgba(192,57,43,0.07)]">
                    </div>

                    <div class="mt-5 flex flex-wrap gap-3">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#FAEAEA] px-4 py-2 text-sm font-medium text-[#A62F24]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            {{ $userSubmission->like_count }} likes
                        </span>

                        <span class="rounded-full bg-[#F7F0EA] px-4 py-2 text-sm font-medium text-[#4A3050]">
                            {{ $userSubmission->created_at->format('M d, Y - H:i') }}
                        </span>
                    </div>
                </div>
            </section>

        @elseif ($battle->status === 'active')
            {{-- ── Upload form ──────────────────────────────────── --}}
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
                            class="w-full rounded-[1.45rem] border border-[#E3D0D4] bg-[#FFFDFC] px-4 py-3 text-[#2E1C30] placeholder:text-[#A58A99] focus:border-[#C0392B] focus:ring-0 outline-none transition"
                        >
                        @error('title') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-[#4A3050]">Artwork Image</label>

                        <div class="upload-dropzone" id="dropzone">
                            <input type="file" wire:model="image" accept="image/*" id="dropzone-input">

                            <div class="upload-dropzone-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="16 16 12 12 8 16"></polyline>
                                    <line x1="12" y1="12" x2="12" y2="21"></line>
                                    <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>
                                </svg>
                            </div>

                            <div class="upload-dropzone-text">
                                <strong>Click to upload</strong> or drag &amp; drop<br>
                            </div>
                            <p class="upload-dropzone-hint">PNG, JPG, WEBP — max 10 MB</p>
                        </div>

                        @error('image') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    @if ($image)
                        <div class="rounded-[1.55rem] border border-[#E8D7DB] bg-[#FDF8F6] p-4">
                            <p class="mb-3 text-sm font-medium text-[#4A3050]">Preview</p>
                            <img src="{{ $image->temporaryUrl() }}"
                                 class="h-52 w-full rounded-[1.25rem] object-cover">
                        </div>
                    @endif

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-[#8A7090]">
                            Your artwork will appear in the gallery after submission.
                        </p>

                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-full bg-[linear-gradient(135deg,#C0392B,#A62F24)] px-6 py-3 text-sm font-medium text-white shadow-[0_12px_24px_rgba(192,57,43,0.22)] transition hover:-translate-y-0.5 hover:shadow-[0_16px_30px_rgba(192,57,43,0.30)]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
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

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($winners as $index => $winner)
                    <article class="overflow-hidden rounded-[1.6rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_8px_24px_rgba(192,57,43,0.06)] transition hover:-translate-y-1 hover:shadow-[0_16px_40px_rgba(192,57,43,0.12)]
                        {{ $index === 0 ? 'relative mt-6 winner-article-first ring-2 ring-[#C4996B]/40' : '' }}">

                        <div class="relative gallery-card-img-wrap cursor-zoom-in"
                             data-lightbox="{{ asset('storage/' . $winner->image_path) }}"
                             data-caption="{{ $winner->title }} — {{ $winner->user->name ?? $winner->user->username }}">
                            <img src="{{ asset('storage/' . $winner->image_path) }}"
                                 alt="{{ $winner->title }}"
                                 class="h-52 w-full object-cover transition duration-300 hover:scale-[1.04]">

                            <span class="winner-rank-badge rank-{{ $index + 1 }}">
                                {{ $index === 0 ? '1st' : ($index === 1 ? '2nd' : '3rd') }} Place
                            </span>
                        </div>

                        <div class="p-4">
                            <h4 class="text-base font-semibold text-[#1C1020]">{{ $winner->title }}</h4>
                            <p class="mt-1 text-xs text-[#8A7090]">
                                by {{ $winner->user->name ?? $winner->user->username }}
                            </p>

                            <div class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-[#FAEAEA] px-3 py-1 text-xs font-medium text-[#A62F24]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                                {{ $winner->like_count }} likes
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <livewire:submission-gallery :battleId="$battle->id" :key="'gallery-' . $battle->id" />

    <div id="lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
        <button id="lightbox-close" aria-label="Close">✕</button>
        <img id="lightbox-img" src="" alt="">
        <p id="lightbox-caption"></p>
    </div>

    <script>
(function () {
    const lb      = document.getElementById('lightbox');
    const lbImg   = document.getElementById('lightbox-img');
    const lbCap   = document.getElementById('lightbox-caption');
    const lbClose = document.getElementById('lightbox-close');

    function openLightbox(src, caption) {
        lbImg.src = src;
        lbImg.alt = caption || '';
        lbCap.textContent = caption || '';
        lb.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lb.classList.remove('open');
        document.body.style.overflow = '';
        setTimeout(() => { lbImg.src = ''; }, 250);
    }

    document.addEventListener('click', function (e) {
        const trigger = e.target.closest('[data-lightbox]');
        if (trigger) {
            e.preventDefault();
            openLightbox(trigger.dataset.lightbox, trigger.dataset.caption || '');
            return;
        }
        if (e.target === lb) closeLightbox();
    });

    lbClose.addEventListener('click', closeLightbox);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lb.classList.contains('open')) closeLightbox();
    });

    const dz = document.getElementById('dropzone');
    if (dz) {
        ['dragenter', 'dragover'].forEach(ev =>
            dz.addEventListener(ev, e => { e.preventDefault(); dz.classList.add('dragover'); })
        );
        ['dragleave', 'drop'].forEach(ev =>
            dz.addEventListener(ev, e => { e.preventDefault(); dz.classList.remove('dragover'); })
        );
    }

    document.querySelectorAll('.flash-banner').forEach(function (el) {
        setTimeout(function () {
            el.classList.add('fade-out');
            setTimeout(function () { el.remove(); }, 500);
        }, 4000);
    });
})();
    </script>

</div>