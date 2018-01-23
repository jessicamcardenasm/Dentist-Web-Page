<?php

class ranController extends Controller {

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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=2 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=56 and idelementos=98) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=56 and idelementos=99) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=56 and idelementos=100) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=56 and idelementos=101) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=56 and idelementos=102) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=56 and idelementos=103) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=56 and idelementos=104) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=56 and idelementos=105) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		


		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=57 and idelementos=106) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=57 and idelementos=107) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=57 and idelementos=108) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=57 and idelementos=109) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=57 and idelementos=110) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=57 and idelementos=111) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=57 and idelementos=112) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=57 and idelementos=113) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=58 and idelementos=114) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=58 and idelementos=115) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=58 and idelementos=116) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=58 and idelementos=117) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
			

		$lg1=DB::select("SELECT limite from graficas where idgraficas=56");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=57");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=58");
		

		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=56");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=57");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=58");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=56");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=57;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=58;");	
		


		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=2 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=118) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=119) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=122) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=123) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=124) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=1074) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=1075) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=125) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=126) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=127) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=932) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=44 and idelementos=1076) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));


		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=118) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=119) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=122) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=123) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=124) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=1074) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=1075) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=125) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=126) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=127) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=932) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=45 and idelementos=1076) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));


		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=118) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=119) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=122) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=123) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=124) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=1074) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=1075) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=125) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=126) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=127) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=932) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=46 and idelementos=1076) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));


		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=118) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=119) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=122) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=123) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=124) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=1074) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=1075) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=125) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=126) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=127) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=932) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=47 and idelementos=1076) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	

		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=48 and idelementos=118) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=48 and idelementos=125) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=49 and idelementos=118) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=49 and idelementos=125) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		

		$g7_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=118) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=119) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=122) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=123) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=124) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=1074) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=1075) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=125) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=126) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=127) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=932) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=50 and idelementos=1076) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));



		$g8_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=51 and idelementos=119) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=51 and idelementos=122) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=51 and idelementos=123) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=51 and idelementos=124) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=51 and idelementos=119) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=51 and idelementos=127) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=51 and idelementos=932) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=51 and idelementos=1076) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=44");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=45");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=46");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=47");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=48");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=49");
		$lg7=DB::select("SELECT limite from graficas where idgraficas=50");
		$lg8=DB::select("SELECT limite from graficas where idgraficas=51");
		

		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=44");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=45");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=46");
		$ng4=DB::select("SELECT nombre FROM graficas where idgraficas=47");
		$ng5=DB::select("SELECT nombre from graficas where idgraficas=48");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=49");
		$ng7=DB::select("SELECT nombre from graficas where idgraficas=50");
		$ng8=DB::select("SELECT nombre from graficas where idgraficas=51");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=44");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=45;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=46;");
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=47");	
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=48;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=49;");
		$eg7=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=50;");	
		$eg8=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=51;");	
		


		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8,$g1_e9, $g1_e10, $g1_e11,$g1_e12),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),

					"g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9, $g2_e10, $g2_e11, $g2_e12),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),

					"g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8, $g3_e9, $g3_e10, $g3_e11, $g3_e11, $g3_e12),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),

					"g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8, $g4_e9, $g4_e10, $g4_e11, $g4_e11, $g4_e12),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),

					"g5"=>array("data"=> array($g5_e1, $g5_e2, $g5_e3, $g5_e4),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),

					"g6"=>array("data"=> array($g6_e1, $g6_e2, $g6_e3, $g6_e4),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),

					"g7"=>array("data"=> array($g7_e1, $g7_e2, $g7_e3, $g7_e4, $g7_e5, $g7_e6, $g7_e7, $g7_e8, $g7_e9, $g7_e10, $g7_e11),"limite"=>$lg7,"nombre"=>$ng7,"elementos"=>$eg7),

					"g8"=>array("data"=> array($g8_e1, $g8_e2, $g8_e3, $g8_e4, $g8_e5, $g8_e6, $g8_e7 ),"limite"=>$lg8,"nombre"=>$ng8,"elementos"=>$eg8),

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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=2 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=52 and idelementos=128) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=52 and idelementos=129) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=52 and idelementos=130) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=52 and idelementos=131) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=52 and idelementos=132) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=52 and idelementos=133) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=52 and idelementos=134) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=52 and idelementos=933) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		


		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=53 and idelementos=128) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=53 and idelementos=129) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=53 and idelementos=130) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=53 and idelementos=131) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=53 and idelementos=132) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=53 and idelementos=133) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=53 and idelementos=134) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=53 and idelementos=933) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=54 and idelementos=128) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=54 and idelementos=129) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=54 and idelementos=130) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=54 and idelementos=131) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=54 and idelementos=132) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=54 and idelementos=133) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=54 and idelementos=134) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=54 and idelementos=933) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=55 and idelementos=128) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=55 and idelementos=129) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=55 and idelementos=130) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=55 and idelementos=131) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=55 and idelementos=132) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=55 and idelementos=133) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=55 and idelementos=134) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=55 and idelementos=933) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=52");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=53");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=54");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=55");
		

		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=52");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=53");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=54");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=55");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=52");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=53;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=54;");
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=55;");	
		


		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}
	
	

	
	public function homeRanIden(){
	
		$anhos=anhos::all();
		return View::make('ranView/iden', array("anhos"=>$anhos));
	}

	public function homeRanRnc(){
	
		$anhos=anhos::all();
		return View::make('ranView/rnc', array("anhos"=>$anhos));
	}

	public function homeRanBsc(){
	
		$anhos=anhos::all();
		return View::make('ranView/bsc', array("anhos"=>$anhos));
	}

	
	
}
