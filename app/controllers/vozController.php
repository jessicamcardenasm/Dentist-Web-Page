<?php

class vozController extends Controller {

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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=1 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=113 and idelementos=524) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=113 and idelementos=525) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=113 and idelementos=526) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=113 and idelementos=527) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=114 and idelementos=528) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=114 and idelementos=529) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=115 and idelementos=528) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=115 and idelementos=529) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=116 and idelementos=528) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=116 and idelementos=529) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=117 and idelementos=530) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=117 and idelementos=531) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=118 and idelementos=532) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=118 and idelementos=533) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g7_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=119 and idelementos=530) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=119 and idelementos=531) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g8_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=120 and idelementos=532) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=120 and idelementos=533) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g9_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=121 and idelementos=530) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g9_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=121 and idelementos=531) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g10_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=122 and idelementos=532) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g10_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=122 and idelementos=533) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g11_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=123 and idelementos=528) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g11_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=123 and idelementos=529) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g12_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=124 and idelementos=530) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g12_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=124 and idelementos=531) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g13_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=125 and idelementos=532) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g13_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=125 and idelementos=533) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		


		$lg1=DB::select("SELECT limite from graficas where idgraficas=113");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=114");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=115");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=116");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=117");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=118");
		$lg7=DB::select("SELECT limite from graficas where idgraficas=119");
		$lg8=DB::select("SELECT limite from graficas where idgraficas=120");
		$lg9=DB::select("SELECT limite from graficas where idgraficas=121");
		$lg10=DB::select("SELECT limite from graficas where idgraficas=122");
		$lg11=DB::select("SELECT limite from graficas where idgraficas=123");
		$lg12=DB::select("SELECT limite from graficas where idgraficas=124");
		$lg13=DB::select("SELECT limite from graficas where idgraficas=125");


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=113");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=114");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=115");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=116");
		$ng5=DB::select("SELECT nombre FROM graficas where idgraficas=117");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=118");
		$ng7=DB::select("SELECT nombre from graficas where idgraficas=119");
		$ng8=DB::select("SELECT nombre from graficas where idgraficas=120");
		$ng9=DB::select("SELECT nombre FROM graficas where idgraficas=121");
		$ng10=DB::select("SELECT nombre from graficas where idgraficas=122");
		$ng11=DB::select("SELECT nombre from graficas where idgraficas=123");
		$ng12=DB::select("SELECT nombre from graficas where idgraficas=124");
		$ng13=DB::select("SELECT nombre from graficas where idgraficas=125");	

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=113;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=114;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=115;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=116;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=117;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=118;");	
		$eg7=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=119;");	
		$eg8=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=120;");
		$eg9=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=121;");	
		$eg10=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=122;");	
		$eg11=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=123;");	
		$eg12=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=124;");
		$eg13=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=125;");	



		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1, $g3_e2 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1, $g4_e2 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"g5"=>array("data"=> array($g5_e1, $g5_e2 ),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					"g6"=>array("data"=> array($g6_e1, $g6_e2 ),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
					"g7"=>array("data"=> array($g7_e1, $g7_e2 ),"limite"=>$lg7,"nombre"=>$ng7,"elementos"=>$eg7),
					"g8"=>array("data"=> array($g8_e1, $g8_e2 ),"limite"=>$lg8,"nombre"=>$ng8,"elementos"=>$eg8),
					"g9"=>array("data"=> array($g9_e1, $g9_e2 ),"limite"=>$lg9,"nombre"=>$ng9,"elementos"=>$eg9),
					"g10"=>array("data"=> array($g10_e1, $g10_e2 ),"limite"=>$lg10,"nombre"=>$ng10,"elementos"=>$eg10),
					"g11"=>array("data"=> array($g11_e1, $g11_e2 ),"limite"=>$lg11,"nombre"=>$ng11,"elementos"=>$eg11),
					"g12"=>array("data"=> array($g12_e1, $g12_e2 ),"limite"=>$lg12,"nombre"=>$ng12,"elementos"=>$eg12),
					"g13"=>array("data"=> array($g13_e1, $g13_e2 ),"limite"=>$lg13,"nombre"=>$ng13,"elementos"=>$eg13),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=1 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=126 and idelementos=534) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=126 and idelementos=535) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=126 and idelementos=537) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=126 and idelementos=538) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=126 and idelementos=540) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=126 and idelementos=541) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=126 and idelementos=542) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=126 and idelementos=602) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=126 and idelementos=603) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=128 and idelementos=539) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=128 and idelementos=536) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=129 and idelementos=540) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=129 and idelementos=541) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=129 and idelementos=542) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=129 and idelementos=543) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=129 and idelementos=544) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=129 and idelementos=545) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=130 and idelementos=540) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=130 and idelementos=541) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=130 and idelementos=542) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=139 and idelementos=602) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=139 and idelementos=603) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	



		$lg1=DB::select("SELECT limite from graficas where idgraficas=126");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=128");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=129");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=130");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=139");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=126");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=128");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=129");
		$ng5=DB::select("SELECT nombre FROM graficas where idgraficas=130");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=139");
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=126;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=128;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=129;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=130;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=139;");	
		


		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4, $g1_e5,$g1_e6,$g1_e7,$g1_e8, $g1_e9),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1,$g2_e2),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"g5"=>array("data"=> array($g5_e1, $g5_e2, $g5_e3 ),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					"g6"=>array("data"=> array($g6_e1, $g6_e2 ),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
					
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=1 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=546) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=547) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=548) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=549) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=878) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=879) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=550) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=551) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=552) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=553) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=880) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=131 and idelementos=881) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=554) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=555) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=556) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=557) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=882) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=883) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=558) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=559) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=560) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=561) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=884) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=132 and idelementos=885) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=562) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=563) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=564) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=565) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=886) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=887) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=566) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=567) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=568) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=569) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=888) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=133 and idelementos=889) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=134 and idelementos=570) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=134 and idelementos=571) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=134 and idelementos=572) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=134 and idelementos=573) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=134 and idelementos=890) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=134 and idelementos=891) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=135 and idelementos=574) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=135 and idelementos=575) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=135 and idelementos=576) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=135 and idelementos=577) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=135 and idelementos=578) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=135 and idelementos=579) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=136 and idelementos=580) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=136 and idelementos=581) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=136 and idelementos=582) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=136 and idelementos=583) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=136 and idelementos=584) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=136 and idelementos=585) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g7_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=586) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=587) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=588) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=589) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=892) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=590) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=591) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=592) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=593) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=137 and idelementos=893) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g8_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=594) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=595) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=596) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=597) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=894) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=598) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=599) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=600) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=601) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=138 and idelementos=895) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	

		$lg1=DB::select("SELECT limite from graficas where idgraficas=131");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=132");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=133");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=134");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=135");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=136");
		$lg7=DB::select("SELECT limite from graficas where idgraficas=137");
		$lg8=DB::select("SELECT limite from graficas where idgraficas=138");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=131");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=132");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=133");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=134");
		$ng5=DB::select("SELECT nombre FROM graficas where idgraficas=135");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=136");
		$ng7=DB::select("SELECT nombre from graficas where idgraficas=137");
		$ng8=DB::select("SELECT nombre from graficas where idgraficas=138");
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=131;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=132;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=133;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=134;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=135;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=136;");	
		$eg7=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=137;");	
		$eg8=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=138;");
		



		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8, $g1_e9, $g1_e10, $g1_e11, $g1_e12),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9, $g2_e10, $g2_e11, $g2_e12 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					 "g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8, $g3_e9, $g3_e10, $g3_e11, $g3_e12 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					 "g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					 "g5"=>array("data"=> array($g5_e1, $g5_e2, $g5_e3, $g5_e4, $g5_e5, $g5_e6 ),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					 "g6"=>array("data"=> array($g6_e1, $g6_e2, $g6_e3, $g6_e4, $g6_e5, $g6_e6 ),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
					 "g7"=>array("data"=> array($g7_e1, $g7_e2, $g7_e3, $g7_e4, $g7_e5, $g7_e6, $g7_e7, $g7_e8, $g7_e9, $g7_e10 ),"limite"=>$lg7,"nombre"=>$ng7,"elementos"=>$eg7),
					 "g8"=>array("data"=> array($g8_e1, $g8_e2, $g8_e3, $g8_e4, $g8_e5, $g8_e6, $g8_e7, $g8_e8, $g8_e9, $g8_e10 ),"limite"=>$lg8,"nombre"=>$ng8,"elementos"=>$eg8),
					
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}


	public function getdatos4(){
		$input=Input::all();
		$week_1=Input::get("week_1");
		$week_2=Input::get("week_2");
		$anho_1=Input::get("anho_1");
		$anho_2=Input::get("anho_2");

		$fecha1=($anho_1*100)+$week_1;
		$fecha2=($anho_2*100)+$week_2;

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=1 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=604) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=605) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=606) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=607) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=896) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=897) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=608) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=609) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=610) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=611) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=612) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=898) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=899) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=140 and idelementos=613) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=614) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=615) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=616) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=900) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=901) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=617) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=618) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=619) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=620) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=902) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=903) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=621) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=622) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=191 and idelementos=623) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=140");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=191");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=140");
		$ng2=DB::select("SELECT nombre FROM graficas where idgraficas=191");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=140;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=191;");	
		

		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4, $g1_e5,$g1_e6,$g1_e7,$g1_e8, $g1_e9,$g1_e10,$g1_e11,$g1_e12, $g1_e13,$g1_e14),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1,$g2_e2,$g2_e3,$g2_e4, $g2_e5,$g2_e6,$g2_e7,$g2_e8, $g2_e9,$g2_e10,$g2_e11,$g2_e12, $g2_e13,$g2_e14),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
						
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}


	public function getdatos5(){
		$input=Input::all();
		$week_1=Input::get("week_1");
		$week_2=Input::get("week_2");
		$anho_1=Input::get("anho_1");
		$anho_2=Input::get("anho_2");

		$fecha1=($anho_1*100)+$week_1;
		$fecha2=($anho_2*100)+$week_2;

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=1 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=141 and idelementos=624) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=141 and idelementos=625) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=141 and idelementos=626) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=141 and idelementos=627) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=141 and idelementos=628) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=141 and idelementos=629) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=141 and idelementos=630) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=141 and idelementos=631) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=632) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=633) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=634) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=635) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=636) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=637) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=638) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=904) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=905) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=639) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=640) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=641) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=906) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=907) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=142 and idelementos=908) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=143 and idelementos=642) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	
		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=144 and idelementos=643) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=144 and idelementos=644) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=144 and idelementos=645) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=144 and idelementos=646) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=144 and idelementos=647) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=144 and idelementos=648) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=144 and idelementos=909) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=144 and idelementos=910) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=144 and idelementos=911) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=649) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=650) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=651) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=652) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=653) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=654) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=655) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=656) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=912) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=145 and idelementos=913) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=146 and idelementos=657) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=146 and idelementos=658) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=146 and idelementos=659) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=146 and idelementos=660) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=146 and idelementos=661) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=146 and idelementos=662) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=146 and idelementos=914) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=146 and idelementos=669) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g7_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=147 and idelementos=663) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=147 and idelementos=664) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=147 and idelementos=665) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=147 and idelementos=666) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g7_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=147 and idelementos=667) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g8_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=148 and idelementos=668) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=148 and idelementos=670) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=148 and idelementos=671) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=148 and idelementos=672) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g8_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=148 and idelementos=673) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g9_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=149 and idelementos=674) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g9_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=149 and idelementos=675) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g9_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=149 and idelementos=676) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g9_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=149 and idelementos=677) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g9_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=149 and idelementos=915) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g9_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=149 and idelementos=916) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g9_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=149 and idelementos=917) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g10_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=150 and idelementos=678) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g10_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=150 and idelementos=679) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g10_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=150 and idelementos=680) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g10_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=150 and idelementos=918) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g11_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=151 and idelementos=681) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g11_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=151 and idelementos=682) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g12_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=152 and idelementos=683) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g12_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=152 and idelementos=684) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g12_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=152 and idelementos=919) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g12_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=152 and idelementos=920) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g12_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=152 and idelementos=921) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g12_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=152 and idelementos=922) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g12_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=152 and idelementos=923) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g12_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=152 and idelementos=924) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g13_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=153 and idelementos=685) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g13_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=153 and idelementos=686) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g13_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=153 and idelementos=925) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g13_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=153 and idelementos=926) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g13_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=153 and idelementos=927) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g13_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=153 and idelementos=928) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g13_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=153 and idelementos=929) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g13_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=153 and idelementos=930) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g14_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=154 and idelementos=687) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g14_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=154 and idelementos=688) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=141");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=142");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=143");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=144");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=145");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=146");
		$lg7=DB::select("SELECT limite from graficas where idgraficas=147");
		$lg8=DB::select("SELECT limite from graficas where idgraficas=148");
		$lg9=DB::select("SELECT limite from graficas where idgraficas=149");
		$lg10=DB::select("SELECT limite from graficas where idgraficas=150");
		$lg11=DB::select("SELECT limite from graficas where idgraficas=151");
		$lg12=DB::select("SELECT limite from graficas where idgraficas=152");
		$lg13=DB::select("SELECT limite from graficas where idgraficas=153");
		$lg14=DB::select("SELECT limite from graficas where idgraficas=154");


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=141");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=142");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=143");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=144");
		$ng5=DB::select("SELECT nombre FROM graficas where idgraficas=145");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=146");
		$ng7=DB::select("SELECT nombre from graficas where idgraficas=147");
		$ng8=DB::select("SELECT nombre from graficas where idgraficas=148");
		$ng9=DB::select("SELECT nombre FROM graficas where idgraficas=149");
		$ng10=DB::select("SELECT nombre from graficas where idgraficas=150");
		$ng11=DB::select("SELECT nombre from graficas where idgraficas=151");
		$ng12=DB::select("SELECT nombre from graficas where idgraficas=152");
		$ng13=DB::select("SELECT nombre from graficas where idgraficas=153");
		$ng14=DB::select("SELECT nombre from graficas where idgraficas=154");	

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=141;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=142;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=143;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=144;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=145;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=146;");	
		$eg7=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=147;");	
		$eg8=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=148;");
		$eg9=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=149;");	
		$eg10=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=150;");	
		$eg11=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=151;");	
		$eg12=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=152;");
		$eg13=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=153;");	
		$eg14=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=154;");	



		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4, $g1_e5,$g1_e6,$g1_e7,$g1_e8),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2,$g2_e3, $g2_e4,$g2_e5, $g2_e6,$g2_e7, $g2_e8,$g2_e9, $g2_e10, $g2_e11,$g2_e12, $g2_e13,$g2_e14, $g2_e15),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8, $g4_e9 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"g5"=>array("data"=> array($g5_e1, $g5_e2, $g5_e3, $g5_e4, $g5_e5, $g5_e6, $g5_e7, $g5_e8, $g5_e9, $g5_e10),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					"g6"=>array("data"=> array($g6_e1, $g6_e2, $g6_e3, $g6_e4, $g6_e5, $g6_e6, $g6_e7, $g6_e8 ),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
					"g7"=>array("data"=> array($g7_e1, $g7_e2, $g7_e3, $g7_e4, $g7_e5 ),"limite"=>$lg7,"nombre"=>$ng7,"elementos"=>$eg7),
					"g8"=>array("data"=> array($g8_e1, $g8_e2, $g8_e3, $g8_e4, $g8_e5 ),"limite"=>$lg8,"nombre"=>$ng8,"elementos"=>$eg8),
					"g9"=>array("data"=> array($g9_e1, $g9_e2, $g9_e3, $g9_e4, $g9_e5, $g9_e6, $g9_e7 ),"limite"=>$lg9,"nombre"=>$ng9,"elementos"=>$eg9),
					"g10"=>array("data"=> array($g10_e1, $g10_e2, $g10_e3, $g10_e4 ),"limite"=>$lg10,"nombre"=>$ng10,"elementos"=>$eg10),
					"g11"=>array("data"=> array($g11_e1, $g11_e2 ),"limite"=>$lg11,"nombre"=>$ng11,"elementos"=>$eg11),
					"g12"=>array("data"=> array($g12_e1, $g12_e2, $g12_e3, $g12_e4, $g12_e5, $g12_e6, $g12_e7, $g12_e8 ),"limite"=>$lg12,"nombre"=>$ng12,"elementos"=>$eg12),
					"g13"=>array("data"=> array($g13_e1, $g13_e2, $g13_e3, $g13_e4, $g13_e5, $g13_e6, $g13_e7, $g13_e8 ),"limite"=>$lg13,"nombre"=>$ng13,"elementos"=>$eg13),
					"g14"=>array("data"=> array($g14_e1, $g14_e2 ),"limite"=>$lg14,"nombre"=>$ng14,"elementos"=>$eg14),
					
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}

	public function getdatos6(){
		$input=Input::all();
		$week_1=Input::get("week_1");
		$week_2=Input::get("week_2");
		$anho_1=Input::get("anho_1");
		$anho_2=Input::get("anho_2");

		$fecha1=($anho_1*100)+$week_1;
		$fecha2=($anho_2*100)+$week_2;

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=1 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=155 and idelementos=528) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=155 and idelementos=529) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=155 and idelementos=689) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=155 and idelementos=690) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=155 and idelementos=691) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=155 and idelementos=692) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=155 and idelementos=536) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=155 and idelementos=539) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=156 and idelementos=528) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=156 and idelementos=529) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=693) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=694) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=695) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=696) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=697) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=698) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=699) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=700) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=701) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=702) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=157 and idelementos=703) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=158 and idelementos=704) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=158 and idelementos=705) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=158 and idelementos=706) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=158 and idelementos=707) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=158 and idelementos=708) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=158 and idelementos=709) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=158 and idelementos=710) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=158 and idelementos=711) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=158 and idelementos=712) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=159 and idelementos=704) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=159 and idelementos=705) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=159 and idelementos=706) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=159 and idelementos=707) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=159 and idelementos=708) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=159 and idelementos=709) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=159 and idelementos=710) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=159 and idelementos=711) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=159 and idelementos=712) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=160 and idelementos=704) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=160 and idelementos=705) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=160 and idelementos=706) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=160 and idelementos=707) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=160 and idelementos=708) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=160 and idelementos=709) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=160 and idelementos=710) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=160 and idelementos=711) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=160 and idelementos=712) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		


		$lg1=DB::select("SELECT limite from graficas where idgraficas=155");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=156");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=157");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=158");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=159");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=160");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=155");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=156");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=157");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=158");
		$ng5=DB::select("SELECT nombre FROM graficas where idgraficas=159");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=160");
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=155;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=156;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=157;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=158;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=159;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=160;");	
		


		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4, $g1_e5,$g1_e6,$g1_e7,$g1_e8),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1,$g3_e2,$g3_e3,$g3_e4,$g3_e5,$g3_e6,$g3_e7,$g3_e8,$g3_e9,$g3_e10,$g3_e11),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8, $g4_e9 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"g5"=>array("data"=> array($g5_e1, $g5_e2, $g5_e3, $g5_e4, $g5_e5, $g5_e6, $g5_e7, $g5_e8, $g5_e9 ),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					"g6"=>array("data"=> array($g6_e1, $g6_e2, $g6_e3, $g6_e4, $g6_e5, $g6_e6, $g6_e7, $g6_e8, $g6_e9 ),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
					
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}


	public function homeVozMsc(){
	
		$anhos=anhos::all();
		return View::make('vozView/msc', array("anhos"=>$anhos));
	}

	public function homeVozGmsc(){
	
		$anhos=anhos::all();
		return View::make('vozView/gmsc', array("anhos"=>$anhos));
	}

	public function homeVozUmgs(){
	
		$anhos=anhos::all();
		return View::make('vozView/umgs', array("anhos"=>$anhos));
	}

	public function homeVozBicc(){
	
		$anhos=anhos::all();
		return View::make('vozView/bicc', array("anhos"=>$anhos));
	}

	public function homeVozTroncales(){
	
		$anhos=anhos::all();
		return View::make('vozView/troncales', array("anhos"=>$anhos));
	}

	public function homeVozLicencias(){
	
		$anhos=anhos::all();
		return View::make('vozView/vlicense', array("anhos"=>$anhos));
	}

	
}
