<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\InsuranceMedical;
use Illuminate\Http\Request;

class BpjsKesehatanController extends Controller
{
    public function index()
    {
        $insuranceMedicals = InsuranceMedical::with('employee')->where('provider', 'BPJS Kesehatan')->get();
        return view('bpjs-kesehatan.index', compact('insuranceMedicals'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('bpjs-kesehatan.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'policy_number' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        $request['provider'] = 'BPJS Kesehatan';

        InsuranceMedical::create($request->all());

        return redirect()->route('bpjs-kesehatan.index')->with('success', 'Data premi berhasil ditambahkan.');
    }

    public function edit($id)
    {
         $insuranceMedical = InsuranceMedical::findOrFail($id);
        $employees = Employee::all();
        return view('bpjs-kesehatan.edit', compact('insuranceMedical', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $insuranceMedical = InsuranceMedical::findOrFail($id);
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'policy_number' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        $insuranceMedical->update($request->all());

        return redirect()->route('bpjs-kesehatan.index')->with('success', 'Data premi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $insuranceMedical = InsuranceMedical::findOrFail($id);
        $insuranceMedical->delete();

        return redirect()->route('bpjs-kesehatan.index')->with('success', 'Data premi berhasil dihapus.');
    }
}
