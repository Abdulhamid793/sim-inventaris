<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    // READ: daftar + search + filter + pagination
    public function index(Request $request)
    {
        $items = Item::query()
            ->when($request->q, function ($query, $s) {
                $query->where(function ($w) use ($s) {
                    $w->where('kode_barang', 'like', "%$s%")
                      ->orWhere('nama_barang', 'like', "%$s%");
                });
            })
            ->when($request->kategori, fn ($q, $v) => $q->where('kategori', $v))
            ->when($request->kondisi, fn ($q, $v) => $q->where('kondisi', $v))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kategoris = ['Elektronik', 'Mebel', 'ATK', 'Lainnya'];

        return view('items.index', compact('items', 'kategoris'));
    }

    // CREATE: tampilkan form
    public function create()
    {
        return view('items.create');
    }

    // CREATE: simpan
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang',
            'nama_barang' => 'required',
            'kategori'    => 'required',
            'stok'        => 'required|integer|min:0',
            'kondisi'     => 'required|in:baik,rusak',
            'gambar'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('items', 'public');
        }

        Item::create($data);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // UPDATE: tampilkan form edit
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'kode_barang' => ['required', Rule::unique('items', 'kode_barang')->ignore($item->id)],
            'nama_barang' => 'required',
            'kategori'    => 'required',
            'stok'        => 'required|integer|min:0',
            'kondisi'     => 'required|in:baik,rusak',
            'gambar'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($item->gambar) {
                Storage::disk('public')->delete($item->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('items', 'public');
        }

        $item->update($data);

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Item $item)
    {
        if ($item->gambar) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }
}
