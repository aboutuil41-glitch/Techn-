<div class="min-h-screen bg-[#F7F0EA] text-[#2E1C30] font-[Jost]">
    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="hidden lg:flex lg:w-80 flex-col border-r border-[#E8D7DB] bg-[#FFFCFA]">
            <div class="border-b border-[#E8D7DB] px-6 py-7">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 items-center justify-center rounded-[1.4rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] text-xl font-semibold text-white shadow-[0_14px_28px_rgba(192,57,43,0.22)]">
                        技
                    </div>

                    <div>
                        <h1 class="font-[Cormorant_Garamond] text-3xl font-semibold leading-none text-[#1C1020]">
                            Aphrodite Admin
                        </h1>
                        <p class="mt-2 text-[11px] uppercase tracking-[0.22em] text-[#8A7090]">
                            Control Center
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex-1 px-5 py-6">
                @php
                    $items = [
                        'dashboard' => ['label' => 'Dashboard', 'icon' => 'home'],
                        'paths' => ['label' => 'Learning Paths', 'icon' => 'layers'],
                        'modules' => ['label' => 'Modules', 'icon' => 'grid'],
                        'lessons' => ['label' => 'Lessons', 'icon' => 'book-open'],
                        'quizzes' => ['label' => 'Quizzes', 'icon' => 'clipboard-list'],
                        'battles' => ['label' => 'Battles', 'icon' => 'sparkles'],
                    ];
                @endphp

                <div class="mb-4 px-3 text-[11px] font-semibold uppercase tracking-[0.2em] text-[#A58A99]">
                    Workspace
                </div>

                <nav class="space-y-3">
                    @foreach ($items as $key => $item)
                        <button
                            wire:click="setSection('{{ $key }}')"
                            class="group w-full rounded-[1.5rem] border px-4 py-4 text-left transition
                            {{ $section === $key
                                ? 'border-[#E8C7CD] bg-[#FAEAEA] text-[#A62F24] shadow-[0_10px_24px_rgba(192,57,43,0.08)]'
                                : 'border-transparent bg-[#FFFCFA] text-[#67516C] hover:border-[#E8D7DB] hover:bg-[#FDF8F6] hover:text-[#1C1020]' }}"
                        >
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-[1.25rem]
                                        {{ $section === $key ? 'bg-[#F4D4D9] text-[#A62F24]' : 'bg-[#F7F0EA] text-[#8A7090] group-hover:bg-[#EEDFE2]' }}">
                                        @switch($item['icon'])
                                            @case('home')
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10.5L12 3l9 7.5V20a1 1 0 0 1-1 1h-5.5v-6h-5v6H4a1 1 0 0 1-1-1v-9.5z"/>
                                                </svg>
                                            @break
                                            @case('layers')
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3 3 8l9 5 9-5-9-5Zm-9 9 9 5 9-5M3 16l9 5 9-5"/>
                                                </svg>
                                            @break
                                            @case('grid')
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4h7v7H4V4Zm9 0h7v7h-7V4ZM4 13h7v7H4v-7Zm9 0h7v7h-7v-7Z"/>
                                                </svg>
                                            @break
                                            @case('book-open')
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.5C10.2 5.5 7.9 5 5.5 5A2.5 2.5 0 0 0 3 7.5v10A2.5 2.5 0 0 1 5.5 15c2.4 0 4.7.5 6.5 1.5m0-10C13.8 5.5 16.1 5 18.5 5A2.5 2.5 0 0 1 21 7.5v10A2.5 2.5 0 0 0 18.5 15c-2.4 0-4.7.5-6.5 1.5m0-10v10"/>
                                                </svg>
                                            @break
                                            @case('clipboard-list')
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5h6m-7 3h8m-8 4h8m-8 4h5M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z"/>
                                                </svg>
                                            @break
                                            @default
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3l2.4 4.9L20 10l-4 3.9.9 5.6L12 17l-4.9 2.5.9-5.6L4 10l5.6-2.1L12 3Z"/>
                                                </svg>
                                        @endswitch
                                    </span>

                                    <div>
                                        <div class="font-medium">{{ $item['label'] }}</div>
                                        <div class="mt-1 text-xs {{ $section === $key ? 'text-[#C0392B]' : 'text-[#A58A99]' }}">
                                            {{ match($key) {
                                                'dashboard' => 'See live platform signals',
                                                'paths' => 'Curate learning journeys',
                                                'modules' => 'Shape lesson structure',
                                                'lessons' => 'Manage content and media',
                                                'quizzes' => 'Control assessment flow',
                                                'battles' => 'Run creative challenges',
                                                default => 'Manage workspace',
                                            } }}
                                        </div>
                                    </div>
                                </div>

                                @if ($section === $key)
                                    <span class="h-2.5 w-2.5 rounded-full bg-[#C0392B] shadow-[0_0_0_5px_rgba(192,57,43,0.08)]"></span>
                                @endif
                            </div>
                        </button>
                    @endforeach
                </nav>
            </div>

            <div class="border-t border-[#E8D7DB] p-5">
                <div class="rounded-[1.5rem] border border-[#E8D7DB] bg-[#FDF8F6] p-5">
                    <p class="text-[11px] uppercase tracking-[0.2em] text-[#A58A99]">Signed in</p>
                    <p class="mt-3 font-medium text-[#2E1C30]">{{ auth()->user()->name ?? auth()->user()->username }}</p>
                    <p class="mt-1 text-sm text-[#8A7090]">Administrator account</p>
                </div>
            </div>
        </aside>

        {{-- MAIN --}}
        <main class="flex-1">
            <div class="px-4 py-4 lg:px-8 lg:py-8">

                {{-- TOPBAR --}}
                <div class="mb-8 overflow-hidden rounded-[1.8rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_18px_45px_rgba(192,57,43,0.08)]">
                    <div class="relative bg-[linear-gradient(145deg,#2C2060_0%,#3D1C5C_45%,#5A1C3C_100%)] px-6 py-8 text-white lg:px-8">
                        <div class="absolute right-0 top-0 h-full w-1/3 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.10),transparent_60%)]"></div>

                        <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#F4D4D9]">
                                    Admin workspace
                                </div>

                                <h2 class="mt-4 font-[Cormorant_Garamond] text-4xl font-medium tracking-tight lg:text-5xl">
                                    {{ match($section) {
                                        'paths' => 'Learning Path Management',
                                        'modules' => 'Module Management',
                                        'lessons' => 'Lesson Management',
                                        'quizzes' => 'Quiz Management',
                                        'battles' => 'Art Challenges',
                                        default => 'Dashboard Overview',
                                    } }}
                                </h2>

                                <p class="mt-3 max-w-2xl text-sm leading-7 text-white/72 lg:text-base">
                                    {{ match($section) {
                                        'paths' => 'Create, shape, and refine the journeys users follow.',
                                        'modules' => 'Control the structure that organizes each learning path.',
                                        'lessons' => 'Manage lessons, media, and the instructional experience.',
                                        'quizzes' => 'Oversee assessments, difficulty, and question flow.',
                                        'battles' => 'Launch challenges, guide participation, and review activity.',
                                        default => 'A live overview of the platform, content, and recent activity.',
                                    } }}
                                </p>
                            </div>

                            <div class="flex flex-wrap items-center gap-3">
                                <div class="rounded-[1.35rem] border border-white/12 bg-white/10 px-4 py-3 backdrop-blur">
                                    <p class="text-[11px] uppercase tracking-[0.18em] text-[#F4D4D9]">User</p>
                                    <p class="mt-1 font-medium text-white">{{ auth()->user()->name ?? auth()->user()->username }}</p>
                                </div>

                                <div class="rounded-[1.35rem] border border-[#C5E7D5] bg-[#EBF7F1] px-4 py-3 text-[#2D8A5C] shadow-sm">
                                    <p class="text-[11px] uppercase tracking-[0.18em]">Status</p>
                                    <p class="mt-1 font-medium">Online</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($section === 'dashboard')
                    <livewire:admin.dashboard-stats />
                @elseif ($section === 'paths')
                    <livewire:admin.paths.path-index />
                @elseif ($section === 'modules')
                    <livewire:admin.modules.module-index />
                @elseif ($section === 'lessons')
                    <livewire:admin.lessons.lesson-index />
                @elseif ($section === 'quizzes')
                    <livewire:admin.quizzes.quiz-index />
                @elseif ($section === 'battles')
                    <livewire:admin.battles.battle-index />
                @endif
            </div>
        </main>
    </div>
</div>