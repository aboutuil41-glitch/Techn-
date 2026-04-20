{{-- navigation.blade.php --}}
<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-[#E8D7DB] bg-[#FFFCFA]/80 backdrop-blur-xl">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="group flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-[1.2rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] text-base font-semibold text-white shadow-[0_10px_24px_rgba(192,57,43,0.20)] transition group-hover:-translate-y-0.5">
                        技
                    </div>

                    <div class="hidden sm:block">
                        <div class="font-[Cormorant_Garamond] text-2xl font-semibold leading-none tracking-wide text-[#1C1020]">
                            {{ config('app.name', 'Techné') }}
                        </div>
                        <div class="mt-1 text-[11px] uppercase tracking-[0.24em] text-[#8A7090]">
                            Workspace
                        </div>
                    </div>
                </a>

                <div class="hidden items-center gap-3 sm:flex">
                    <x-nav-link
                        :href="route('home')"
                        :active="request()->routeIs('home')"
                        class="rounded-full border px-5 py-2.5 text-sm transition
                        {{ request()->routeIs('home')
                            ? 'border-[#C0392B] bg-[#FAEAEA] text-[#C0392B] font-medium shadow-[0_6px_16px_rgba(192,57,43,0.08)]'
                            : 'border-transparent text-[#67516C] hover:border-[#E8C7CD] hover:bg-[#FDF8F6] hover:text-[#1C1020]' }}"
                    >
                        Home
                    </x-nav-link>

                    <x-nav-link
                        :href="route('list')"
                        :active="request()->routeIs('learning-paths.*')"
                        class="rounded-full border px-5 py-2.5 text-sm transition
                        {{ request()->routeIs('learning-paths.*')
                            ? 'border-[#C0392B] bg-[#FAEAEA] text-[#C0392B] font-medium shadow-[0_6px_16px_rgba(192,57,43,0.08)]'
                            : 'border-transparent text-[#67516C] hover:border-[#E8C7CD] hover:bg-[#FDF8F6] hover:text-[#1C1020]' }}"
                    >
                        Paths
                    </x-nav-link>

                    <x-nav-link
                        :href="route('battles.index')"
                        :active="request()->routeIs('battles.*')"
                        class="rounded-full border px-5 py-2.5 text-sm transition
                        {{ request()->routeIs('battles.*')
                            ? 'border-[#C0392B] bg-[#FAEAEA] text-[#C0392B] font-medium shadow-[0_6px_16px_rgba(192,57,43,0.08)]'
                            : 'border-transparent text-[#67516C] hover:border-[#E8C7CD] hover:bg-[#FDF8F6] hover:text-[#1C1020]' }}"
                    >
                        Battles
                    </x-nav-link>

                    @role('admin')
                        <x-nav-link
                            :href="route('admin.dashboard')"
                            :active="request()->routeIs('admin.*')"
                            class="rounded-full border px-5 py-2.5 text-sm transition
                            {{ request()->routeIs('admin.*')
                                ? 'border-[#C0392B] bg-[#FAEAEA] text-[#C0392B] font-medium shadow-[0_6px_16px_rgba(192,57,43,0.08)]'
                                : 'border-transparent text-[#67516C] hover:border-[#E8C7CD] hover:bg-[#FDF8F6] hover:text-[#1C1020]' }}"
                        >
                            Admin
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            <div class="hidden items-center sm:flex">
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 rounded-full border border-[#E8D7DB] bg-[#FFFDFC] px-4 py-2.5 shadow-[0_6px_16px_rgba(192,57,43,0.04)] transition hover:bg-[#FDF8F6]">
                            <div class="hidden text-right sm:block">
                                <div class="font-medium text-[#1C1020]">
                                    {{ Auth::user()->name ?? Auth::user()->username }}
                                </div>
                                <div class="text-xs text-[#8A7090]">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-full border border-[#E8C7CD] bg-[linear-gradient(135deg,#C0392B,#E8A0A8)] text-sm font-semibold text-white shadow-[0_8px_18px_rgba(192,57,43,0.16)]">
                                {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->username, 0, 1)) }}
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-[#EFE1E4]">
                            <div class="font-medium text-[#1C1020]">
                                {{ Auth::user()->name ?? Auth::user()->username }}
                            </div>
                            <div class="text-xs text-[#8A7090]">
                                {{ Auth::user()->email }}
                            </div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center sm:hidden">
                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-[1rem] border border-[#E8D7DB] bg-[#FFFDFC] p-2.5 text-[#67516C] transition hover:bg-[#FDF8F6]">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition class="border-t border-[#E8D7DB] bg-[#FFFCFA] sm:hidden">
        <div class="space-y-2 px-4 py-4">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Home
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('list')" :active="request()->routeIs('learning-paths.*')">
                Paths
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('battles.index')" :active="request()->routeIs('battles.*')">
                Battles
            </x-responsive-nav-link>

            @role('admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                    Admin
                </x-responsive-nav-link>
            @endrole
        </div>

        <div class="border-t border-[#E8D7DB] px-4 py-4">
            <div class="mb-4">
                <div class="font-medium text-[#1C1020]">
                    {{ Auth::user()->name ?? Auth::user()->username }}
                </div>
                <div class="text-sm text-[#8A7090]">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="space-y-2">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>