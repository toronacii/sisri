@extends('layout.base')

@section('css_js')

    @parent 

@stop

@section('content')

<div ng-app="miApp" ng-controller="angularCtrl">

	<!-- Personas -->
	
	<div class="col-md-6 {{ ($errors->has('personas_id')) ? 'has-error' : '' }}">
        {{ Form::label('personas_id', 'Persona / Amo de casa:') }}

        @if($errors->has('personas_id'))
        {{Form::label('personas_id', $errors->first('personas_id'), array('class' => 'label label-danger'))}}
        @endif

        <div class='input-group'>
            <select class="form-control" id="personas_id" name="personas_id">
                <option value="" selected>Seleccione</option>
                @foreach(Persona::all() as $persona)  
                <option value="{{ $persona->id }}">
                    <span title="{{ Direccion::getStringDireccion($persona->direcciones_id) }}">
                        {{ (trim($name = $persona->nombre . " " . $persona->apellido)) ? $name : "(Sin nombre)" }}
                    </span>
                </option>
                @endforeach
            </select>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button" title="Nuevo registro" data-toggle="modal" data-target="#crearPersona">
                    <span class="glyphicon glyphicon-new-window"></span>
                </button>
            </span>
        </div>
    </div>

    <!-- Publicador -->

    <div class="col-md-6 {{ ($errors->has('publicadores_id')) ? 'has-error' : '' }}">
         {{ Form::label('publicadores_id', 'Publicador:') }}

        @if($errors->has('publicadores_id'))
        {{Form::label('publicadores_id', $errors->first('publicadores_id'), array('class' => 'label label-danger'))}}
        @endif

        <div class='input-group'>
            {{ Form::select('publicadores_id', Publicador::getListPublicadores(), NULL, array('class' => 'form-control')) }}
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button" title="Nuevo registro">
                    <span class="glyphicon glyphicon-new-window"></span>
                </button>
            </span>
        </div>
    <div>
</fieldset>

</div>


@stop

@section('scripts')
    
    @parent

    {{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js')}}
    {{HTML::script('js/angular/app.js')}}

@stop