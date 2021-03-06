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

	private function get_persona($id, $trash = FALSE)
	{
		$persona = ($trash) ? Persona::onlyTrashed()->find($id) : Persona::find($id);

		if ($persona == NULL)
		{
			return \App::abort(404);
		}

		return $persona;
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
				$html = '<a href="' . URL::to("persona/show/{$model->id}") . '" class="btn btn-primary btn-xs" title="Mostrar / Editar"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;';
				$html.= '<a href="' . URL::to("visita/create/{$model->id}") . '" class="btn btn-info btn-xs" title="Añadir visita"><span class="glyphicon glyphicon-calendar"></span></a>&nbsp;';
				$html.= '<a href="' . URL::to("persona/delete/{$model->id}") . '" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></button>';
			}
			
			return $html;
		})
		->searchColumns('nombre', 'direccion', 'id')
		->orderColumns('id', 'nombre', 'direccion', 'acciones')
		->make();
	}

	public function delete($id)
	{
		$persona = $this->get_persona($id);

		$persona->delete();

		Session::flash('mensaje', "Persona eliminada satisfactoriamente");

		return Redirect::route('persona.admin');
	}

	public function restore($id)
	{
		$persona = $this->get_persona($id, TRUE);

		$persona->restore();

		Session::flash('mensaje', "Persona restaurada con exito");

		return Redirect::route('persona.admin');
	}

	
	public function show($id)
	{
		$persona = Persona::with([
			'direccion',
			'direccion.zona',
			'telefonos',
			'visitas' => function($query){
				$query->orderBy('fecha', 'desc')->limit(5);
			},
			'visitas.publicador'
		])->find($id);

		#dd($persona->toArray());

		if ($persona == NULL)
		{
			return \App::abort(404);
		}

		return View::make('persona.show')->with('persona', $persona)->with('id_persona', $id);

	}

	public function update($id)
	{
		$persona = Persona::with('direccion')->findOrFail($id);

		#dd($persona->toArray());
		$direccion = $persona->direccion;

		$persona->fill(Input::get('persona'));
		$direccion->fill(Input::get('direccion'));
		$resp = array();

		#dd($persona, $direccion);

		try
		{

			DB::transaction(function() use ($persona, $direccion)
			{
				$direccion->save();
				$persona->save();

			});

			Return Redirect::to('/persona/show/' . $persona->id)->withMessage('Registro actualizado exitosamente');

		}
		catch (Exception $e)
		{
			Return Redirect::to('/persona/show/' . $persona->id)->withErrors('Error al insertar datos');
		}

	}

}