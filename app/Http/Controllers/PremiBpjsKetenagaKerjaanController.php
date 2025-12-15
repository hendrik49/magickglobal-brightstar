<?php

namespace App\Http\Controllers;

use App\Models\PremiBpjsKetenagakerjaan;
use Illuminate\Http\Request;

class PremiBpjsKetenagaKerjaanController extends Controller
{
    // Menampilkan semua data premi
    public function index()
    {
        $premis = PremiBpjsKetenagakerjaan::all();
        return view('premi.index', compact('premis'));
    }

    // Menampilkan form tambah premi
    public function create()
    {
        return view('premi.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'premi' => 'required|numeric|min:0',
        ]);

        PremiBpjsKetenagakerjaan::create($request->only('name', 'premi'));

        return redirect()->route('premi.index')->with('success', 'Data premi berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $premi = PremiBpjsKetenagakerjaan::findOrFail($id);
        return view('premi.edit', compact('premi'));
    }

    // Update data premi
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'premi' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $premi = PremiBpjsKetenagakerjaan::findOrFail($id);
        $premi->update($request->only('name', 'premi', 'is_active'));

        return redirect()->route('premi.index')->with('success', 'Data premi berhasil diperbarui.');
    }

    // Hapus data premi
    public function destroy($id)
    {
        $premi = PremiBpjsKetenagakerjaan::findOrFail($id);
        $premi->delete();

        return redirect()->route('premi.index')->with('success', 'Data premi berhasil dihapus.');
    }
}

