<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Laporan Rekapitulasi Inventaris') }}
        </h2>
    </x-slot>

    @php
        // Mengambil data asli langsung dari tabel items (sesuai struktur query database Anda)
        $totalJenis = \App\Models\Item::count();
        $stokBaik   = \App\Models\Item::where('kondisi', 'baik')->sum('stok');
        $stokRusak  = \App\Models\Item::where('kondisi', 'rusak')->sum('stok');
        
        // Mengelompokkan rekapitulasi berdasarkan kategori yang ada di tabel items
        $rekapKategori = \App\Models\Item::selectRaw('kategori, count(*) as total_jenis, sum(stok) as total_stok')
                            ->groupBy('kategori')
                            ->get();
    @endphp

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <!-- Header & Tombol Cetak -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 pb-4 border-b border-gray-200">
            <div>
                <h3 class="font-bold text-lg text-gray-800">Rekapitulasi Stok & Kondisi Barang</h3>
                <p class="text-xs text-gray-500 mt-0.5">Laporan resmi berkala inventaris kampus.</p>
            </div>
            <button onclick="window.print()" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition flex items-center gap-2">
                🖨️ Cetak / Print Rekapitulasi
            </button>
        </div>

        <!-- Ringkasan Kartu Statistik Laporan (Sinkron Database) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-50 border border-gray-200 p-4 rounded-xl">
                <p class="text-xs font-bold text-gray-400 uppercase">Total Jenis Barang</p>
                <p class="text-2xl font-extrabold text-gray-800 mt-1">{{ $totalJenis }} <span class="text-xs font-normal text-gray-500">Item</span></p>
            </div>
            <div class="bg-gray-50 border border-gray-200 p-4 rounded-xl">
                <p class="text-xs font-bold text-gray-400 uppercase">Total Unit (Kondisi Baik)</p>
                <p class="text-2xl font-extrabold text-emerald-600 mt-1">{{ $stokBaik }} <span class="text-xs font-normal text-gray-500">Unit</span></p>
            </div>
            <div class="bg-gray-50 border border-gray-200 p-4 rounded-xl">
                <p class="text-xs font-bold text-gray-400 uppercase">Total Unit (Kondisi Rusak)</p>
                <p class="text-2xl font-extrabold text-red-600 mt-1">{{ $stokRusak }} <span class="text-xs font-normal text-gray-500">Unit</span></p>
            </div>
        </div>

        <!-- Tabel Rekapitulasi Utama -->
        <div class="overflow-x-auto border rounded-lg">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Jumlah Jenis Barang</th>
                        <th class="py-3 px-4">Total Stok Unit</th>
                        <th class="py-3 px-4">Keterangan Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm text-gray-700">
                    @forelse($rekapKategori as $index => $rekap)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $rekap->kategori ?? 'Tanpa Kategori' }}</td>
                        <td class="py-3 px-4">{{ $rekap->total_jenis }} Jenis</td>
                        <td class="py-3 px-4">{{ $rekap->total_stok }} Unit</td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Terekap</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-400">Belum ada data barang untuk direkapitulasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>