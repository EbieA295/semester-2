<?php

namespace App\Http\Controllers;

use App\Models\Unit; // Ganti Kamar jadi Unit
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KamarController extends Controller
{
    public function index()
    {
        // Gunakan Unit::all()
        $semuaKamar = Unit::all();
        return view('kamar.index', compact('semuaKamar'));
    }

    public function create()
    {
        return view('kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kamar' => 'required',
            'harga_per_bulan' => 'required|numeric',
            'stok_kamar' => 'required|numeric',
        ]);

        // Gunakan Unit::create
        Unit::create([
            'user_id'         => Auth::id() ?? 1,
            'nama_kamar'      => $request->nama_kamar,
            'deskripsi'       => $request->deskripsi,
            'harga_per_bulan' => $request->harga_per_bulan,
            'stok_kamar'      => $request->stok_kamar,
            'fasilitas'       => $request->fasilitas,
        ]);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan!');
    }
}
