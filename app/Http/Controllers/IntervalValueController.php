<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\IntervalValue;
use Illuminate\Http\Request;

class IntervalValueController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage goal tracking')) {
            $user = \Auth::user();
            if ($user->type == 'Employee') {
                $employee      = Employee::where('user_id', $user->id)->first();
                $intervalvalues = IntervalValue::where('created_by', '=', \Auth::user()->creatorId())->where('branch', $employee->branch_id)->with(['branches'])->get();
            } else {
                $intervalvalues = IntervalValue::where('created_by', '=', \Auth::user()->creatorId())->with(['branches'])->get();
            }

            return view('intervalvalue.index', compact('intervalvalues'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if (\Auth::user()->can('create interval value')) {
            $brances = Branch::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $brances->prepend('Select Branch', '');
            $status = IntervalValue::$status;

            return view('intervalvalue.create', compact('brances', 'status'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create interval value')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'branch' => 'required',
                    'min' => 'required|numeric|lte:max',
                    'max' => 'required|numeric|gte:min',
                    'name' => 'required',
                    'description' => 'nullable',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $intervalvalues                     = new IntervalValue();
            $intervalvalues->branch             = $request->branch;
            $intervalvalues->min                = $request->min;
            $intervalvalues->max                = $request->max;
            $intervalvalues->name                = $request->name;
            $intervalvalues->description        = $request->description;
            $intervalvalues->created_by         = \Auth::user()->creatorId();
            $intervalvalues->save();

            return redirect()->route('intervalvalue.index')->with('success', __('Intervalal value successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(IntervalValue $IntervalValue)
    {
        //
    }


    public function edit($id)
    {

        if (\Auth::user()->can('edit interval value')) {
            $intervalvalue = IntervalValue::find($id);
            $brances      = Branch::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $brances->prepend('Select Branch', '');
            $status = IntervalValue::$status;

            return view('intervalvalue.edit', compact('brances', 'intervalvalue', 'status'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit interval value')) {
            $intervalvalue = IntervalValue::find($id);
            $validator    = \Validator::make(
                $request->all(),
                [
                    'branch' => 'required',
                    'name' => 'required',
                    'min' => 'required|numeric|lte:max',
                    'max' => 'required|numeric|gte:min',
                    'description' => 'nullable',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $intervalvalue->branch             = $request->branch;
            $intervalvalue->min         = $request->min;
            $intervalvalue->max           = $request->max;
            $intervalvalue->name            = $request->name;
            $intervalvalue->description        = $request->description;
            $intervalvalue->save();

            return redirect()->route('intervalvalue.index')->with('success', __('Interval value successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }



    public function destroy($id)
    {

        if (\Auth::user()->can('delete interval value')) {
            $intervalvalue = IntervalValue::find($id);
            if ($intervalvalue->created_by == \Auth::user()->creatorId()) {
                $intervalvalue->delete();

                return redirect()->route('intervalvalue.index')->with('success', __('intervalvalue successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
