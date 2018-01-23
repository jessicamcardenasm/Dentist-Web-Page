<?php

class disasterController extends Controller {

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

	public function disaster(){
	
		
		return View::make('disasterView/disaster');
	}


	public function homedisaster(){
	
		
		return View::make('disasterView/homedisaster');
	}

	public function crearEvento(){
		$nombre_evento=$_POST['nombre_evento'];
		$descripcion_evento=$_POST['descripcion_evento'];
		$estado='Activo';
		$fecha_registro=$_POST['fecha_registro'];
		$fecha_inicio=$_POST['fecha_inicio'];
		$usuario=$_POST['usuario']; //usuario creador
		$nombre=$_POST['nombre']; //nombre del usuario creador

		DB::INSERT("INSERT INTO evento (nombre_evento, descripcion, estado, fecha_registro, fecha_inicio, usuario_creador, nombre_usuario_creador) values (?,?,?,?,?,?,?)",array($nombre_evento,$descripcion_evento,$estado,$fecha_registro,$fecha_inicio,$usuario,$nombre));

		$id_evento_obj=DB::SELECT("SELECT MAX(id_evento) as id_evento from evento;");

		foreach ($id_evento_obj as $var ) {
			$id_evento = $var->id_evento ;
		};

		$id_evento_ne_obj=DB::SELECT("SELECT id_ne from ne_evento;");

		foreach ($id_evento_ne_obj as $var) {
			$id_ne = $var->id_ne;

			DB::INSERT("INSERT INTO evento_detalle (id_evento,id_ne,estado_logico,estado_fisico) values (?,?,?,?)",array($id_evento,$id_ne,0,0));
		}

		echo "<script> location.href='http://127.0.0.1/Entel/public/index.php/HomeDisaster'; </script>";

	}

	public function getEventos(){

        $data=DB::select("SELECT * from evento ORDER BY id_evento DESC");
        return  array("data" => $data );


    }


    public function getEvento_id(){

        $data=DB::select("SELECT * from evento where id_evento=? ORDER BY id_evento DESC",array(Input::get("id_evento")));
        return  array("data" => $data );


    }

    public function getValorNuevo(){

        $data_ne=DB::select("SELECT id_ne from ne_evento where id_superv=? or id_superv=?",array(Input::get("id_superv1"),Input::get("id_superv2")));
        $cantidad_ne=count($data_ne)*2;

        $cantidad_revision_logica_obj_0=DB::select("SELECT estado_logico from evento_detalle a inner join ne_evento b on a.id_ne=b.id_ne where (b.id_superv=? or b.id_superv=?) and a.estado_logico=0 and a.id_evento=? ;",array(Input::get("id_superv1"),Input::get("id_superv2"),Input::get("id_evento")));
        $cantidad_revision_fisica_obj_0=DB::select("SELECT estado_fisico from evento_detalle a inner join ne_evento b on a.id_ne=b.id_ne where (b.id_superv=? or b.id_superv=?) and a.estado_fisico=0 and a.id_evento=? ;",array(Input::get("id_superv1"),Input::get("id_superv2"),Input::get("id_evento")));
        
        $cantidad_logica_0=count($cantidad_revision_logica_obj_0);
        $cantidad_fisica_0=count($cantidad_revision_fisica_obj_0);

        $total_tipo_0=$cantidad_logica_0+$cantidad_fisica_0;

        $valor_0=round(($total_tipo_0/$cantidad_ne)*100);


        $cantidad_revision_logica_obj_1=DB::select("SELECT estado_logico from evento_detalle a inner join ne_evento b on a.id_ne=b.id_ne where (b.id_superv=? or b.id_superv=?) and a.estado_logico=1 and a.id_evento=? ;",array(Input::get("id_superv1"),Input::get("id_superv2"),Input::get("id_evento")));
        $cantidad_revision_fisica_obj_1=DB::select("SELECT estado_fisico from evento_detalle a inner join ne_evento b on a.id_ne=b.id_ne where (b.id_superv=? or b.id_superv=?) and a.estado_fisico=1 and a.id_evento=? ;",array(Input::get("id_superv1"),Input::get("id_superv2"),Input::get("id_evento")));
        
        $cantidad_logica_1=count($cantidad_revision_logica_obj_1);
        $cantidad_fisica_1=count($cantidad_revision_fisica_obj_1);

        $total_tipo_1=$cantidad_logica_1+$cantidad_fisica_1;

        $valor_1=round(($total_tipo_1/$cantidad_ne)*100);


        $cantidad_revision_logica_obj_2=DB::select("SELECT estado_logico from evento_detalle a inner join ne_evento b on a.id_ne=b.id_ne where (b.id_superv=? or b.id_superv=?) and a.estado_logico=2 and a.id_evento=? ;",array(Input::get("id_superv1"),Input::get("id_superv2"),Input::get("id_evento")));
        $cantidad_revision_fisica_obj_2=DB::select("SELECT estado_fisico from evento_detalle a inner join ne_evento b on a.id_ne=b.id_ne where (b.id_superv=? or b.id_superv=?) and a.estado_fisico=2 and a.id_evento=? ;",array(Input::get("id_superv1"),Input::get("id_superv2"),Input::get("id_evento")));
        
        $cantidad_logica_2=count($cantidad_revision_logica_obj_2);
        $cantidad_fisica_2=count($cantidad_revision_fisica_obj_2);

        $total_tipo_2=$cantidad_logica_2+$cantidad_fisica_2;

        $valor_2=round(($total_tipo_2/$cantidad_ne)*100);

        return  array("pendiente" => $valor_0, "revision" => $valor_1, "ok" => $valor_2 );


    }


    public function getTitulos(){

        $jefatura_obj=DB::select(" SELECT distinct(jefatura) from supervisiones where idsupervisiones =?;",array(Input::get("id_superv1")));
        foreach ($jefatura_obj as $var) { $jefatura= $var->jefatura;};

        $superv1_obj=DB::select(" SELECT nombre from supervisiones where idsupervisiones=?",array(Input::get("id_superv1")));
        foreach ($superv1_obj as $var) { $superv1= $var->nombre;};

        $superv2_obj=DB::select(" SELECT nombre from supervisiones where idsupervisiones=?",array(Input::get("id_superv2")));
        foreach ($superv2_obj as $var) { $superv2= $var->nombre;};


        return  array("jefatura"=>$jefatura, "superv1"=>$superv1, "superv2"=>$superv2 );


    }


    public function getTabla_evento(){

        $data=DB::select(" SELECT * from evento_detalle a inner join ne_evento b on a.id_ne=b.id_ne where b.id_superv=? and a.id_evento=?;",array(Input::get("id_superv"),Input::get("id_evento")));
        
        return  array("data"=>$data);


    }


    public function postEstadoNuevo(){

    	$tipo=Input::get("tipo");

    	if ($tipo == 1) {
    		 DB::update(" UPDATE evento_detalle set estado_logico=?, usuario_revision_logica=?, correo_usuario_revision_logica=? where id_evento_detalle=?;",array(Input::get("estado"),Input::get("nombre"),Input::get("correo"),Input::get("id_evento_detalle")));
    	} else {

    		DB::update(" UPDATE evento_detalle set estado_fisico=?, usuario_revision_fisica=?, correo_usuario_revision_fisica=? where id_evento_detalle=?;",array(Input::get("estado"),Input::get("nombre"),Input::get("correo"),Input::get("id_evento_detalle")));
    	}

       
        
       
    }


    public function postObservacion(){
		$id_evento=$_GET['id_evento'];
		$observacion_logica=$_GET['observacion_logica'];
		$observacion_fisica=$_GET['observacion_fisica'];
		

		DB::UPDATE(" UPDATE evento_detalle set observacion_revision_logica=?, observacion_revision_fisica=? where id_evento_detalle=?",array($observacion_logica,$observacion_fisica,$id_evento));
		
		//alert($id_evento.','.$observacion_logica.','.$observacion_fisica);	
	}

	public function getObservacion(){
		$id_evento=$_GET['id_evento'];
		

		$data=DB::select(" SELECT  observacion_revision_logica, observacion_revision_fisica FROM evento_detalle where id_evento_detalle=?",array($id_evento));
		
		//alert($id_evento.','.$observacion_logica.','.$observacion_fisica);	

		return array("data"=>$data);
	}

	public function actualizarDetalle(){
		$nombre_evento=$_GET['nombre_evento'];
    	$descripcion=$_GET['descripcion'];
    	$fecha_inicio=$_GET['fecha_inicio'];
    	$id_evento=$_GET['id_evento'];
		

		DB::UPDATE(" UPDATE evento set nombre_evento=?, descripcion=?, fecha_inicio=? where id_evento=?",array($nombre_evento,$descripcion,$fecha_inicio,$id_evento));
		
		//alert($id_evento.','.$observacion_logica.','.$observacion_fisica);	
	}

	public function cerrarEvento(){
		$id_evento=Input::get("id_evento");
		$fecha_fin=date('Y-m-d H:i:s',strtotime('-5 hour', strtotime(date('Y-m-d H:i:s',time()))));

		$ne_evento_obj=DB::select("SELECT estado_logico, estado_fisico from evento_detalle where id_evento=?", array($id_evento));

		$cont1=count($ne_evento_obj);
		$cont2=0;
		foreach ($ne_evento_obj as $var) {
			
			if ($var->estado_logico == 2 && $var->estado_fisico == 2) {
				$cont2++;
			}

		}

		if ($cont2 == $cont1) {
			DB::update("UPDATE evento set estado='Cerrado', fecha_fin=? where id_evento=?",array($fecha_fin,$id_evento));
			$respuesta="El evento fue cerrado correctamente";
		}else{
			$respuesta="El evento no puede ser cerrado debido a que todas las revisiones no han sido completadas";
		}
		return $respuesta;

	}
	
	
	
}
