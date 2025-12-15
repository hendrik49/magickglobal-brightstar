{{Form::model($setting,array('route' => array('bpjs-employee.updateSettingBPJS'), 'method' => 'POST', 'class'=>'needs-validation', 'novalidate')) }}
<div class="modal-body">
    {{Form::hidden('type','health',array('class'=>'form-control','required'=>'required', 'placeholder'=>__('Enter Company Percentage')))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('company_percentage',__('Company Percentage'),['class'=>'form-label'])}}
                {{Form::number('company_percentage',@$setting->company_percentage,array('class'=>'form-control','required'=>'required', 'placeholder'=>__('Enter Company Percentage')))}}
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('employee_percentage',__('Employee Percentage'),['class'=>'form-label'])}}
                {{Form::number('employee_percentage',@$setting->employee_percentage,array('class'=>'form-control','required'=>'required', 'placeholder'=>__('Enter Employee Percentage')))}}
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

