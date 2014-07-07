<?php

use LaravelBook\Ardent\Ardent;

class Visita extends Ardent {

	protected $fillable = array('condicion', 'personas_id', 'publicadores_id', 'fecha', 'tipo', 'hora', 'tema', 'publicacion', 'observacion');

	public static $rules = array(
		'personas_id' => 'required',
		'tipo' => 'required',
		'fecha' => 'required'
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

	public function getStringVisita($id = NULL)
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

	public static function getListTipos($first = "Seleccione"){

		$tipos = self::$tipos;

		$return = ($first) ? array('' => $first) : array();

		foreach ($tipos as $idx => $tipo){
			if ($idx)
				$return[] = $tipo;
		}
		return $return;

	}

	public function beforeSave() 
	{

		if ($this->isDirty('publicadores_id') && empty($this->publicadores_id)) {
			unset($this->publicadores_id);
		}

		return true;
	}

	#ACCESSORS

	public function getFechaAttribute($value)
	{
		return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
	}

	#MUTATORS

	public function setFechaAttribute($value)
	{
		if ($value)
			$this->attributes['fecha'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
	}

	public function setHoraAttribute($value)
	{
		if ($value)
			$this->attributes['hora'] = $value;
	}
}
