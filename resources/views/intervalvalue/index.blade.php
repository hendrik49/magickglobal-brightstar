@extends('layouts.admin')
@section('page-title')
    {{__('Manage Interval Value')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Interval Value')}}</li>
@endsection
@push('css-page')
    <style>
        @import url({{ asset('css/font-awesome.css') }});
    </style>
@endpush
@push('script-page')
    <script src="{{ asset('js/bootstrap-toggle.js') }}"></script>
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
            $("fieldset[id^='demo'] .stars").click(function () {
                alert($(this).val());
                $(this).attr("checked");
            });
        });

    </script>
@endpush

@section('action-btn')
    <div class="float-end">
    @can('create interval value')
       <a href="#" data-size="lg" data-url="{{ route('intervalvalue.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create New Interval Value')}}" class="btn btn-sm btn-primary">
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
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Min')}}</th>
                                <th>{{__('Max')}}</th>
                                <th>{{__('Description')}}</th>
                                <th width="200px">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="font-style">

                            @foreach ($intervalvalues as $intervalvalue)

                                <tr>
                                    <td>{{ !empty($intervalvalue->branches)?$intervalvalue->branches->name:'' }}</td>
                                    <td>{{$intervalvalue->name}}</td>
                                    <td>{{$intervalvalue->min}}</td>
                                    <td>{{$intervalvalue->max}}</td>
                                    <td>{{$intervalvalue->description}}</td>                          
                                    @if( Gate::check('edit interval value') ||Gate::check('delete interval value'))
                                        <td>
                                            @can('edit interval value')
                                            <div class="action-btn me-2">
                                                <a href="#" data-url="{{ route('intervalvalue.edit',$intervalvalue->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Interval Value')}}" class="mx-3 btn btn-sm align-items-center bg-info " data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                <i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                                @endcan
                                            @can('delete interval value')
                                            <div class="action-btn ">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['intervalvalue.destroy', $intervalvalue->id],'id'=>'delete-form-'.$intervalvalue->id]) !!}
                                                   <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para bg-danger" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm-yes="document.getElementById('delete-form-{{$intervalvalue->id}}').submit();">
                                                   <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                {!! Form::close() !!}
                                            </div>
                                            @endcan
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
@endsection



