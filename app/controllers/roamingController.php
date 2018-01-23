<?php

class roamingController extends Controller {

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
	
	


	public function homeRoaming(){
	
		$anhos=anhos::all();
		return View::make('roamingView/roaming', array("anhos"=>$anhos));
	}

	

}
