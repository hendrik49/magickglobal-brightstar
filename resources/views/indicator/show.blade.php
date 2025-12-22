<div class="modal-body">
    <div class="row">
        <div class="col-md-12 ">
            <div class="info text-sm">
                <strong>{{__('Branch')}} : </strong>
                <span>{{ !empty($indicator->branches)?$indicator->branches->name:''}}</span>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="info text-sm font-style">
                <strong>{{__('Department')}} : </strong>
                <span>{{ !empty($indicator->departments)?$indicator->departments->name:'' }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info text-sm">
                <strong>{{__('Tanggal')}} : </strong>
                <span>{{ !empty($indicator->tanggal)?$indicator->tanggal:'' }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info text-sm">
                <strong>{{__('Designation')}} : </strong>
                <span>{{ !empty($indicator->designations)?$indicator->designations->name:''}}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info text-sm">
                <strong>{{__('Periode')}} : </strong>
                <span>{{ !empty($indicator->periode)?$indicator->periode:''}}</span>
            </div>
        </div>
    </div>

    @foreach($performance as $performances)
    <div class="row">
        <div class="col-md-12 mt-3">
            <h6>{{$performances->name}}</h6>
            <hr class="mt-0">
        </div>
        @foreach($performances->types as $types )
        <div class="col-md-4">
            {{$types->name}}
        </div>
        <div class="col-md-8">
            <fieldset id='demo1'>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="number" value="{{$targets[$types->id]}}" name="target" id="target" @if(\Auth::user()->type != 'Employee') readonly @endif>
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="number" value="{{$realisasi[$types->id]}}" name="realisasi" id="realisasi" @if(\Auth::user()->type != 'Employee') readonly @endif>
                    </div>
                    @if(\Auth::user()->type == 'HRD')
                    <div class="col-md-4 mb-2">
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" style="width:{{ $realisasi[$types->id]/$targets[$types->id]*100 }}%">{{ $realisasi[$types->id]/$targets[$types->id]*100 }} %</div>
                        </div>
                    </div>
                    @endif
                </div>
            </fieldset>
        </div>
        @endforeach
    </div>
    @endforeach
</div>



