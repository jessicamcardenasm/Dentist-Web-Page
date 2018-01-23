<?php

class ispController extends Controller {

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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=8 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=161 and idelementos=713) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=161 and idelementos=714) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=161 and idelementos=974) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=161 and idelementos=715) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=162 and idelementos=716) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=162 and idelementos=717) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=162 and idelementos=718) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=162 and idelementos=719) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=162 and idelementos=720) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=163 and idelementos=716) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=163 and idelementos=717) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=163 and idelementos=718) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=163 and idelementos=719) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=163 and idelementos=720) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=164 and idelementos=716) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=164 and idelementos=717) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=165 and idelementos=721) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=165 and idelementos=722) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=165 and idelementos=723) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=165 and idelementos=724) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=165 and idelementos=725) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=165 and idelementos=726) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=166 and idelementos=721) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=166 and idelementos=722) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=166 and idelementos=723) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=166 and idelementos=724) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=166 and idelementos=725) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=166 and idelementos=726) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		


		$lg1=DB::select("SELECT limite from graficas where idgraficas=161");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=162");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=163");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=164");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=165");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=166");
		

		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=161");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=162");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=163");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=164");
		$ng5=DB::select("SELECT nombre FROM graficas where idgraficas=165");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=166");
		
		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=161;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=162;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=163;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=164;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=165;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=166;");	
		



		return array("g1"=>array("data"=> array($g1_e1,$g1_e2,$g1_e3,$g1_e4),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					"g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					"g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					"g4"=>array("data"=> array($g4_e1, $g4_e2 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					"g5"=>array("data"=> array($g5_e1, $g5_e2, $g5_e3, $g5_e4, $g5_e5, $g5_e6 ),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					"g6"=>array("data"=> array($g6_e1, $g6_e2, $g6_e3, $g6_e4, $g6_e5, $g6_e6 ),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=8 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=727) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=728) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=729) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=730) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=731) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=732) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=733) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=734) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=735) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=975) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=736) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=737) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=976) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=738) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=739) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=740) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=741) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=742) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=743) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=977) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=744) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e22=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=745) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e23=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=746) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e24=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=747) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e25=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=748) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e26=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=749) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e27=DB::select("SELECT valor, comentario from producto where (idgraficas=167 and idelementos=750) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=751) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=752) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=753) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=754) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=755) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=756) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=757) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=758) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=759) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=760) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=761) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=762) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=763) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=764) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=765) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=766) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=767) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=768) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=769) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=770) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=771) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e22=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=772) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e23=DB::select("SELECT valor, comentario from producto where (idgraficas=168 and idelementos=773) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=727) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=728) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=729) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=730) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=731) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=732) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=733) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=734) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=735) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=975) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=736) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=737) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=976) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=738) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=739) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=740) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=741) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=742) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=743) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=977) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=744) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e22=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=745) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e23=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=746) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e24=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=747) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e25=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=748) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e26=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=749) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e27=DB::select("SELECT valor, comentario from producto where (idgraficas=169 and idelementos=750) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
	

		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=751) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=752) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=753) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=754) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=755) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=756) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=757) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=758) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=759) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=760) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=761) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=762) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=763) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=764) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=765) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=766) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=767) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=768) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=769) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=770) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=771) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e22=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=772) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e23=DB::select("SELECT valor, comentario from producto where (idgraficas=170 and idelementos=773) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=167");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=168");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=169");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=170");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=167");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=168");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=169");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=170");
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=167;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=168;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=169;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=170;");
		

		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8, $g1_e9, $g1_e10, $g1_e11, $g1_e12, $g1_e13, $g1_e14, $g1_e15, $g1_e16, $g1_e17, $g1_e18, $g1_e19, $g1_e20, $g1_e21, $g1_e22, $g1_e23, $g1_e24, $g1_e25, $g1_e26, $g1_e27 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9, $g2_e10, $g2_e11, $g2_e12, $g2_e13, $g2_e14, $g2_e15, $g2_e16, $g2_e17, $g2_e18, $g2_e19, $g2_e20, $g2_e21, $g2_e22, $g2_e23 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					 "g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8, $g3_e9, $g3_e10, $g3_e11, $g3_e12, $g3_e13, $g3_e14, $g3_e15, $g3_e16, $g3_e17, $g3_e18, $g3_e19, $g3_e20, $g3_e21, $g3_e22, $g3_e23, $g3_e24, $g3_e25, $g3_e26, $g3_e27 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					 "g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8, $g4_e9, $g4_e10, $g4_e11, $g4_e12, $g4_e13, $g4_e14, $g4_e15, $g4_e16, $g4_e17, $g4_e18, $g4_e19, $g4_e20, $g4_e21, $g4_e22, $g4_e23 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=8 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=774) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=978) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=775) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=776) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=777) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=778) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=779) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=780) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=781) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=782) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=783) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=784) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=979) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=785) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=786) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=787) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=788) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=789) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=980) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=790) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=791) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e22=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=792) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e23=DB::select("SELECT valor, comentario from producto where (idgraficas=171 and idelementos=793) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=794) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=795) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=796) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=797) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=798) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=799) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=800) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=801) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=802) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=803) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=804) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=805) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=806) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=807) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=808) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=809) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=810) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=811) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=812) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=813) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=172 and idelementos=814) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		


		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=774) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=978) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=775) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=776) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=777) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=778) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=779) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=780) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=781) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=781) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=783) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=784) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=979) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=785) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=786) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=787) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=788) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=789) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=980) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=790) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=791) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e22=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=792) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e23=DB::select("SELECT valor, comentario from producto where (idgraficas=173 and idelementos=793) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=794) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=795) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=796) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=797) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=798) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=799) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=800) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=801) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=802) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=803) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=804) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=805) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=806) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=807) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=808) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=809) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=810) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e18=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=811) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e19=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=812) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e20=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=813) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e21=DB::select("SELECT valor, comentario from producto where (idgraficas=174 and idelementos=814) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=171");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=172");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=173");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=174");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=171");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=172");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=173");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=174");
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=171;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=172;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=173;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=174;");
		

		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8, $g1_e9, $g1_e10, $g1_e11, $g1_e12, $g1_e13, $g1_e14, $g1_e15, $g1_e16, $g1_e17, $g1_e18, $g1_e19, $g1_e20, $g1_e21, $g1_e22, $g1_e23 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9, $g2_e10, $g2_e11, $g2_e12, $g2_e13, $g2_e14, $g2_e15, $g2_e16, $g2_e17, $g2_e18, $g2_e19, $g2_e20, $g2_e21 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					 "g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8, $g3_e9, $g3_e10, $g3_e11, $g3_e12, $g3_e13, $g3_e14, $g3_e15, $g3_e16, $g3_e17, $g3_e18, $g3_e19, $g3_e20, $g3_e21, $g3_e22, $g3_e23),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					 "g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8, $g4_e9, $g4_e10, $g4_e11, $g4_e12, $g4_e13, $g4_e14, $g4_e15, $g4_e16, $g4_e17, $g4_e18, $g4_e19, $g4_e20, $g4_e21 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=8 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=175 and idelementos=815) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=175 and idelementos=816) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=175 and idelementos=817) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=175 and idelementos=818) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=175 and idelementos=819) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=175 and idelementos=820) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=176 and idelementos=815) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=176 and idelementos=816) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=176 and idelementos=817) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=176 and idelementos=818) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=176 and idelementos=819) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=176 and idelementos=820) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=177 and idelementos=815) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=177 and idelementos=816) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=177 and idelementos=817) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=177 and idelementos=818) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=177 and idelementos=819) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=177 and idelementos=820) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=178 and idelementos=821) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=178 and idelementos=822) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=178 and idelementos=823) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=178 and idelementos=824) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=178 and idelementos=825) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=178 and idelementos=826) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=179 and idelementos=821) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=179 and idelementos=822) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=179 and idelementos=823) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=179 and idelementos=824) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=179 and idelementos=825) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=179 and idelementos=826) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g6_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=180 and idelementos=821) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=180 and idelementos=822) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=180 and idelementos=825) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g6_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=180 and idelementos=826) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		



		$lg1=DB::select("SELECT limite from graficas where idgraficas=175");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=176");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=177");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=178");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=179");
		$lg6=DB::select("SELECT limite from graficas where idgraficas=180");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=175");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=176");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=177");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=178");
		$ng5=DB::select("SELECT nombre from graficas where idgraficas=179");
		$ng6=DB::select("SELECT nombre from graficas where idgraficas=180");
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=175;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=176;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=177;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=178;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=179;");	
		$eg6=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=180;");
		

		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					 "g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					 "g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					 "g5"=>array("data"=> array($g5_e1, $g5_e2, $g5_e3, $g5_e4, $g5_e5, $g5_e6 ),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					 "g6"=>array("data"=> array($g6_e1, $g6_e2, $g6_e3, $g6_e4 ),"limite"=>$lg6,"nombre"=>$ng6,"elementos"=>$eg6),
					
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=8 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=181 and idelementos=827) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=181 and idelementos=828) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=181 and idelementos=829) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=181 and idelementos=830) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=181 and idelementos=831) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=181 and idelementos=832) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=181 and idelementos=833) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=181 and idelementos=834) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=181 and idelementos=835) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=182 and idelementos=827) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=182 and idelementos=828) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=182 and idelementos=829) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=182 and idelementos=830) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=182 and idelementos=831) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=182 and idelementos=832) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=182 and idelementos=833) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=182 and idelementos=834) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=182 and idelementos=835) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		

		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=188 and idelementos=870) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=188 and idelementos=871) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=188 and idelementos=872) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=188 and idelementos=873) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=188 and idelementos=874) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=188 and idelementos=875) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=188 and idelementos=876) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=188 and idelementos=877) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=189 and idelementos=870) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=189 and idelementos=871) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=189 and idelementos=872) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=189 and idelementos=873) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=189 and idelementos=874) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=189 and idelementos=875) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=189 and idelementos=876) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=189 and idelementos=877) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=190 and idelementos=876) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=190 and idelementos=877) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=181");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=182");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=188");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=189");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=190");
				


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=181");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=182");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=188");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=189");
		$ng5=DB::select("SELECT nombre from graficas where idgraficas=190");
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=181;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=182;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=188;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=189;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=190;");
		

		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8, $g1_e9 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					 "g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					 "g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					 "g5"=>array("data"=> array($g5_e1, $g5_e2),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					
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

		$semanas=DB::select("select distinct(semana) from producto  where idsupervisiones=8 and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));

		$g1_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=836) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=837) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=838) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=839) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=840) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=841) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=842) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=843) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=844) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=845) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=846) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=847) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=848) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=849) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=850) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=851) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g1_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=183 and idelementos=852) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		
		$g2_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=853) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=854) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=855) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=856) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=857) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=858) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=859) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=860) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=861) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=862) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=863) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=864) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=865) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=866) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=867) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=868) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g2_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=184 and idelementos=869) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g3_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=836) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=837) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=838) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=839) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=840) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=841) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=842) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=843) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=844) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=845) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=846) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=847) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=848) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=849) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=850) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=851) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g3_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=185 and idelementos=852) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g4_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=853) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=854) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=855) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=856) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=857) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=858) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=859) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=860) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e9=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=861) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e10=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=862) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e11=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=863) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e12=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=864) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e13=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=865) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e14=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=866) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e15=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=867) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e16=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=868) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g4_e17=DB::select("SELECT valor, comentario from producto where (idgraficas=186 and idelementos=869) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$g5_e1=DB::select("SELECT valor, comentario from producto where (idgraficas=187 and idelementos=836) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e2=DB::select("SELECT valor, comentario from producto where (idgraficas=187 and idelementos=837) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e3=DB::select("SELECT valor, comentario from producto where (idgraficas=187 and idelementos=838) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e4=DB::select("SELECT valor, comentario from producto where (idgraficas=187 and idelementos=839) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e5=DB::select("SELECT valor, comentario from producto where (idgraficas=187 and idelementos=840) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e6=DB::select("SELECT valor, comentario from producto where (idgraficas=187 and idelementos=841) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e7=DB::select("SELECT valor, comentario from producto where (idgraficas=187 and idelementos=842) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		$g5_e8=DB::select("SELECT valor, comentario from producto where (idgraficas=187 and idelementos=843) and (semana>=? and semana<=?) order by semana",array($fecha1,$fecha2));
		

		$lg1=DB::select("SELECT limite from graficas where idgraficas=183");
		$lg2=DB::select("SELECT limite from graficas where idgraficas=184");
		$lg3=DB::select("SELECT limite from graficas where idgraficas=185");
		$lg4=DB::select("SELECT limite from graficas where idgraficas=186");
		$lg5=DB::select("SELECT limite from graficas where idgraficas=187");
		


		$ng1=DB::select("SELECT nombre FROM graficas where idgraficas=183");
		$ng2=DB::select("SELECT nombre from graficas where idgraficas=184");
		$ng3=DB::select("SELECT nombre from graficas where idgraficas=185");
		$ng4=DB::select("SELECT nombre from graficas where idgraficas=186");
		$ng5=DB::select("SELECT nombre from graficas where idgraficas=187");
		
		

		$eg1=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=183;");	
		$eg2=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=184;");	
		$eg3=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=185;");	
		$eg4=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=186;");
		$eg5=DB::select("SELECT nombre_elemento FROM cockpit_entel.producto_catalogo where idgraficas=187;");
		

		return array("g1"=>array("data"=> array($g1_e1, $g1_e2, $g1_e3, $g1_e4, $g1_e5, $g1_e6, $g1_e7, $g1_e8, $g1_e9, $g1_e10, $g1_e11, $g1_e12, $g1_e13, $g1_e14, $g1_e15, $g1_e16, $g1_e17 ),"limite"=>$lg1,"nombre"=>$ng1,"elementos"=>$eg1),
					 "g2"=>array("data"=> array($g2_e1, $g2_e2, $g2_e3, $g2_e4, $g2_e5, $g2_e6, $g2_e7, $g2_e8, $g2_e9, $g2_e10, $g2_e11, $g2_e12, $g2_e13, $g2_e14, $g2_e15, $g2_e16, $g2_e17 ),"limite"=>$lg2,"nombre"=>$ng2,"elementos"=>$eg2),
					 "g3"=>array("data"=> array($g3_e1, $g3_e2, $g3_e3, $g3_e4, $g3_e5, $g3_e6, $g3_e7, $g3_e8, $g3_e9, $g3_e10, $g3_e11, $g3_e12, $g3_e13, $g3_e14, $g3_e15, $g3_e16, $g3_e17 ),"limite"=>$lg3,"nombre"=>$ng3,"elementos"=>$eg3),
					 "g4"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8, $g4_e9, $g4_e10, $g4_e11, $g4_e12, $g4_e13, $g4_e14, $g4_e15, $g4_e16, $g4_e17 ),"limite"=>$lg4,"nombre"=>$ng4,"elementos"=>$eg4),
					 "g5"=>array("data"=> array($g4_e1, $g4_e2, $g4_e3, $g4_e4, $g4_e5, $g4_e6, $g4_e7, $g4_e8 ),"limite"=>$lg5,"nombre"=>$ng5,"elementos"=>$eg5),
					
					"semanas"=>$semanas
		);

		//return array("week"=>$weeks,"data"=>$data,"coment"=>$comentarios);
	}
	


	public function homeIsp1(){
	
		$anhos=anhos::all();
		return View::make('ispView/isp1', array("anhos"=>$anhos));
	}

	public function homeIsp2(){
	
		$anhos=anhos::all();
		return View::make('ispView/isp2', array("anhos"=>$anhos));
	}

	public function homeIsp3(){
	
		$anhos=anhos::all();
		return View::make('ispView/isp3', array("anhos"=>$anhos));
	}

	public function homeIsp4(){
	
		$anhos=anhos::all();
		return View::make('ispView/isp4', array("anhos"=>$anhos));
	}

	public function homeIsp5(){
	
		$anhos=anhos::all();
		return View::make('ispView/isp5', array("anhos"=>$anhos));
	}

	public function homeIsp6(){
	
		$anhos=anhos::all();
		return View::make('ispView/isp6', array("anhos"=>$anhos));
	}


	
	
}
