@extends('layouts.admin')

@section('page-title')
{{ __('Create Punishment') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item"><a href="{{ url('punishment') }}">{{ __('Punishment') }}</a></li>
<li class="breadcrumb-item">{{ __('Create Punishment') }}</li>
@endsection


@section('content')
<div class="row">
    {{ Form::open(['route' => ['punishment.store'], 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=>'needs-validation', 'novalidate']) }}
    <div class="">
        <div class="">
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card em-card">
                        <div class="card-header">
                            <h5>{{ __('Punishment Create') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                {{-- Karyawan --}}
                                <div class="form-group col-md-6">
                                    {!! Form::label('employee_id', __('Karyawan'), ['class' => 'form-label']) !!}
                                    <x-required></x-required>
                                    {!! Form::select(
                                    'employee_id',
                                    $employees->pluck('name', 'id'),
                                    null,
                                    ['class' => 'form-control', 'required', 'placeholder' => 'Pilih Karyawan']
                                    ) !!}
                                </div>

                                {{-- Deduction Type --}}
                                <div class="form-group col-md-6">
                                    {!! Form::label('deduction_type', __('Deduction Type'), ['class' => 'form-label'])
                                    !!}
                                    <x-required></x-required>
                                    {!! Form::select(
                                    'punishmentype',
                                    $punishmentype->pluck('name', 'id'),
                                    null,
                                    ['class' => 'form-control', 'required', 'placeholder' => 'Pilih Deduction Type']
                                    ) !!}
                                </div>

                                {{-- Date --}}
                                <div class="form-group col-md-6">
                                    {!! Form::label('date', __('Tanggal'), ['class' => 'form-label']) !!}
                                    <x-required></x-required>
                                    {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
                                </div>

                                {{-- Amount --}}
                                <div class="form-group col-md-6">
                                    {!! Form::label('amount', __('Potong Deduction'), ['class' => 'form-label']) !!}
                                    <x-required></x-required>
                                    {!! Form::number('amount', null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => 'Contoh: 20000'
                                    ]) !!}
                                </div>

                                {{-- Description --}}
                                <div class="form-group col-md-12">
                                    {!! Form::label('description', __('Deskripsi'), ['class' => 'form-label']) !!}
                                    {!! Form::textarea('description', null, [
                                    'class' => 'form-control',
                                    'rows' => 3,
                                    'placeholder' => 'Contoh: Terlambat masuk kerja'
                                    ]) !!}
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="float-end">
                    <input type="button" value="{{__('Cancel')}}"
                        onclick="location.href = '{{route('punishment.index')}}'" class="btn btn-secondary me-2">
                    <button type="submit" class="btn  btn-primary">{{ 'Create' }}</button>
                </div>

            </div>


        </div>


    </div>
    {!! Form::close() !!}
</div>
@endsection