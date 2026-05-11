<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPoliklinik; // Pastikan memanggil model yang benar
use App\Models\Dokter;
use App\Models\Poliklinik;
use Illuminate\Support\Str;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalPoliklinik::query(); // Menggunakan Model

        // Filter tanggal jika ada input dari request
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal_praktek', [$request->start_date, $request->end_date]);
        }

        // Ambil data dan urutkan berdasarkan tanggal praktek
        $jadwalpoliklinik = $query->orderBy('tanggal_praktek', 'asc')->get();

        // Pastikan nama view sesuai dengan folder kamu (tadi foldernya 'jadwal')
        return view('jadwal.index', compact('jadwalpoliklinik'));
    }

    public function create()
    {
        $dokter = Dokter::all();
        return view('jadwal.create', compact('dokter'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:tabel_dokters,id',
            'tanggal_praktek' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'jumlah' => 'required|integer|min:1',
        ]);

        $jadwal = new JadwalPoliklinik();
        // Kolom 'kode' tidak perlu diisi manual karena sudah otomatis di Model boot()
        $jadwal->dokter_id = $request->dokter_id;

        // Ambil poliklinik_id otomatis dari dokter yang dipilih
        $dokter_terpilih = Dokter::find($request->dokter_id);
        $jadwal->poliklinik_id = $dokter_terpilih->poliklinik_id;

        $jadwal->tanggal_praktek = $request->tanggal_praktek;
        $jadwal->jam_mulai = $request->jam_mulai;
        $jadwal->jam_selesai = $request->jam_selesai;
        $jadwal->jumlah = $request->jumlah;
        $jadwal->save();

        return redirect()->route('jadwalpoliklinik.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwalpoliklinik = JadwalPoliklinik::findOrFail($id);
        $dokter = Dokter::all();
        return view('jadwal.update', compact('jadwalpoliklinik', 'dokter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:tabel_dokters,id',
            'tanggal_praktek' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'jumlah' => 'required|integer|min:1',
        ]);

        $jadwal = JadwalPoliklinik::findOrFail($id);
        $jadwal->dokter_id = $request->dokter_id;
        $jadwal->poliklinik_id = Dokter::find($request->dokter_id)->poliklinik_id;
        $jadwal->tanggal_praktek = $request->tanggal_praktek;
        $jadwal->jam_mulai = $request->jam_mulai;
        $jadwal->jam_selesai = $request->jam_selesai;
        $jadwal->jumlah = $request->jumlah;
        $jadwal->save();

        return redirect()->route('jadwalpoliklinik.index')->with('success', 'Data berhasil diperbarui');
    }
