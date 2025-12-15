{{ Form::model($incomingMail, array('route' => array('incoming-mail.update', $incomingMail->id), 'method' => 'PUT', 'class'=>'needs-validation', 'novalidate')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('mail_no', __('Mail No'),['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::text('mail_no', '', array('class' => 'form-control','required'=>'required', 'placeholder' => __('Enter Mail No'))) }}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('subject',__('Subject'),array('class'=>'form-label')) }}<x-required></x-required>
            {{Form::textarea('subject',null,array('class'=>'form-control','rows'=>3 ,'required'=>'required', 'placeholder' => __('Enter Subject'))) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('date',__('Date'),array('class'=>'form-label')) }}<x-required></x-required>
            {{ Form::date('date',null,array('class'=>'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('source',__('Source'),array('class'=>'form-label')) }}<x-required></x-required>
            {{ Form::text('source',null,array('class'=>'form-control', 'placeholder' => __('Enter Source'))) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('status',__('Status'),array('class'=>'form-label')) }}<x-required></x-required>
            {{ Form::select('status', ['R' => 'Received', 'P' => 'Processed'], null, array('class' => 'form-control select', 'required'=>'required')) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Edit')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}
