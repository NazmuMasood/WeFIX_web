@extends('adminlte::page')

@section('title', 'WeFIX Reports')

@section('content_header')
	@include('flash-message')
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
	<form class="form" action="{{ route('reports.delete') }}" method="POST"> @csrf
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
			<th><button class="btn" title="Delete rows" type="submit" >
				<i class="fa fa-trash"></i></button></th>
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
			<td align="center"><input type="checkbox" name="del_ids[]" value="{{$key}}"></td>
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
				<th><button class="btn" title="Delete rows" type="submit">
					<i class="fa fa-trash"></i></button></th>
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
		<p>&copy; {{ date('Y') }} WeFIX &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
	</footer>
@stop

@section('js')
	<!-- page script -->
	<script>	
		var table = $('#example1').DataTable({
		// ... skipped ...
		});

		$('form').on('submit', function(e){
			if(!confirm("Do you really want to delete the selected rows?")) {
				return false;
			}
			var $form = $(this);

			// Iterate over all checkboxes in the table
			table.$('input[type="checkbox"]').each(function(){
				// If checkbox doesn't exist in DOM
				if(!$.contains(document, this)){
					// If checkbox is checked
					if(this.checked){
						// Create a hidden element 
						$form.append(
						$('<input>')
							.attr('type', 'hidden')
							.attr('name', this.name)
							.val(this.value)
						);
					}
				} 
			});          
		});
	</script>
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
