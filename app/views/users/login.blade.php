@extends('layouts.master')

@section('title')
@parent
:: Login
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
<h2>Log in with your MU account</h2>
</div>

{{ Form::open(array('url' => 'login', 'class' => 'form-horizontal')) }}

<!-- Name -->
<div class="control-group {{{ $errors->has('username') ? 'error' : '' }}}">
{{ Form::label('MUid', 'MUid', array('class' => 'control-label')) }}

<div class="controls">
{{ Form::text('MUid', Input::old('MUid')) }}
{{ $errors->first('MUid') }}
</div>
</div>


<!-- Password -->
<div class="control-group {{{ $errors->has('password') ? 'error' : '' }}}">
{{ Form::label('password', 'Password', array('class' => 'control-label')) }}

<div class="controls">
{{ Form::password('password') }}
{{ $errors->first('password') }}
</div>
</div>

<!-- Login button -->
<div class="control-group">
<div class="controls">
{{ Form::submit('Login', array('class' => 'btn')) }}
</div>
</div>

{{ Form::close() }}
@stop
