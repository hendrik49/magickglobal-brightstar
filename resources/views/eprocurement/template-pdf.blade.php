@php
$logo=\App\Models\Utility::get_file('uploads/logo/');
$dark_logo    = Utility::getValByName('dark_logo');
$img = asset($logo . '/' . (isset($dark_logo) && !empty($dark_logo) ? $dark_logo : 'logo-dark.png'));
$settings    = Utility::settings();
@endphp

@extends('layouts.contractheader')
@section('page-title')
    {{ __('E-Procurement Details') }}
@endsection

@section('title')
    {{ __('E-Procurement Details') }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10">
        <div class="container">
            <div>
                <div class="card mt-5" id="printTable" style="margin-left: 180px;margin-right: -57px;">
                    <div class="card-body p-4" id="boxes">
                        <div class="row invoice-title mt-2">
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                <img src="{{$img}}" style="max-width: 150px;"/>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                                <h3 class="invoice-number">{{ $eprocurement->nama_perusahaan }}</h3>
                            </div>
                        </div>

                        <div class="row align-items-center mb-4">
                            <div class="col-sm-6 mb-3 mb-sm-0 mt-3">
                                <div class="col-lg-12 col-md-8 mb-3">
                                    <h6 class="d-inline-block m-0 d-print-none">{{__('Nomor SK Menkumham :')}}</h6>
                                    <span class="col-md-8"><span class="text-md">{{ $eprocurement->nomor_sk_menkumham }}</span></span>
                                </div>
                                <div class="col-lg-6 col-md-8">
                                    <h6 class="d-inline-block m-0 d-print-none">{{__('No. Akta :')}}</h6>
                                    <span class="col-md-8"><span class="text-md">{{ $eprocurement->no_akta }}</span></span>
                                </div>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <div>
                                    <div class="float-end">
                                        <div class="">
                                            <h6 class="d-inline-block m-0 d-print-none">{{__('Nomor NIB OSS :')}}</h6>
                                            <span class="col-md-8"><span class="text-md">{{ $eprocurement->nomor_nib_oss }}</span></span>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="d-inline-block m-0 d-print-none">{{__('NPWP :')}}</h6>
                                            <span class="col-md-8"><span class="text-md">{{ $eprocurement->npwp }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="mb-3">{{ __('Contact Information') }}</h5>
                                <div class="mb-2">
                                    <strong>{{ __('Izin Operasional') }}:</strong> {{ $eprocurement->izin_operasional }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('Nomor Telpon') }}:</strong> {{ $eprocurement->nomor_telpon }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('Email') }}:</strong> {{ $eprocurement->email }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('Website') }}:</strong> {{ $eprocurement->website }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('Alamat') }}:</strong> {{ $eprocurement->alamat }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">{{ __('Manager Information') }}</h5>
                                <div class="mb-2">
                                    <strong>{{ __('Nama Manager') }}:</strong> {{ $eprocurement->nama_manager }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('KTP Manager') }}:</strong> {{ $eprocurement->ktp_manager }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('NPWP Komisaris') }}:</strong> {{ $eprocurement->npwp_komisaris }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('NPWP Direktur') }}:</strong> {{ $eprocurement->npwp_direktur }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="mb-3">{{ __('Bank Information') }}</h5>
                                <div class="mb-2">
                                    <strong>{{ __('Nomor Rekening') }}:</strong> {{ $eprocurement->nomor_rekening }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('Nama Bank') }}:</strong> {{ $eprocurement->nama_bank }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('Cabang Bank') }}:</strong> {{ $eprocurement->cabang_bank }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('Atas Nama') }}:</strong> {{ $eprocurement->atas_nama }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">{{ __('Status Information') }}</h5>
                                <div class="mb-2">
                                    <strong>{{ __('Status') }}:</strong> {{ ucfirst($eprocurement->status) }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('Created By') }}:</strong> {{ $eprocurement->creator->name ?? 'N/A' }}
                                </div>
                                <div class="mb-2">
                                    <strong>{{ __('Created At') }}:</strong> {{ $eprocurement->created_at->format('Y-m-d H:i:s') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-page')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
<script>

    $(window).on('load', function () {
        var element = document.getElementById('boxes');
        var opt = {
            filename: '{{$eprocurement->nama_perusahaan}}',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A4'}
        };

        html2pdf().set(opt).from(element).save();
    });
</script>
@endpush 