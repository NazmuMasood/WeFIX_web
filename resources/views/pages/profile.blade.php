@extends('adminlte::page')

@section('title', 'WeFIX Profile')

@section('content_header')
    <h1 class="m-0 text-dark">Profile</h1>
@stop

@section('content')
    
    <div class="card" style="width: 22rem;">
        <span class="border border-info">
            <img class="card-img-top" src="vendor/adminlte/dist/img/profile-icon.svg" alt="Profile picture" 
            height="190" >
        </span>
        <div class="card-body" style="background-color:#e9e9e6;">
        <h6><u>Name</u>: <i>{{$user->name}}</i></h6>
        <h6><u>Email</u>: <i>{{$user->email}}</i></h6>
        </div>
    </div>

@stop

@section('footer')
	<!-- FOOTER -->
	<footer class="container">
		<p>&copy; {{ date('Y') }} WeFIX &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
	</footer>
@stop
