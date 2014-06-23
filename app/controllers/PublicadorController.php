<?php

class PublicadorController extends BaseController {

	protected $publicador;

	public function __construct(Publicador $publicador)
	{
		$this->publicador = $publicador;
	}

	public function ajaxStore()
	{
		$publicador = $this->publicador;
		$direccion = new Direccion;

		$publicador->fill(Input::get('publicador'));
		$direccion->fill(Input::get('direccion'));
		$resp = array();

		try
		{
			DB::transaction(function() use ($publicador, $direccion)
			{
				$direccion->save();
				$publicador->direcciones_id = $direccion->id;
				if (! $publicador->congregaciones_id)
					unset($publicador->congregaciones_id);
				$publicador->save();

			});



			$resp['publicador'] = $publicador->toArray();
			$resp['publicador']['direccion'] =  Direccion::getStringDireccion($publicador->direcciones_id, ',<br>');

		}
		catch (Exception $e)
		{

			if (count($direccion->errors()))
				$resp['errors']['direccion'] = $direccion->errors()->all();
			else if (count($publicador->errors()))
				$resp['errors']['publicador'] = $publicador->errors()->all();
			else
				$resp['errors']['exception'] = array('Error al insertar en base de datos', $e->getMessage());
		}

		return Response::json($resp);
		
	}

}