<?php

class SelectController extends Controller {

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


	public function getSemIAnhoF(){
		$input=Input::all();
		$weeksI=DB::select("select week, month from week where year =? ",array(Input::get("anho_1")));
		$anhoF=DB::select("select year from year where year >=?", array(Input::get("anho_1")));

		return array('weeksI' => $weeksI, 'anhoF' => $anhoF);


	}


	public function getSemF1(){
		$input=Input::all();
		$weeksF=DB::select("select week, month from week where year =? and week >? ",array(Input::get("anho_1"),Input::get("sem_1")));
	
		return array('weeksF' => $weeksF);

	}


	public function getSemF2(){
		$input=Input::all();
		$weeksF=DB::select("select week, month from week where year =? ",array(Input::get("anho_2")));
	
		return array('weeksF' => $weeksF);

	}

	public function getSemSuperv(){
		$input=Input::all();

		//echo "<script>console.log($input['idSup']) </script>";
		$semanasSuperv=DB::select("Select week, month, semana from week where semana not in (SELECT distinct(semana) FROM producto WHERE idsupervisiones=? ) and year=?",array(Input::get("idSup"),Input::get("anhoc")));
	
		return array('semanasSuperv' => $semanasSuperv, 'input' => $input);

	}
	
}