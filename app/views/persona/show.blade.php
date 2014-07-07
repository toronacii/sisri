@extends('layout.base')

@section('css_js')

    @parent
    
    {{HTML::style('css/bootstrap-datetimepicker.min.css')}}
    {{HTML::style('css/bootstrap-select.min.css')}}
    {{HTML::script('js/moment-2.4.0.js')}}
    {{HTML::script('js/bootstrap-datetimepicker.js')}}
    {{HTML::script('js/locales/bootstrap-datetimepicker.es.js')}}
    {{HTML::script('js/bootstrap-select.min.js')}}

    {{HTML::style('css/bootstrap-dialog/bootstrap-dialog.min.css')}}
    {{HTML::script('js/bootstrap-dialog/bootstrap-dialog.min.js')}}

@stop

@section('content')

	@if (Session::has('errors'))
		<div class="alert alert-danger">{{Session::get('errors')}}</div>
	@endif

	@if (Session::has('message'))
		<div class="alert alert-success">{{Session::get('message')}}</div>
	@endif

	<div class="page-header">
		<h3><span class="glyphicon glyphicon-user"></span>Persona #{{$persona->id}}</h3>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="col-md-6">
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
			<div class="col-md-6">
				<button class="btn btn-success pull-right" data-toggle="modal" data-target="#editPersona">Modificar</button>
			</div>			
			<div class="clearfix"></div>
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
			</tbody>
		</table>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="col-md-6">Ultimas 5 visitas</div>
			<div class="col-md-6">
				<a href="{{url("visita/create/$persona->id")}}" class="btn btn-success pull-right">Agregar visita</a>
			</div>
			
			<div class="clearfix"></div>
		</div>
		@if ($persona->visitas->count())
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Publicador</th>
					<th>Observación</th>
					<th>Fecha</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			@foreach ($persona->visitas as $visita)
			<tbody>
				<tr>
					<td>{{ ($visita->publicador) ? $visita->publicador->getNombreCompleto() : "(vacio)" }}</td>
					<td>{{ $visita->getStringVisita() }}</td>
					<td>{{ $visita->fecha }}</td>
					<td><button class="btn btn-primary btn-xs editVisitaBtn" title="Mostrar / Editar" data-id="{{$visita->id}}"><span class="glyphicon glyphicon-eye-open"></span></button></td>
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

	<form id="updatePersona" method="post" action="{{ url("/persona/update/$persona->id") }}">

	<div class="modal fade" id="editPersona">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Modificar persona</h4>
	            </div>
	            <div class="modal-body">
	                @include('persona.edit-partial', ['persona' => $persona, 'direccion' => $persona->direccion])
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary submit">Guardar</button>
	            </div>
	        </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	</form>

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

			$('.selectpicker').selectpicker();

			$('#personas_id').change(function(){
				var id = $(this).find(':selected').val();
				if (id) location.href = base_url + "/persona/show/" + id;
			});

		    refresh_selectpicker_title('#personas_id');

		    $('#editPersona [type=submit]').click(function(){
				$(this).addClass('disabled');
			});

			$('.editVisitaBtn').click(function(){

				BootstrapDialog.show({
		            title: 'Edita visita',
		            message: $('<div></div>').load(base_url + '/visita/form-edit/' + $(this).data('id')),
		            buttons: [{
		                label: 'Cerrar',
		                action: function(me){
		                    me.close();
		                }
		            }, {
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(me){
		                	$(me.getModalContent()).find('form').submit();
		                }
		            }]
		        });

			});

			

		})

		



	</script>



@stop