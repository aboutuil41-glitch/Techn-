{{-- guest.blade.php --}}
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
</head>
<body class="min-h-screen bg-[#F7F0EA] font-[Jost] text-[#2E1C30] antialiased">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-12">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(232,160,168,0.16),transparent_22%),radial-gradient(circle_at_bottom_right,rgba(196,153,107,0.08),transparent_20%)]"></div>

        <div class="pointer-events-none absolute left-10 top-12 hidden text-[160px] leading-none text-[#C0392B]/[0.04] lg:block">
            ✿
        </div>
        <div class="pointer-events-none absolute bottom-10 right-12 hidden text-[180px] leading-none text-[#E8A0A8]/[0.08] lg:block">
            ✿
        </div>

        <div class="relative w-full max-w-md">
            <div class="mb-10 text-center">
                <a href="/" class="inline-flex items-center gap-4">
                    <div class="flex h-16 w-16 items-center justify-center rounded-[1.6rem] bg-[linear-gradient(135deg,#C0392B,#A62F24)] text-2xl font-semibold text-white shadow-[0_16px_30px_rgba(192,57,43,0.24)]">
                        技
                    </div>

                    <div class="text-left">
                        <div class="font-[Cormorant_Garamond] text-3xl font-semibold leading-none text-[#1C1020]">
                            {{ config('app.name', 'Techné') }}
                        </div>
                        <div class="mt-2 text-[11px] uppercase tracking-[0.26em] text-[#8A7090]">
                            Enter the workspace
                        </div>
                    </div>
                </a>
            </div>

            <div class="overflow-hidden rounded-[2rem] border border-[#E8D7DB] bg-[#FFFCFA] shadow-[0_24px_60px_rgba(192,57,43,0.10)]">
                <div class="border-b border-[#EFE1E4] bg-[linear-gradient(180deg,#FFFDFC,#FDF6F4)] px-8 py-6 text-center">
                    <p class="text-xs uppercase tracking-[0.22em] text-[#A58A99]">Welcome</p>
                    <h1 class="mt-3 font-[Cormorant_Garamond] text-4xl font-medium text-[#1C1020]">
                        Step inside
                    </h1>
                    <p class="mt-2 text-sm leading-7 text-[#8A7090]">
                        Continue your learning journey in a calmer, more intentional space.
                    </p>
                </div>

                <div class="p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>