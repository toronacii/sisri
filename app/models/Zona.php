<?php

use LaravelBook\Ardent\Ardent;

class Zona extends Ardent{

	public $table = 'zonas';

	public static function getListZonas($first = "Seleccione")
	{
		$zonas = self::all();

		$return = ($first) ? array('' => $first) : array();

		foreach ($zonas as $zona)
			#var_dump($zona->municipio()->get()->toArray()); exit;
			$return[$zona->id] = $zona->zona;

		return $return;

	}

	public function municipio()
	{
		return $this->belongsTo('Municipio');
	
	}

	public function direcciones()
	{
		return $this->hasMany('Direccion');
	
	}



}