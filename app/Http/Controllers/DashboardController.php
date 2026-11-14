<?php

namespace App\Http\Controllers;

use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItem = Item::count();                              // jumlah jenis barang
        $totalStok = Item::sum('stok');                          // total unit fisik
        $barangRusak = Item::where('kondisi', 'rusak')->sum('stok');
        $terbaru = Item::latest()->take(5)->get();

        return view('dashboard', compact('totalItem', 'totalStok', 'barangRusak', 'terbaru'));
    }
}