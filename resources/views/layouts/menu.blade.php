<x-side-link href='{{ route('dashboard') }}' active='{{ request()->routeIs('dashboard') }}'>Dashboard</x-side-link>
<x-side-link href='{{ route('items.index') }}' active='{{ request()->routeIs('items.*') }}'>Data Barang</x-side-link>
@if (auth()->user()->role === 'admin')
    <x-side-link href='{{ route('users.index') }}' active='{{ request()->routeIs('users.*') }}'>Kelola User</x-side-link>
@endif