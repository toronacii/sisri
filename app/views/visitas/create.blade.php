@extends('layout.base')

@section('content')

@if(Session::has('message'))
	<div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif

{{Form::open(array('route' => 'visitas.store', 'method' => 'POST'))}}
	<fieldset class="form-group">
		{{Form::label('picture', 'Imagen: ')}}

		@if($errors->has('picture'))
		{{Form::label('picture', $errors->first('picture'))}}
		@endif

		{{Form::file('picture')}}
		<p class="help-block">Debes subir exclusivamente archivos de imagen</p>
	</fieldset>

	<fieldset class="form-group">
		<input type="submit" class="btn btn-success" value="Subir">
	</fieldset>
{{Form::close()}}

@stop