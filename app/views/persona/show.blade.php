@extends('layout.base')

@section('css_js')

    @parent
    
    {{HTML::style('css/bootstrap-datetimepicker.min.css')}}
    {{HTML::style('css/bootstrap-select.min.css')}}
    {{HTML::script('js/moment-2.4.0.js')}}
    {{HTML::script('js/bootstrap-datetimepicker.js')}}
    {{HTML::script('js/locales/bootstrap-datetimepicker.es.js')}}
    {{HTML::script('js/bootstrap-select.min.js')}}

@stop

@section('content')

	<div class="page-header">
		<h3><span class="glyphicon glyphicon-user"></span>Persona #{{$persona->id}}</h3>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<select class="form-control selectpicker show-tick" id="personas_id" name="personas_id" data-live-search="true" data-size="5" data-container="body">
		        <option value="">Seleccionar persona</option>
		        @foreach(Persona::all() as $personaSelect)  
		            <?php $id_old_persona = (isset($id_persona)) ? $id_persona : Input::old('personas_id'); ?>
		        <option value="{{ $personaSelect->id }}" data-title="{{ $direccion = Direccion::getStringDireccion($personaSelect->direcciones_id, ',<br>') }}" data-subtext="{{ $direccion }}" {{($personaSelect->id == $id_old_persona) ? 'selected' : ''}}>
		            #{{$personaSelect->id}} {{ $personaSelect->getNombreCompleto() }}
		        </option>
		        @endforeach
		    </select>
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
				<tr>
					<td><strong>Género: </strong>{{ $persona->genero }}</td>
					<td><strong>Edad: </strong>{{ $persona->edad }}</td>
				</tr>
				<tr>
					<td colspan="2">
						<strong>Dirección: </strong>
						{{ Direccion::getStringDireccion($persona->direcciones_id) }}
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="panel panel-default">
							<div class="panel-heading">Ultimas 5 visitas
								<a href="{{url("visita/create/$persona->id")}}" class="btn btn-success pull-right">Agregar visita</a>
								<div class="clearfix"></div>
							</div>
							@if ($persona->visitas->count())
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Publicador</th>
										<th>Observación</th>
										<th>Fecha</th>
									</tr>
								</thead>
								@foreach ($persona->visitas as $visita)
								<tbody>
									<tr>
										<td>{{ ($visita->publicador) ? $visita->publicador->getNombreCompleto() : "(vacio)" }}</td>
										<td>{{ $visita->observacion }}</td>
										<td>{{ $visita->fecha }}</td>
									</tr>
								</tbody>
								@endforeach
							</table>
							@else
							<div class="panel-body">
								No se ha visitado a esta persona
							</div>
							@endif
						</div>
						
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@stop

@section('scripts')

	<style>
	    .tooltip-inner {
	        white-space:pre;
	        max-width:none;
	    }

	    ul.selectpicker li small.muted{
	        display: none;
	    }

	    .bootstrap-select{
	    	max-width:400px !important;
	    }

	    h3 div.select{
	    	text-align: right;
	    }
	</style>

	<script>

		function refresh_selectpicker_title(id){

            $(id +'.selectpicker option').each(function(i){

                var titleHTML = $(this).data('title');

                $('ul.selectpicker li').eq(i).tooltip({
                    placement:'top', 
                    title: titleHTML,
                    html: true
                });
            });

        }

		$(function(){

			$('.selectpicker').selectpicker().change(function(){
				var id = $(this).find(':selected').val();
				if (id) location.href = base_url + "/persona/show/" + id;
			});

		    refresh_selectpicker_title('#personas_id');

		})
	</script>



@stop