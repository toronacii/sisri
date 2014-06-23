<?php #echo "<pre>"; print_r($registros->toArray()); echo "</pre>"; exit?>

<table>
	<tr>
		<th>id</th>
		<th>Nombre</th>
		<th>Proveniente</th>
		<th>Genero</th>
		<th>Edad</th>
		<th>Direccion</th>
	</tr>
	@foreach ($registros as $registro)
	<tr>
		<td>{{$registro->id}}</td>
		<td>{{$registro->nombre . ' ' . $registro->apellido}}</td>
		<!--<td>{{--$registro->direccion->zona->zona--}}</td>-->
		<td>{{$registro->proveniente}}</td>
		<td>{{$registro->genero}}</td>
		<td>{{$registro->edad}}</td>
		<td>{{Direccion::getStringDireccion($registro->direcciones_id)}}</td>
		
	</tr>
	@endforeach
</table>


<!--<pre><?php #print_r($registros->toArray()); ?></pre>-->

