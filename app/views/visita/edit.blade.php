@extends('layouts.scaffold')

@section('main')

<h1>Edit Visitum</h1>
{{ Form::model($visitum, array('method' => 'PATCH', 'route' => array('visita.update', $visitum->id))) }}
	<ul>
        <li>
            {{ Form::label('condicion', 'Condicion:') }}
            {{ Form::text('condicion') }}
        </li>

        <li>
            {{ Form::label('fecha', 'Fecha:') }}
            {{ Form::text('fecha') }}
        </li>

        <li>
            {{ Form::label('obsercacion', 'Obsercacion:') }}
            {{ Form::textarea('obsercacion') }}
        </li>

        <li>
            {{ Form::label('tipo', 'Tipo:') }}
            {{ Form::text('tipo') }}
        </li>

        <li>
            {{ Form::label('hora', 'Hora:') }}
            {{ Form::text('hora') }}
        </li>

        <li>
            {{ Form::label('tema', 'Tema:') }}
            {{ Form::text('tema') }}
        </li>

        <li>
            {{ Form::label('publicacion', 'Publicacion:') }}
            {{ Form::text('publicacion') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('visita.show', 'Cancel', $visitum->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
