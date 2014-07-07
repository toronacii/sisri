<?php

class VisitaController extends BaseController {

	/**
	 * visita Repository
	 *
	 * @var visita
	 */
	protected $visita;

	public function __construct(Visita $visita)
	{
		$this->visita = $visita;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$visita = $this->visita->all();

		return View::make('visita.index', compact('visita'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id_persona = NULL)
	{
		return View::make('visita.create')->with('id_persona', $id_persona);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->visita->fill(Input::all());

		#dd($this->visita->attributes);

		if ($this->visita->save())
		{
			$messages['success'][] = 'Visita creada con exito.';
			if (Input::has('guardar'))
				return Redirect::route('persona.admin');
			return Redirect::route('visita.create')->withMessage($messages);

		}else
		{
			$messages['danger'][] = 'Hay errores de validación.';
			return Redirect::route('visita.create')
			->withInput()
			->withErrors($this->visita->errors())
			->with('message', $messages);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$visita = $this->visita->findOrFail($id);

		return View::make('visita.show', compact('visita'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$visita = $this->visita->find($id);

		return View::make('visita.edit-partial', compact('visita'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$visita = $this->visita->findOrFail($id);

		$visita->fill(array_except(Input::all(), '_method'));

		#dd(Input::all(), $visita->attributes);

		if ($visita->save())
		{
			return Redirect::route('persona.show', $visita->personas_id)->withMessage('Visiata modificada exitosamente');
		}
		return Redirect::route('persona.show', $visita->personas_id)
			->withErrors(/*$validation*/"Error al modificar visita");

		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->visita->find($id)->delete();

		return Redirect::route('visita.index');
	}

}
