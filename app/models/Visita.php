<?php

use LaravelBook\Ardent\Ardent;

class Visita extends Ardent {

	protected $guarded = array();

	public static $rules = array(
		'personas_id' => 'required',
		'tipo' => 'required',
	);

	public static $customMessages = array(
	    'personas_id.required' => 'Seleccione',
	    'publicadores_id.required' => 'Seleccione',
	    'tipo.required' => 'Seleccione',
	    'condicion.required' => 'Seleccione',
	    'required' => 'Debe llenar este campo'
	);

	public static $condiciones = array(
		'' => 'Seleccione', 
		'v' => 'En casa', 
		'nc' => 'No se encontró', 
		'o' => 'Ocupado', 
		'n' => 'No atendió favorablemente'
	);

	public static $tipos = array(
		'' => 'Seleccione', 
		'casa' => 'De casa en casa', 
		'telefono' => 'Telefónico', 
	);

	public function persona(){
		return $this->belongsTo('Persona', 'personas_id');
	}

	public function publicador(){
		return $this->belongsTo('Publicador', 'publicadores_id');
	}

	public function getStringvisita($id = NULL)
	{
		$visita = ($id) ? self::find($id) : $this;
		$visString = "";

		if ($visita)
		{

			if ($visita->tipo)
				$visString .= "<i>Tipo visita</i> $visita->tipo, "; 
			if ($visita->hora)
				$visString .= "<i>hora</i> $visita->hora, "; 
			if ($visita->tema)
				$visString .= "<i>tema</i> $visita->tema, "; 
			if ($visita->publicacion)
				$visString .= "<i>publicacion dejada</i> $visita->publicacion, "; 
			if ($visita->observacion)
				$visString .= "<i>observación</i> $visita->observacion, "; 

			return substr($visString,0,-2);
		}

		return null;
	
	}

	public function beforeSave() 
	{
		if($this->isDirty('fecha')) {
			$fecha = explode('/', $this->fecha);
			$this->fecha = "$fecha[2]-$fecha[1]-$fecha[0]";
		}

		if($this->isDirty('publicadores_id') && empty($this->publicadores_id)) {
			unset($this->publicadores_id);
		}

		return true;
	}
}
