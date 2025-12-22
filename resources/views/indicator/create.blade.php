{{Form::open(array('url'=>'indicator','method'=>'post', 'class'=>'needs-validation', 'novalidate'))}}
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('branch',__('Branch'),['class'=>'form-label'])}}<x-required></x-required>
                {{Form::select('branch',$brances,null,array('class'=>'form-control select','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('department',__('Department'),['class'=>'form-label'])}}<x-required></x-required>
                {{Form::select('department',$departments,null,array('class'=>'form-control select','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('tanggal',__('Tanggal'),['class'=>'form-label'])}}<x-required></x-required>
                {{Form::date('tanggal', date('Y-m-d'), array('class'=>'form-control ','required' => 'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('designation',__('Designation'),['class'=>'form-label'])}}<x-required></x-required>
                <select class="select form-control select2-multiple" id="designation_id" name="designation" data-toggle="select2" data-placeholder="{{ __('Select Designation ...') }}" required>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('periode',__('Periode'),['class'=>'form-label'])}}<x-required></x-required>
                <select class="select form-control select2-multiple" id="periode" name="periode" data-toggle="select2" data-placeholder="{{ __('Select Periode ...') }}" required>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>
        </div>
    </div>
    <hr class="mt-0">
    <div class="row">
        <div class="col-md-4">
            <h6>Indikator</h6>
        </div>
        <div class="col-md-3">
            <h6> Target</h6>
        </div>
        <div class="col-md-3">
            <h6> Pencapaian</h6>
        </div>
    </div>
    <hr class="mt-1">
    @foreach($performance as $performances)
    <div class="row">
        <div class="col-md-12 mt-3">
            <h6>{{$performances->name}}</h6>
            <hr class="mt-0">
        </div>
        @foreach($performances->types as $types )
        <div class="col-4">
            {{$types->name}}
        </div>
        <div class="col-8">
            <fieldset id='demo1'>
                <div class="row">
                    <div class="col-4 mb-2">
                        <input type="number" class="form-control" name="target[{{$types->id}}]" id="target-{{$types->id}}">
                    </div>
                    <div class="col-4 mb-2">
                        <input type="number" class="form-control" name="realisasi[{{$types->id}}]" id="realisasi-{{$types->id}}">
                    </div>
                </div>
            </fieldset>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{Form::close()}}

<script>
    $(document).ready(function() {
        $('#designation_id').empty();
        $('#designation_id').append('<option value="">{{__('Select Designation')}}</option>');
    });
</script>