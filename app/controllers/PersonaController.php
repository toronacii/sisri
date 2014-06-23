<?php

class PersonaController extends BaseController {

	/**
	 * persona Repository
	 *
	 * @var persona
	 */
	protected $persona;

	public function __construct(Persona $persona)
	{
		$this->persona = $persona;
	}

	public function ajaxStore()
	{
		$persona = $this->persona;
		$direccion = new Direccion;

		$persona->fill(Input::get('persona'));
		$direccion->fill(Input::get('direccion'));
		$resp = array();

		try
		{

			DB::transaction(function() use ($persona, $direccion)
			{
				$direccion->save();
				$persona->direcciones_id = $direccion->id;
				$persona->save();

			});

			$resp['persona'] = $persona->toArray();
			$resp['persona']['direccion'] =  Direccion::getStringDireccion($persona->direcciones_id, ',<br>');

		}
		catch (Exception $e)
		{

			if (count($direccion->errors()))
				$resp['errors']['direccion'] = $direccion->errors()->all();
			else if (count($persona->errors()))
				$resp['errors']['persona'] = $persona->errors()->all();
			else
				$resp['errors']['exception'] = array('Error al insertar en base de datos');
		}

		return Response::json($resp);
		
	}

	public function index(){

		$table = Datatable::table()
	    ->addColumn('ID', 'Nombre', 'Direccion', 'Acciones')  
	    ->setUrl(URL::to('/persona/get_ajax_personas'))
	    ->noScript();

		return View::make('persona.index')->with('datatable', $table);
		return View::make('layout.menu');



	}

	public function get_ajax_personas()
	{
		return Datatable::collection(Persona::with('direccion')->get())
		->showColumns('id')
		->addColumn('nombre', function($model)
		{
			return $model->getNombreCompleto();
		})
		->addColumn('direccion', function($model)
		{
			$direccion = Direccion::getStringDireccion($model->direcciones_id);
			return "<span title='$direccion'>" . substr($direccion, 0, 50) . "...</span>";
		})
		->addColumn('acciones', function($model)
		{
			$html = '<button class="btn btn-primary btn-xs" title="Mostrar"><span class="glyphicon glyphicon-eye-open"></span></button>&nbsp;';
			$html.= '<button class="btn btn-success btn-xs" title="Editar"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;';
			$html.= '<button class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></button>';

			return $html;
		})
		->searchColumns('nombre', 'direccion')
		->orderColumns('id', 'nombre', 'direccion', 'acciones')
		->make();
	}

}