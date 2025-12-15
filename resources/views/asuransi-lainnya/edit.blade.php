{{ Form::model($insuranceMedical, ['route' => ['asuransi-lainnya.update', $insuranceMedical->id], 'method' => 'PUT', 'class' => 'needs-validation', 'novalidate']) }}
<div class="modal-body" id="bpjsModal">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('policy_number', __('Nomor BPJS'), ['class' => 'form-label']) }}
                {{ Form::number('policy_number', null, ['class' => 'form-control', 'required' => true, 'placeholder' => __('Masukkan Nomor BPJS')]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('provider', __('Jenis Asuransi'), ['class' => 'form-label']) }}
                {{ Form::text('provider', null, ['class' => 'form-control', 'required' => true, 'placeholder' => __('Masukkan Jenis Asuransi')]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('employee_id', __('Karyawan'), ['class' => 'form-label']) }}
                {{ Form::select('employee_id', $employees->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '-- Pilih Karyawan --', 'required' => true]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('nominal', __('Nominal (Rp)'), ['class' => 'form-label']) }}
                {{ Form::number('nominal', null, ['class' => 'form-control', 'required' => true, 'step' => '0.01']) }}
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn btn-primary">
</div>
{{ Form::close() }}
