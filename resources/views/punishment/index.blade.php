@extends('layouts.admin')

@section('page-title')
{{__('Manage Punishment')}}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item">{{__('Punishment')}}</li>
@endsection

@section('content')
<form method="GET" action="{{ route('punishment.index') }}" class="row align-items-end mb-3">

    {{-- Filter Tanggal --}}
    <div class="col-md-3">
        <label class="form-label">{{ __('Date') }}</label>
        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
    </div>

    {{-- Filter Position --}}
    <div class="col-md-3">
        <label class="form-label">{{ __('Position') }}</label>
        <select name="department_id" class="form-control">
    <option value="">Select Department</option>
    @foreach ($departments as $department)
        <option value="{{ $department->id }}"
            {{ request('department_id') == $department->id ? 'selected' : '' }}>
            {{ $department->name }}
        </option>
    @endforeach
</select>

    </div>

    {{-- Filter + Reset Buttons --}}
    <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            {{ __('Filter') }}
        </button>
        <a href="{{ route('punishment.index') }}" class="btn btn-secondary">
            {{ __('Reset') }}
        </a>
    </div>

    {{-- Tombol Add / Create --}}
    @can('punishment-create')
    <div class="col-md-3 text-end">
        <a href="{{ route('punishment.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> {{ __('Add') }}
        </a>
    </div>
    @endcan
</form>

<div class="col-md-12">
    <div class="card">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table punishmenttable">
                    <thead>
                        <tr>
                            @role('company')
                            <th>{{__('Employee')}}</th>
                            @endrole
                            <th>{{__('Deduction Type')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Jabatan')}}</th>
                            <th>{{__('Potong Deduction')}}</th>
                            <th>{{__('Description')}}</th>
                            @if(Gate::check('punishment-edit') || Gate::check('punishment-delete'))
                            <th width="200px">{{__('Action')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="font-style">
                        @foreach ($punishment as $punishments)
                        <tr>
                            <td>{{!empty($punishments->employee)? $punishments->employee->name:'' }}</td>

                            <td>{{ $punishments->deduction->name }}</td>
                            <td>{{ $punishments->date }}</td>
                            <td>
                                {{ $punishments->employee && $punishments->employee->department
                                ? $punishments->employee->department->name
                                : '-' }}
                                                    </td>
                            <td> Rp {{ number_format($punishments->gift, 0, ',', '.') }}</td>
                            <td>{{ $punishments->description }}</td>
                            <td class="Action">
                                <span>
                                    @can('punishment-edit')
                                    <div class="action-btn me-2">
                                        <a href="{{ route('punishment.edit', $punishments->id) }}"
                                            class="mx-3 btn btn-sm align-items-center bg-info" data-bs-toggle="tooltip"
                                            title="{{ __('Edit') }}">
                                            <i class="ti ti-pencil text-white"></i>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('punishment-delete')
                                    <div class="action-btn">
                                        {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['punishment.destroy', $punishments->id],
                                        'id' => 'delete-form-' . $punishments->id,
                                        ]) !!}
                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para bg-danger"
                                            data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                            onclick="event.preventDefault(); if(confirm('{{ __('Are You Sure? This action cannot be undone.') }}')) document.getElementById('delete-form-{{ $punishments->id }}').submit();">
                                            <i class="ti ti-trash text-white"></i>
                                        </a>
                                        {!! Form::close() !!}
                                    </div>
                                    @endcan
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection