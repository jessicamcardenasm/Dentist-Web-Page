<?php

class vasController extends Controller {

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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=5 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("select valor, comentario from producto where (idgraficas=82 and idelementos=199) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("select valor, comentario from producto where (idgraficas=82 and idelementos=200) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("select valor, comentario from producto where (idgraficas=82 and idelementos=201) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("select valor, comentario from producto where (idgraficas=82 and idelementos=202) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("select valor, comentario from producto where (idgraficas=82 and idelementos=203) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("select valor, comentario from producto where (idgraficas=82 and idelementos=204) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e1=DB::select("select valor, comentario from producto where (idgraficas=83 and idelementos=199) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("select valor, comentario from producto where (idgraficas=83 and idelementos=200) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("select valor, comentario from producto where (idgraficas=83 and idelementos=201) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("select valor, comentario from producto where (idgraficas=83 and idelementos=202) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("select valor, comentario from producto where (idgraficas=83 and idelementos=203) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("select valor, comentario from producto where (idgraficas=83 and idelementos=204) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e1=DB::select("select valor, comentario from producto where (idgraficas=84 and idelementos=199) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("select valor, comentario from producto where (idgraficas=84 and idelementos=200) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("select valor, comentario from producto where (idgraficas=84 and idelementos=201) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("select valor, comentario from producto where (idgraficas=84 and idelementos=202) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("select valor, comentario from producto where (idgraficas=84 and idelementos=203) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("select valor, comentario from producto where (idgraficas=84 and idelementos=204) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e1=DB::select("select valor, comentario from producto where (idgraficas=85 and idelementos=205) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$lg1=DB::select("select limite from graficas where idgraficas=82");
		$lg2=DB::select("select limite from graficas where idgraficas=83");
		$lg3=DB::select("select limite from graficas where idgraficas=84");
		$lg4=DB::select("select limite from graficas where idgraficas=85");

		$ng1=DB::select("select nombre from graficas where idgraficas=82");
		$ng2=DB::select("select nombre from graficas where idgraficas=83");
		$ng3=DB::select("select nombre from graficas where idgraficas=84");
		$ng4=DB::select("select nombre from graficas where idgraficas=85");		



		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4,$g1_e5,$g1_e6),"limite"=>$lg1,"nombre"=>$ng1),
					"g2"=>array("data"=> array($g2_e1,$g2_e2,$g2_e3,$g2_e4,$g2_e5,$g2_e6),"limite"=>$lg2,"nombre"=>$ng2),
					"g3"=>array("data"=> array($g3_e1,$g3_e2,$g3_e3,$g3_e4,$g3_e5,$g3_e6),"limite"=>$lg3,"nombre"=>$ng3),
					"g4"=>array("data"=> array($g4_e1),"limite"=>$lg4,"nombre"=>$ng4),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=5 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("select valor, comentario from producto where (idgraficas=86 and idelementos=206) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("select valor, comentario from producto where (idgraficas=86 and idelementos=207) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("select valor, comentario from producto where (idgraficas=86 and idelementos=208) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("select valor, comentario from producto where (idgraficas=86 and idelementos=209) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e1=DB::select("select valor, comentario from producto where (idgraficas=87 and idelementos=206) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("select valor, comentario from producto where (idgraficas=87 and idelementos=207) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("select valor, comentario from producto where (idgraficas=87 and idelementos=208) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("select valor, comentario from producto where (idgraficas=87 and idelementos=209) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e1=DB::select("select valor, comentario from producto where (idgraficas=88 and idelementos=206) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("select valor, comentario from producto where (idgraficas=88 and idelementos=207) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("select valor, comentario from producto where (idgraficas=88 and idelementos=208) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("select valor, comentario from producto where (idgraficas=88 and idelementos=209) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e1=DB::select("select valor, comentario from producto where (idgraficas=89 and idelementos=210) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$lg1=DB::select("select limite from graficas where idgraficas=86");
		$lg2=DB::select("select limite from graficas where idgraficas=87");
		$lg3=DB::select("select limite from graficas where idgraficas=88");
		$lg4=DB::select("select limite from graficas where idgraficas=89");

		$ng1=DB::select("select nombre from graficas where idgraficas=86");
		$ng2=DB::select("select nombre from graficas where idgraficas=87");
		$ng3=DB::select("select nombre from graficas where idgraficas=88");
		$ng4=DB::select("select nombre from graficas where idgraficas=89");		



		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4),"limite"=>$lg1,"nombre"=>$ng1),
					"g2"=>array("data"=> array($g2_e1,$g2_e2,$g2_e3,$g2_e4),"limite"=>$lg2,"nombre"=>$ng2),
					"g3"=>array("data"=> array($g3_e1,$g3_e2,$g3_e3,$g3_e4),"limite"=>$lg3,"nombre"=>$ng3),
					"g4"=>array("data"=> array($g4_e1),"limite"=>$lg4,"nombre"=>$ng4),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=5 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("select valor, comentario from producto where (idgraficas=90 and idelementos=211) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("select valor, comentario from producto where (idgraficas=90 and idelementos=212) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("select valor, comentario from producto where (idgraficas=90 and idelementos=213) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("select valor, comentario from producto where (idgraficas=90 and idelementos=214) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("select valor, comentario from producto where (idgraficas=90 and idelementos=215) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("select valor, comentario from producto where (idgraficas=90 and idelementos=216) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("select valor, comentario from producto where (idgraficas=90 and idelementos=217) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("select valor, comentario from producto where (idgraficas=90 and idelementos=218) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("select valor, comentario from producto where (idgraficas=90 and idelementos=219) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g2_e1=DB::select("select valor, comentario from producto where (idgraficas=91 and idelementos=211) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("select valor, comentario from producto where (idgraficas=91 and idelementos=212) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("select valor, comentario from producto where (idgraficas=91 and idelementos=213) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("select valor, comentario from producto where (idgraficas=91 and idelementos=214) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("select valor, comentario from producto where (idgraficas=91 and idelementos=215) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("select valor, comentario from producto where (idgraficas=91 and idelementos=216) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("select valor, comentario from producto where (idgraficas=91 and idelementos=217) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("select valor, comentario from producto where (idgraficas=91 and idelementos=218) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("select valor, comentario from producto where (idgraficas=91 and idelementos=219) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g3_e1=DB::select("select valor, comentario from producto where (idgraficas=92 and idelementos=211) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("select valor, comentario from producto where (idgraficas=92 and idelementos=212) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("select valor, comentario from producto where (idgraficas=92 and idelementos=213) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("select valor, comentario from producto where (idgraficas=92 and idelementos=214) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("select valor, comentario from producto where (idgraficas=92 and idelementos=215) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("select valor, comentario from producto where (idgraficas=92 and idelementos=216) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("select valor, comentario from producto where (idgraficas=92 and idelementos=217) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("select valor, comentario from producto where (idgraficas=92 and idelementos=218) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("select valor, comentario from producto where (idgraficas=92 and idelementos=219) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g4_e1=DB::select("select valor, comentario from producto where (idgraficas=93 and idelementos=220) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("select valor, comentario from producto where (idgraficas=93 and idelementos=221) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("select valor, comentario from producto where (idgraficas=93 and idelementos=222) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		
		$lg1=DB::select("select limite from graficas where idgraficas=90");
		$lg2=DB::select("select limite from graficas where idgraficas=91");
		$lg3=DB::select("select limite from graficas where idgraficas=92");
		$lg4=DB::select("select limite from graficas where idgraficas=93");

		$ng1=DB::select("select nombre from graficas where idgraficas=90");
		$ng2=DB::select("select nombre from graficas where idgraficas=91");
		$ng3=DB::select("select nombre from graficas where idgraficas=92");
		$ng4=DB::select("select nombre from graficas where idgraficas=93");		



		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4,$g1_e5,$g1_e6,$g1_e7,$g1_e8,$g1_e9),"limite"=>$lg1,"nombre"=>$ng1),
					"g2"=>array("data"=> array($g2_e1,$g2_e2,$g2_e3,$g2_e4,$g2_e5,$g2_e6,$g2_e7,$g2_e8,$g2_e9),"limite"=>$lg2,"nombre"=>$ng2),
					"g3"=>array("data"=> array($g3_e1,$g3_e2,$g3_e3,$g3_e4,$g3_e5,$g3_e6,$g3_e7,$g3_e8,$g3_e9),"limite"=>$lg3,"nombre"=>$ng3),
					"g4"=>array("data"=> array($g4_e1,$g4_e2,$g4_e3),"limite"=>$lg4,"nombre"=>$ng4),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=5 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("select valor, comentario from producto where (idgraficas=94 and idelementos=223) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("select valor, comentario from producto where (idgraficas=94 and idelementos=224) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("select valor, comentario from producto where (idgraficas=94 and idelementos=225) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("select valor, comentario from producto where (idgraficas=94 and idelementos=226) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("select valor, comentario from producto where (idgraficas=94 and idelementos=227) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("select valor, comentario from producto where (idgraficas=94 and idelementos=228) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("select valor, comentario from producto where (idgraficas=94 and idelementos=229) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g2_e1=DB::select("select valor, comentario from producto where (idgraficas=95 and idelementos=223) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("select valor, comentario from producto where (idgraficas=95 and idelementos=224) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("select valor, comentario from producto where (idgraficas=95 and idelementos=225) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("select valor, comentario from producto where (idgraficas=95 and idelementos=226) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("select valor, comentario from producto where (idgraficas=95 and idelementos=227) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("select valor, comentario from producto where (idgraficas=95 and idelementos=228) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("select valor, comentario from producto where (idgraficas=95 and idelementos=229) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("select valor, comentario from producto where (idgraficas=96 and idelementos=223) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("select valor, comentario from producto where (idgraficas=96 and idelementos=224) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("select valor, comentario from producto where (idgraficas=96 and idelementos=225) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("select valor, comentario from producto where (idgraficas=96 and idelementos=226) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("select valor, comentario from producto where (idgraficas=96 and idelementos=227) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("select valor, comentario from producto where (idgraficas=96 and idelementos=228) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("select valor, comentario from producto where (idgraficas=96 and idelementos=229) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g4_e1=DB::select("select valor, comentario from producto where (idgraficas=97 and idelementos=230) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("select valor, comentario from producto where (idgraficas=97 and idelementos=231) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$lg1=DB::select("select limite from graficas where idgraficas=94");
		$lg2=DB::select("select limite from graficas where idgraficas=95");
		$lg3=DB::select("select limite from graficas where idgraficas=96");
		$lg4=DB::select("select limite from graficas where idgraficas=97");

		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=94");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=95");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=96");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=97");	

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=94;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=95;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=96;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=97;");	



		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4,$g1_e5,$g1_e6,$g1_e7),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1,$g2_e2,$g2_e3,$g2_e4,$g2_e5,$g2_e6,$g2_e7),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1,$g3_e2,$g3_e3,$g3_e4,$g3_e5,$g3_e6,$g3_e7),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1,$g4_e2),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}
	


	public function homeVasSmsc(){
	
		$anhos=anhos::all();
		return View::make('vasView/smsc', array("anhos"=>$anhos));
	}

	public function homeVasUssd(){
	
		$anhos=anhos::all();
		return View::make('vasView/ussd', array("anhos"=>$anhos));
	}

	public function homeVasDmm(){
	
		$anhos=anhos::all();
		return View::make('vasView/dmm', array("anhos"=>$anhos));
	}
	public function homeVasMmsc(){
	
		$anhos=anhos::all();
		return View::make('vasView/mmsc', array("anhos"=>$anhos));
	}

}
