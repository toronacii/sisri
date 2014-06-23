@extends('layouts.scaffold')

@section('main')

<h1>All Visita</h1>

<p>{{ link_to_route('visita.create', 'Add new visitum') }}</p>

@if ($visita->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Condicion</th>
				<th>Fecha</th>
				<th>Obsercacion</th>
				<th>Tipo</th>
				<th>Hora</th>
				<th>Tema</th>
				<th>Publicacion</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($visita as $visitum)
				<tr>
					<td>{{{ $visitum->condicion }}}</td>
					<td>{{{ $visitum->fecha }}}</td>
					<td>{{{ $visitum->obsercacion }}}</td>
					<td>{{{ $visitum->tipo }}}</td>
					<td>{{{ $visitum->hora }}}</td>
					<td>{{{ $visitum->tema }}}</td>
					<td>{{{ $visitum->publicacion }}}</td>
                    <td>{{ link_to_route('visita.edit', 'Edit', array($visitum->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('visita.destroy', $visitum->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no visita
@endif

@stop
