@extends('layout.base')

@section('content')

	<div class="page-header">
		<h3><span class="glyphicon glyphicon-user"></span>Persona #{{$persona->id}}</h3>
	</div>

	<table class="table">
		<tbody>
			<tr>
				<td><strong>Nombre: </strong>{{ $persona->getNombreCompleto() }}</td>
				<td><strong>Zona: </strong>{{ $persona->direccion->zona->zona }}</td>
			</tr>
			<tr>
				<td><strong>Teléfonos: </strong>{{ $persona->getTelefonos() }}</td>
				<td><strong>Proveniente de: </strong>{{ $persona->proveniente }}</td>
			</tr>
		</tbody>
	</table>

@stop

@section('scripts')


@stop