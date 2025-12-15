@extends('layouts.admin')
@section('page-title')
    {{__('Manage BPJS Ketenagakerjaan')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('BPJS Ketenagakerjaan')}}</li>
@endsection

@section('action-btn')
    <div class="float-end d-flex">
        <a href="#" data-url="{{ route('bpjs-ketenagakerjaan.create') }}" data-ajax-popup="true" data-title="{{__('Tambah BPJS Ketenagakerjaan')}}" data-bs-toggle="tooltip" title="{{__('Tambah BPJS Ketenagakerjaan')}}"  class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
        <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('Employee ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Lama Bekerja')}}</th>
                                <th>{{__('Gaji')}}</th>
                                <th>{{__('NO BPJS')}}</th>
                                <th>{{__('Porsi Karyawan') }}</th>
                                <th>{{__('Porsi Perusahaan') }}</th>
                                <th width="200px">{{__('Action')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($premiums as $employee)
                                <tr>
                                    <td class="Id">
                                        @can('show employee profile')
                                            <a href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($employee->employee->id))}}" class="btn btn-outline-primary">{{ \Auth::user()->employeeIdFormat($employee->employee->employee_id) }}</a>
                                        @else
                                            <a href="#"  class="btn btn-outline-primary">{{ \Auth::user()->employeeIdFormat($employee->employee->employee_id) }}</a>
                                        @endcan
                                    </td>
                                    <td class="font-style">{{ $employee->employee->name }}</td>
                                    <td>{{ $employee->employee->lama_bekerja }}</td>
                                    <td>{{ number_format(@$employee->employee->salary, 0, ',', '.') }}</td>
                                    <td>{{ @$employee->policy_number }}</td>
                                    <td>{{ number_format(@$employee->employee_contribution, 0, ',', '.') }} ({{ number_format(@$employee->employee_percentage, 0, ',', '.') }}%)</td>
                                    <td>{{ number_format(@$employee->company_contribution, 0, ',', '.') }} ({{ number_format(@$employee->company_percentage, 0, ',', '.') }}%)</td>
                                    @if(Gate::check('edit employee') || Gate::check('delete employee'))
                                        <td>
                                            <div class="action-btn me-2">
                                                <a href="#" data-url="{{ route('bpjs-ketenagakerjaan.edit',$employee->id)}}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit BPJS Ketenagakerjaan')}}" class="mx-3 btn btn-sm align-items-center bg-info" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit BPJS Ketenagakerjaan')}}"><i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                            <div class="action-btn ">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['bpjs-ketenagakerjaan.destroy', $employee->id],'id'=>'delete-form-'.$employee->id]) !!}

                                                <a href="#" class=" btn btn-sm align-items-center bs-pass-para bg-danger" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$employee->id}}').submit();">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
