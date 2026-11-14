@props(['href', 'active' => false])

<a href='{{ $href }}'
   class='block px-3 py-2 rounded-md text-sm {{ $active ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}'>
    {{ $slot }}
</a>
F2. Layout utama (ganti seluruh isi resources/views/layouts/app.blade.php)
<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='csrf-token' content='{{ csrf_token() }}'>
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class='font-sans antialiased bg-gray-100'>
@php
    // Form pencarian di bar atas otomatis menyesuaikan paket yang dipakai
    $searchAction = Route::has('items.index') ? route('items.index')
        : (Route::has('panel.posts.index') ? route('panel.posts.index') : route('katalog'));
@endphp

<div x-data='{ open: false }' class='min-h-screen md:flex'>

    {{-- ===== SIDEBAR ===== --}}
    <aside class='bg-slate-800 w-64 shrink-0 fixed inset-y-0 left-0 z-40 flex flex-col transform transition-transform md:static md:translate-x-0'
           :class='open ? `translate-x-0` : `-translate-x-full`'>
        <div class='px-5 py-4 text-white font-bold text-lg border-b border-slate-700'>
            {{ config('app.name', 'SIM KAMPUS') }}
        </div>

        <nav class='flex-1 p-3 space-y-1'>
            <p class='px-3 pb-1 text-xs text-slate-400'>NAVIGASI</p>
            @include('layouts.menu')
        </nav>

        <div class='p-3 border-t border-slate-700'>
            <form method='POST' action='{{ route('logout') }}'>
                @csrf
                <button class='w-full text-left px-3 py-2 rounded-md text-sm text-slate-300 hover:bg-slate-700 hover:text-white'>Keluar</button>
            </form>
        </div>
    </aside>

    {{-- Latar gelap saat sidebar terbuka di HP --}}
    <div x-show='open' @click='open = false' class='fixed inset-0 bg-black/40 z-30 md:hidden'></div>

    {{-- ===== KONTEN UTAMA ===== --}}
    <div class='flex-1 min-w-0'>

        {{-- Bar atas: pencarian + menu user --}}
        <div class='bg-white shadow px-4 py-3 flex items-center justify-between gap-3'>
            <button @click='open = !open' class='md:hidden px-3 py-1 border rounded'>&#9776;</button>

            <form method='GET' action='{{ $searchAction }}' class='flex-1 max-w-md'>
                <input type='text' name='q' value='{{ request('q') }}' placeholder='Pencarian...'
                       class='w-full rounded-md border-gray-300 bg-gray-50 text-sm'>
            </form>

            <x-dropdown align='right' width='48'>
                <x-slot name='trigger'>
                    <button class='flex items-center gap-2 text-sm'>
                        <span class='w-8 h-8 rounded-full bg-slate-700 text-white flex items-center justify-center'>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        <span class='hidden sm:inline'>{{ Auth::user()->name }}</span>
                        <span>&#9662;</span>
                    </button>
                </x-slot>
                <x-slot name='content'>
                    <x-dropdown-link href='{{ route('profile.edit') }}'>Profil</x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>

        {{-- Judul halaman (slot header dari tiap view) --}}
        @isset($header)
            <header class='bg-white border-b'>
                <div class='px-6 py-4 text-gray-800'>{{ $header }}</div>
            </header>
        @endisset

        <main>{{ $slot }}</main>
    </div>
</div>
</body>
</html>