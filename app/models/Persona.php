<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Persona extends Ardent{

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	public $table = 'personas';

	public $throwOnValidation = true;

	protected $guarded = array();

	public static $rules = array(
		'idiomas_id' => 'required',
		'direcciones_id' => 'required'
	);

	public static $generos = array(
		'' => 'Seleccione', 
		'hombre' => 'Hombre', 
		'mujer' => 'Mujer', 
		'niño' => 'Niño', 
		'niña' => 'Niña'
	);

	public static $tipo_registros = array(
		'' => 'Seleccione', 
		'casa' => 'Casa', 
		'telefono' => 'Teléfono'
	);

	public static function getListPersonas($first = "Seleccione"){

		$personas = self::all();

		$return = ($first) ? array('' => $first) : array();

		foreach ($personas as $persona){
			$nombre = $persona->nombre . " " . $persona->apellido;
			if (trim($nombre) == "")
				$nombre = "(Sin nombre)";
			$return[$persona->id] = $nombre;
		}
		return $return;

	}

	public function getNombreCompleto()
	{
		$nombre = trim("$this->nombre $this->apellido");
		if ($nombre == '')
			return "(sin nombre)";
		return $nombre;
	}

	public function direccion(){
		return $this->belongsTo('Direccion', 'direcciones_id');
	}

	public function telefonos(){
		return $this->hasMany('Telefono', 'personas_id');
	}

	public function visitas(){
		return $this->HasMany('Visita', 'personas_id');
	}

}