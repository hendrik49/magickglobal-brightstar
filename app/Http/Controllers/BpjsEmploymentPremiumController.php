<?php

namespace App\Http\Controllers;

use App\Models\BpjsEmploymentPremium;
use App\Models\PremiBpjsKetenagakerjaan;
use App\Models\Employee;
use Illuminate\Http\Request;

class BpjsEmploymentPremiumController extends Controller
{
    // Tampilkan daftar data premi
    public function index()
    {
        $premiums = BpjsEmploymentPremium::with(['employee', 'premiType'])->get();
        return view('bpjs-ketenagakerjaan.index', compact('premiums'));
    }

    // Tampilkan form tambah
    public function create()
    {
        $employees = Employee::where('created_by', \Auth::user()->creatorId())->get();
        $premiTypes = PremiBpjsKetenagakerjaan::all();
        return view('bpjs-ketenagakerjaan.create', compact('employees', 'premiTypes'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'premi_bpjs_ketenagakerjaan_id' => 'required|exists:premi_bpjs_ketenagakerjaan,id',
            'employee_id' => 'required|exists:employees,id',
            'policy_number' => 'required|string|max:255',
            'company_percentage' => 'required|numeric|min:0|max:100',
            'employee_percentage' => 'required|numeric|min:0|max:100',
        ]);

        BpjsEmploymentPremium::create($request->all());

        return redirect()->route('bpjs-ketenagakerjaan.index')->with('success', 'Data BPJS berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $premium = BpjsEmploymentPremium::findOrFail($id);
        $employees = Employee::where('created_by', \Auth::user()->creatorId())->get();
        $premiTypes = PremiBpjsKetenagakerjaan::all();
        return view('bpjs-ketenagakerjaan.edit', compact('premium', 'employees', 'premiTypes'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'premi_bpjs_ketenagakerjaan_id' => 'required|exists:premi_bpjs_ketenagakerjaan,id',
            'employee_id' => 'required|exists:employees,id',
            'policy_number' => 'required|string|max:255',
            'company_percentage' => 'required|numeric|min:0|max:100',
            'employee_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $premium = BpjsEmploymentPremium::findOrFail($id);
        $premium->update($request->all());

        return redirect()->route('bpjs-ketenagakerjaan.index')->with('success', 'Data BPJS berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $premium = BpjsEmploymentPremium::findOrFail($id);
        $premium->delete();

        return redirect()->route('bpjs-ketenagakerjaan.index')->with('success', 'Data BPJS berhasil dihapus.');
    }
}
