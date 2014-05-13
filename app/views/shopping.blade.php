@extends('layouts.master')

@section('title')
@parent
:: Shopping
@stop

@section('content')


@for ($i = 0; $i < count($clients); $i++)

<div class="page-header">    
	{{ Form::open( array(
    'route' => 'postShopping',
    'method' => 'post'
	))}}

		<input type="hidden" name={{$clients[$i]}}>

	    <table>

	    <tr>
	        <td>owner:</td>
	        <td>{{$clients[$i]}}</td>
	        <td></td>
	    </tr>
	    <tr>
	        <td>course:</td>
	        @for ($j = 0; $j < count($courses[$i]); $j++)
	        <td>	
		    
		       	<input type="checkbox" name="course[]" value={{$courses[$i][$j]}}>{{$courses[$i][$j]}}
		    
		    </td>
		    @endfor
	    </tr>

	    <tr>
	        <td>post time:</td>
	        @for ($j = 0; $j < count($timestamps[$i]); $j++)
	        <td>	
		    
		       	{{$timestamps[$i][$j]}}
		    
		    </td>
		    @endfor
	    </tr>

	    <tr>
	        <td>time:</td>
	        <td>
		        <select name="time">
		        	<option value="default">select a time</option>	
			    @for ($k = 0; $k < count($times[$i]); $k++)
			       	<option value={{$times[$i][$k]}}>{{$times[$i][$k]}}</option>
			    @endfor
				</select>
			</td>
	    </tr>
	    </table>
	    <input type='submit' value='Add to Cart' />
	{{ Form::close() }}
</div>
@endfor	

@stop
