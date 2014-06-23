<?php

use LaravelBook\Ardent\Ardent;

class Municipio extends Ardent{

	public $table = 'municipios';

	public function zonas()
	{
		return $this->hasMany('Zona');
	}

}