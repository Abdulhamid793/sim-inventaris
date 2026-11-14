<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex">
            
            <!-- SIDEBAR KIRI -->
            <div class="w-64 bg-slate-900 text-slate-300 hidden md:flex flex-col justify-between shadow-xl min-h-screen">
                <div>
                    <div class="h-16 flex items-center px-6 bg-slate-950 text-white font-bold tracking-wider border-b border-slate-800">
                        📦 SIM INVENTARIS
                    </div>
                    <div class="px-4 py-6 space-y-2">
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                            📊 Dashboard
                        </a>
                        <a href="{{ route('items.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('items.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                            📁 Data Barang
                        </a>

                        @php $user = Auth::user(); @endphp

                        @if($user && $user->role === 'admin')
                        <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('users.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                            👥 Kelola User
                        </a>
                        <a href="{{ route('reports.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('reports.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                            📈 Laporan
                        </a>
                        @endif
                    </div>
                </div>

                <div class="p-4 border-t border-slate-800">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium text-red-400 hover:bg-red-500/10">
                            🚪 Keluar
                        </button>
                    </form>
                </div>
            </div>

            <!-- KONTEN UTAMA -->
            <div class="flex-1 flex flex-col min-w-0">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow-sm border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>