<!DOCTYPE html>
<html>
<head>
<title>
@section('title')
Bernie
@show
</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS are placed here -->
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/bootstrap-responsive.css') }}

<style>
@section('styles')
body {
    padding-top: 60px;
}
@show
</style>

</head>

<body>
<!-- Navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>

<a class="brand" href="{{{ URL::to('about') }}}">Bernie</a>

<!-- Everything you want hidden at 940px or less, place within here -->
<div class="nav-collapse collapse">
<ul class="nav">
<li><a href="{{{ URL::to('') }}}">Home</a></li>
<li><a href="{{{ URL::to('clients') }}}">Clients</a> </li>
<li><a href="{{{ URL::to('records') }}}">Clientcart</a> </li>
<li><a href="{{{ URL::to('shopping') }}}">Shopping</a></li>
<li><a href="{{{ URL::to('tutors') }}}">Tutorcart</a></li>
<li><a href="{{{ URL::to('admin') }}}">Admin</a></li>

</ul> 
</div>

<div class="nav pull-right">
    <ul class="nav">
    @if ( Auth::guest() )
    <li>{{ HTML::link('login', 'Login') }}</li>


    @else
    <li>{{ HTML::link('logout', 'Logout') }}</li>
    
    @if ($user = Session::get('user'))
    <li>{{ HTML::link('profile', $user) }}</li>
    @endif
    

    @endif
    </ul>
    </div> 
    </div>
    </div>
    </div> 

    <!-- Container -->
    <div class="container">

    <!-- Success-Messages -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Success</h4>
    {{{ $message }}}
    </div>
    @endif

    <!-- Warning-Messages -->
    @if ($message = Session::get('warning'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Warning</h4>
    {{{ $message }}}
    </div>
    @endif

<!-- Content -->
@yield('content')


</div>

<!-- Scripts are placed here -->
{{ HTML::script('js/jquery.v1.8.3.min.js') }}
{{ HTML::script('js/bootstrap/bootstrap.min.js') }}

{{ HTML::script('js/shopping.js') }}
{{ HTML::script('js/cart.js') }}

{{ HTML::script('js/clientsUpdate.js') }}
{{ HTML::script('js/clientcart.js') }}
{{ HTML::script('js/admin.js') }}
@if (Session::get('new') && Session::get('user'))
    {{ HTML::script('js/getCourses.js') }}
@endif

</body>
</html>
