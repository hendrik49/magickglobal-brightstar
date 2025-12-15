@extends('layouts.admin')
@section('page-title')
    {{ __('Setting Dashboard Company') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Companies') }}</a></li>
    <li class="breadcrumb-item">{{ __('Setting Dashboard Company') }}</li>
@endsection

@php
    $lang = \App\Models\Utility::getValByName('default_language');
    // $logo=asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo');

    $logo_light = \App\Models\Utility::getValByName('logo_light');
    $logo_dark = \App\Models\Utility::getValByName('logo_dark');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $setting = \App\Models\Utility::colorset();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';
    $flag = !empty($setting['color_flag']) ? $setting['color_flag'] : '';
    $SITE_RTL = isset($setting['SITE_RTL']) ? $setting['SITE_RTL'] : 'off';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $google_recaptcha_version = ['v2-checkbox' => __('v2'), 'v3' => __('v3')];
@endphp

{{-- Storage setting --}}
@php
    $file_type = config('files_types');
    $setting = App\Models\Utility::settings();

    $local_storage_validation = $setting['local_storage_validation'];
    $local_storage_validations = explode(',', $local_storage_validation);

    $s3_storage_validation = $setting['s3_storage_validation'];
    $s3_storage_validations = explode(',', $s3_storage_validation);

    $wasabi_storage_validation = $setting['wasabi_storage_validation'];
    $wasabi_storage_validations = explode(',', $wasabi_storage_validation);

@endphp
<style>


</style>


@push('script-page')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })

        $('.colorPicker').each(function () {
            const colorPicker = this;

            const hiddenInput = $(colorPicker)
                .closest('.color-picker-wrp')
                .find(".color-hidden-input");

            colorPicker.addEventListener('input', function () {
                const selectedColor = colorPicker.value;
                document.documentElement.style.setProperty('--color-customColor', selectedColor);
                hiddenInput.val(selectedColor);
                console.log('Warna yang dipilih:', selectedColor, '→ disimpan ke input name:', hiddenInput.attr('name'));
            });
        });
        
           
       $(document).ready(function () {
            $('.upload-trigger').on('click', function () {
                $(this).siblings('.file-input').click();
            });

            $('.file-input').on('change', function (e) {
                const file = e.target.files[0];

                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    // Cari elemen img terdekat ke atas
                    const $imgPreview = $(this).closest('.choose-files').prev('.logo-content').find('img');

                    reader.onload = function (e) {
                        $imgPreview.attr('src', e.target.result);
                    };

                    reader.readAsDataURL(file);
                } else {
                    alert('File yang dipilih bukan gambar!');
                }
            });
        });

        $.fn.removeClassRegex = function(regex) {
            return $(this).removeClass(function(index, classes) {
                return classes.split(/\s+/).filter(function(c) {
                    return regex.test(c);
                }).join(' ');
            });
        };
    </script>

    <script type="text/javascript">

    </script>

    {{--    for cookie setting --}}
    <script type="text/javascript">
        function enablecookie() {
            const element = $('#enable_cookie').is(':checked');
            $('.cookieDiv').addClass('disabledCookie');
            if (element == true) {
                $('.cookieDiv').removeClass('disabledCookie');
                $("#cookie_logging").attr('checked', true);
            } else {
                $('.cookieDiv').addClass('disabledCookie');
                $("#cookie_logging").attr('checked', false);
            }
        }
    </script>

    <script>
        if ($('#cust-darklayout').length > 0) {
            var custthemedark = document.querySelector("#cust-darklayout");
            custthemedark.addEventListener("click", function() {
                if (custthemedark.checked) {
                    $('#main-style-link').attr('href', '{{ config('app.url') }}' +
                        '/public/assets/css/style-dark.css');
                    document.body.style.Icon = 'linear-gradient(141.55deg, #22242C 3.46%, #22242C 99.86%)';

                    $('.dash-sidebar .main-logo a img').attr('src',
                        '{{ isset($logo_light) && !empty($logo_light) ? $logo . $logo_light : $logo . '/logo-light.png' }}'
                        );

                } else {
                    $('#main-style-link').attr('href', '{{ config('app.url') }}' + '/public/assets/css/style.css');
                    document.body.style.setProperty('Icon',
                        'linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #f0f4f3 99.86%)', 'important');

                    $('.dash-sidebar .main-logo a img').attr('src',
                        '{{ isset($logo_light) && !empty($logo_light) ? $logo . $logo_light : $logo . '/logo-dark.png' }}'
                        );

                }
            });
        }

    </script>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Settings') }}</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">

                <div class="col-xl-12">
                    {{--  Start for all settings tab --}}

                    <!--Site Settings-->
                    <div id="brand-settings" class="card">
                        <div class="card-header">
                            <h5>{{ __('Dashboard Company') }}</h5>
                        </div>
                        <form action="{{ route('update.dashboard.company', $id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon Manufacture') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_manufacture))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_manufacture ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_manufacture" id="icon_manufacture" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color Manufacture') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_manufacture }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_manufacture"
                                                    value="{{ @$settingDashoard->background_manufacture }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon pertambangan') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_pertambangan))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_pertambangan ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_pertambangan" id="icon_pertambangan" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color pertambangan') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_pertambangan }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_pertambangan"
                                                    value="{{ @$settingDashoard->background_pertambangan }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon koperasi') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_koperasi))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_koperasi ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_koperasi" id="icon_koperasi" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color koperasi') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_koperasi }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_koperasi"
                                                    value="{{ @$settingDashoard->background_koperasi }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon pertanian') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_pertanian))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_pertanian ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_pertanian" id="icon_pertanian" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color pertanian') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_pertanian }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_pertanian"
                                                    value="{{ @$settingDashoard->background_pertanian }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon ekspedisi') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_ekspedisi))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_ekspedisi ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_ekspedisi" id="icon_ekspedisi" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color ekspedisi') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_ekspedisi }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_ekspedisi"
                                                    value="{{ @$settingDashoard->background_ekspedisi }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon ritel') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_ritel))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_ritel ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_ritel" id="icon_ritel" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color ritel') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_ritel }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_ritel"
                                                    value="{{ @$settingDashoard->background_ritel }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon pelanggan') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_pelanggan))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_pelanggan ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_pelanggan" id="icon_pelanggan" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color pelanggan') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_pelanggan }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_pelanggan"
                                                    value="{{ @$settingDashoard->background_pelanggan }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon vendor') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_vendor))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_vendor ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_vendor" id="icon_vendor" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color vendor') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_vendor }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_vendor"
                                                    value="{{ @$settingDashoard->background_vendor }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon invoice') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_invoice))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_invoice ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_invoice" id="icon_invoice" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color invoice') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_invoice }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_invoice"
                                                    value="{{ @$settingDashoard->background_invoice }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card logo_card">
                                            <div class="card-header">
                                                <h5>{{ __('Icon bills') }}</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="setting-card">
                                                    <div class="logo-content mt-4">
                                                        @if(!empty($settingDashoard->icon_bill))
                                                            <img src="{{asset(Storage::url('/'.$settingDashoard->icon_bill ))}}" class="big-logo">
                                                        @else
                                                            <img id="image" src="https://placehold.co/600x400" class="big-logo">
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <div class="bg-primary company_logo_update upload-trigger" style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="icon_bill" id="icon_bill" class="form-control file d-none file-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card"
                                                class="me-2"></i>{{ __('Color bills') }}
                                        </h6>
        
                                        <hr class="my-2" />
                                        <div class="color-wrp">
                                            <div class="color-picker-wrp">
                                                <input type="color" value="{{ @$settingDashoard->background_bill }}"
                                                    class="colorPicker"
                                                    name="custom_color" id="color-picker">
                                                <input type='hidden'  class="color-hidden-input" name="background_bill"
                                                    value="{{ @$settingDashoard->background_bill }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="form-group mb-0">
                                    <input class="btn btn-print-invoice btn-primary" type="submit"
                                        value="{{ __('Save Changes') }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
