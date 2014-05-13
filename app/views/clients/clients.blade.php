@extends('layouts.master')

@section('title')
@parent
:: Clients
@stop

@section('content')
<div class="page-header">
<h2>Hello Client!</h2>
</div>





<div class="page-header">
{{ Form::open(array(
	'route' => 'postClients',
    'method' => 'post')) 
}}

{{ Form::label('courselabel', 'Select courses:') }}


<div style="display: inline-block">
<select id="availableCourse" multiple size="5">
	<optgroup style="font-size:9px;text-decoration:none;" label="Available"></optgroup>
	@foreach ($coursesAvailable as $element)
   		<option value={{ $element }}> {{ $element}} </option>
	@endforeach	
</select>
</div>

<div style="display: inline-block">
<div style="border: 1px solid #000; padding: 3px; cursor: pointer" id="moveright">&gt</div>
<div style="border: 1px solid #000; padding: 3px; cursor: pointer" id="moveleft">&lt</div>
</div>

<div style="display: inline-block">
<select id="chosenCourse" name="chosenCourse[]" multiple size="5">
	<optgroup style="font-size:9px;text-decoration:none;" label="Waitinglist"></optgroup>
	@foreach ($coursesWaitinglist as $beingTutoredCourse)
   		<option value={{ $beingTutoredCourse }}> {{ $beingTutoredCourse}} </option>
	@endforeach	
</select>
</div>
</div>   
    
    {{ Form::label('courselabel', 'Select times:') }}
<div class="page-header">

    <div style="display: inline-block">
<select id="availableTime" multiple size="10">
	<optgroup style="font-size:9px;text-decoration:none;" label="Available"></optgroup>
     <optgroup style="font-size:12px;text-decoration:none;" label="Monday"></optgroup>
	   	<option value=8-9am,Monday> 8-9am </option>
	   	<option value=9-10am,Monday> 9-10am </option>
	   	<option value=10-11am,Monday> 10-11am </option>
        <option value=2-3pm,Monday> 2-3pm </option>
        <option value=3-4pm,Monday> 3-4pm </option>
    <optgroup style="font-size:12px;text-decoration:none;" label="Tuesday"></optgroup>
	   	<option value=8-9am,Tuesday> 8-9am </option>
	   	<option value=9-10am,Tuesday> 9-10am </option>
	   	<option value=10-11am,Tuesday> 10-11am </option>
        <option value=2-3pm,Tuesday> 2-3pm </option>
        <option value=3-4pm,Tuesday> 3-4pm </option>
    <optgroup style="font-size:12px;text-decoration:none;" label="Wednesday"></optgroup>
	   	<option value=8-9am,Wednesday> 8-9am </option>
	   	<option value=9-10am,Wednesday> 9-10am </option>
	   	<option value=10-11am,Wednesday> 10-11am </option>
        <option value=2-3pm,Wednesday> 2-3pm </option>
        <option value=3-4pm,Wednesday> 3-4pm </option>
    <optgroup style="font-size:12px;text-decoration:none;" label="Thursday"></optgroup>
	   	<option value=8-9am,Thursday> 8-9am </option>
	   	<option value=9-10am,Thursday> 9-10am </option>
	   	<option value=10-11am,Thursday> 10-11am </option>
        <option value=2-3pm,Thursday> 2-3pm </option>
        <option value=3-4pm,Thursday> 3-4pm </option>
    <optgroup style="font-size:12px;text-decoration:none;" label="Friday"></optgroup>
	   	<option value=8-9am,Friday> 8-9am </option>
	   	<option value=9-10am,Friday> 9-10am </option>
	   	<option value=10-11am,Friday> 10-11am </option>
		
</select>
</div>

<div style="display: inline-block">
<div style="border: 1px solid #000; padding: 3px; cursor: pointer" id="addtime">&gt</div>

</div>

<div style="display: inline-block">
<select id="chosenTime" name="chosenCourse[]" multiple size="10">
	<optgroup style="font-size:9px;text-decoration:none;" label="Chosen"></optgroup>
	@foreach ($timeChosen as $element)
   		<option value={{ $element }}> {{ $element}} </option>
	@endforeach	
</select>
</div>
    
<div style="display: inline-block">
<div style="border: 1px solid #000; padding: 3px; cursor: pointer" id="deletetime">&gt</div>
</div>

</div>


<div class="page-header">

	{{ Form::submit('update');}}
</div>

{{ Form::close() }}
@stop
