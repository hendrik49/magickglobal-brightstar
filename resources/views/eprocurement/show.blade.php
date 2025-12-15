@extends('layouts.admin')

@section('page-title')
    {{ __('E-Procurement Details') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    
    @if(@$mode == "view")
        <li class="breadcrumb-item"><a href="{{ route('eprocurement.verified') }}">{{ __('Vendor Terverifikasi') }}</a></li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('eprocurement.index') }}">{{ __('E-Procurement') }}</a></li>
    @endif

    <li class="breadcrumb-item">{{ __('Details') }}</li>
@endsection

@section('content')
    <!-- Preview Modal -->
    <div class="modal fade" id="filePreviewModal" tabindex="-1" aria-labelledby="filePreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filePreviewModalLabel">File Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="previewContent">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>{{ __('E-Procurement Details') }}</h5>
                        <a href="{{ route('eprocurement.pdf', Crypt::encrypt($eprocurement->id)) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-file-pdf"></i> {{ __('Export PDF') }}
                        </a>
                    </div>
                </div>
                <div class="card-body" id="printableArea">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Field') }}</th>
                                    <th>{{ __('Value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ __('Nama Perusahaan') }}</td>
                                    <td>{{ $eprocurement->nama_perusahaan }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Nomor SK Menkumham') }}</td>
                                    <td>{{ $eprocurement->nomor_sk_menkumham }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('No. Akta') }}</td>
                                    <td>{{ $eprocurement->no_akta }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Nomor NIB OSS') }}</td>
                                    <td>{{ $eprocurement->nomor_nib_oss }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('NPWP') }}</td>
                                    <td>{{ $eprocurement->npwp }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Izin Operasional') }}</td>
                                    <td>{{ $eprocurement->izin_operasional }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Nomor Telpon') }}</td>
                                    <td>{{ $eprocurement->nomor_telpon }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Email') }}</td>
                                    <td>{{ $eprocurement->email }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Website') }}</td>
                                    <td>{{ $eprocurement->website }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Alamat') }}</td>
                                    <td>{{ $eprocurement->alamat }}</td>
                                </tr>

                                <!-- Manager Identity -->
                                <tr>
                                    <td>{{ __('Nama Manager') }}</td>
                                    <td>{{ $eprocurement->nama_manager }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('KTP Manager') }}</td>
                                    <td>{{ $eprocurement->ktp_manager }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('NPWP Komisaris') }}</td>
                                    <td>{{ $eprocurement->npwp_komisaris }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('NPWP Direktur') }}</td>
                                    <td>{{ $eprocurement->npwp_direktur }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('HP Komisaris') }}</td>
                                    <td>{{ $eprocurement->hp_komisaris }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('HP Direktur') }}</td>
                                    <td>{{ $eprocurement->hp_direktur }}</td>
                                </tr>

                                <tr>
                                    <td>{{ __('Nomor Rekening') }}</td>
                                    <td>{{ $eprocurement->nomor_rekening }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Nama Bank') }}</td>
                                    <td>{{ $eprocurement->nama_bank }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Cabang Bank') }}</td>
                                    <td>{{ $eprocurement->cabang_bank }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Atas Nama') }}</td>
                                    <td>{{ $eprocurement->atas_nama }}</td>
                                </tr>

                                <tr>
                                    <td>{{ __('Status') }}</td>
                                    <td>
                                        @switch($eprocurement->status)
                                            @case('pending')
                                                <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                @break
                                            @case('approved')
                                                <span class="badge bg-success">{{ __('Approved') }}</span>
                                                @break
                                            @case('rejected')
                                                <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $eprocurement->status }}</span>
                                        @endswitch
                                    </td>
                                </tr>

                                <tr>
                                    <td>{{ __('Created By') }}</td>
                                    <td>{{ $eprocurement->creator->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Created At') }}</td>
                                    <td>{{ $eprocurement->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>{{ __('Documents File') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row">
                        @foreach([
                            'sk_menkumham_file' => __('SK Menkumham File'),
                            'akta_file' => __('Akta File'),
                            'npwp_file' => __('NPWP File'),
                            'nib_oss_file' => __('NIB OSS File'),
                            'siup_file' => __('SIUP File'),
                            'npwp_komisaris_file' => __('NPWP Komisaris File'),
                            'npwp_direksi_file' => __('NPWP Direksi File'),
                            'ktp_komisaris_file' => __('KTP Komisaris File'),
                            'ktp_direksi_file' => __('KTP Direksi File'),
                            'rekening_koran_file' => __('Rekening Koran File'),
                            'neraca_file' => __('Neraca File'),
                            'company_profile_file' => __('Company Profile File'),
                            'portfolio_file' => __('Portfolio File'),
                            'cv_tenaga_ahli_file' => __('CV Tenaga Ahli File')
                        ] as $field => $label)
                            <dt class="col-sm-4">{{ $label }}:</dt>
                            <dd class="col-sm-8">
                                <div class="lazy-load" data-file-path="{{ $eprocurement->$field }}">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </dd>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    
</script>
@endsection

@push('script-page')
    <script>
        $(document).ready(function() {
            const previewModal = new bootstrap.Modal($('#filePreviewModal'));
            const previewContent = $('#previewContent');
            const modalTitle = $('#filePreviewModalLabel');

            // Lazy loading implementation
            const lazyLoadObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const container = $(entry.target);
                        const filePath = container.data('file-path');
                        
                        if (filePath && filePath !== 'null') {
                            // Show loading spinner
                            container.html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
                            
                            // Load file content
                            $.get(`/eprocurement/load-file?path=${encodeURIComponent(filePath)}`, function(response) {
                                if (response.type && response.content) {
                                    const fileType = response.type;
                                    const fileContent = response.content;
                                    
                                    // Create preview and download buttons
                                    const btnGroup = $('<div>', { class: 'btn-group', role: 'group' });
                                    
                                    const previewBtn = $('<button>', {
                                        type: 'button',
                                        class: 'btn btn-sm btn-primary preview-file',
                                        'data-file-type': fileType,
                                        'data-file-content': fileContent
                                    }).html('<i class="fas fa-eye"></i> Preview');
                                    
                                    const downloadBtn = $('<a>', {
                                        href: `data:${fileType};base64,${fileContent}`,
                                        class: 'btn btn-sm btn-success',
                                        download: filePath.split('/').pop()
                                    }).html('<i class="fas fa-download"></i> Download');
                                    
                                    btnGroup.append(previewBtn, downloadBtn);
                                    container.html(btnGroup);
                                } else {
                                    container.html('N/A');
                                }
                            }).fail(function(xhr, status, error) {
                                console.error('Error loading file:', error);
                                container.html('Error loading file');
                            });
                        } else {
                            container.html('N/A');
                        }
                        
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.1
            });

            $('.lazy-load').each(function() {
                lazyLoadObserver.observe(this);
            });

            // Preview file handler with event delegation
            $(document).on('click', '.preview-file', function(e) {
                e.preventDefault();
                
                const fileType = $(this).data('file-type');
                const fileContent = $(this).data('file-content');
                
                previewContent.empty();
                
                // Handle different file types
                if (fileType.startsWith('image/')) {
                    // For images
                    const img = $('<img>', {
                        src: `data:${fileType};base64,${fileContent}`,
                        class: 'img-fluid'
                    });
                    previewContent.append(img);
                } else if (fileType === 'application/pdf') {
                    // For PDFs
                    const iframe = $('<iframe>', {
                        src: `data:${fileType};base64,${fileContent}`,
                        style: 'width: 100%; height: 500px;'
                    });
                    previewContent.append(iframe);
                } else if (fileType.startsWith('text/')) {
                    // For text files
                    const pre = $('<pre>', {
                        class: 'bg-light p-3',
                        text: atob(fileContent)
                    });
                    previewContent.append(pre);
                } else {
                    // For unsupported file types
                    previewContent.html('<div class="alert alert-warning">Preview not available for this file type. Please download the file to view it.</div>');
                }
                
                previewModal.show();
            });
        });
    </script>
@endpush