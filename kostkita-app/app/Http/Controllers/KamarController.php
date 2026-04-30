<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KamarController extends Controller
{
    // Menampilkan semua daftar kamar
    public function index()
    {
        $semuaKamar = Kamar::all();
        return view('kamar.index', compact('semuaKamar'));
    }

    // Menampilkan form tambah kamar
    public function create()
    {
        return view('kamar.create');
    }

    // Menyimpan data kamar baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kamar' => 'required',
            'harga_per_bulan' => 'required|numeric',
            'stok_kamar' => 'required|numeric',
        ]);

        Kamar::create([
            'user_id' => Auth::id() ?? 1, // Mengambil ID user yang sedang login
            'nama_kamar' => $request->nama_kamar,
            'deskripsi' => $request->deskripsi,
            'harga_per_bulan' => $request->harga_per_bulan,
            'stok_kamar' => $request->stok_kamar,
            'fasilitas' => $request->fasilitas,
        ]);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan!');
    }
}