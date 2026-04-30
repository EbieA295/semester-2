<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Dokter;
use App\Models\Poliklinik;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::latest()->get();
        return view('dokter.index', compact('dokter'));
    }

    public function create()
    {
        Log::info('Metode create dipanggil');
        $poliklinik = Poliklinik::all();
        return view('dokter.create', compact('poliklinik'));
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'nama_dokter'   => 'required|max:255',
            'poliklinik_id' => 'required',
            'foto_dokter'   => 'image|nullable|max:1999'
        ]);

        // Upload foto
        if ($request->hasFile('foto_dokter')) {
            $file = $request->file('foto_dokter');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $file->storeAs('public/foto_dokter', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Simpan data
        Dokter::create([
            'nama_dokter'   => $validatedData['nama_dokter'],
            'poliklinik_id' => $validatedData['poliklinik_id'],
            'foto_dokter'   => $fileNameToStore
        ]);

        return redirect()->route('dokter.index')
            ->with('success', 'Berhasil menyimpan data');
    }

    public function show($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('dokter.show', compact('dokter'));
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $poliklinik = Poliklinik::all();

        return view('dokter.update', compact('dokter', 'poliklinik'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_dokter'   => 'required|max:255',
            'poliklinik_id' => 'required',
            'foto_dokter'   => 'image|nullable|max:1999'
        ]);

        $dokter = Dokter::findOrFail($id);

        if ($request->hasFile('foto_dokter')) {
            $file = $request->file('foto_dokter');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $file->storeAs('public/foto_dokter', $fileNameToStore);

            // Hapus foto lama
            if ($dokter->foto_dokter !== 'noimage.jpg') {
                Storage::delete('public/foto_dokter/' . $dokter->foto_dokter);
            }

            $dokter->foto_dokter = $fileNameToStore;
        }

        $dokter->update([
            'nama_dokter'   => $validatedData['nama_dokter'],
            'poliklinik_id' => $validatedData['poliklinik_id']
        ]);

        return redirect()->route('dokter.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);

        if ($dokter->foto_dokter !== 'noimage.jpg') {
            Storage::delete('public/foto_dokter/' . $dokter->foto_dokter);
        }

        $dokter->delete();

        return redirect()->route('dokter.index')
            ->with('success', 'Data berhasil dihapus');
    }
}