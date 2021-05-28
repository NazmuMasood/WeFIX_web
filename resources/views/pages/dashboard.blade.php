@extends('adminlte::page')

@section('title', 'WeFIX Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
	@if (session()->has('flash_notification.success')) 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">{!! session('flash_notification.success') !!}</p>
                </div>
            </div>
        </div>
	</div>
	@endif

	<div class="card" style="width: 14rem;">
		<a href="/reports">
			<img class="card-img-top" src="vendor/adminlte/dist/img/web_hi_res_512.png" alt="Card image cap">
			<div class="card-body">
			<h4>
				See Reports
				@if (session()->has('reportsCount'))
					({{session()->get('reportsCount')}})
				@endif
			</h4>
			</div>
		</a>
    </div>
@stop

@section('footer')
	<!-- FOOTER -->
	<footer class="container">
		<p>&copy; {{ date('Y') }} WeFIX &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
	</footer>
@stop
