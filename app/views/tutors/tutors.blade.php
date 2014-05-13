@extends('layouts.master')

@section('title')
@parent
:: Cart
@stop

@section('content')
<h1>Wishlist</h1>
@for ($i = 0; $i < count($wishlistcustomers); $i++)

<div class="page-header">    
	{{ Form::open( array(
    'route' => 'postCart',
    'method' => 'post'
	))}}

		Customer: {{$wishlistcustomers[$i]}}  <br//>
		Course  : {{$wishlistcourses[$i]}}  <br/>
		Time    : {{$wishlisttimes[$i]}}	<br/> <br/>

		<input type="hidden" name={{$wishlistcustomers[$i]}}>
		<input type="hidden" name={{$wishlistcourses[$i]}}>
		<input type="hidden" name={{$wishlisttimes[$i]}}>

	 
	    <input type='submit' value='Delete' />
	    <input type='submit' value='Confirm' />
	{{ Form::close() }}
</div>
@endfor	

<h1>Confirmed</h1>
@for ($i = 0; $i < count($confirmedcustomers); $i++)

<div class="page-header">    
	{{ Form::open( array(
    'route' => 'postCart',
    'method' => 'post'
	))}}

		Customer: {{$confirmedcustomers[$i]}}  <br//>
		Course  : {{$confirmedcourses[$i]}}  <br/>
		Time    : {{$confirmedtimes[$i]}}	<br/> <br/>

		<input type="hidden" name={{$confirmedcustomers[$i]}}>
		<input type="hidden" name={{$confirmedcourses[$i]}}>
		<input type="hidden" name={{$confirmedtimes[$i]}}>

	 
	    <input type='submit' value='Cancel' />
	{{ Form::close() }}
</div>
@endfor	

@stop
