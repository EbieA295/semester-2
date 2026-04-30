<?php

namespace App\Http\Controllers;

// WAJIB: Tambahkan baris ini agar Laravel mengenali Model Poliklinik
use App\Models\Poliklinik; 
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    public function index()
    {
        $poliklinik = Poliklinik::latest()->get();
        return view('poliklinik.index', [
            'poliklinik' => $poliklinik
        ]);
    }

    public function create()
    {
        return view('poliklinik.create');
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'nama_poliklinik' => 'required|max:255',
            'total_pasien' => 'required|numeric', // Validasi untuk total_pasien
        ]);

        Poliklinik::create($validatedData);

        // Alert success akan ditangkap oleh SweetAlert di view
        return redirect()->route('poliklinik.index')->with('success', 'Data poliklinik berhasil ditambah!');
    }

    public function edit($id)
    {
        $poliklinik = Poliklinik::findOrFail($id);
        return view('poliklinik.update', compact('poliklinik'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_poliklinik' => 'required|max:255',
            'total_pasien' => 'required|numeric', // Validasi untuk total_pasien
        ]);

        $poliklinik = Poliklinik::findOrFail($id);
        $poliklinik->update($validatedData);

        return redirect()->route('poliklinik.index')->with('success', 'Data berhasil diperbaharui!');
    }

    public function destroy($id)
    {
        $poliklinik = Poliklinik::findOrFail($id);
        $poliklinik->delete();

        return redirect()->route('poliklinik.index')->with('success', 'Data berhasil dihapus!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poliklinik' => 'required',
            'total_pasien' => 'required|numeric', // Tambahkan validasi
        ]);
    
        Poliklinik::create($request->all()); // Pastikan menggunakan create atau sebutkan kolomnya
    
        return redirect()->route('poliklinik.index')->with('success', 'Data Berhasil Ditambah');
    }
}