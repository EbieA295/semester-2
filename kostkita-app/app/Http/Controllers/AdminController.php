<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class AdminController extends Controller
{
    public function index()
    {
        $units = Unit::all(); // ambil data dari database
        return view('admin', ['units' => $units]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|unique:units,id',
            'tipe' => 'required',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required'
        ]);

        Unit::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Unit berhasil ditambahkan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $validated = $request->validate([
            'tipe' => 'required',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required'
        ]);

        $unit->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Unit berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Unit berhasil dihapus'
        ]);
    }

}