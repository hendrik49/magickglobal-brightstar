{{Form::model(null,array('route' => array('bpjs-ketenagakerjaan.store'), 'method' => 'POST', 'class'=>'needs-validation', 'novalidate')) }}
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
                {{ Form::label('employee_id', __('Karyawan'), ['class' => 'form-label']) }}
                {{ Form::select('employee_id', $employees->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '-- Pilih Karyawan --', 'required' => true]) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('premi_bpjs_ketenagakerjaan_id', __('Jenis Premi'), ['class' => 'form-label']) }}
                {{ Form::select('premi_bpjs_ketenagakerjaan_id', $premiTypes->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '-- Pilih Jenis Premi --', 'required' => true]) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('company_percentage', __('Persentase Perusahaan (%)'), ['class' => 'form-label']) }}
                {{ Form::number('company_percentage', null, ['class' => 'form-control', 'required' => true, 'step' => '0.01']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('employee_percentage', __('Persentase Karyawan (%)'), ['class' => 'form-label']) }}
                {{ Form::number('employee_percentage', null, ['class' => 'form-control', 'required' => true, 'step' => '0.01']) }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Save')}}" class="btn btn-primary">
</div>
{{Form::close()}}





