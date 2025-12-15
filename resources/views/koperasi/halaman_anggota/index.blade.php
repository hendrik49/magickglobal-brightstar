@extends('layouts.admin')

@section('page-title')
    {{ __('Koperasi') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Koperasi') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Halaman Anggota List') }}</h5>
                </div>
                <div class="card-body table-border-style table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Nama Perusahaan') }}</th>
                                    <th>{{ __('Nomor SK Menkumham') }}</th>
                                    <th>{{ __('No. Akta') }}</th>
                                    <th>{{ __('Nomor NIB OSS') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
<script>
</script>
@endpush