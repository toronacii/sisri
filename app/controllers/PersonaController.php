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

	public function index($trash = NULL)
	{

		$table = Datatable::table()
	    ->addColumn('#', 'Nombre', 'Direccion', 'Acciones')  
	    ->setUrl(URL::to('/persona/get_ajax_personas' . (($trash) ? "/true" : "")))
	    ->noScript();

		return View::make('persona.index')->with('datatable', $table);
		return View::make('layout.menu');

	}

	public function get_ajax_personas($trash = FALSE)
	{
		$personas = ($trash) ? Persona::onlyTrashed()->with('direccion')->get() : Persona::with('direccion')->get();
		return Datatable::collection($personas)
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
		->addColumn('acciones', function($model) use ($trash)
		{
			if ($trash)
			{
				$html = '<a href="' . URL::to("persona/restore/{$model->id}") . '" class="btn btn-success btn-xs" title="Restaurar"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;';
			}
			else
			{
				$html = '<button class="btn btn-primary btn-xs" title="Mostrar"><span class="glyphicon glyphicon-eye-open"></span></button>&nbsp;';
				$html.= '<button class="btn btn-success btn-xs" title="Editar"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;';
				$html.= '<a href="' . URL::to("visita/create/{$model->id}") . '" class="btn btn-info btn-xs" title="Añadir visita"><span class="glyphicon glyphicon-calendar"></span></a>&nbsp;';
				$html.= '<a href="' . URL::to("persona/delete/{$model->id}") . '" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></button>';
			}
			
			return $html;
		})
		->searchColumns('nombre', 'direccion')
		->orderColumns('id', 'nombre', 'direccion', 'acciones')
		->make();
	}

	public function delete($id)
	{
		$persona = Persona::find($id);

		if ($persona == NULL)
		{
			return \App::abort(404);
		}

		$persona->delete();

		Session::flash('mensaje', "Persona eliminada satisfactoriamente");

		return Redirect::route('persona.admin');
	}

	public function restore($id)
	{
		$persona = Persona::onlyTrashed()->find($id);

		if ($persona == NULL)
		{
			return \App::abort(404);
		}

		$persona->restore();

		Session::flash('mensaje', "Persona restaurada con exito");

		return Redirect::route('persona.admin');
	}

}