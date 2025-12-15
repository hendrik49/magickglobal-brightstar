@extends('layouts.auth_eprocurement')
@php
    use App\Models\Utility;
    $logo = \App\Models\Utility::get_file('uploads/logo');
    $settings = Utility::settings();
    $company_logo = $settings['company_logo'] ?? '';
@endphp

@section('page-title')
    {{ __('Login') }}
@endsection


@section('content')
    <div class="card-body">
        <div>
            <h2 class="mb-3 f-w-600">{{ __('Login E-Procurement') }}</h2>
        </div>
        {{ Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form', 'class'=>'needs-validation', 'novalidate']) }}
        @if (session('status'))
            <div class="mb-4 font-medium text-lg text-green-600 text-danger">
                {{ session('status') }}
            </div>
        @endif
        <div class="custom-login-form">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Email') }}</label>
                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email'), 'required' => 'required']) }}
                @error('email')
                    <span class="error invalid-email text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Your Password'), 'id' => 'input-password', 'required' => 'required']) }}
                @error('password')
                    <span class="error invalid-password text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-grid">
                {{ Form::submit(__('Login'), ['class' => 'btn btn-primary mt-2', 'id' => 'saveBtn']) }}
            </div>

            <p class="my-4 text-center">{{ __("Don't have an account?") }}
                <a href="{{ route('eprocurement.register') }}" class="text-primary">{{ __('Register') }}</a>
            </p>
        </div>
        {{ Form::close() }}
    </div>
@endsection

<script src="{{ asset('js/jquery.min.js') }}"></script>
