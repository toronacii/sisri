@extends('layout.pdf')

@section('content')
	@foreach($registros as $ind => $registro)
	<table border="1" @if (($ind + 1) % 3 == 0) {{ "style='page-break-after:always;'" }} @endif>
		<tr>
			<th width="10%">#{{$registro->id}}</th>
			<td><label>Nombre:</label> {{ $registro->nombre . " " . $registro->apellido }}</td>
			<td width="60%"><label>Zona:</label> {{ $registro->direccion->zona->zona }}</td>
		</tr>
		<tr>
			<td colspan="2"><label>Teléfonos: </label>
				<?php $telefono = "" ?>
				@if ($registro->telefonos)
					@foreach($registro->telefonos as $tel)
					<?php $telefono = $tel->telefono . " / "; ?>
					@endforeach
					{{substr($telefono,0,-3)}}
				@endif
			</td>
			<td><label>Proveniente de: </label>{{$registro->proveniente}}</td>
		</tr>
		<tr>
			<td colspan="2"><label>Género: </label>{{$registro->genero}}</td>
			<td><label>Edad: </label>{{$registro->edad}}</td>
		</tr>
		<tr>
			<td colspan="2"><label>Dirección:</label>
				{{Direccion::getStringDireccion($registro->direcciones_id)}}

			</td>
			<td class="visitas">
				<table border="1">
					<tr>
						<th width="25%" class="nt nl nb">Publicador</th>
						<th class="nt nb">Observación</th>
						<th width="15%" class="nt nr nb">Fecha</th>
					</tr>
					@foreach ($registro->visitas as $visita)
					<tr class="nb">
						<td class="nl nb">{{ ($p = $visita->publicador) ? $p->nombre . " " . $p->apellido : "" }}</td>
						<td class="nb">{{ $visita->getStringvisita() }}</td>
						<td class="nr nb">{{ ($visita->fecha && $visita->fecha != '1970-01-01' ) ? date('d/m/Y', strtotime($visita->fecha)) : "" }}</td>
					</tr>
					@endforeach
					<!-- PROVICIONAL -->
					<tr class="nb">
						<td class="nl nb" style="padding:50px 0"></td>
						<td class="nb"></td>
						<td class="nr nb"></td>
					</tr>
					<!-- FIN PROVICIONAL -->
				</table>
			</td>
		</tr>
	</table>
	<br>
	@endforeach
@stop

