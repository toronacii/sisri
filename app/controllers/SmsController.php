<?php

class SmsController extends BaseController {

	public function getDireccion($id)
	{
		$persona = Persona::find($id);

		if (! $persona)
		{
			return Response::json(['resp' => "Este numero de persona no existe"]);
		}

		$nombre = $persona->getNombreCompleto("");

		if ($nombre)
			$nombre = "Nombre: $nombre "; 

		return Response::json(['resp' => $nombre . Direccion::getStringDireccionSms($persona->direcciones_id)]);

	}

}