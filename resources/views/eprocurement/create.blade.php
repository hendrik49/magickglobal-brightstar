@extends('layouts.admin')
@section('page-title')
    {{__('E-Procurement')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('E-Procurement')}}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('E-Procurement Form') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('eprocurement.store') }}" method="POST" enctype="multipart/form-data" id="eprocurement-form">
                        @csrf
                        <input type="hidden" id="current_step" name="current_step" value="{{ session('current_step', 1) }}">
                        <input type="hidden" id="form_action" name="form_action" value="next">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <!-- Progress bar -->
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="step-info mt-2 mb-4">
                                    <span id="current-step-text">{{__('Halaman ke 1 dari 4')}}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Steps -->
                        <div class="form-steps">
                            <!-- Step 1: Corporate Identity -->
                            <div class="step" id="step-1">
                                <h3 class="mb-4">{{__('Data Perusahaan')}}</h3>
                                
                                <div class="row">
                                    <!-- Nama Perusahaan -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Nama Perusahaan')}}</label>
                                        <input class="form-control @error('nama_perusahaan') is-invalid @enderror" id="nama_perusahaan" type="text"
                                            name="nama_perusahaan" value="{{ $eprocurement->nama_perusahaan ?? old('nama_perusahaan') }}" autocomplete="nama_perusahaan"
                                            placeholder="{{ __('Enter Nama Perusahaan') }}" required="required">
                                        @error('nama_perusahaan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Email')}}</label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="email" type="email"
                                            name="email" value="{{ $eprocurement->email ?? old('email') }}" autocomplete="email"
                                            placeholder="{{ __('Enter Email') }}" required="required">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Nomor SK Menkumham')}}</label>
                                        <input class="form-control @error('nomor_sk_menkumham') is-invalid @enderror" id="nomor_sk_menkumham" type="text"
                                            name="nomor_sk_menkumham" value="{{ $eprocurement->nomor_sk_menkumham ?? old('nomor_sk_menkumham') }}" autocomplete="nomor_sk_menkumham"
                                            placeholder="{{ __('Enter Nomor SK Menkumham') }}" required="required">
                                        @error('nomor_sk_menkumham')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- SK Menkumham File -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload SK Menkumham File')}}</label>
                                        <input class="form-control @error('sk_menkumham_file') is-invalid @enderror" type="file" 
                                            name="sk_menkumham_file" id="sk_menkumham_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->sk_menkumham_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->sk_menkumham_file) }}</small>
                                        @endif
                                        @error('sk_menkumham_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('No. Akta')}}</label>
                                        <input class="form-control @error('no_akta') is-invalid @enderror" id="no_akta" type="number"
                                            name="no_akta" value="{{ $eprocurement->no_akta ?? old('no_akta') }}" autocomplete="no_akta"
                                            placeholder="{{ __('Enter No. Akta') }}" required="required">
                                        @error('no_akta')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Akta File -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload Akta File')}}</label>
                                        <input class="form-control @error('akta_file') is-invalid @enderror" type="file" 
                                            name="akta_file" id="akta_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->akta_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->akta_file) }}</small>
                                        @endif
                                        @error('akta_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>                                   

                                    <!-- Nomor NIB OSS -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('No. NIB OSS')}}</label>
                                        <input class="form-control @error('nomor_nib_oss') is-invalid @enderror" id="nomor_nib_oss" type="number"
                                            name="nomor_nib_oss" value="{{ $eprocurement->nomor_nib_oss ?? old('nomor_nib_oss') }}" autocomplete="nomor_nib_oss"
                                            placeholder="{{ __('Enter Nomor NIB OSS') }}" required="required">
                                        @error('nomor_nib_oss')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- NIB OSS File -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload NIB OSS File')}}</label>
                                        <input class="form-control @error('nib_oss_file') is-invalid @enderror" type="file" 
                                            name="nib_oss_file" id="nib_oss_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->nib_oss_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->nib_oss_file) }}</small>
                                        @endif
                                        @error('nib_oss_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- NPWP -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('NPWP')}}</label>
                                        <input class="form-control @error('npwp') is-invalid @enderror" id="npwp" type="number"
                                            name="npwp" value="{{ $eprocurement->npwp ?? old('npwp') }}" autocomplete="npwp"
                                            placeholder="{{ __('Enter NPWP') }}" required="required">
                                        @error('npwp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- NPWP File -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload NPWP File')}}</label>
                                        <input class="form-control @error('npwp_file') is-invalid @enderror" type="file" 
                                            name="npwp_file" id="npwp_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->npwp_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->npwp_file) }}</small>
                                        @endif
                                        @error('npwp_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Izin Operasional -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Izin Operasional')}}</label>
                                        <input class="form-control @error('izin_operasional') is-invalid @enderror" id="izin_operasional" type="text"
                                            name="izin_operasional" value="{{ $eprocurement->izin_operasional ?? old('izin_operasional') }}" autocomplete="izin_operasional"
                                            placeholder="{{ __('Enter Izin Operasional') }}" required="required">
                                        @error('izin_operasional')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Izin Operasional File -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload Izin Operasional File')}}</label>
                                        <input class="form-control @error('siup_file') is-invalid @enderror" type="file" 
                                            name="siup_file" id="siup_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->siup_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->siup_file) }}</small>
                                        @endif
                                        @error('siup_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Nomor Telpon -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Nomor Telpon')}}</label>
                                        <input class="form-control @error('nomor_telpon') is-invalid @enderror" id="nomor_telpon" type="number"
                                            name="nomor_telpon" value="{{ $eprocurement->nomor_telpon ?? old('nomor_telpon') }}" autocomplete="nomor_telpon"
                                            placeholder="{{ __('Enter Nomor Telpon') }}" required="required">
                                        @error('nomor_telpon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Website -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Website')}}</label>
                                        <input class="form-control @error('website') is-invalid @enderror" id="website" type="url"
                                            name="website" value="{{ $eprocurement->website ?? old('website') }}" autocomplete="website"
                                            placeholder="{{ __('Enter Website') }}">
                                        @error('website')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Manager Identity -->
                            <div class="step d-none" id="step-2">
                                <h3 class="mb-4">{{__('Data Manager')}}</h3>
                                
                                <div class="row">
                                    <!-- Nama Direksi -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Nama Direksi')}}</label>
                                        <input class="form-control @error('nama_direksi') is-invalid @enderror" id="nama_direksi" type="text"
                                            name="nama_direksi" value="{{ $eprocurement->nama_direksi ?? old('nama_direksi') }}"
                                            placeholder="{{ __('Enter Nama Direksi') }}" required="required">
                                        @error('nama_direksi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Nama Komisaris -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Nama Komisaris')}}</label>
                                        <input class="form-control @error('nama_komisaris') is-invalid @enderror" id="nama_komisaris" type="text"
                                            name="nama_komisaris" value="{{ $eprocurement->nama_komisaris ?? old('nama_komisaris') }}"
                                            placeholder="{{ __('Enter Nama Komisaris') }}" required="required">
                                        @error('nama_komisaris')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- KTP Direksi -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('KTP Direksi')}}</label>
                                        <input class="form-control @error('ktp_direksi') is-invalid @enderror" id="ktp_direksi" type="number"
                                            name="ktp_direksi" value="{{ $eprocurement->ktp_direksi ?? old('ktp_direksi') }}"
                                            placeholder="{{ __('Enter KTP Direksi') }}" required="required">
                                        @error('ktp_direksi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- KTP Direksi File -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload KTP Direksi')}}</label>
                                        <input class="form-control @error('ktp_direksi_file') is-invalid @enderror" id="ktp_direksi_file" type="file"
                                            name="ktp_direksi_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->ktp_direksi_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->ktp_direksi_file) }}</small>
                                        @endif
                                        @error('ktp_direksi_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- KTP Komisaris -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('KTP Komisaris')}}</label>
                                        <input class="form-control @error('ktp_komisaris') is-invalid @enderror" id="ktp_komisaris" type="number"
                                            name="ktp_komisaris" value="{{ $eprocurement->ktp_komisaris ?? old('ktp_komisaris') }}"
                                            placeholder="{{ __('Enter KTP Komisaris') }}" required="required">
                                        @error('ktp_komisaris')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- KTP Komisaris File -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload KTP Komisaris')}}</label>
                                        <input class="form-control @error('ktp_komisaris_file') is-invalid @enderror" id="ktp_komisaris_file" type="file"
                                            name="ktp_komisaris_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->ktp_komisaris_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->ktp_komisaris_file) }}</small>
                                        @endif
                                        @error('ktp_komisaris_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- NPWP Direksi -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('NPWP Direksi')}}</label>
                                        <input class="form-control @error('npwp_direksi') is-invalid @enderror" id="npwp_direksi" type="number"
                                            name="npwp_direksi" value="{{ $eprocurement->npwp_direksi ?? old('npwp_direksi') }}"
                                            placeholder="{{ __('Enter NPWP Direksi') }}" required="required">
                                        @error('npwp_direksi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- NPWP Direksi File -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload NPWP Direksi')}}</label>
                                        <input class="form-control @error('npwp_direksi_file') is-invalid @enderror" id="npwp_direksi_file" type="file"
                                            name="npwp_direksi_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->npwp_direksi_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->npwp_direksi_file) }}</small>
                                        @endif
                                        @error('npwp_direksi_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- NPWP Komisaris -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('NPWP Komisaris')}}</label>
                                        <input class="form-control @error('npwp_komisaris') is-invalid @enderror" id="npwp_komisaris" type="number"
                                            name="npwp_komisaris" value="{{ $eprocurement->npwp_komisaris ?? old('npwp_komisaris') }}"
                                            placeholder="{{ __('Enter NPWP Komisaris') }}" required="required">
                                        @error('npwp_komisaris')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- NPWP Komisaris File -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload NPWP Komisaris')}}</label>
                                        <input class="form-control @error('npwp_komisaris_file') is-invalid @enderror" id="npwp_komisaris_file" type="file"
                                            name="npwp_komisaris_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->npwp_komisaris_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->npwp_komisaris_file) }}</small>
                                        @endif
                                        @error('npwp_komisaris_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- HP Direksi -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('HP Direksi')}}</label>
                                        <input class="form-control @error('hp_direksi') is-invalid @enderror" id="hp_direksi" type="number"
                                            name="hp_direksi" value="{{ $eprocurement->hp_direksi ?? old('hp_direksi') }}"
                                            placeholder="{{ __('Enter HP Direksi') }}" required="required">
                                        @error('hp_direksi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- HP Komisaris -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('HP Komisaris')}}</label>
                                        <input class="form-control @error('hp_komisaris') is-invalid @enderror" id="hp_komisaris" type="number"
                                            name="hp_komisaris" value="{{ $eprocurement->hp_komisaris ?? old('hp_komisaris') }}"
                                            placeholder="{{ __('Enter HP Komisaris') }}" required="required">
                                        @error('hp_komisaris')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Financial Data -->
                            <div class="step d-none" id="step-3">
                                <h3 class="mb-4">{{__('Data Keuangan')}}</h3>
                                
                                <div class="row">
                                    <!-- Nomor Rekening -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Nomor Rekening')}}</label>
                                        <input class="form-control @error('nomor_rekening') is-invalid @enderror" id="nomor_rekening" type="number"
                                            name="nomor_rekening" value="{{ $eprocurement->nomor_rekening ?? old('nomor_rekening') }}" autocomplete="nomor_rekening"
                                            placeholder="{{ __('Enter Nomor Rekening') }}" required="required">
                                        @error('nomor_rekening')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Nama Bank -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Nama Bank')}}</label>
                                        <input class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank" type="text"
                                            name="nama_bank" value="{{ $eprocurement->nama_bank ?? old('nama_bank') }}" autocomplete="nama_bank"
                                            placeholder="{{ __('Enter Nama Bank') }}" required="required">
                                        @error('nama_bank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Cabang Bank -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Cabang Bank')}}</label>
                                        <input class="form-control @error('cabang_bank') is-invalid @enderror" id="cabang_bank" type="text"
                                            name="cabang_bank" value="{{ $eprocurement->cabang_bank ?? old('cabang_bank') }}" autocomplete="cabang_bank"
                                            placeholder="{{ __('Enter Cabang Bank') }}" required="required">
                                        @error('cabang_bank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Atas Nama -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Atas Nama')}}</label>
                                        <input class="form-control @error('atas_nama') is-invalid @enderror" id="atas_nama" type="text"
                                            name="atas_nama" value="{{ $eprocurement->atas_nama ?? old('atas_nama') }}" autocomplete="atas_nama"
                                            placeholder="{{ __('Enter Atas Nama') }}" required="required">
                                        @error('atas_nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Upload buku/rekening koran -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload Buku/Rekening Koran')}}</label>
                                        <input class="form-control @error('rekening_koran_file') is-invalid @enderror" type="file"
                                            name="rekening_koran_file" id="rekening_koran_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->rekening_koran_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->rekening_koran_file) }}</small>
                                        @endif
                                        @error('rekening_koran_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Upload Neraca -->
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">{{__('Upload Neraca')}}</label>
                                        <input class="form-control @error('neraca_file') is-invalid @enderror" type="file"
                                            name="neraca_file" id="neraca_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->neraca_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->neraca_file) }}</small>
                                        @endif
                                        @error('neraca_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Portfolio -->
                            <div class="step d-none" id="step-4">
                                <h3 class="mb-4">{{__('Portofolio')}}</h3>
                                
                                <div class="row">
                                    <!-- Upload Company Profile -->
                                    <div class="col-md-4 form-group">
                                        <label class="form-label">{{__('Upload Company Profile')}}</label>
                                        <input class="form-control @error('company_profile_file') is-invalid @enderror" type="file"
                                            name="company_profile_file" id="company_profile_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->company_profile_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->company_profile_file) }}</small>
                                        @endif
                                        @error('company_profile_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Upload Portfolio -->
                                    <div class="col-md-4 form-group">
                                        <label class="form-label">{{__('Upload Portofolio')}}</label>
                                        <input class="form-control @error('portfolio_file') is-invalid @enderror" type="file"
                                            name="portfolio_file" id="portfolio_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->portfolio_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->portfolio_file) }}</small>
                                        @endif
                                        @error('portfolio_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Upload CV Tenaga Ahli -->
                                    <div class="col-md-4 form-group">
                                        <label class="form-label">{{__('Upload CV Tenaga Ahli')}}</label>
                                        <input class="form-control @error('cv_tenaga_ahli_file') is-invalid @enderror" type="file"
                                            name="cv_tenaga_ahli_file" id="cv_tenaga_ahli_file" accept=".pdf,.jpg,.jpeg">
                                        @if($eprocurement && $eprocurement->cv_tenaga_ahli_file)
                                            <small class="text-muted">{{__('Current file:')}}</small>
                                            <small class="text-success">{{ basename($eprocurement->cv_tenaga_ahli_file) }}</small>
                                        @endif
                                        @error('cv_tenaga_ahli_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <button type="button" id="prev-btn" class="btn btn-secondary d-none">{{__('Sebelumnya')}}</button>
                                <button type="button" id="next-btn" class="btn btn-primary">{{__('Selanjutnya')}}</button>
                                <button type="submit" id="submit-btn" class="btn btn-success d-none">{{__('Submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
<script>
    $(document).ready(function() {
        let currentStep = {{ session('current_step', 1) }};
        let totalSteps = 4; // Make sure this matches your actual number of steps
        
        // Update progress bar and buttons
        function updateProgress() {
            let progressPercentage = ((currentStep) / totalSteps) * 100;
            $('.progress-bar').css('width', progressPercentage + '%');
            $('.progress-bar').attr('aria-valuenow', progressPercentage);
            
            // Update step text
            $('#current-step-text').text('Halaman ke ' + currentStep + ' dari ' + totalSteps);
            
            // Update buttons
            if (currentStep > 1) {
                $('#prev-btn').removeClass('d-none');
            } else {
                $('#prev-btn').addClass('d-none');
            }
            
            if (currentStep === totalSteps) {
                $('#next-btn').addClass('d-none');
                $('#submit-btn').removeClass('d-none').prop('disabled', false);
            } else {
                $('#next-btn').removeClass('d-none');
                $('#submit-btn').addClass('d-none');
            }
        }
        
        // Show specific step
        function showStep(stepNumber) {
            $('.step').addClass('d-none');
            $('#step-' + stepNumber).removeClass('d-none');
            currentStep = stepNumber;
            updateProgress();
        }

        // Disable regular form submission - all submissions will be handled by our buttons
        $('#eprocurement-form').on('submit', function(e) {
            // If the submission wasn't triggered by our buttons, prevent default behavior
            if (!window.submittingForm) {
                e.preventDefault();
                console.log('Prevented default form submission');
                return false;
            }
            
            // For debugging
            console.log('Form successfully submitting with action:', $('#form_action').val());
            
            // Allow the form to submit
            return true;
        });
        
        // Next button click
        $('#next-btn').click(function(e) {
            e.preventDefault();
            
            // Validate only visible fields in current step
            let hasError = false;
            $('#step-' + currentStep).find('input[required], select[required], textarea[required]').each(function() {
                if ($(this).val().trim() === '') {
                    hasError = true;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if (hasError) {
                alert('Please fill in all required fields in this step');
                return false;
            }
            
            // Set form action values
            $('#current_step').val(currentStep);
            $('#form_action').val('next');
            
            // Remove required attribute from all hidden steps
            $('.step.d-none').find('input[required], select[required], textarea[required]').each(function() {
                $(this).removeAttr('required');
            });
            
            console.log('Submitting next with currentStep:', currentStep);
            
            // Flag that we're intentionally submitting the form
            window.submittingForm = true;
            
            // Submit the form using native DOM method to avoid jQuery event issues
            document.getElementById('eprocurement-form').submit();
        });
        
        // Previous button click
        $('#prev-btn').click(function(e) {
            e.preventDefault();
            
            // Set form action values
            $('#current_step').val(currentStep);
            $('#form_action').val('previous');
            
            // Remove all required attributes to prevent validation
            $('form').find('input[required], select[required], textarea[required]').each(function() {
                $(this).removeAttr('required');
            });
            
            console.log('Submitting previous with currentStep:', currentStep);
            
            // Flag that we're intentionally submitting the form
            window.submittingForm = true;
            
            // Submit the form using native DOM method
            document.getElementById('eprocurement-form').submit();
        });
        
        // Submit button (final submission)
        $('#submit-btn').click(function(e) {
            e.preventDefault();
            
            // Validate current step
            let hasError = false;
            $('#step-' + currentStep).find('input[required], select[required], textarea[required]').each(function() {
                if ($(this).val().trim() === '') {
                    hasError = true;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if (hasError) {
                alert('Please fill in all required fields in this step');
                return false;
            }
            
            // Set form action values
            $('#current_step').val(currentStep);
            $('#form_action').val('submit');
            
            console.log('Submitting final form');
            
            // Flag that we're intentionally submitting the form
            window.submittingForm = true;
            
            // Submit the form using native DOM method
            document.getElementById('eprocurement-form').submit();
        });
        
        // Initialize
        showStep(currentStep);
        console.log('Starting at step:', currentStep);
    });
</script>
@endpush