@extends('layouts.admin')

@section('page-title')
{{ __('Edit Punishment') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item"><a href="{{ url('punishment') }}">{{ __('Punishment') }}</a></li>
<li class="breadcrumb-item">{{ __('Edit Punishment') }}</li>
@endsection

@section('content')
<div class="row">

    {{ Form::model($punishment, [
        'route' => ['punishment.update', $punishment->id],
        'method' => 'PUT',
        'class' => 'needs-validation',
        'novalidate'
    ]) }}

    <div class="col-md-12 d-flex">
        <div class="card em-card w-100">

            <div class="card-header">
                <h5>{{ __('Edit Punishment') }}</h5>
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
                        ['class' => 'form-control', 'required']
                        ) !!}
                    </div>

                    {{-- Deduction Type --}}
                    <div class="form-group col-md-6">
                        {!! Form::label('punishmentype', __('Deduction Type'), ['class' => 'form-label']) !!}
                        <x-required></x-required>
                        {!! Form::select(
                        'punishmentype',
                        $punishmentype->pluck('name', 'id'),
                        null,
                        ['class' => 'form-control', 'required']
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
                        {!! Form::label('gift', __('Gift'), ['class' => 'form-label']) !!}
                        <x-required></x-required>
                        {!! Form::number('gift', null, [
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

    <div class="mt-3 text-end">
        <a href="{{ route('punishment.index') }}" class="btn btn-secondary me-2">
            {{ __('Cancel') }}
        </a>
        <button type="submit" class="btn btn-primary">
            {{ __('Update') }}
        </button>
    </div>

    {!! Form::close() !!}
</div>
@endsection