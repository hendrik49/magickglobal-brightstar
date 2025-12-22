{{-- <div class='row'> --}}
<div class="col-4  text-end" style="margin-left: 80px;">
    <h5>{{__('Indicator')}}</h5>
</div>
<div class="col-5  text-end">
    <h5>{{__('Appraisal')}}</h5>
</div>
<hr class="mt-0">
<div class="col-3  text-end" style="margin-left: 80px;">
    <h5>{{__('Target')}}</h5>
</div>
<div class="col-2  text-end">
    <h5>{{__('Realisasi')}}</h5>
</div>
<div class="col-2 text-end" style="margin-left: 70px;">
    <h5>{{__('Target')}}</h5>
</div>
<div class="col-1  text-end">
    <h5>{{__('Realisasi')}}</h5>
</div>
@foreach ($performance_types as $performance_type)
<div class="col-md-12 mt-3">
    <h6>{{ $performance_type->name }}</h6>
    <hr class="mt-0">
</div>

@foreach ($performance_type->types as $types)
<div class="col-3">
    {{ $types->name }}
</div>
<div class="col-5">
    <fieldset id='demo1' class="rating">
        <div class="row">
            <div class="col-md-4 mb-2">
                <input class="form-control" type="number" value="{{$targets[$types->id]}}" name="target" id="target" @if(\Auth::user()->type != 'Employee') readonly @endif>
            </div>
            <div class="col-md-4 mb-2">
                <input class="form-control" type="number" value="{{$realisasi[$types->id]}}" name="realisasi" id="realisasi" @if(\Auth::user()->type != 'Employee') readonly @endif>
            </div>
        </div>
    </fieldset>
</div>
<div class="col-4">
    <fieldset id='demo1'>
        <div class="row">
            <div class="col-5 mb-2">
                <input type="number" class="form-control" name="target[{{$types->id}}]" id="target-{{$types->id}}" @if(\Auth::user()->type != 'HRD') readonly @endif>
            </div>
            <div class="col-5 mb-2">
                <input type="number" class="form-control" name="realisasi[{{$types->id}}]" id="realisasi-{{$types->id}}" @if(\Auth::user()->type != 'HRD') readonly @endif>
            </div>
        </div>
    </fieldset>
</div>

@endforeach
@endforeach