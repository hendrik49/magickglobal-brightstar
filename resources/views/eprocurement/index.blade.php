@extends('layouts.admin')

@section('page-title')
    {{ __('E-Procurement List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('E-Procurement') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('E-Procurement List') }}</h5>
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
                                @foreach($eprocurements as $eprocurement)
                                    <tr>
                                        <td>{{ $eprocurement->id }}</td>
                                        <td>{{ $eprocurement->nama_perusahaan }}</td>
                                        <td>{{ $eprocurement->nomor_sk_menkumham }}</td>
                                        <td>{{ $eprocurement->no_akta }}</td>
                                        <td>{{ $eprocurement->nomor_nib_oss }}</td>
                                        <td>{{ $eprocurement->email }}</td>
                                        <td>{{ $eprocurement->status }}</td>
                                        <td>{{ $eprocurement->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                
                                         @if(@$mode != "view")       
                                                                                        <a href="{{ route('eprocurement.show', $eprocurement->id) }}" class="btn btn-sm align-items-center bg-info me-1" data-bs-toggle="tooltip" title="{{__('View')}}" data-original-title="{{__('View')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm align-items-center bg-success me-1" data-bs-toggle="tooltip" title="{{__('Approve')}}" data-original-title="{{__('Approve')}}" onclick="confirmAction('approved', {{ $eprocurement->id }})">
                                                    <i class="ti ti-check text-white"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm align-items-center bg-danger" data-bs-toggle="tooltip" title="{{__('Reject')}}" data-original-title="{{__('Reject')}}" onclick="confirmAction('rejected', {{ $eprocurement->id }})">
                                                    <i class="ti ti-x text-white"></i>
                                                </a>
                                        
                                        @else
                                        
                                                <a href="{{ route('eprocurement.view', $eprocurement->id) }}" class="btn btn-sm align-items-center bg-info me-1" data-bs-toggle="tooltip" title="{{__('View')}}" data-original-title="{{__('View')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                        @endif
                                        
                                            </div>
                                        </td>
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

@push('script-page')
<script>
    function confirmAction(action, id) {
        const actionText = action === 'approved' ? 'Approved' : 'Rejected';
        Swal.fire({
            title: 'Konfirmasi',
            text: `Apakah anda yakin untuk ${actionText}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: action === 'approved' ? '#28a745' : '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/eprocurement/${id}/edit?action=${action}`;
            }
        });
    }
</script>
@endpush