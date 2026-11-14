<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Utama</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.flash')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-xs text-gray-500">TOTAL ITEM BARANG</p>
                    <p class="text-3xl font-bold">{{ $totalItem }} Jenis</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-xs text-gray-500">TOTAL STOK FISIK</p>
                    <p class="text-3xl font-bold">{{ $totalStok }} Unit</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-xs text-gray-500">BARANG RUSAK/AFKIR</p>
                    <p class="text-3xl font-bold text-red-600">{{ $barangRusak }} Unit</p>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-bold mb-3">5 Barang Terbaru</h3>
                <ul class="divide-y">
                    @foreach ($terbaru as $b)
                        <li class="py-2 flex justify-between">
                            <span>{{ $b->kode_barang }} - {{ $b->nama_barang }}</span>
                            <span>Stok: {{ $b->stok }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('items.index') }}" class="text-blue-600 mt-3 inline-block">Lihat semua &rarr;</a>
            </div>
        </div>
    </div>
</x-app-layout>