<?php

class transporteController extends Controller {

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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=7 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=981) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=982) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=983) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=984) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=985) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=986) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=987) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=988) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=989) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=990) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=991) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=992) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=993) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=193 and idelementos=994) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=995) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=996) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=997) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=998) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=999) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=1000) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=1001) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=1002) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=1003) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=1004) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=1005) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=194 and idelementos=1006) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1007) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1008) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1009) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1010) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1011) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1012) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1013) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1014) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1015) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1016) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1017) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1018) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=195 and idelementos=1019) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=193");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=194");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=195");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=193");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=194");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=195");
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=193");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=194;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=195;");	
		


		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8, $g1_e9, $g1_e10, $g1_e11, $g1_e12, $g1_e13, $g1_e14 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9, $g2_e10, $g2_e11, $g2_e12),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					 "g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8, $g3_e9, $g3_e10, $g3_e11, $g3_e12, $g3_e13),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=7 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=196 and idelementos=1020) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=196 and idelementos=1021) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=196 and idelementos=1022) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=196 and idelementos=1023) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=196 and idelementos=1024) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=196 and idelementos=1025) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=196 and idelementos=1026) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=196 and idelementos=1027) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=196 and idelementos=1028) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=197 and idelementos=1029) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=197 and idelementos=1030) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=197 and idelementos=1031) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=197 and idelementos=1032) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=197 and idelementos=1033) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=197 and idelementos=1034) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=197 and idelementos=1035) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=197 and idelementos=1036) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=197 and idelementos=1037) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		
		$lg1=DB::select("SELECT limite from graficas where idgraficas=196");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=197");
		
		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=196");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=197");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=196");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=197;");	
		

		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8, $g1_e9 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=7 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1038) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1039) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1040) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1041) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1042) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1043) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1044) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1045) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1046) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1047) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=198 and idelementos=1048) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1049) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1050) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1051) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1052) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1053) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1054) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1055) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1056) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1057) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=199 and idelementos=1058) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=198");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=199");
		
		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=198");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=199");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=198");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=199;");	
		

		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8, $g1_e9, $g1_e10, $g1_e11 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9, $g2_e10),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=7 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1059) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1060) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1061) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1062) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1063) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1064) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1065) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1066) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1067) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1068) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1069) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1070) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1071) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1072) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=200 and idelementos=1073) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=200");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=200");
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=200");	
		


		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8, $g1_e9, $g1_e10, $g1_e11, $g1_e12, $g1_e13, $g1_e14, $g1_e15 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}


	
	public function TransporteNorte(){
	
		$anhos=anhos::all();
		return View::make('transporteView/TransporteNorte', array("anhos"=>$anhos));
	}

	public function TransporteCentro(){
	
		$anhos=anhos::all();
		return View::make('transporteView/TransporteCentro', array("anhos"=>$anhos));
	}

	public function TransporteSur(){
	
		$anhos=anhos::all();
		return View::make('transporteView/TransporteSur', array("anhos"=>$anhos));
	}

	public function TransporteLima(){
	
		$anhos=anhos::all();
		return View::make('transporteView/TransporteLima', array("anhos"=>$anhos));
	}

	
	
	
}
