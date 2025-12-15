<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\InsuranceMedical;
use Illuminate\Http\Request;

class AsuransiLainnyaController extends Controller
{
    public function index()
    {
        $insuranceMedicals = InsuranceMedical::with('employee')->where('provider', '!=','BPJS Kesehatan')->get();
        return view('asuransi-lainnya.index', compact('insuranceMedicals'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('asuransi-lainnya.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'policy_number' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'provider' => 'required'
        ]);

        InsuranceMedical::create($request->all());

        return redirect()->route('asuransi-lainnya.index')->with('success', 'Data premi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $insuranceMedical = InsuranceMedical::findOrFail($id);
        $employees = Employee::all();
        return view('asuransi-lainnya.edit', compact('insuranceMedical', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $insuranceMedical = InsuranceMedical::findOrFail($id);
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'policy_number' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'provider' => 'required'
        ]);

        $insuranceMedical->update($request->all());

        return redirect()->route('asuransi-lainnya.index')->with('success', 'Data premi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $insuranceMedical = InsuranceMedical::findOrFail($id);
        $insuranceMedical->delete();

        return redirect()->route('asuransi-lainnya.index')->with('success', 'Data premi berhasil dihapus.');
    }
}
