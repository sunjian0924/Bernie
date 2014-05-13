@extends('layouts.master')

@section('title')
@parent
:: Records
@stop

@section('content')


@for ($i = 0; $i < count($tutors); $i++)

<div class="page-header">    
	{{ Form::open( array(
    'route' => 'postRecords',
    'method' => 'post'
	))}}

		Tutor  : {{$tutors[$i]}}  <br//>
		Course  : {{$courses[$i]}}  <br/>
		Time    : {{$times[$i]}}	<br/> <br/>

		<input type="hidden" name={{$tutors[$i]}}>
		<input type="hidden" name={{$courses[$i]}}>
		<input type="hidden" name={{$times[$i]}}>

	 
	    <input type='submit' value='Cancel' />
	    <input type='submit' value='Cancel Next Week' />

	{{ Form::close() }}
</div>
@endfor	

@stop
