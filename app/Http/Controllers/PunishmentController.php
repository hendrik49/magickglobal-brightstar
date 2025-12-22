<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Punishment;
use App\Models\Employee;
use App\Models\Department;
use App\Models\DeductionOption;


class PunishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
       public function index(Request $request)
{
    if (!\Auth::user()->can('punishment-view')) {
        return view('errors.permission', [
            'message' => __('Permission denied. You do not have access to manage punishments.')
        ]);
    }

    $query = Punishment::where('created_by', \Auth::user()->creatorId());

    if ($request->filled('date')) {
        $query->whereDate('date', $request->date);
    }

     // 🔥 Filter position
    if ($request->filled('department_id')) {
    $query->whereHas('employee', function ($q) use ($request) {
        $q->where('department_id', $request->department_id);
    });
}


    $departments = Department::all();
    $punishment = $query->get();

    return view('punishment.index', compact('punishment' , 'departments'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      if (\Auth::user()->can('punishment-create')) {
        $employees = Employee::all();
        $punishmentype = DeductionOption::all();
        return view('punishment.create', compact('employees', 'punishmentype'));
    }

    abort(403, 'Permission denied.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!\Auth::user()->can('punishment-create')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        

    
        $request->validate([
            'employee_id'    => 'required|exists:employees,id',
            'punishmentype'  => 'required|exists:deduction_options,id',
            'amount'         => 'required|numeric|min:0',
            'date'           => 'required|date',
            'description'    => 'nullable|string',
        ]);

    
        Punishment::create([
            'employee_id'    => $request->employee_id,
            'punishmentype' => $request->punishmentype,
            'amount'         => $request->amount,
            'date'           => $request->date,
            'description'    => $request->description,
            'created_by'     => \Auth::user()->id,
        ]);

        return redirect()
            ->route('punishment.index')->with('success', __('Punishment created successfully.'));
    }

    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (\Auth::user()->can('view-punishment')) {
            $punishment = Punishment::findOrFail($id);
            return view('punishment.show', compact('punishment'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (\Auth::user()->can('punishment-edit')) {
                $punishment = Punishment::findOrFail($id);

              $punishmentype = DeductionOption::where('created_by', \Auth::user()->creatorId())->get();
              $employees = Employee::where('created_by', \Auth::user()->creatorId())->get();
            return view('punishment.edit', compact('punishmentype', 'employees', 'punishment'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, $id)
{
    if (!\Auth::user()->can('punishment-edit')) {
        return redirect()->back()->with('error', __('Permission denied.'));
    }

    $punishment = Punishment::findOrFail($id);

    $request->validate([
        'employee_id'   => 'required|exists:employees,id',
        'punishmentype' => 'required|exists:deduction_options,id',
        'date'          => 'required|date',
        'gift'          => 'required|numeric|min:0',
        'description'   => 'nullable|string',
    ]);

    $punishment->update([
        'employee_id'   => $request->employee_id,
        'punishmentype' => $request->punishmentype,
        'date'          => $request->date,
        'gift'          => $request->gift,
        'description'   => $request->description,
    ]);

    return redirect()->route('punishment.index')
        ->with('success', __('Punishment updated successfully.'));
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (\Auth::user()->can('punishment-delete')) {
            $punishment = Punishment::findOrFail($id);
            $punishment->delete();

            return redirect()->route('punishment.index')
                             ->with('success', __('Punishment deleted successfully.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
