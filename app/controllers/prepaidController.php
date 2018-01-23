<?php

class prepaidController extends Controller {

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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=6 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=98 and idelementos=232) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=98 and idelementos=233) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=98 and idelementos=234) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=98 and idelementos=235) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=98 and idelementos=236) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=99 and idelementos=237) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=99 and idelementos=238) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=99 and idelementos=239) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=100 and idelementos=240) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=101 and idelementos=241) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=101 and idelementos=242) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=101 and idelementos=243) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=101 and idelementos=244) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=101 and idelementos=245) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	

		$lg1=DB::select("SELECT limite from graficas where idgraficas=98");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=99");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=100");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=101");

		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=98");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=99");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=100");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=101");	

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=98;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=99;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=100;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=101;");	



		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4,$g1_e5),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1,$g2_e2,$g2_e3),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1,$g4_e2,$g4_e3,$g4_e4,$g4_e5),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=6 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=102 and idelementos=246) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=102 and idelementos=247) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=102 and idelementos=248) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=102 and idelementos=249) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=250) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=251) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=252) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=253) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=254) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=255) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=256) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=954) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=955) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=956) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=957) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=958) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=959) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=960) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=961) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=962) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=963) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=964) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=965) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=966) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=967) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e22=DB::select("SELECT valor, comentario from producto where (idgraficas=103 and idelementos=968) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=257) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=258) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=259) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=969) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=970) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=260) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=261) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=262) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=971) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=104 and idelementos=972) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=105 and idelementos=246) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=105 and idelementos=247) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=105 and idelementos=248) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=105 and idelementos=249) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=250) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=251) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=252) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=253) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=254) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=255) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=256) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=954) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=955) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=956) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=957) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=958) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=959) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=960) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=961) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=962) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=963) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=964) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=965) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=966) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=967) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e22=DB::select("SELECT valor, comentario from producto where (idgraficas=106 and idelementos=968) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		


		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=257) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=258) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=259) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=969) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=970) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=260) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=261) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=262) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=971) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=107 and idelementos=972) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=102");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=103");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=104");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=105");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=106");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=107");


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=102");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=103");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=104");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=105");
		$ng5=DB::select("SELECT nombre from graficas where idgraficas=106");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=107");	

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=102;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=103;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=104;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=105;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=106;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=107;");	



		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1,$g2_e2,$g2_e3,$g2_e4,$g2_e5,$g2_e6,$g2_e7,$g2_e8,$g2_e9,$g2_e10,$g2_e11,$g2_e12,$g2_e13,$g2_e14,$g2_e15,$g2_e16,$g2_e17,$g2_e18,$g2_e19,$g2_e20,$g2_e21,$g2_e22),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1,$g3_e2,$g3_e3,$g3_e4,$g3_e5,$g3_e6,$g3_e7,$g3_e8,$g3_e9,$g3_e10),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1,$g4_e2,$g4_e3,$g4_e4),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"g5"=>array("data"=> array($g5_e1,$g5_e2,$g5_e3,$g5_e4,$g5_e5,$g5_e6,$g5_e7,$g5_e8,$g5_e9,$g5_e10,$g5_e11,$g5_e12,$g5_e13,$g5_e14,$g5_e15,$g5_e16,$g5_e17,$g5_e18,$g5_e19,$g5_e20,$g5_e21,$g5_e22),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					"g6"=>array("data"=> array($g6_e1,$g6_e2,$g6_e3,$g6_e4,$g6_e5,$g6_e6,$g6_e7,$g6_e8,$g6_e9,$g6_e10),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=6 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=108 and idelementos=263) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=108 and idelementos=264) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=108 and idelementos=265) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=108 and idelementos=266) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=108 and idelementos=267) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
			
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=109 and idelementos=268) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=109 and idelementos=269) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=109 and idelementos=270) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=109 and idelementos=271) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=109 and idelementos=272) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=109 and idelementos=273) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=109 and idelementos=973) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=109 and idelementos=274) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		
		$lg1=DB::select("SELECT limite from graficas where idgraficas=108");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=109");
		

		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=108");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=109");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=108;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=109;");	
		


		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4,$g1_e5),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1,$g2_e2,$g2_e3,$g2_e4,$g2_e5,$g2_e6,$g2_e7,$g2_e8),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}


	public function homePrepaidServices(){
	
		$anhos=anhos::all();
		return View::make('prepaidView/services', array("anhos"=>$anhos));
	}

	public function homePrepaidIcc(){
	
		$anhos=anhos::all();
		return View::make('prepaidView/icc', array("anhos"=>$anhos));
	}

	public function homePrepaidLicense(){
	
		$anhos=anhos::all();
		return View::make('prepaidView/license', array("anhos"=>$anhos));
	}
	
}
