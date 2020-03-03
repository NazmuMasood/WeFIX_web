@extends('adminlte::page')

@section('title', 'WeFIX Reports')

@section('content_header')
    <h1 class="m-0 text-dark">Reports</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header" style="background-color:mistyrose;">
	  <h3 class="card-title">
			<i>
				<a id="target">Total Reports</a>
				{{-- @if (isset($anchor))
					<input type="hidden" name="anchor" value="{{ $anchor }}">
				@endif --}}
				@if (session()->has('reportsCount'))
						({{session()->get('reportsCount')}})
				@endif
			</i>
		</h3>
	  <div style="float:right">
			<a href="{{action('FirebaseController@static_array_to_csv')}}" target="_blank">
				<u>Download as CSV</u>
			</a>
	  </div>
    </div>
    <!-- /.box-header -->
    <div class="card-body">
	<form action="{{ route('reports.delete') }}" method="POST"> @csrf
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
			<th><button class="btn" title="Delete rows" type="submit"><i class="fa fa-trash"></i></button></th>
            <th style="width:11.5%">Pollution type</th>
			<th>Address</th>
			<th style="width:11.5%">Latitude-Longitude</th>
			<th style="width:11.5%">Extent</th>
			<th style="width:11.5%">Source</th>
			<th style="width:11.5%">Posted At</th>
			<th style="width:11.5%">Audio</th>
			<th style="width:11.5%">Images</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($reports as $key => $report)
        <tr>
			<td align="center"><input type="checkbox" name="del_ids[]" class="selectbox" val="{{$key}}"></td>
            <td>{{$report['category']}}</td>
			<td>{{$report['address']}}</td>

			<td>
				{{$report['location']['latitude']}}, {{ $report['location']['longitude']}}
			</td>

			<td>{{$report['extent']}}</td>
			<td>{{$report['source']}}</td>
			<td>{{$report['postedAt']}}</td>
			
			@if (array_key_exists('audiosUrl',$report))
				<td>
					<a href={{$report['audiosUrl']}} target="_blank">Play audio</a>
				</td>
			@else
				<td> - </td>
			@endif

			@if (array_key_exists('imagesUrl',$report))
				<td>
					@foreach ($report['imagesUrl'] as $indexKey=>$imageUrl)
						<a href={{$imageUrl}} target="_blank">Image-{{$indexKey+1}}<br></a>
					@endforeach
				</td>
			@else
				<td> - </td>
			@endif
        </tr>
        @endforeach
        </tbody>
		
		<tfoot>
			<tr>
				<th>Pollution type</th>
				<th>Address</th>
				<th>Latitude-Longitude</th>
				<th>Extent</th>
				<th>Source</th>
				<th>Posted At</th>
				<th>Audio</th>
				<th>Images</th>
			</tr>
		</tfoot>
	  </table>
	  <input type="hidden" name='_method' value='POST'>
	</form>
    </div>
    <!-- /.box-body -->
</div>

@stop

@section('footer')
	<!-- FOOTER -->
	<footer class="container">
		<p class="float-right"><a href="#">Back to top</a></p>
		<p>&copy; 2020 WeFIX &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
	</footer>
@stop

@section('js')
	<!-- page script -->
	<script>
		$(function () {
			//if ( $( "[name='anchor']" ).length ) {
				// window.location = '#' + $( "[name='anchor']" ).val();
			//}
			//window.location = '#' + "target";
		});
	</script>
	
	@stack('js')
	@yield('js')
@stop
