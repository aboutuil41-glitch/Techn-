<div class="space-y-6 font-[Jost]">

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

            <div class="rounded-[1.4rem] border border-[#E8D7DB] bg-[#FDF8F6] px-4 py-3 text-sm text-[#67516C]">
                Sorted by most likes
            </div>
        </div>
    </section>

    <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($submissions as $submission)
            <article class="group overflow-hidden rounded-[1.9rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_14px_40px_rgba(192,57,43,0.06)] transition duration-200 hover:-translate-y-1.5 hover:shadow-[0_24px_55px_rgba(192,57,43,0.12)]">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('storage/' . $submission->image_path) }}"
                         alt="{{ $submission->title }}"
                         class="h-80 w-full object-cover transition duration-300 group-hover:scale-[1.03]">

                    <div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-black/50 to-transparent"></div>

                    <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-xl font-semibold text-white drop-shadow">{{ $submission->title }}</h4>
                            <p class="mt-1 text-sm text-white/80">
                                by {{ $submission->user->name ?? $submission->user->username }}
                            </p>
                        </div>

                        <span class="rounded-full bg-white/90 px-3 py-1 text-sm font-medium text-[#4A3050] shadow-sm">
                            {{ $submission->like_count }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-between p-5">
                    <span class="text-sm text-[#A58A99]">
                        {{ $submission->created_at->format('M d, Y') }}
                    </span>

                    @auth
                        @if (auth()->id() !== $submission->user_id)
                            @php
                                $isLiked = $submission->likes->contains('user_id', auth()->id());
                            @endphp

                            <button
                                wire:click="like({{ $submission->id }})"
                                class="inline-flex items-center justify-center rounded-full px-4 py-2 text-sm font-medium text-white transition
                                {{ $isLiked ? 'bg-red-600 hover:bg-red-700' : 'bg-[#C0392B] hover:bg-[#A62F24]' }}">
                                {{ $isLiked ? 'Dislike' : 'Like' }}
                            </button>
                        @endif
                    @endauth
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-[1.9rem] border border-[#E8D7DB] bg-[#FFFCFA] px-6 py-16 text-center shadow-[0_14px_40px_rgba(192,57,43,0.06)]">
                <p class="font-[Cormorant_Garamond] text-3xl font-medium text-[#8A7090]">
                    No submissions yet.
                </p>
            </div>
        @endforelse
    </section>

</div>