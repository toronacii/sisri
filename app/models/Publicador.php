<?php

use LaravelBook\Ardent\Ardent;

class Publicador extends Ardent{

	public $table = 'publicadores';
	protected $guarded = array();

	public $throwOnValidation = true;

	public static $rules = array(
		'direcciones_id' => 'required',
		'nombre' => 'required'
	);

	public function usuario()
	{
		return $this->hasOne('usuario');
	}

	public function congregacion()
	{
		return $this->belongsTo('Congregacion', 'congregaciones_id');
	}

	public function visitas()
	{
		return $this->hasMany('Visita', 'publicadores_id');
	}

	public static function getListPublicadores($first = "Seleccione"){

		$publicadores = self::all();

		$return = ($first) ? array('' => $first) : array();

		foreach ($publicadores as $publicador)
			$return[$publicador->id] = $publicador->nombre . " " . $publicador->apellido;

		return $return;

	}

	public function getNombreCompleto()
	{
		return trim("$this->nombre $this->apellido");
	}

}