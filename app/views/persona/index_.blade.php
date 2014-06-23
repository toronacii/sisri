@extends('layout.base')

@section('css_js')

    @parent
    
    {{HTML::style('css/bootstrap-datetimepicker.min.css')}}
    {{HTML::script('js/moment-2.4.0.js')}}
    {{HTML::script('js/bootstrap-datetimepicker.js')}}
    {{HTML::script('js/locales/bootstrap-datetimepicker.es.js')}}

@stop

@section('content')
	
	<div class="col-md-12">
		<h1>Listado de personas</h1>

		@if ($personas)
		<div class="panel-group" id="accordion">
			@foreach($personas as $persona)

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$persona->id}}"> 
								#{{$persona->id}} | {{$persona->getNombreCompleto()}}
							</a>
						</h4>
					</div>
					<div id="collapse{{$persona->id}}" class="panel-collapse collapse">
						<div class="panel-body">
							
						</div>
					</div>
				</div>
			@endforeach
			{{$personas->links()}}
		</div>
		@else
		<h2>No hay personas registradas</h2>
		@endif

	</div>
	
@stop

@section('scripts')

    @parent

@stop