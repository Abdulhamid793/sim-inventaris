<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Barang</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.flash')

            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">DAFTAR INVENTARIS BARANG</h3>
                    <a href="{{ route('items.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Barang Baru</a>
                </div>

                {{-- Filter kategori + kondisi + pencarian --}}
                <form method="GET" class="flex flex-wrap gap-2 mb-4">
                    <select name="kategori" class="border-gray-300 rounded">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $k)
                            <option value="{{ $k }}" @selected(request('kategori') == $k)>{{ $k }}</option>
                        @endforeach
                    </select>
                    <select name="kondisi" class="border-gray-300 rounded">
                        <option value="">Semua Kondisi</option>
                        <option value="baik" @selected(request('kondisi') == 'baik')>Baik</option>
                        <option value="rusak" @selected(request('kondisi') == 'rusak')>Rusak</option>
                    </select>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari Kode/Nama..."
                           class="border-gray-300 rounded">
                    <button class="bg-gray-800 text-white px-4 rounded">Cari</button>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2">Foto</th>
                                <th class="p-2">Kode</th>
                                <th class="p-2">Nama Barang</th>
                                <th class="p-2">Kategori</th>
                                <th class="p-2">Stok</th>
                                <th class="p-2">Kondisi</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr class="border-b">
                                    <td class="p-2">
                                        @if ($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="h-10 rounded">
                                        @else - @endif
                                    </td>
                                    <td class="p-2">{{ $item->kode_barang }}</td>
                                    <td class="p-2">{{ $item->nama_barang }}</td>
                                    <td class="p-2">{{ $item->kategori }}</td>
                                    <td class="p-2">{{ $item->stok }}</td>
                                    <td class="p-2">
                                        <span class="px-2 py-1 rounded text-xs {{ $item->kondisi == 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($item->kondisi) }}
                                        </span>
                                    </td>
                                    <td class="p-2 flex gap-2">
                                        <a href="{{ route('items.edit', $item) }}" class="text-blue-600">Edit</a>
                                        <form method="POST" action="{{ route('items.destroy', $item) }}"
                                              onsubmit="return confirm('Yakin hapus barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="p-4 text-center text-gray-500">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $items->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>