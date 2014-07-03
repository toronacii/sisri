<?php

use LaravelBook\Ardent\Ardent;

class Direccion extends Ardent{

	public $table = 'direcciones';

	protected $guarded = array();

	public $throwOnValidation = true;

	public static $rules = array(
		'zonas_id' => 'required'
	);

	public static $customMessages = array(
	    'zonas_id.required' => 'Debe elegir una zona.'
	);

	/*public static $relationsData = array(
		'persona' => array(self::HAS_ONE, 'Persona')
	);*/

	public function persona()
	{
		return $this->hasMany('Persona', 'direcciones_id');
	}

	public function zona()
	{
		return $this->belongsTo('Zona', 'zonas_id');
	}

	public static function getStringDireccion($id, $sep = ", ")
	{
		$direccion = self::find($id);
		$zona = Zona::find($direccion->zonas_id);
		$dirString = "";

		if ($direccion)
		{
			if ($zona)
				$dirString .= "<i>Zona</i> $zona->zona" . $sep; 
			if ($direccion->calle_avenida)
				$dirString .= "<i>calle o avenida</i> $direccion->calle_avenida" . $sep; 
			if ($direccion->cruce_con)
				$dirString .= "<i>cruce con</i> $direccion->cruce_con" . $sep; 
			if ($direccion->casa_edificio)
				$dirString .= "<i>casa o edificio</i> $direccion->casa_edificio" . $sep; 
			if ($direccion->piso)
				$dirString .= "<i>piso</i> $direccion->piso" . $sep; 
			if ($direccion->apto)
				$dirString .= "<i>apartamento</i> $direccion->apto" . $sep; 
			if ($direccion->local)
				$dirString .= "<i>local</i> $direccion->local" . $sep; 
			if ($direccion->ref)
				$dirString .= "<i>referencia</i> $direccion->ref" . $sep; 

			return substr($dirString, 0, -1 * strlen($sep));
		}

		return null;
	
	}

	public static function getStringDireccionSms($id, $sep = ", ")
	{
		$direccion = self::find($id);
		$zona = Zona::find($direccion->zonas_id);
		$dirString = "";

		if ($direccion)
		{
			if ($zona)
				$dirString .= "Zona:$zona->zona" . $sep; 
			if ($direccion->calle_avenida)
				$dirString .= "calle o avenida:$direccion->calle_avenida" . $sep; 
			if ($direccion->cruce_con)
				$dirString .= "cruce con:$direccion->cruce_con" . $sep; 
			if ($direccion->casa_edificio)
				$dirString .= "casa o edificio:$direccion->casa_edificio" . $sep; 
			if ($direccion->piso)
				$dirString .= "piso:$direccion->piso" . $sep; 
			if ($direccion->apto)
				$dirString .= "apartamento:$direccion->apto" . $sep; 
			if ($direccion->local)
				$dirString .= "local:$direccion->local" . $sep; 
			if ($direccion->ref)
				$dirString .= "referencia:$direccion->ref" . $sep; 

			return substr($dirString, 0, -1 * strlen($sep));
		}

		return null;
	
	}

}