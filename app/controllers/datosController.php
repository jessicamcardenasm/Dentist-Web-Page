<?php

class datosController extends Controller {

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
	

	public function getdatos1(){
		$input=Input::all();
		$week_1=Input::get("week_1");
		$week_2=Input::get("week_2");
		$anho_1=Input::get("anho_1");
		$anho_2=Input::get("anho_2");

		$fecha1=($anho_1*100)+$week_1;
		$fecha2=($anho_2*100)+$week_2;

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=3 and (semana>=? and semana<=?) order by semana;",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=59 and idelementos=135) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=59 and idelementos=136) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=60 and idelementos=135) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=60 and idelementos=136) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=61 and idelementos=135) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=61 and idelementos=136) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=62 and idelementos=135) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=62 and idelementos=136) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=63 and idelementos=135) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=63 and idelementos=136) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=64 and idelementos=135) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=64 and idelementos=136) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			

		$lg1=DB::select("SELECT limite from graficas where idgraficas=59");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=60");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=61");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=62");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=63");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=64");


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=59");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=60");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=61");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=62");
		$ng5=DB::select("SELECT nombre from graficas where idgraficas=63");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=64");	

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=59");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=60;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=61;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=62;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=63;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=64;");	



		return array("g1"=>array("data"=> array($g1_e1, $g1_e2),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1, $g3_e2 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1, $g4_e2 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"g5"=>array("data"=> array($g5_e1, $g5_e2 ),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					"g6"=>array("data"=> array($g6_e1, $g6_e2 ),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}

	public function getdatos2(){
		$input=Input::all();
		$week_1=Input::get("week_1");
		$week_2=Input::get("week_2");
		$anho_1=Input::get("anho_1");
		$anho_2=Input::get("anho_2");

		$fecha1=($anho_1*100)+$week_1;
		$fecha2=($anho_2*100)+$week_2;

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=3 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=65 and idelementos=137) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=65 and idelementos=138) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=66 and idelementos=137) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=66 and idelementos=138) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=67 and idelementos=137) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=67 and idelementos=138) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=68 and idelementos=137) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=68 and idelementos=138) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
			

		$lg1=DB::select("SELECT limite from graficas where idgraficas=65");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=66");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=67");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=68");
		

		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=65");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=66");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=67");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=68");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=65");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=66;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=67;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=68;");
		


		return array("g1"=>array("data"=> array($g1_e1, $g1_e2),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1, $g3_e2 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1, $g4_e2 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}

	public function getdatos3(){
		$input=Input::all();
		$week_1=Input::get("week_1");
		$week_2=Input::get("week_2");
		$anho_1=Input::get("anho_1");
		$anho_2=Input::get("anho_2");

		$fecha1=($anho_1*100)+$week_1;
		$fecha2=($anho_2*100)+$week_2;

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=3 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=69 and idelementos=135) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=69 and idelementos=136) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=69 and idelementos=137) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=69 and idelementos=138) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=69 and idelementos=139) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=69 and idelementos=140) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
			
		
			

		$lg1=DB::select("SELECT limite from graficas where idgraficas=69");
		

		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=69");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=69");	
		

		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}

	

	
	public function homeDatosUsn(){
	
		$anhos=anhos::all();
		return View::make('datosView/usn', array("anhos"=>$anhos));
	}

	public function homeDatosUgw(){
	
		$anhos=anhos::all();
		return View::make('datosView/ugw', array("anhos"=>$anhos));
	}

	public function homeDatosCpu(){
	
		$anhos=anhos::all();
		return View::make('datosView/cpu', array("anhos"=>$anhos));
	}

	
	
}
