@extends('layouts.master')

@section('title')
@parent
:: Admin
@stop

{{-- Content --}}
@section('content')



<div style="display: inline-block" class="page-header">
	{{ Form::open(array('url' => 'admin', 'class' => 'form-vertical')) }}
	<label for="MUid">MUid</label>
	<input type="text" name="MUid"><br>

	<label for="expertise">expertise</label>
	<input type="text" name="expertise"><br>

	<input type="submit" value="Add" class="btn">
	{{ Form::close() }}
</div>


<div>
	{{ Form::open(array('url' => 'admin', 'class' => 'form-vertical')) }}
	    <table id="updateTable">
	    	<tr>
		        <td>MUid</td>
		        <td>expertise</td>
		        <td>Delete</td>
	    	</tr>
		    @for ($i = 0; $i < count($tutorMUid); $i++)	    
		    <tr>
		        <td>{{$tutorMUid[$i]}}</td>
		        <td>{{$tutorExpertise[$i]}}</td>
		        <td><input type="checkbox" name="checkbox[]" value={{$i}}></td>
		    </tr>
		    @endfor
	    </table>
	    <input type='submit' value='Update' class="btn">
	{{ Form::close() }}
</div>



@stop
