<?php

use LaravelBook\Ardent\Ardent;

class Idioma extends Ardent{

	public $table = 'idiomas';

	public static function getListIdiomas($first = "Seleccione"){

		$idiomas = self::all();

		$return = ($first) ? array('' => $first) : array();

		foreach ($idiomas as $idioma)
			$return[$idioma->id] = $idioma->idioma;

		return $return;

	}

}