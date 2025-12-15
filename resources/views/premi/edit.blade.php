{{Form::model($premi,array('route' => array('premi.update', $premi->id), 'method' => 'PUT', 'class'=>'needs-validation', 'novalidate')) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('name',__('Nama Premi'),['class'=>'form-label'])}}
                {{Form::text('name', $premi->name,array('class'=>'form-control','required'=>'required', 'placeholder'=>__('Enter Nama Premi')))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('premi',__('Nilai Premi'),['class'=>'form-label'])}}
                {{Form::number('premi', $premi->premi,array('class'=>'form-control','required'=>'required', 'placeholder'=>__('Enter Premi')))}}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
</div>
{{Form::close()}}


<script>
    document.getElementById('document').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
    }
</script>

