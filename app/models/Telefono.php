<?php

use LaravelBook\Ardent\Ardent;

class Telefono extends Ardent{

	public $table = "telefonos";

	public function persona(){
		return $this->belongsTo('Persona', 'personas_id');
	}


}