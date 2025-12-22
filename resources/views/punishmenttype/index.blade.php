@extends('layouts.admin')

@section('page-title')
    {{__('Manage Punishment')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Punishment')}}</li>
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('create Punishment ')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('award.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Award')}}">
                <i class="fa fa-plus"></i> {{__('Create')}}
            </a>
            </div>

        @endcan
    </div>
@endsection
@section('action-btn')
    <div class="float-end">
        @can('create award')
        <a href="{{ route('punishment.create') }}" data-size="lg" data-url="{{ route('punishment.create') }}" data-ajax-popup="true"
           data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create New Award')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>


        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                               
                                <th>{{__('Name')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Gift')}}</th>
                                <th>{{__('Description')}}</th>
                                @if(Gate::check('edit award') || Gate::check('delete award'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
