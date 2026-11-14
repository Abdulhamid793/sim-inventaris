<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = ['Elektronik', 'Mebel', 'ATK', 'Lainnya'];
        for ($i = 1; $i <= 15; $i++) {
            Item::create([
                'kode_barang' => 'BRG-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_barang' => 'Barang Contoh ' . $i,
                'kategori'    => $kategori[$i % 4],
                'stok'        => rand(1, 50),
                'kondisi'     => $i % 5 == 0 ? 'rusak' : 'baik',
            ]);
        }
    }
}