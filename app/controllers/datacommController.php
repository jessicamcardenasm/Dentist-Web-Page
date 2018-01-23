<?php

class datacommController extends Controller {

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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=4 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=70 and idelementos=141) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=70 and idelementos=142) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=70 and idelementos=143) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=70 and idelementos=144) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=71 and idelementos=145) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=71 and idelementos=146) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=71 and idelementos=147) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=71 and idelementos=148) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=71 and idelementos=149) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=71 and idelementos=150) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=71 and idelementos=151) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=71 and idelementos=152) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=153) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=154) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=155) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=156) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=504) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=505) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=506) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=507) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=508) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=509) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=510) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=511) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=512) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=513) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=946) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=72 and idelementos=947) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));




		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=73 and idelementos=141) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=73 and idelementos=142) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=73 and idelementos=143) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=73 and idelementos=144) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=74 and idelementos=145) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=74 and idelementos=146) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=74 and idelementos=147) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=74 and idelementos=148) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=74 and idelementos=149) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=74 and idelementos=150) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=74 and idelementos=151) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=74 and idelementos=152) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	
		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=153) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=154) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=155) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=156) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=504) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=505) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=506) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=507) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=508) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=509) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=510) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=511) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=512) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=513) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=946) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=75 and idelementos=947) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));



		$lg1=DB::select("SELECT limite from graficas where idgraficas=70");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=71");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=72");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=73");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=74");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=75");


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=70");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=71");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=72");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=73");
		$ng5=DB::select("SELECT nombre from graficas where idgraficas=74");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=75");	

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=70");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=71;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=72;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=73;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=74;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=75;");	



		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8, $g3_e9, $g3_e10, $g3_e11, $g3_e12, $g3_e13, $g3_e14,$g3_e15, $g3_e16 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"g5"=>array("data"=> array($g5_e1, $g5_e2, $g5_e3, $g5_e4, $g5_e5, $g5_e6, $g5_e7, $g5_e8),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					"g6"=>array("data"=> array($g6_e1, $g6_e2, $g6_e3, $g6_e4, $g6_e5, $g6_e6, $g6_e7, $g6_e8, $g6_e9, $g6_e10, $g6_e11, $g6_e12, $g6_e13, $g6_e14, $g6_e15, $g6_e16),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=4 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=76 and idelementos=157) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=76 and idelementos=158) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=76 and idelementos=159) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=76 and idelementos=160) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=76 and idelementos=161) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=76 and idelementos=162) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=76 and idelementos=163) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=76 and idelementos=164) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=165) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=166) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=167) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=168) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=169) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=170) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=934) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=935) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=514) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=515) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=936) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=937) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=516) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=517) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=938) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=77 and idelementos=939) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		


		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=78 and idelementos=171) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=78 and idelementos=172) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=78 and idelementos=173) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=78 and idelementos=174) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=78 and idelementos=175) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=78 and idelementos=176) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=78 and idelementos=177) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=78 and idelementos=178) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=79 and idelementos=179) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=79 and idelementos=180) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=79 and idelementos=181) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=79 and idelementos=182) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=79 and idelementos=183) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=79 and idelementos=184) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=79 and idelementos=185) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=79 and idelementos=186) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	
		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=80 and idelementos=187) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=80 and idelementos=188) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=80 and idelementos=189) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=80 and idelementos=190) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=80 and idelementos=191) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=81 and idelementos=192) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=81 and idelementos=193) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=81 and idelementos=194) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=81 and idelementos=195) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=81 and idelementos=196) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=81 and idelementos=197) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=81 and idelementos=198) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g7_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=518) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=519) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=940) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=941) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=520) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=521) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=942) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=943) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=944) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=945) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=522) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=523) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=948) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=949) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=950) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=951) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=952) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=192 and idelementos=953) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	

		$lg1=DB::select("SELECT limite from graficas where idgraficas=76");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=77");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=78");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=79");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=80");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=81");
		$lg7=DB::select("SELECT limite from graficas where idgraficas=192");


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=76");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=77");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=78");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=79");
		$ng5=DB::select("SELECT nombre from graficas where idgraficas=80");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=81");	
		$ng7=DB::select("SELECT nombre from graficas where idgraficas=192");	

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=76");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=77;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=78;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=79;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=80;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=81;");	
		$eg7=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=192;");	



		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9, $g2_e10, $g2_e11, $g2_e12, $g2_e13, $g2_e14, $g2_e15, $g2_e16 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8  ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"g5"=>array("data"=> array($g5_e1, $g5_e2, $g5_e3, $g5_e4, $g5_e5),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					"g6"=>array("data"=> array($g6_e1, $g6_e2, $g6_e3, $g6_e4, $g6_e5, $g6_e6, $g6_e7),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
					"g7"=>array("data"=> array($g7_e1, $g7_e2, $g7_e3, $g7_e4, $g7_e5, $g7_e6, $g7_e7,$g7_e8, $g7_e9, $g7_e10, $g7_e11, $g7_e12, $g7_e13, $g7_e14,$g7_e15, $g7_e16,$g7_e17, $g7_e18),"limite"=>$lg7,"nombre"=>$ng7,"elementos"=>$eg7),
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}
	

	
	public function homeDatacommNE(){
	
		$anhos=anhos::all();
		return View::make('datacommView/ne', array("anhos"=>$anhos));
	}

	public function homeDatacommEnlaces(){
	
		$anhos=anhos::all();
		return View::make('datacommView/enlaces', array("anhos"=>$anhos));
	}

	
	
}
