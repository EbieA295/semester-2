<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPoliklinik;
use App\Models\Dokter;
use Illuminate\Support\Str;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = JadwalPoliklinik::query();

        if ($start_date && $end_date) {
            $query->whereBetween('tanggal_praktek', [$start_date, $end_date]);
        }

        // Variabel compact disesuaikan agar sama dengan di view
        $jadwalpoliklinik = $query->orderBy('tanggal_praktek', 'asc')->get();

        return view('jadwalpoliklinik.index', compact('jadwalpoliklinik'));
    }

    public function create()
    {
        $dokters = Dokter::all();
        return view('jadwalpoliklinik.create', compact('dokters'));
    }

    public function add(Request $request)
    {
        $request->validate([
            // Diubah ke 'dokters' (pakai s) sesuai database kamu di image_76d699.jpg
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_praktek' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'jumlah' => 'required|integer|min:1',
        ]);

        $jadwalpoliklinik = new JadwalPoliklinik();
        // Model JadwalPoliklinik kamu sudah punya fitur auto-kode di boot(),
        // jadi baris kode manual ini sebenarnya opsional.
        $jadwalpoliklinik->dokter_id = $request->dokter_id;
        $jadwalpoliklinik->poliklinik_id = Dokter::find($request->dokter_id)->poliklinik_id;
        $jadwalpoliklinik->tanggal_praktek = $request->tanggal_praktek;
        $jadwalpoliklinik->jam_mulai = $request->jam_mulai;
        $jadwalpoliklinik->jam_selesai = $request->jam_selesai;
        $jadwalpoliklinik->jumlah = $request->jumlah;
        $jadwalpoliklinik->save();

        return redirect()->route('jadwalpoliklinik.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(int $id)
    {
        $jadwalpoliklinik = JadwalPoliklinik::findOrFail($id);
        $dokter = Dokter::all();
        return view('jadwalpoliklinik.update', compact('jadwalpoliklinik', 'dokter'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_praktek' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'jumlah' => 'required|integer|min:1',
        ]);

        $jadwalpoliklinik = JadwalPoliklinik::findOrFail($id);
        $jadwalpoliklinik->dokter_id = $request->dokter_id;
        $jadwalpoliklinik->poliklinik_id = Dokter::find($request->dokter_id)->poliklinik_id;
        $jadwalpoliklinik->tanggal_praktek = $request->tanggal_praktek;
        $jadwalpoliklinik->jam_mulai = $request->jam_mulai;
        $jadwalpoliklinik->jam_selesai = $request->jam_selesai;
        $jadwalpoliklinik->jumlah = $request->jumlah;
        $jadwalpoliklinik->save();

        return redirect()->route('jadwalpoliklinik.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(int $id)
    {
        $jadwalpoliklinik = JadwalPoliklinik::findOrFail($id);
        $jadwalpoliklinik->delete();

        return redirect()->route('jadwalpoliklinik.index')->with('success', 'Data berhasil dihapus');
    }
}
