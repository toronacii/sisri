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
	public function create()
	{
		return View::make('visita.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->visita->fill(Input::except('guardar', 'guardar-otro'));

		#var_dump(Input::all()); exit;

		if ($this->visita->save())
		{
			$messages['success'][] = 'Visita creada con exito.';
			if (Input::has('guardar'))
				return Redirect::route('visita.index');
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

		if (is_null($visita))
		{
			return Redirect::route('visita.index');
		}

		return View::make('visita.edit', compact('visita'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Visita::$rules);

		if ($validation->passes())
		{
			$visita = $this->visita->find($id);
			$visita->update($input);

			return Redirect::route('visita.show', $id);
		}

		return Redirect::route('visita.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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
