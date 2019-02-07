<div class="form-group {{ $errors->has('course_code') ? 'has-error' : ''}}">
    {!! Form::label('course_code', 'Course Code', ['class' => 'control-label']) !!}
    {!! Form::text('course_code', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('course_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('course_description') ? 'has-error' : ''}}">
    {!! Form::label('course_description', 'Course Description', ['class' => 'control-label']) !!}
    {!! Form::text('course_description', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('course_description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
    {!! Form::label('department_id', 'Department Id', ['class' => 'control-label']) !!}
    {{-- {!! Form::number('department_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!} --}}
    {!! Form::select('department_id', $departments, null, ['class' => 'form-control']) !!}
    {!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
