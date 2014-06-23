@extends('layout.base')

@section('content')

	<div class="page-header">
		<h3><span class="glyphicon glyphicon-user"></span>Personas</h3>
	</div>

	{{ $datatable->render() }}

@stop

@section('scripts')

	{{HTML::style('css/datatables/dataTables.bootstrap.css')}}
	{{HTML::script('js/datatables/jquery.dataTables.min.js')}}
	{{HTML::script('js/datatables/dataTables.bootstrap.js')}}
	
	{{ $datatable->script() }}

@stop