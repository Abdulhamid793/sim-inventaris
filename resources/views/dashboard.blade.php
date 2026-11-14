<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Inventaris') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- KARTU STATISTIK ATAS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-200">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Jenis Barang</p>
                    <p class="text-3xl font-extrabold text-gray-900 mt-2">
                        {{ \App\Models\Item::count() }} <span class="text-sm font-normal text-gray-500">Item</span>
                    </p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-200">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Stok Unit (Baik)</p>
                    <p class="text-3xl font-extrabold text-emerald-600 mt-2">
                        {{ \App\Models\Item::where('kondisi', 'baik')->sum('stok') }} <span class="text-sm font-normal text-gray-500">Unit</span>
                    </p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-200">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Stok Unit (Rusak)</p>
                    <p class="text-3xl font-extrabold text-red-600 mt-2">
                        {{ \App\Models\Item::where('kondisi', 'rusak')->sum('stok') }} <span class="text-sm font-normal text-gray-500">Unit</span>
                    </p>
                </div>
            </div>

            <!-- TABEL DATA BARANG TERBARU DI DASHBOARD -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-lg text-gray-800">Daftar Barang Terbaru</h3>
                    <a href="{{ route('items.index') }}" class="text-sm text-indigo-600 font-semibold hover:underline">Kelola Data Barang &rarr;</a>
                </div>

                <div class="overflow-x-auto border rounded-lg">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b">
                                <th class="py-3 px-4">No</th>
                                <th class="py-3 px-4">Kode Barang</th>
                                <th class="py-3 px-4">Nama Barang</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4">Stok</th>
                                <th class="py-3 px-4">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y text-sm text-gray-700">
                            @php
                                // Mengambil data barang terbaru dari database
                                $items = \App\Models\Item::latest()->take(5)->get();
                            @endphp

                            @forelse($items as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{ $index + 1 }}</td>
                                <!-- Menyesuaikan dengan kolom database yang umum (kode_barang / kode atau name / nama_barang) -->
                                <td class="py-3 px-4 font-mono text-xs font-semibold text-gray-600">{{ $item->kode_barang ?? $item->kode ?? '-' }}</td>
                                <td class="py-3 px-4 font-medium text-gray-900">{{ $item->nama_barang ?? $item->name ?? '-' }}</td>
                                <td class="py-3 px-4 text-gray-600">{{ $item->kategori ?? '-' }}</td>
                                <td class="py-3 px-4 font-semibold">{{ $item->stok ?? 0 }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ strtolower($item->kondisi) == 'baik' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($item->kondisi ?? 'Baik') }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-400">Belum ada data barang yang tersimpan di sistem.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>