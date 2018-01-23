<?php

class actualizarController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


	public function getelementos(){
		$input=Input::all();
		$ne=DB::select("SELECT nombre_elemento, idelementos FROM producto_catalogo where idsupervisiones=? and idgraficas=?; ",array(Input::get("idsupervision"),Input::get("idgrafica")));
		$grafica=DB::select("SELECT nombre, limite FROM graficas where idgraficas=?", array(Input::get("idgrafica")));

		return array('ne'=>$ne, 'grafica'=>$grafica);

	}


	public function actualizarvista(){
		return View::make('actualizar');

	}


	public function updatecomentario(){

		$input=Input::all();
		DB::update("UPDATE producto SET comentario=? WHERE idsupervisiones=? and idgraficas=? and idelementos=? and semana=? ",
					array(Input::get("comentario"),
						  Input::get("idsupervision"),
						  Input::get("idgrafica"),
						  Input::get("idelemento"),
						  Input::get("semana"),));

		$resultado="Comentario Actualizado";

		return array('resultado' => $resultado);
		
	}

	public function getcomentario(){
		$input=Input::all();
		$comentario_actual=DB::select("SELECT comentario FROM producto  WHERE idsupervisiones=? and idgraficas=? and idelementos=? and semana=?; ",array(Input::get("idsupervision"),Input::get("idgrafica"),Input::get("idelemento"),Input::get("semana")));
		
		return array('comentario_actual'=>$comentario_actual);
	}


	public function updatelimite(){

		$input=Input::all();
		DB::update("UPDATE graficas SET limite=? WHERE idgraficas=? ",
					array(Input::get("limite"), Input::get("idgrafica")));

		$resultado="Limite Actualizado";

		return array('resultado' => $resultado);
		
	}

	
}