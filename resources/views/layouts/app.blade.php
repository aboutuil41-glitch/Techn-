{{-- app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Techné') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @livewireStyles
</head>
<body class="min-h-screen bg-[#F7F0EA] font-[Jost] text-[#2E1C30] antialiased">
    <div class="relative min-h-screen overflow-hidden">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(232,160,168,0.10),transparent_18%),radial-gradient(circle_at_bottom_right,rgba(196,153,107,0.08),transparent_18%)]"></div>

        <div class="relative min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-[#E8D7DB] bg-[#FFFCFA]/85 backdrop-blur-xl">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        <div class="rounded-[1.6rem] border border-[#EEE0E3] bg-[#FFFDFC] px-6 py-5 shadow-[0_10px_30px_rgba(192,57,43,0.05)]">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <main class="relative">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>