@extends('layouts.app')

@section('content')
<div class="container">
	<a href="{{ route('generate-pdf',['download'=>'pdf']) }}">Download PDF</a>
	<table class="table table-bordered">
		<thead>
			<th>name</th>
			<th>amount</th>
			<th>date</th>
		</thead>
		<tbody>
			@foreach($sponsors as $sponsor)
			@if(\Auth::user()->id == $sponsor->user_id)
			<tr>
				<td>{{ $sponsor->project_id }}</td>
				<td>{{ $sponsor->credits }}</td>
				<td>{{ $sponsor->created_at }}</td>
			</tr>
			@endif
			@endforeach
		</tbody>
	</table>
@endsection