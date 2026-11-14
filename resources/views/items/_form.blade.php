@csrf

<div class="mb-4">
    <label class="block font-medium">Kode Barang</label>
    <input type="text" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang ?? '') }}"
           class="w-full border-gray-300 rounded">
    @error('kode_barang') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Nama Barang</label>
    <input type="text" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang ?? '') }}"
           class="w-full border-gray-300 rounded">
    @error('nama_barang') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Kategori</label>
    <select name="kategori" class="w-full border-gray-300 rounded">
        @foreach (['Elektronik', 'Mebel', 'ATK', 'Lainnya'] as $k)
            <option value="{{ $k }}" @selected(old('kategori', $item->kategori ?? '') == $k)>{{ $k }}</option>
        @endforeach
    </select>
    @error('kategori') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Stok</label>
    <input type="number" name="stok" value="{{ old('stok', $item->stok ?? 0) }}"
           class="w-full border-gray-300 rounded">
    @error('stok') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Kondisi</label>
    <select name="kondisi" class="w-full border-gray-300 rounded">
        <option value="baik" @selected(old('kondisi', $item->kondisi ?? '') == 'baik')>Baik</option>
        <option value="rusak" @selected(old('kondisi', $item->kondisi ?? '') == 'rusak')>Rusak</option>
    </select>
</div>

<div class="mb-4">
    <label class="block font-medium">Gambar Bukti Fisik (opsional)</label>
    <input type="file" name="gambar" accept="image/*">
    @error('gambar') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    @if (!empty($item->gambar))
        <img src="{{ asset('storage/' . $item->gambar) }}" class="h-20 mt-2 rounded">
    @endif
</div>

<div class="flex gap-2">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="{{ route('items.index') }}" class="px-4 py-2 border rounded">Batal</a>
</div>