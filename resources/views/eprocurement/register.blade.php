@extends('layouts.auth_eprocurement')
@php
    use App\Models\Utility;
    $logo = \App\Models\Utility::get_file('uploads/logo');
    $settings = Utility::settings();
    $company_logo = $settings['company_logo'] ?? '';
    $setting = \Modules\LandingPage\Entities\LandingPageSetting::settings();
@endphp

@section('page-title')
    {{ __('Register E-Procurement') }}
@endsection


@section('content')
    <div class="card-body">
        <div>
            <h2 class="mb-3 f-w-600">{{ __('Register E-Procurement') }}</h2>
        </div>
        <form method="POST" action="{{ route('register.store.eprocurement') }}" class='needs-validation' novalidate>
            @if (session('status'))
                <div class="mb-4 font-medium text-lg text-green-600 text-danger">
                    {{ session('status') }}
                </div>
            @endif
            @csrf
            <div class="custom-login-form">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" autocomplete="name" autofocus
                        placeholder="{{ __('Enter Name') }}" required="required">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email"
                        name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                        placeholder="{{ __('Enter Email') }}" required="required">
                    @error('email')
                        <span class="error invalid-email text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" data-indicator="pwindicator"
                        class="form-control pwstrength @error('password') is-invalid @enderror" name="password"
                        autocomplete="new-password" placeholder="{{ __('Enter Password') }}" required="required">
                    @error('password')
                        <span class="error invalid-password text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Password Confirmation') }}</label>
                    <input id="password_confirmation" type="password" data-indicator="password_confirmation"
                        class="form-control pwstrength @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" autocomplete="new-password"
                        placeholder="{{ __('Enter Confirm Password') }}" required="required">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div id="password_confirmation" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="whatsapp_number" class="form-label">{{ __('Whatsapp Number') }}</label>
                    <input id="whatsapp_number" type="number" data-indicator="whatsapp_number" value="{{ old('whatsapp_number') }}"
                        class="form-control @error('whatsapp_number') is-invalid @enderror" name="whatsapp_number"
                        autocomplete="whatsapp_number" placeholder="{{ __('Enter Whatsapp Number') }}" required="required">
                    @error('whatsapp_number')
                        <span class="error invalid-whatsapp_number text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-check custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="termsCheckbox" name="terms" required="required">
                    <label class="form-check-label text-sm" for="termsCheckbox">{{ __('I agree to the ') }}
                        @if (is_array(json_decode($setting['menubar_page'])) || is_object(json_decode($setting['menubar_page'])))
                            @foreach (json_decode($setting['menubar_page']) as $key => $value)
                                @if (in_array($value->menubar_page_name, ['Terms and Conditions']) && isset($value->template_name))
                                    <a href="{{ $value->template_name == 'page_content' ? route('custom.page', $value->page_slug) : $value->page_url }}"
                                        target="_blank">{{ $value->menubar_page_name }}</a>
                                @endif
                            @endforeach
                            {{ __('and the ') }}
                            @foreach (json_decode($setting['menubar_page']) as $key => $value)
                                @if (in_array($value->menubar_page_name, ['Privacy Policy']) && isset($value->template_name))
                                    <a href="{{ $value->template_name == 'page_content' ? route('custom.page', $value->page_slug) : $value->page_url }}"
                                        target="_blank">{{ $value->menubar_page_name }}</a>
                                @endif
                            @endforeach
                        @endif
                    </label>
                </div>

                <div class="d-grid">
                    <input type="hidden" name="ref_code" value="0">
                    <button type="submit" class="btn btn-primary mt-2" id="saveBtn">{{ __('Register') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection

<script src="{{ asset('js/jquery.min.js') }}"></script>
