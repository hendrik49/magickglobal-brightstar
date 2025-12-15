@extends('layouts.admin')
@section('page-title')
    {{__('Manage Premi BPJS Ketenagakerjaan')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Premi')}}</li>
@endsection

@section('action-btn')
    <div class="float-end d-flex">
        <a href="#" data-url="{{ route('premi.create') }}" data-ajax-popup="true" data-title="{{__('Tambah Premi')}}" data-bs-toggle="tooltip" title="{{__('Tambah Premi')}}"  class="btn btn-sm btn-primary">
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
                                <th>{{__('Name')}}</th>
                                <th>{{__('Premi')}}</th>
                                <th width="200px">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($premis as $premi)
                                <tr>
                                    <td class="font-style">{{ $premi->name }}</td>
                                    <td>{{ $premi->premi }}%</td>
                                    @if(Gate::check('edit employee') || Gate::check('delete employee'))
                                        <td>
                                            <div class="action-btn me-2">
                                                <a href="#" data-url="{{ route('premi.edit',$premi->id)}}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Premi')}}" class="mx-3 btn btn-sm align-items-center bg-info" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}"><i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                            <div class="action-btn ">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['premi.destroy', $premi->id],'id'=>'delete-form-'.$premi->id]) !!}

                                                <a href="#" class=" btn btn-sm align-items-center bs-pass-para bg-danger" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$premi->id}}').submit();">
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
