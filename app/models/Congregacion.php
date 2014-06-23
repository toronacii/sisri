<?php

use LaravelBook\Ardent\Ardent;

class Congregacion extends Ardent{

	public $table = 'congregaciones';

	protected $guarded = array();

	public $throwOnValidation = true;

	public static $rules = array();

	public static $customMessages = array();

	public function publicadores()
	{
		return $this->hasMany('Publicador', 'congregaciones_id');
	}

	public static function getListCongregaciones($first = "Seleccione"){

		$congregaciones = self::all();

		$return = ($first) ? array('' => $first) : array();

		foreach ($congregaciones as $congregacion){
			$return[$congregacion->id] = $congregacion->congregacion;
		}
		return $return;

	}

}