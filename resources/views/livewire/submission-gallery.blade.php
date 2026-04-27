<div class="space-y-6 font-[Jost] px-4 sm:px-6">

    {{-- ── Gallery header ──────────────────────────────────── --}}
    <section class="rounded-[1.9rem] border border-[#E8D7DB] bg-[#FFFCFA] p-6 shadow-[0_14px_40px_rgba(192,57,43,0.06)]">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.18em] text-[#A58A99]">Gallery</p>
                <h3 class="mt-3 font-[Cormorant_Garamond] text-4xl font-medium text-[#1C1020]">
                    Battle Submissions
                </h3>
                <p class="mt-3 text-sm leading-7 text-[#8A7090]">
                    Browse artworks, support your favorites, and see which creations rise to the top.
                </p>
            </div>

            <div class="inline-flex items-center gap-2 rounded-[1.4rem] border border-[#E8D7DB] bg-[#FDF8F6] px-4 py-3 text-sm text-[#67516C]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#C0392B]" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                Sorted by most likes
            </div>
        </div>
    </section>

    {{-- ── Cards grid ───────────────────────────────────────── --}}
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($submissions as $submission)
            <article class="gallery-card group">

                {{-- image + overlay --}}
                <div class="gallery-card-img-wrap"
                     data-lightbox="{{ asset('storage/' . $submission->image_path) }}"
                     data-caption="{{ $submission->title }} — {{ $submission->user->name ?? $submission->user->username }}">

                    <img src="{{ asset('storage/' . $submission->image_path) }}"
                         alt="{{ $submission->title }}"
                         loading="lazy">

                    <div class="gallery-card-overlay"></div>

                    <div class="gallery-card-meta">
                        <div>
                            <h4 class="gallery-card-title">{{ $submission->title }}</h4>
                            <p class="gallery-card-author">
                                by {{ $submission->user->name ?? $submission->user->username }}
                            </p>
                        </div>

                        <span class="gallery-like-count">{{ $submission->like_count }}</span>
                    </div>
                </div>

                {{-- footer --}}
                <div class="gallery-card-footer">
                    <span class="gallery-card-date">
                        {{ $submission->created_at->format('M d, Y') }}
                    </span>

                    @auth
                        @if (auth()->id() !== $submission->user_id)
                            @php
                                $isLiked = $submission->likes->contains('user_id', auth()->id());
                            @endphp

                            <button
                                wire:click="like({{ $submission->id }})"
                                onclick="animateLike(this)"
                                class="like-btn {{ $isLiked ? 'liked' : 'unliked' }}"
                                aria-label="{{ $isLiked ? 'Remove like' : 'Like this artwork' }}">

                                {{-- heart icon — filled when liked, outline when not --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                                    @if ($isLiked)
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#fff" stroke="none"/>
                                    @else
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" fill="none" stroke="#C0392B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    @endif
                                </svg>

                                {{ $isLiked ? 'Liked' : 'Like' }}
                            </button>
                        @endif
                    @endauth
                </div>

            </article>
        @empty
            <div class="col-span-full rounded-[1.9rem] border border-[#E8D7DB] bg-[#FFFCFA] px-6 py-16 text-center shadow-[0_14px_40px_rgba(192,57,43,0.06)]">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-[#FAEAEA]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#C0392B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="font-[Cormorant_Garamond] text-3xl font-medium text-[#8A7090]">
                    No submissions yet.
                </p>
                <p class="mt-2 text-sm text-[#B9A6B0]">Be the first to submit your artwork.</p>
            </div>
        @endforelse
    </section>

</div>