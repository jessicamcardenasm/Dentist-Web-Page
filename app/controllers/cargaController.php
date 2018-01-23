<?php

require_once 'Excel/reader.php';
session_start ();
class cargaController extends Controller {

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


   


    public function datosDatos(){

        $user=$_SESSION['usuario'];
        $anhos=anhos::all();
        //echo $user;
        $obj_tec=DB::SELECT("SELECT s.nombre, p.ruta, p.nombre as nombre_p, s.idsupervisiones from supervisiones s inner join superv_equipo e on s.idsupervisiones=e.id_superv inner join plantillas p on p.id_superv=e.id_superv where e.usuario=?;",array($user));
        $cantidad=count($obj_tec);
        if ($cantidad==1) {
            foreach ($obj_tec as $superv) {$nombre = $superv->nombre; $ruta= $superv->ruta; $nombre_p= $superv->nombre_p; $id_tec= $superv->idsupervisiones;};
        }

        //Devuelve el nombre de la supervision, nombre_p de la plantilla, ruta de la plantilla, id_tec de la supervision, y la lista de aÃ±os disponibles en la bd
        return View::make('cargaView/ddatos',array("nombre"=>$nombre,"ruta"=>$ruta,"nombre_p"=>$nombre_p, "id_tec"=>$id_tec),array("anhos"=>$anhos));
    }

    
    public function actualizarDocumentoView(){
        return View::make('cargaView/actualizar_documento');

    }


    public function getDocumentos(){

        $documentos=DB::select("SELECT * from documentos where id_superv=? ORDER BY id DESC",array(Input::get("idSup")));
        return  array("data" => $documentos );


    }

    public function postEliminar(){

        
        $semana=(Input::get("semana"));
        $id_documento=(Input::get("id_documento"));
        $id_superv=(Input::get("id_superv"));
        //$ip=(Input::get("ip"));
        $obj_documento=DB::SELECT("SELECT d.nombre from documentos d where d.id=?",array($id_documento));

        if (count($obj_documento) == 1) {
            foreach ($obj_documento as $doc) {
                $nombre_documento = $doc->nombre;
                
            };
        }

        //echo $nombre_documento;
        //echo $ruta_documento;
        //echo $ip;

        //borrando archivo del directorio

        switch ($id_superv) {
                case 3: $target_path = "documentos/datos/".$nombre_documento;
                break;

                case 5: $target_path = "documentos/vas/".$nombre_documento;
                break;
                
                case 4: $target_path = "documentos/datacomm/".$nombre_documento;
                break;

                case 6: $target_path = "documentos/prepago/".$nombre_documento;
                break;  

                case 2: $target_path = "documentos/ran/".$nombre_documento;
                break;

                case 8: $target_path = "documentos/isp/".$nombre_documento;
                break; 

                case 7: $target_path = "documentos/transporte/".$nombre_documento;
                break;                    

                default:
                # code...
                break;
            }




        
        unlink($target_path);
        //borrando archivo de la bd
        DB::DELETE("DELETE FROM documentos where id=?",array($id_documento));
        //borrando datos de la bd - tabla producto
        DB::DELETE("DELETE FROM producto where idsupervisiones=? and semana=?",array($id_superv,$semana));
        //borrando registro de la tabla semana_supervision 
        //DB::DELETE("DELETE FROM semana_superv where id_suprv=? and anho_semana=?",array($id_superv,$semana));


        //Datos para el log
            
            $id_tec=$id_superv;
            $usuario=$_SESSION['usuario'];
            $fecha_registro=date("Y-m-d H:i:s");
            $accion="DELETE";
            $descripcion='Eliminacion de datos, archivo:'.$nombre_documento;
            DB::INSERT("INSERT INTO logs (fecha,usuario,id_supervision,accion,descripcion) values (?,?,?,?,?)",array($fecha_registro,$usuario,$id_tec,$accion,$descripcion));


        $respuesta="Los datos fueron eliminados correctamente, semana: ".$semana;

        return $respuesta;

    }

    public function postData(){

        $respuesta="";
        if (isset($_POST['submit']) && !empty($_FILES['sel_file']['tmp_name'])) {

            // Se verifica que sea un xls, versiÃ³n de excel hasta el 2003 y se comprueba el nombre del archivo

            $fname = $_FILES['sel_file']['name'];
            $chk = explode("_", $fname);

            //Datos para el log
            
            $id_tec=$_POST['id_tec'];
            $usuario=$_SESSION['usuario'];
            $fecha_registro=date("Y-m-d H:i:s");
            $accion='INSERT';
            $descripcion='Ingreso de nuevos datos, archivo:'.basename($fname);

            switch ($id_tec) {
                case 3:

                    if (strtolower($chk[0]) == "datos") {
                        $respuesta=$this->postdatos();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: datos_YYYY_SS.xls";
                    }
                        
                break;

                case 5:

                    if (strtolower($chk[0]) == "vas") {
                        $respuesta=$this->postvas();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: vas_YYYY_SS.xls";
                    }
                        
                break;

                case 4:

                    if (strtolower($chk[0]) == "datacomm") {
                        $respuesta=$this->postdatacomm();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: datacomm_YYYY_SS.xls";
                    }
                        
                break;

                case 6:

                    if (strtolower($chk[0]) == "prepago") {
                        $respuesta=$this->postprepago();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: prepago_YYYY_SS.xls";
                    }
                        
                break;

                case 2:

                    if (strtolower($chk[0]) == "ran") {
                        $respuesta=$this->postran();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: ran_YYYY_SS.xls";
                    }
                        
                break;

                 case 8:

                    if (strtolower($chk[0]) == "isp") {
                        $respuesta=$this->postisp();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: isp_YYYY_SS.xls";
                    }
                        
                break;

                 case 7:

                    if (strtolower($chk[0]) == "transporte") {
                        $respuesta=$this->posttransporte();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: transporte_YYYY_SS.xls";
                    }
                        
                break;
                    
                default:
                # code...
                break;
            }

            
        }
        else{$respuesta="No existe archivo adjunto";}

        DB::INSERT("INSERT INTO logs (fecha,usuario,id_supervision,accion,descripcion) values (?,?,?,?,?)",array($fecha_registro,$usuario,$id_tec,$accion,$descripcion));


        echo '<script >alert("'.$respuesta.'");</script>'; 
        echo "<script> location.href='http://127.0.0.1/Entel/public/index.php/DatosDatos'; </script>";
   }

   public function postDataActualizar(){

        $respuesta="";
        

            // Se verifica que sea un xls, versiÃ³n de excel hasta el 2003 y se comprueba el nombre del archivo

            $fname = $_FILES['sel_file']['name'];
            $chk = explode("_", $fname);
           
            $id_tec=$_POST['id_tec'];
            $anho=$_POST['anhosc'];
            $semana=$_POST['semanac'];

            switch ($id_tec) {
                case 3:

                    if (strtolower($chk[0]) == "datos") {
                       $respuesta=$this->postdatos();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: datos_YYYY_SS.xls";
                    }
                        
                break;

                case 5:

                    if (strtolower($chk[0]) == "vas") {
                       $respuesta=$this->postvas();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: vas_YYYY_SS.xls";
                    }
                        
                break;

                case 4:

                    if (strtolower($chk[0]) == "datacomm") {
                       $respuesta=$this->postdatacomm();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: datacomm_YYYY_SS.xls";
                    }
                        
                break;

                case 6:

                    if (strtolower($chk[0]) == "prepago") {
                       $respuesta=$this->postprepago();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: prepago_YYYY_SS.xls";
                    }
                        
                break;

                case 2:

                    if (strtolower($chk[0]) == "ran") {
                       $respuesta=$this->postran();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: ran_YYYY_SS.xls";
                    }
                        
                break;

                case 8:

                    if (strtolower($chk[0]) == "isp") {
                       $respuesta=$this->postisp();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: isp_YYYY_SS.xls";
                    }
                        
                break;

                case 7:

                    if (strtolower($chk[0]) == "transporte") {
                       $respuesta=$this->posttransporte();
                    } else {
                        $respuesta="Ningun archivo seleccionado o el archivo es incorrecto. El archivo debe tener el siguiente formato: transporte_YYYY_SS.xls";
                    }
                        
                break;
                    
                default:
                # code...
                break;
            }

            
       
        //Datos para el log
            
            
            $usuario=$_SESSION['usuario'];
            $fecha_registro=date("Y-m-d H:i:s");
            $accion="UPDATE";
            $descripcion='Actualizacion de datos, archivo:'.basename($fname);
            DB::INSERT("INSERT INTO logs (fecha,usuario,id_supervision,accion,descripcion) values (?,?,?,?,?)",array($fecha_registro,$usuario,$id_tec,$accion,$descripcion));




        echo '<script >alert("'.$respuesta.'");</script>'; 
        echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
        //echo "<script> location.href='http://localhost/Entel/public/index.php/actualizarDocumentoView'; </script>";
   
    }
    
    public function postdatos(){
            

            $filename = $_FILES['sel_file']['tmp_name'];
            $fname = $_FILES['sel_file']['name'];

            $data = new Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('CP1251');
            $data->read($filename);
            
            // semana y anÃ±o del excel
            $week=$data->sheets[0]['cells'][1][4];

            if (strlen($week) == 1) {
                $week="0".$week;
            }

            $year=$data->sheets[0]['cells'][1][6];
            $anho_semana=$year."".$week;
            //
            //echo "anho_semana del excel".$anho_semana;

            $week2=$_POST['semanac']; // semana concatenada
            $year2=$_POST['anhosc']; // aÃ±o solito del select
            //echo "wee2 ".$week2;
            
            $chk2 = explode("_", $fname);  
            $chk3 = end($chk2);
            $chk4 = explode(".", $chk3);
            // aÃ±o y semana concatenados, la semana es la que aparece en el nombre del archivo
            $week3= $year2."".$chk4[0];         

            if ($anho_semana == $week2 && $week2 == $week3 ) {
                # code...
            

            $semana=$week2;
            //echo $semana;
            $id_supervision=$_POST['id_tec'];

            //echo $id_supervision;
            
           
            try {

            //DB::INSERT("INSERT INTO semana_superv (id_suprv,anho,semana,anho_semana) values (?,?,?,?);",array( $id_supervision,$year2,$week,$anho_semana));
            
           

            $target_path = "documentos/datos/";
            $target_path = $target_path . basename( $_FILES['sel_file']['name']); 
            $target_path_2 = "../".$target_path;
            $fecha_registro=date("Y-m-d H:i:s");
            if(move_uploaded_file($_FILES['sel_file']['tmp_name'], $target_path)) { 
                //echo "El archivo ". basename( $_FILES['sel_file']['name']). " ha sido subido";

                DB::INSERT("INSERT INTO documentos (id_superv,nombre,ruta,fecha_registro,usuario,semana) values (?,?,?,?,?,?)",array($id_supervision,basename( $_FILES['sel_file']['name']),$target_path_2,$fecha_registro,$_SESSION['usuario'],$anho_semana));              

                $respuesta =  "Datos cargados a la BD, archivo: ".$fname.", Datos" ;
            } else{
                $respuesta= "Ha ocurrido un error, trate de nuevo!";
            }

             

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,59,135,$semana,$data->sheets[0]['cells'][6][2],$data->sheets[0]['cells'][6][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,59,136,$semana,$data->sheets[0]['cells'][7][2],$data->sheets[0]['cells'][7][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,60,135,$semana,$data->sheets[0]['cells'][9][2],$data->sheets[0]['cells'][9][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,60,136,$semana,$data->sheets[0]['cells'][10][2],$data->sheets[0]['cells'][10][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,61,135,$semana,$data->sheets[0]['cells'][12][2],$data->sheets[0]['cells'][12][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,61,136,$semana,$data->sheets[0]['cells'][13][2],$data->sheets[0]['cells'][13][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,62,135,$semana,$data->sheets[0]['cells'][16][2],$data->sheets[0]['cells'][16][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,62,136,$semana,$data->sheets[0]['cells'][17][2],$data->sheets[0]['cells'][17][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,63,135,$semana,$data->sheets[0]['cells'][19][2],$data->sheets[0]['cells'][19][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,63,136,$semana,$data->sheets[0]['cells'][20][2],$data->sheets[0]['cells'][20][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,64,135,$semana,$data->sheets[0]['cells'][22][2],$data->sheets[0]['cells'][22][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,64,136,$semana,$data->sheets[0]['cells'][23][2],$data->sheets[0]['cells'][23][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,65,138,$semana,$data->sheets[0]['cells'][25][2],$data->sheets[0]['cells'][25][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,65,137,$semana,$data->sheets[0]['cells'][26][2],$data->sheets[0]['cells'][26][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,66,138,$semana,$data->sheets[0]['cells'][28][2],$data->sheets[0]['cells'][28][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,66,137,$semana,$data->sheets[0]['cells'][29][2],$data->sheets[0]['cells'][29][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,67,138,$semana,$data->sheets[0]['cells'][32][2],$data->sheets[0]['cells'][32][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,67,137,$semana,$data->sheets[0]['cells'][33][2],$data->sheets[0]['cells'][33][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,68,138,$semana,$data->sheets[0]['cells'][35][2],$data->sheets[0]['cells'][35][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,68,137,$semana,$data->sheets[0]['cells'][36][2],$data->sheets[0]['cells'][36][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,69,135,$semana,$data->sheets[0]['cells'][39][2],$data->sheets[0]['cells'][39][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,69,136,$semana,$data->sheets[0]['cells'][40][2],$data->sheets[0]['cells'][40][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,69,138,$semana,$data->sheets[0]['cells'][41][2],$data->sheets[0]['cells'][41][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,69,137,$semana,$data->sheets[0]['cells'][42][2],$data->sheets[0]['cells'][42][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,69,139,$semana,$data->sheets[0]['cells'][43][2],$data->sheets[0]['cells'][43][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,69,140,$semana,$data->sheets[0]['cells'][44][2],$data->sheets[0]['cells'][44][4]));
        
                      

            }catch(Exception $e)

            {
                $respuesta= $e;
            };

            } else {$respuesta =  "La semana seleccionada no coincide con la semana en el archivo o la semana en el nombre del archivo" ;};

            return $respuesta;


            //echo '<script language="javascript">alert("'.$respuesta.'");</script>'; 
            //echo "<script> location.href='http://10.30.17.62:80/Entel/public/index.php/DatosDatos'; </script>";

    }

    public function postvas(){
            

            $filename = $_FILES['sel_file']['tmp_name'];
            $fname = $_FILES['sel_file']['name'];

            $data = new Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('CP1251');
            $data->read($filename);
            
            // semana y anÃ±o del excel
            $week=$data->sheets[0]['cells'][1][4];

            if (strlen($week) == 1) {
                $week="0".$week;
            }

            $year=$data->sheets[0]['cells'][1][6];
            $anho_semana=$year."".$week;
            //
            //echo "anho_semana del excel".$anho_semana;

            $week2=$_POST['semanac']; // semana concatenada
            $year2=$_POST['anhosc']; // aÃ±o solito del select
            //echo "wee2 ".$week2;
            
            $chk2 = explode("_", $fname);  
            $chk3 = end($chk2);
            $chk4 = explode(".", $chk3);
            // aÃ±o y semana concatenados, la semana es la que aparece en el nombre del archivo
            $week3= $year2."".$chk4[0];         

            if ($anho_semana == $week2 && $week2 == $week3 ) {
                # code...
            

            $semana=$week2;
            //echo $semana;
            $id_supervision=$_POST['id_tec'];

            //echo $id_supervision;
            
           
            try {

            //DB::INSERT("INSERT INTO semana_superv (id_suprv,anho,semana,anho_semana) values (?,?,?,?);",array( $id_supervision,$year2,$week,$anho_semana));
            
           

            $target_path = "documentos/vas/";
            $target_path = $target_path . basename( $_FILES['sel_file']['name']); 
            $target_path_2 = "../".$target_path;
            $fecha_registro=date("Y-m-d H:i:s");
            if(move_uploaded_file($_FILES['sel_file']['tmp_name'], $target_path)) { 
               //echo "El archivo ". basename( $_FILES['sel_file']['name']). " ha sido subido";

                DB::INSERT("INSERT INTO documentos (id_superv,nombre,ruta,fecha_registro,usuario,semana) values (?,?,?,?,?,?)",array($id_supervision,basename( $_FILES['sel_file']['name']),$target_path_2,$fecha_registro,$_SESSION['usuario'],$anho_semana));              

                $respuesta =  "Datos cargados a la BD, archivo: ".$fname.", VAS" ;
            } else{
                $respuesta= "Ha ocurrido un error, trate de nuevo!";
            }

             

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,82,199,$semana,$data->sheets[0]['cells'][6][2],$data->sheets[0]['cells'][6][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,82,200,$semana,$data->sheets[0]['cells'][7][2],$data->sheets[0]['cells'][7][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,82,201,$semana,$data->sheets[0]['cells'][8][2],$data->sheets[0]['cells'][8][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,82,202,$semana,$data->sheets[0]['cells'][9][2],$data->sheets[0]['cells'][9][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,82,203,$semana,$data->sheets[0]['cells'][10][2],$data->sheets[0]['cells'][10][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,82,204,$semana,$data->sheets[0]['cells'][11][2],$data->sheets[0]['cells'][11][4]));
          
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,83,199,$semana,$data->sheets[0]['cells'][13][2],$data->sheets[0]['cells'][13][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,83,200,$semana,$data->sheets[0]['cells'][14][2],$data->sheets[0]['cells'][14][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,83,201,$semana,$data->sheets[0]['cells'][15][2],$data->sheets[0]['cells'][15][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,83,202,$semana,$data->sheets[0]['cells'][16][2],$data->sheets[0]['cells'][16][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,83,203,$semana,$data->sheets[0]['cells'][17][2],$data->sheets[0]['cells'][17][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,83,204,$semana,$data->sheets[0]['cells'][18][2],$data->sheets[0]['cells'][18][4]));
          
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,84,199,$semana,$data->sheets[0]['cells'][20][2],$data->sheets[0]['cells'][20][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,84,200,$semana,$data->sheets[0]['cells'][21][2],$data->sheets[0]['cells'][21][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,84,201,$semana,$data->sheets[0]['cells'][22][2],$data->sheets[0]['cells'][22][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,84,202,$semana,$data->sheets[0]['cells'][23][2],$data->sheets[0]['cells'][23][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,84,203,$semana,$data->sheets[0]['cells'][24][2],$data->sheets[0]['cells'][24][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,84,204,$semana,$data->sheets[0]['cells'][25][2],$data->sheets[0]['cells'][25][4]));
          
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,85,205,$semana,$data->sheets[0]['cells'][27][2],$data->sheets[0]['cells'][27][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,86,206,$semana,$data->sheets[0]['cells'][30][2],$data->sheets[0]['cells'][30][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,86,207,$semana,$data->sheets[0]['cells'][31][2],$data->sheets[0]['cells'][31][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,86,208,$semana,$data->sheets[0]['cells'][32][2],$data->sheets[0]['cells'][32][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,86,209,$semana,$data->sheets[0]['cells'][33][2],$data->sheets[0]['cells'][33][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,87,206,$semana,$data->sheets[0]['cells'][35][2],$data->sheets[0]['cells'][35][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,87,207,$semana,$data->sheets[0]['cells'][36][2],$data->sheets[0]['cells'][36][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,87,208,$semana,$data->sheets[0]['cells'][37][2],$data->sheets[0]['cells'][37][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,87,209,$semana,$data->sheets[0]['cells'][38][2],$data->sheets[0]['cells'][38][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,88,206,$semana,$data->sheets[0]['cells'][40][2],$data->sheets[0]['cells'][40][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,88,207,$semana,$data->sheets[0]['cells'][41][2],$data->sheets[0]['cells'][41][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,88,208,$semana,$data->sheets[0]['cells'][42][2],$data->sheets[0]['cells'][42][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,88,209,$semana,$data->sheets[0]['cells'][43][2],$data->sheets[0]['cells'][43][4]));
          
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,89,210,$semana,$data->sheets[0]['cells'][45][2],$data->sheets[0]['cells'][45][4]));
          
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,90,211,$semana,$data->sheets[0]['cells'][48][2],$data->sheets[0]['cells'][48][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,90,212,$semana,$data->sheets[0]['cells'][49][2],$data->sheets[0]['cells'][49][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,90,213,$semana,$data->sheets[0]['cells'][50][2],$data->sheets[0]['cells'][50][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,90,214,$semana,$data->sheets[0]['cells'][51][2],$data->sheets[0]['cells'][51][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,90,215,$semana,$data->sheets[0]['cells'][52][2],$data->sheets[0]['cells'][52][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,90,216,$semana,$data->sheets[0]['cells'][53][2],$data->sheets[0]['cells'][53][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,90,217,$semana,$data->sheets[0]['cells'][54][2],$data->sheets[0]['cells'][54][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,90,218,$semana,$data->sheets[0]['cells'][55][2],$data->sheets[0]['cells'][55][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,90,219,$semana,$data->sheets[0]['cells'][56][2],$data->sheets[0]['cells'][56][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,91,211,$semana,$data->sheets[0]['cells'][58][2],$data->sheets[0]['cells'][58][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,91,212,$semana,$data->sheets[0]['cells'][59][2],$data->sheets[0]['cells'][59][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,91,213,$semana,$data->sheets[0]['cells'][60][2],$data->sheets[0]['cells'][60][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,91,214,$semana,$data->sheets[0]['cells'][61][2],$data->sheets[0]['cells'][61][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,91,215,$semana,$data->sheets[0]['cells'][62][2],$data->sheets[0]['cells'][62][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,91,216,$semana,$data->sheets[0]['cells'][63][2],$data->sheets[0]['cells'][63][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,91,217,$semana,$data->sheets[0]['cells'][64][2],$data->sheets[0]['cells'][64][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,91,218,$semana,$data->sheets[0]['cells'][65][2],$data->sheets[0]['cells'][65][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,91,219,$semana,$data->sheets[0]['cells'][66][2],$data->sheets[0]['cells'][66][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,92,211,$semana,$data->sheets[0]['cells'][68][2],$data->sheets[0]['cells'][68][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,92,212,$semana,$data->sheets[0]['cells'][69][2],$data->sheets[0]['cells'][69][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,92,213,$semana,$data->sheets[0]['cells'][70][2],$data->sheets[0]['cells'][70][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,92,214,$semana,$data->sheets[0]['cells'][71][2],$data->sheets[0]['cells'][71][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,92,215,$semana,$data->sheets[0]['cells'][72][2],$data->sheets[0]['cells'][72][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,92,216,$semana,$data->sheets[0]['cells'][73][2],$data->sheets[0]['cells'][73][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,92,217,$semana,$data->sheets[0]['cells'][74][2],$data->sheets[0]['cells'][74][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,92,218,$semana,$data->sheets[0]['cells'][75][2],$data->sheets[0]['cells'][75][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,92,219,$semana,$data->sheets[0]['cells'][76][2],$data->sheets[0]['cells'][76][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,93,220,$semana,$data->sheets[0]['cells'][78][2],$data->sheets[0]['cells'][78][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,93,221,$semana,$data->sheets[0]['cells'][79][2],$data->sheets[0]['cells'][79][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,93,222,$semana,$data->sheets[0]['cells'][80][2],$data->sheets[0]['cells'][80][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,94,223,$semana,$data->sheets[0]['cells'][83][2],$data->sheets[0]['cells'][83][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,94,224,$semana,$data->sheets[0]['cells'][84][2],$data->sheets[0]['cells'][84][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,94,225,$semana,$data->sheets[0]['cells'][85][2],$data->sheets[0]['cells'][85][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,94,226,$semana,$data->sheets[0]['cells'][86][2],$data->sheets[0]['cells'][86][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,94,227,$semana,$data->sheets[0]['cells'][87][2],$data->sheets[0]['cells'][87][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,94,228,$semana,$data->sheets[0]['cells'][88][2],$data->sheets[0]['cells'][88][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,94,229,$semana,$data->sheets[0]['cells'][89][2],$data->sheets[0]['cells'][89][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,95,223,$semana,$data->sheets[0]['cells'][91][2],$data->sheets[0]['cells'][91][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,95,224,$semana,$data->sheets[0]['cells'][92][2],$data->sheets[0]['cells'][92][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,95,225,$semana,$data->sheets[0]['cells'][93][2],$data->sheets[0]['cells'][93][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,95,226,$semana,$data->sheets[0]['cells'][94][2],$data->sheets[0]['cells'][94][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,95,227,$semana,$data->sheets[0]['cells'][95][2],$data->sheets[0]['cells'][95][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,95,228,$semana,$data->sheets[0]['cells'][96][2],$data->sheets[0]['cells'][96][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,95,229,$semana,$data->sheets[0]['cells'][97][2],$data->sheets[0]['cells'][97][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,96,223,$semana,$data->sheets[0]['cells'][99][2],$data->sheets[0]['cells'][99][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,96,224,$semana,$data->sheets[0]['cells'][100][2],$data->sheets[0]['cells'][100][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,96,225,$semana,$data->sheets[0]['cells'][101][2],$data->sheets[0]['cells'][101][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,96,226,$semana,$data->sheets[0]['cells'][102][2],$data->sheets[0]['cells'][102][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,96,227,$semana,$data->sheets[0]['cells'][103][2],$data->sheets[0]['cells'][103][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,96,228,$semana,$data->sheets[0]['cells'][104][2],$data->sheets[0]['cells'][104][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,96,229,$semana,$data->sheets[0]['cells'][105][2],$data->sheets[0]['cells'][105][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,97,230,$semana,$data->sheets[0]['cells'][107][2],$data->sheets[0]['cells'][107][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,97,231,$semana,$data->sheets[0]['cells'][108][2],$data->sheets[0]['cells'][108][4]));
           


            }catch(Exception $e)

            {
                $respuesta= $e;
            };

            } else {$respuesta =  "La semana seleccionada no coincide con la semana en el archivo o la semana en el nombre del archivo" ;};

            return $respuesta;


           // echo '<script language="javascript">alert("'.$respuesta.'");</script>'; 
            //echo "<script> location.href='http://10.30.17.62:80/Entel/public/index.php/DatosDatos'; </script>";

    }

    public function postdatacomm(){
            

            $filename = $_FILES['sel_file']['tmp_name'];
            $fname = $_FILES['sel_file']['name'];

            $data = new Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('CP1251');
            $data->read($filename);
            
            // semana y anÃ±o del excel
            $week=$data->sheets[0]['cells'][1][4];

            if (strlen($week) == 1) {
                $week="0".$week;
            }

            $year=$data->sheets[0]['cells'][1][6];
            $anho_semana=$year."".$week;
            //
            //echo "anho_semana del excel".$anho_semana;

            $week2=$_POST['semanac']; // semana concatenada
            $year2=$_POST['anhosc']; // aÃ±o solito del select
            //echo "wee2 ".$week2;
            
            $chk2 = explode("_", $fname);  
            $chk3 = end($chk2);
            $chk4 = explode(".", $chk3);
            // aÃ±o y semana concatenados, la semana es la que aparece en el nombre del archivo
            $week3= $year2."".$chk4[0];         

            if ($anho_semana == $week2 && $week2 == $week3 ) {
                # code...
            

            $semana=$week2;
            //echo $semana;
            $id_supervision=$_POST['id_tec'];

            //echo $id_supervision;
            
           
            try {

            //DB::INSERT("INSERT INTO semana_superv (id_suprv,anho,semana,anho_semana) values (?,?,?,?);",array( $id_supervision,$year2,$week,$anho_semana));
            
           

            $target_path = "documentos/datacomm/";
            $target_path = $target_path . basename( $_FILES['sel_file']['name']); 
            $target_path_2 = "../".$target_path;
            $fecha_registro=date("Y-m-d H:i:s");
            if(move_uploaded_file($_FILES['sel_file']['tmp_name'], $target_path)) { 
                //echo "El archivo ". basename( $_FILES['sel_file']['name']). " ha sido subido";

                DB::INSERT("INSERT INTO documentos (id_superv,nombre,ruta,fecha_registro,usuario,semana) values (?,?,?,?,?,?)",array($id_supervision,basename( $_FILES['sel_file']['name']),$target_path_2,$fecha_registro,$_SESSION['usuario'],$anho_semana));              

                $respuesta =  "Datos cargados a la BD, archivo: ".$fname.", Datacomm" ;
            } else{
                $respuesta= "Ha ocurrido un error, trate de nuevo!";
            }

             

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,70,141,$semana,$data->sheets[0]['cells'][6][2],$data->sheets[0]['cells'][6][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,70,142,$semana,$data->sheets[0]['cells'][7][2],$data->sheets[0]['cells'][7][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,70,143,$semana,$data->sheets[0]['cells'][8][2],$data->sheets[0]['cells'][8][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,70,144,$semana,$data->sheets[0]['cells'][9][2],$data->sheets[0]['cells'][9][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,71,145,$semana,$data->sheets[0]['cells'][11][2],$data->sheets[0]['cells'][11][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,71,146,$semana,$data->sheets[0]['cells'][12][2],$data->sheets[0]['cells'][12][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,71,147,$semana,$data->sheets[0]['cells'][13][2],$data->sheets[0]['cells'][13][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,71,148,$semana,$data->sheets[0]['cells'][14][2],$data->sheets[0]['cells'][14][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,71,149,$semana,$data->sheets[0]['cells'][15][2],$data->sheets[0]['cells'][15][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,71,150,$semana,$data->sheets[0]['cells'][16][2],$data->sheets[0]['cells'][16][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,71,151,$semana,$data->sheets[0]['cells'][17][2],$data->sheets[0]['cells'][17][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,71,152,$semana,$data->sheets[0]['cells'][18][2],$data->sheets[0]['cells'][18][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,153,$semana,$data->sheets[0]['cells'][20][2],$data->sheets[0]['cells'][20][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,154,$semana,$data->sheets[0]['cells'][21][2],$data->sheets[0]['cells'][21][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,155,$semana,$data->sheets[0]['cells'][22][2],$data->sheets[0]['cells'][22][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,156,$semana,$data->sheets[0]['cells'][23][2],$data->sheets[0]['cells'][23][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,504,$semana,$data->sheets[0]['cells'][24][2],$data->sheets[0]['cells'][24][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,505,$semana,$data->sheets[0]['cells'][25][2],$data->sheets[0]['cells'][25][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,506,$semana,$data->sheets[0]['cells'][26][2],$data->sheets[0]['cells'][26][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,507,$semana,$data->sheets[0]['cells'][27][2],$data->sheets[0]['cells'][27][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,508,$semana,$data->sheets[0]['cells'][28][2],$data->sheets[0]['cells'][28][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,509,$semana,$data->sheets[0]['cells'][29][2],$data->sheets[0]['cells'][29][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,510,$semana,$data->sheets[0]['cells'][30][2],$data->sheets[0]['cells'][30][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,511,$semana,$data->sheets[0]['cells'][31][2],$data->sheets[0]['cells'][31][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,512,$semana,$data->sheets[0]['cells'][32][2],$data->sheets[0]['cells'][32][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,513,$semana,$data->sheets[0]['cells'][33][2],$data->sheets[0]['cells'][33][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,946,$semana,$data->sheets[0]['cells'][34][2],$data->sheets[0]['cells'][34][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,72,947,$semana,$data->sheets[0]['cells'][35][2],$data->sheets[0]['cells'][35][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,73,141,$semana,$data->sheets[0]['cells'][38][2],$data->sheets[0]['cells'][38][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,73,142,$semana,$data->sheets[0]['cells'][39][2],$data->sheets[0]['cells'][39][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,73,143,$semana,$data->sheets[0]['cells'][40][2],$data->sheets[0]['cells'][40][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,73,144,$semana,$data->sheets[0]['cells'][41][2],$data->sheets[0]['cells'][41][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,74,145,$semana,$data->sheets[0]['cells'][43][2],$data->sheets[0]['cells'][43][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,74,146,$semana,$data->sheets[0]['cells'][44][2],$data->sheets[0]['cells'][44][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,74,147,$semana,$data->sheets[0]['cells'][45][2],$data->sheets[0]['cells'][45][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,74,148,$semana,$data->sheets[0]['cells'][46][2],$data->sheets[0]['cells'][46][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,74,149,$semana,$data->sheets[0]['cells'][47][2],$data->sheets[0]['cells'][47][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,74,150,$semana,$data->sheets[0]['cells'][48][2],$data->sheets[0]['cells'][48][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,74,151,$semana,$data->sheets[0]['cells'][49][2],$data->sheets[0]['cells'][49][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,74,152,$semana,$data->sheets[0]['cells'][50][2],$data->sheets[0]['cells'][50][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,153,$semana,$data->sheets[0]['cells'][52][2],$data->sheets[0]['cells'][52][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,154,$semana,$data->sheets[0]['cells'][53][2],$data->sheets[0]['cells'][53][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,155,$semana,$data->sheets[0]['cells'][54][2],$data->sheets[0]['cells'][54][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,156,$semana,$data->sheets[0]['cells'][55][2],$data->sheets[0]['cells'][55][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,504,$semana,$data->sheets[0]['cells'][56][2],$data->sheets[0]['cells'][56][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,505,$semana,$data->sheets[0]['cells'][57][2],$data->sheets[0]['cells'][57][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,506,$semana,$data->sheets[0]['cells'][58][2],$data->sheets[0]['cells'][58][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,507,$semana,$data->sheets[0]['cells'][59][2],$data->sheets[0]['cells'][59][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,508,$semana,$data->sheets[0]['cells'][60][2],$data->sheets[0]['cells'][60][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,509,$semana,$data->sheets[0]['cells'][61][2],$data->sheets[0]['cells'][61][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,510,$semana,$data->sheets[0]['cells'][62][2],$data->sheets[0]['cells'][62][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,511,$semana,$data->sheets[0]['cells'][63][2],$data->sheets[0]['cells'][63][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,512,$semana,$data->sheets[0]['cells'][64][2],$data->sheets[0]['cells'][64][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,513,$semana,$data->sheets[0]['cells'][65][2],$data->sheets[0]['cells'][65][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,946,$semana,$data->sheets[0]['cells'][66][2],$data->sheets[0]['cells'][66][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,75,947,$semana,$data->sheets[0]['cells'][67][2],$data->sheets[0]['cells'][67][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,76,157,$semana,$data->sheets[0]['cells'][70][2],$data->sheets[0]['cells'][70][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,76,158,$semana,$data->sheets[0]['cells'][71][2],$data->sheets[0]['cells'][71][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,76,159,$semana,$data->sheets[0]['cells'][72][2],$data->sheets[0]['cells'][72][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,76,160,$semana,$data->sheets[0]['cells'][73][2],$data->sheets[0]['cells'][73][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,76,161,$semana,$data->sheets[0]['cells'][74][2],$data->sheets[0]['cells'][74][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,76,162,$semana,$data->sheets[0]['cells'][75][2],$data->sheets[0]['cells'][75][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,76,163,$semana,$data->sheets[0]['cells'][76][2],$data->sheets[0]['cells'][76][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,76,164,$semana,$data->sheets[0]['cells'][77][2],$data->sheets[0]['cells'][77][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,165,$semana,$data->sheets[0]['cells'][79][2],$data->sheets[0]['cells'][79][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,166,$semana,$data->sheets[0]['cells'][80][2],$data->sheets[0]['cells'][80][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,167,$semana,$data->sheets[0]['cells'][81][2],$data->sheets[0]['cells'][81][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,168,$semana,$data->sheets[0]['cells'][82][2],$data->sheets[0]['cells'][82][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,169,$semana,$data->sheets[0]['cells'][83][2],$data->sheets[0]['cells'][83][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,170,$semana,$data->sheets[0]['cells'][84][2],$data->sheets[0]['cells'][84][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,934,$semana,$data->sheets[0]['cells'][85][2],$data->sheets[0]['cells'][85][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,935,$semana,$data->sheets[0]['cells'][86][2],$data->sheets[0]['cells'][86][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,514,$semana,$data->sheets[0]['cells'][87][2],$data->sheets[0]['cells'][87][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,515,$semana,$data->sheets[0]['cells'][88][2],$data->sheets[0]['cells'][88][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,936,$semana,$data->sheets[0]['cells'][89][2],$data->sheets[0]['cells'][89][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,937,$semana,$data->sheets[0]['cells'][90][2],$data->sheets[0]['cells'][90][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,516,$semana,$data->sheets[0]['cells'][91][2],$data->sheets[0]['cells'][91][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,517,$semana,$data->sheets[0]['cells'][92][2],$data->sheets[0]['cells'][92][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,938,$semana,$data->sheets[0]['cells'][93][2],$data->sheets[0]['cells'][93][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,77,939,$semana,$data->sheets[0]['cells'][94][2],$data->sheets[0]['cells'][94][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,518,$semana,$data->sheets[0]['cells'][95][2],$data->sheets[0]['cells'][95][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,519,$semana,$data->sheets[0]['cells'][96][2],$data->sheets[0]['cells'][96][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,940,$semana,$data->sheets[0]['cells'][97][2],$data->sheets[0]['cells'][97][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,941,$semana,$data->sheets[0]['cells'][98][2],$data->sheets[0]['cells'][98][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,520,$semana,$data->sheets[0]['cells'][99][2],$data->sheets[0]['cells'][99][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,521,$semana,$data->sheets[0]['cells'][100][2],$data->sheets[0]['cells'][100][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,942,$semana,$data->sheets[0]['cells'][101][2],$data->sheets[0]['cells'][101][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,943,$semana,$data->sheets[0]['cells'][102][2],$data->sheets[0]['cells'][102][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,944,$semana,$data->sheets[0]['cells'][103][2],$data->sheets[0]['cells'][103][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,945,$semana,$data->sheets[0]['cells'][104][2],$data->sheets[0]['cells'][104][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,522,$semana,$data->sheets[0]['cells'][105][2],$data->sheets[0]['cells'][105][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,523,$semana,$data->sheets[0]['cells'][106][2],$data->sheets[0]['cells'][106][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,948,$semana,$data->sheets[0]['cells'][107][2],$data->sheets[0]['cells'][107][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,949,$semana,$data->sheets[0]['cells'][108][2],$data->sheets[0]['cells'][108][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,950,$semana,$data->sheets[0]['cells'][109][2],$data->sheets[0]['cells'][109][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,951,$semana,$data->sheets[0]['cells'][110][2],$data->sheets[0]['cells'][110][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,952,$semana,$data->sheets[0]['cells'][111][2],$data->sheets[0]['cells'][111][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,192,953,$semana,$data->sheets[0]['cells'][112][2],$data->sheets[0]['cells'][112][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,78,171,$semana,$data->sheets[0]['cells'][114][2],$data->sheets[0]['cells'][114][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,78,172,$semana,$data->sheets[0]['cells'][115][2],$data->sheets[0]['cells'][115][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,78,173,$semana,$data->sheets[0]['cells'][116][2],$data->sheets[0]['cells'][116][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,78,174,$semana,$data->sheets[0]['cells'][117][2],$data->sheets[0]['cells'][117][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,78,175,$semana,$data->sheets[0]['cells'][118][2],$data->sheets[0]['cells'][118][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,78,176,$semana,$data->sheets[0]['cells'][119][2],$data->sheets[0]['cells'][119][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,78,177,$semana,$data->sheets[0]['cells'][120][2],$data->sheets[0]['cells'][120][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,78,178,$semana,$data->sheets[0]['cells'][121][2],$data->sheets[0]['cells'][121][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,79,179,$semana,$data->sheets[0]['cells'][123][2],$data->sheets[0]['cells'][123][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,79,180,$semana,$data->sheets[0]['cells'][124][2],$data->sheets[0]['cells'][124][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,79,181,$semana,$data->sheets[0]['cells'][125][2],$data->sheets[0]['cells'][125][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,79,182,$semana,$data->sheets[0]['cells'][126][2],$data->sheets[0]['cells'][126][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,79,183,$semana,$data->sheets[0]['cells'][127][2],$data->sheets[0]['cells'][127][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,79,184,$semana,$data->sheets[0]['cells'][128][2],$data->sheets[0]['cells'][128][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,79,185,$semana,$data->sheets[0]['cells'][129][2],$data->sheets[0]['cells'][129][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,79,186,$semana,$data->sheets[0]['cells'][130][2],$data->sheets[0]['cells'][130][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,80,187,$semana,$data->sheets[0]['cells'][132][2],$data->sheets[0]['cells'][132][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,80,188,$semana,$data->sheets[0]['cells'][133][2],$data->sheets[0]['cells'][133][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,80,189,$semana,$data->sheets[0]['cells'][134][2],$data->sheets[0]['cells'][134][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,80,190,$semana,$data->sheets[0]['cells'][135][2],$data->sheets[0]['cells'][135][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,80,191,$semana,$data->sheets[0]['cells'][136][2],$data->sheets[0]['cells'][136][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,81,192,$semana,$data->sheets[0]['cells'][138][2],$data->sheets[0]['cells'][138][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,81,193,$semana,$data->sheets[0]['cells'][139][2],$data->sheets[0]['cells'][139][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,81,194,$semana,$data->sheets[0]['cells'][140][2],$data->sheets[0]['cells'][140][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,81,195,$semana,$data->sheets[0]['cells'][141][2],$data->sheets[0]['cells'][141][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,81,196,$semana,$data->sheets[0]['cells'][142][2],$data->sheets[0]['cells'][142][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,81,197,$semana,$data->sheets[0]['cells'][143][2],$data->sheets[0]['cells'][143][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,81,198,$semana,$data->sheets[0]['cells'][144][2],$data->sheets[0]['cells'][144][4]));
            

            }catch(Exception $e)

            {
                $respuesta= $e;
            };

            } else {$respuesta =  "La semana seleccionada no coincide con la semana en el archivo o la semana en el nombre del archivo" ;};

            return $respuesta;


            //echo '<script language="javascript">alert("'.$respuesta.'");</script>'; 
            //echo "<script> location.href='http://10.30.17.62:80/Entel/public/index.php/DatosDatos'; </script>";

    }

    public function postprepago(){
            

            $filename = $_FILES['sel_file']['tmp_name'];
            $fname = $_FILES['sel_file']['name'];

            $data = new Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('CP1251');
            $data->read($filename);
            
            // semana y anÃ±o del excel
            $week=$data->sheets[0]['cells'][1][4];

            if (strlen($week) == 1) {
                $week="0".$week;
            }

            $year=$data->sheets[0]['cells'][1][6];
            $anho_semana=$year."".$week;
            //
            //echo "anho_semana del excel".$anho_semana;

            $week2=$_POST['semanac']; // semana concatenada
            $year2=$_POST['anhosc']; // aÃ±o solito del select
            //echo "wee2 ".$week2;
            
            $chk2 = explode("_", $fname);  
            $chk3 = end($chk2);
            $chk4 = explode(".", $chk3);
            // aÃ±o y semana concatenados, la semana es la que aparece en el nombre del archivo
            $week3= $year2."".$chk4[0];         

            if ($anho_semana == $week2 && $week2 == $week3 ) {
                # code...
            

            $semana=$week2;
            //echo $semana;
            $id_supervision=$_POST['id_tec'];

            //echo $id_supervision;
            
           
            try {

            //DB::INSERT("INSERT INTO semana_superv (id_suprv,anho,semana,anho_semana) values (?,?,?,?);",array( $id_supervision,$year2,$week,$anho_semana));
            
           

            $target_path = "documentos/prepago/";
            $target_path = $target_path . basename( $_FILES['sel_file']['name']); 
            $target_path_2 = "../".$target_path;
            $fecha_registro=date("Y-m-d H:i:s");
            if(move_uploaded_file($_FILES['sel_file']['tmp_name'], $target_path)) { 
                //echo "El archivo ". basename( $_FILES['sel_file']['name']). " ha sido subido";

                DB::INSERT("INSERT INTO documentos (id_superv,nombre,ruta,fecha_registro,usuario,semana) values (?,?,?,?,?,?)",array($id_supervision,basename( $_FILES['sel_file']['name']),$target_path_2,$fecha_registro,$_SESSION['usuario'],$anho_semana));              

                $respuesta =  "Datos cargados a la BD, archivo: ".$fname.", Prepago" ;
            } else{
                $respuesta= "Ha ocurrido un error, trate de nuevo!";
            }

             

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,98,232,$semana,$data->sheets[0]['cells'][6][2],$data->sheets[0]['cells'][6][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,98,233,$semana,$data->sheets[0]['cells'][7][2],$data->sheets[0]['cells'][7][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,98,234,$semana,$data->sheets[0]['cells'][8][2],$data->sheets[0]['cells'][8][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,98,235,$semana,$data->sheets[0]['cells'][9][2],$data->sheets[0]['cells'][9][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,98,236,$semana,$data->sheets[0]['cells'][10][2],$data->sheets[0]['cells'][10][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,99,237,$semana,$data->sheets[0]['cells'][12][2],$data->sheets[0]['cells'][12][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,99,238,$semana,$data->sheets[0]['cells'][13][2],$data->sheets[0]['cells'][13][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,99,239,$semana,$data->sheets[0]['cells'][14][2],$data->sheets[0]['cells'][14][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,100,240,$semana,$data->sheets[0]['cells'][16][2],$data->sheets[0]['cells'][16][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,101,241,$semana,$data->sheets[0]['cells'][18][2],$data->sheets[0]['cells'][18][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,101,242,$semana,$data->sheets[0]['cells'][19][2],$data->sheets[0]['cells'][19][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,101,243,$semana,$data->sheets[0]['cells'][20][2],$data->sheets[0]['cells'][20][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,101,244,$semana,$data->sheets[0]['cells'][23][2],$data->sheets[0]['cells'][23][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,101,245,$semana,$data->sheets[0]['cells'][24][2],$data->sheets[0]['cells'][24][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,102,246,$semana,$data->sheets[0]['cells'][26][2],$data->sheets[0]['cells'][26][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,102,247,$semana,$data->sheets[0]['cells'][27][2],$data->sheets[0]['cells'][27][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,102,248,$semana,$data->sheets[0]['cells'][28][2],$data->sheets[0]['cells'][28][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,102,249,$semana,$data->sheets[0]['cells'][29][2],$data->sheets[0]['cells'][29][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,250,$semana,$data->sheets[0]['cells'][31][2],$data->sheets[0]['cells'][31][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,251,$semana,$data->sheets[0]['cells'][32][2],$data->sheets[0]['cells'][32][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,252,$semana,$data->sheets[0]['cells'][33][2],$data->sheets[0]['cells'][33][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,253,$semana,$data->sheets[0]['cells'][34][2],$data->sheets[0]['cells'][34][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,254,$semana,$data->sheets[0]['cells'][35][2],$data->sheets[0]['cells'][35][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,255,$semana,$data->sheets[0]['cells'][36][2],$data->sheets[0]['cells'][36][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,256,$semana,$data->sheets[0]['cells'][37][2],$data->sheets[0]['cells'][37][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,954,$semana,$data->sheets[0]['cells'][38][2],$data->sheets[0]['cells'][38][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,955,$semana,$data->sheets[0]['cells'][39][2],$data->sheets[0]['cells'][39][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,956,$semana,$data->sheets[0]['cells'][40][2],$data->sheets[0]['cells'][40][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,957,$semana,$data->sheets[0]['cells'][41][2],$data->sheets[0]['cells'][41][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,958,$semana,$data->sheets[0]['cells'][42][2],$data->sheets[0]['cells'][42][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,959,$semana,$data->sheets[0]['cells'][43][2],$data->sheets[0]['cells'][43][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,960,$semana,$data->sheets[0]['cells'][44][2],$data->sheets[0]['cells'][44][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,961,$semana,$data->sheets[0]['cells'][45][2],$data->sheets[0]['cells'][45][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,962,$semana,$data->sheets[0]['cells'][46][2],$data->sheets[0]['cells'][46][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,963,$semana,$data->sheets[0]['cells'][47][2],$data->sheets[0]['cells'][47][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,964,$semana,$data->sheets[0]['cells'][48][2],$data->sheets[0]['cells'][48][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,965,$semana,$data->sheets[0]['cells'][49][2],$data->sheets[0]['cells'][49][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,966,$semana,$data->sheets[0]['cells'][50][2],$data->sheets[0]['cells'][50][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,967,$semana,$data->sheets[0]['cells'][51][2],$data->sheets[0]['cells'][51][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,103,968,$semana,$data->sheets[0]['cells'][52][2],$data->sheets[0]['cells'][52][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,257,$semana,$data->sheets[0]['cells'][54][2],$data->sheets[0]['cells'][54][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,258,$semana,$data->sheets[0]['cells'][55][2],$data->sheets[0]['cells'][55][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,259,$semana,$data->sheets[0]['cells'][56][2],$data->sheets[0]['cells'][56][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,969,$semana,$data->sheets[0]['cells'][57][2],$data->sheets[0]['cells'][57][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,970,$semana,$data->sheets[0]['cells'][58][2],$data->sheets[0]['cells'][58][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,260,$semana,$data->sheets[0]['cells'][59][2],$data->sheets[0]['cells'][59][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,261,$semana,$data->sheets[0]['cells'][60][2],$data->sheets[0]['cells'][60][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,262,$semana,$data->sheets[0]['cells'][61][2],$data->sheets[0]['cells'][61][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,971,$semana,$data->sheets[0]['cells'][62][2],$data->sheets[0]['cells'][62][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,104,972,$semana,$data->sheets[0]['cells'][63][2],$data->sheets[0]['cells'][63][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,105,246,$semana,$data->sheets[0]['cells'][65][2],$data->sheets[0]['cells'][65][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,105,247,$semana,$data->sheets[0]['cells'][66][2],$data->sheets[0]['cells'][66][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,105,248,$semana,$data->sheets[0]['cells'][67][2],$data->sheets[0]['cells'][67][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,105,249,$semana,$data->sheets[0]['cells'][68][2],$data->sheets[0]['cells'][68][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,250,$semana,$data->sheets[0]['cells'][70][2],$data->sheets[0]['cells'][70][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,251,$semana,$data->sheets[0]['cells'][71][2],$data->sheets[0]['cells'][71][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,252,$semana,$data->sheets[0]['cells'][72][2],$data->sheets[0]['cells'][72][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,253,$semana,$data->sheets[0]['cells'][73][2],$data->sheets[0]['cells'][73][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,254,$semana,$data->sheets[0]['cells'][74][2],$data->sheets[0]['cells'][74][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,255,$semana,$data->sheets[0]['cells'][75][2],$data->sheets[0]['cells'][75][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,256,$semana,$data->sheets[0]['cells'][76][2],$data->sheets[0]['cells'][76][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,954,$semana,$data->sheets[0]['cells'][77][2],$data->sheets[0]['cells'][77][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,955,$semana,$data->sheets[0]['cells'][78][2],$data->sheets[0]['cells'][78][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,956,$semana,$data->sheets[0]['cells'][79][2],$data->sheets[0]['cells'][79][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,957,$semana,$data->sheets[0]['cells'][80][2],$data->sheets[0]['cells'][80][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,958,$semana,$data->sheets[0]['cells'][81][2],$data->sheets[0]['cells'][81][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,959,$semana,$data->sheets[0]['cells'][82][2],$data->sheets[0]['cells'][82][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,960,$semana,$data->sheets[0]['cells'][83][2],$data->sheets[0]['cells'][83][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,961,$semana,$data->sheets[0]['cells'][84][2],$data->sheets[0]['cells'][84][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,962,$semana,$data->sheets[0]['cells'][85][2],$data->sheets[0]['cells'][85][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,963,$semana,$data->sheets[0]['cells'][86][2],$data->sheets[0]['cells'][86][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,964,$semana,$data->sheets[0]['cells'][87][2],$data->sheets[0]['cells'][87][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,965,$semana,$data->sheets[0]['cells'][88][2],$data->sheets[0]['cells'][88][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,966,$semana,$data->sheets[0]['cells'][89][2],$data->sheets[0]['cells'][89][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,967,$semana,$data->sheets[0]['cells'][90][2],$data->sheets[0]['cells'][90][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,106,968,$semana,$data->sheets[0]['cells'][91][2],$data->sheets[0]['cells'][91][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,257,$semana,$data->sheets[0]['cells'][93][2],$data->sheets[0]['cells'][93][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,258,$semana,$data->sheets[0]['cells'][94][2],$data->sheets[0]['cells'][94][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,259,$semana,$data->sheets[0]['cells'][95][2],$data->sheets[0]['cells'][95][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,969,$semana,$data->sheets[0]['cells'][96][2],$data->sheets[0]['cells'][96][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,970,$semana,$data->sheets[0]['cells'][97][2],$data->sheets[0]['cells'][97][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,260,$semana,$data->sheets[0]['cells'][98][2],$data->sheets[0]['cells'][98][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,261,$semana,$data->sheets[0]['cells'][99][2],$data->sheets[0]['cells'][99][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,262,$semana,$data->sheets[0]['cells'][100][2],$data->sheets[0]['cells'][100][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,971,$semana,$data->sheets[0]['cells'][101][2],$data->sheets[0]['cells'][101][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,107,972,$semana,$data->sheets[0]['cells'][102][2],$data->sheets[0]['cells'][102][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,108,263,$semana,$data->sheets[0]['cells'][104][2],$data->sheets[0]['cells'][104][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,108,264,$semana,$data->sheets[0]['cells'][105][2],$data->sheets[0]['cells'][105][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,108,265,$semana,$data->sheets[0]['cells'][106][2],$data->sheets[0]['cells'][106][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,108,966,$semana,$data->sheets[0]['cells'][107][2],$data->sheets[0]['cells'][107][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,108,967,$semana,$data->sheets[0]['cells'][108][2],$data->sheets[0]['cells'][108][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,109,268,$semana,$data->sheets[0]['cells'][110][2],$data->sheets[0]['cells'][110][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,109,269,$semana,$data->sheets[0]['cells'][111][2],$data->sheets[0]['cells'][111][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,109,270,$semana,$data->sheets[0]['cells'][112][2],$data->sheets[0]['cells'][112][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,109,271,$semana,$data->sheets[0]['cells'][113][2],$data->sheets[0]['cells'][113][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,109,272,$semana,$data->sheets[0]['cells'][114][2],$data->sheets[0]['cells'][114][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,109,273,$semana,$data->sheets[0]['cells'][115][2],$data->sheets[0]['cells'][115][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,109,973,$semana,$data->sheets[0]['cells'][116][2],$data->sheets[0]['cells'][116][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,109,274,$semana,$data->sheets[0]['cells'][117][2],$data->sheets[0]['cells'][117][4]));
                    

            }catch(Exception $e)

            {
                $respuesta= $e;
            };

            } else {$respuesta =  "La semana seleccionada no coincide con la semana en el archivo o la semana en el nombre del archivo" ;};

            return $respuesta;


            //echo '<script language="javascript">alert("'.$respuesta.'");</script>'; 
            //echo "<script> location.href='http://10.30.17.62:80/Entel/public/index.php/DatosDatos'; </script>";

    }

    public function postran(){
            

            $filename = $_FILES['sel_file']['tmp_name'];
            $fname = $_FILES['sel_file']['name'];

            $data = new Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('CP1251');
            $data->read($filename);
            
            // semana y anÃ±o del excel
            $week=$data->sheets[0]['cells'][1][4];

            if (strlen($week) == 1) {
                $week="0".$week;
            }

            $year=$data->sheets[0]['cells'][1][6];
            $anho_semana=$year."".$week;
            //
            //echo "anho_semana del excel".$anho_semana;

            $week2=$_POST['semanac']; // semana concatenada
            $year2=$_POST['anhosc']; // aÃ±o solito del select
            //echo "wee2 ".$week2;
            
            $chk2 = explode("_", $fname);  
            $chk3 = end($chk2);
            $chk4 = explode(".", $chk3);
            // aÃ±o y semana concatenados, la semana es la que aparece en el nombre del archivo
            $week3= $year2."".$chk4[0];         

            if ($anho_semana == $week2 && $week2 == $week3 ) {
                # code...
            

            $semana=$week2;
            //echo $semana;
            $id_supervision=$_POST['id_tec'];

            //echo $id_supervision;
            
           
            try {

            //DB::INSERT("INSERT INTO semana_superv (id_suprv,anho,semana,anho_semana) values (?,?,?,?);",array( $id_supervision,$year2,$week,$anho_semana));
            
           

            $target_path = "documentos/ran/";
            $target_path = $target_path . basename( $_FILES['sel_file']['name']); 
            $target_path_2 = "../".$target_path;
            $fecha_registro=date("Y-m-d H:i:s");
            if(move_uploaded_file($_FILES['sel_file']['tmp_name'], $target_path)) { 
                //echo "El archivo ". basename( $_FILES['sel_file']['name']). " ha sido subido";

                DB::INSERT("INSERT INTO documentos (id_superv,nombre,ruta,fecha_registro,usuario,semana) values (?,?,?,?,?,?)",array($id_supervision,basename( $_FILES['sel_file']['name']),$target_path_2,$fecha_registro,$_SESSION['usuario'],$anho_semana));              

                $respuesta =  "Datos cargados a la BD, archivo: ".$fname.", RAN" ;
            } else{
                $respuesta= "Ha ocurrido un error, trate de nuevo!";
            }

             

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,56,98,$semana,$data->sheets[0]['cells'][6][2],$data->sheets[0]['cells'][6][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,56,99,$semana,$data->sheets[0]['cells'][7][2],$data->sheets[0]['cells'][7][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,56,100,$semana,$data->sheets[0]['cells'][8][2],$data->sheets[0]['cells'][8][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,56,101,$semana,$data->sheets[0]['cells'][9][2],$data->sheets[0]['cells'][9][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,56,102,$semana,$data->sheets[0]['cells'][10][2],$data->sheets[0]['cells'][10][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,56,103,$semana,$data->sheets[0]['cells'][11][2],$data->sheets[0]['cells'][11][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,56,104,$semana,$data->sheets[0]['cells'][12][2],$data->sheets[0]['cells'][12][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,56,105,$semana,$data->sheets[0]['cells'][13][2],$data->sheets[0]['cells'][13][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,57,106,$semana,$data->sheets[0]['cells'][15][2],$data->sheets[0]['cells'][15][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,57,107,$semana,$data->sheets[0]['cells'][16][2],$data->sheets[0]['cells'][16][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,57,108,$semana,$data->sheets[0]['cells'][17][2],$data->sheets[0]['cells'][17][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,57,109,$semana,$data->sheets[0]['cells'][18][2],$data->sheets[0]['cells'][18][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,57,110,$semana,$data->sheets[0]['cells'][19][2],$data->sheets[0]['cells'][19][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,57,111,$semana,$data->sheets[0]['cells'][20][2],$data->sheets[0]['cells'][20][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,57,112,$semana,$data->sheets[0]['cells'][21][2],$data->sheets[0]['cells'][21][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,57,113,$semana,$data->sheets[0]['cells'][22][2],$data->sheets[0]['cells'][22][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,58,114,$semana,$data->sheets[0]['cells'][24][2],$data->sheets[0]['cells'][24][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,58,115,$semana,$data->sheets[0]['cells'][25][2],$data->sheets[0]['cells'][25][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,58,116,$semana,$data->sheets[0]['cells'][26][2],$data->sheets[0]['cells'][26][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,58,117,$semana,$data->sheets[0]['cells'][27][2],$data->sheets[0]['cells'][27][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,118,$semana,$data->sheets[0]['cells'][30][2],$data->sheets[0]['cells'][30][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,119,$semana,$data->sheets[0]['cells'][31][2],$data->sheets[0]['cells'][31][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,120,$semana,$data->sheets[0]['cells'][32][2],$data->sheets[0]['cells'][32][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,121,$semana,$data->sheets[0]['cells'][33][2],$data->sheets[0]['cells'][33][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,122,$semana,$data->sheets[0]['cells'][34][2],$data->sheets[0]['cells'][34][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,123,$semana,$data->sheets[0]['cells'][35][2],$data->sheets[0]['cells'][35][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,124,$semana,$data->sheets[0]['cells'][36][2],$data->sheets[0]['cells'][36][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,125,$semana,$data->sheets[0]['cells'][37][2],$data->sheets[0]['cells'][37][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,126,$semana,$data->sheets[0]['cells'][38][2],$data->sheets[0]['cells'][38][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,127,$semana,$data->sheets[0]['cells'][39][2],$data->sheets[0]['cells'][39][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,44,932,$semana,$data->sheets[0]['cells'][40][2],$data->sheets[0]['cells'][40][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,118,$semana,$data->sheets[0]['cells'][42][2],$data->sheets[0]['cells'][42][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,119,$semana,$data->sheets[0]['cells'][43][2],$data->sheets[0]['cells'][43][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,120,$semana,$data->sheets[0]['cells'][44][2],$data->sheets[0]['cells'][44][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,121,$semana,$data->sheets[0]['cells'][45][2],$data->sheets[0]['cells'][45][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,122,$semana,$data->sheets[0]['cells'][46][2],$data->sheets[0]['cells'][46][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,123,$semana,$data->sheets[0]['cells'][47][2],$data->sheets[0]['cells'][47][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,124,$semana,$data->sheets[0]['cells'][48][2],$data->sheets[0]['cells'][48][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,125,$semana,$data->sheets[0]['cells'][49][2],$data->sheets[0]['cells'][49][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,126,$semana,$data->sheets[0]['cells'][50][2],$data->sheets[0]['cells'][50][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,127,$semana,$data->sheets[0]['cells'][51][2],$data->sheets[0]['cells'][51][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,45,932,$semana,$data->sheets[0]['cells'][52][2],$data->sheets[0]['cells'][52][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,118,$semana,$data->sheets[0]['cells'][54][2],$data->sheets[0]['cells'][54][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,119,$semana,$data->sheets[0]['cells'][55][2],$data->sheets[0]['cells'][55][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,120,$semana,$data->sheets[0]['cells'][56][2],$data->sheets[0]['cells'][56][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,121,$semana,$data->sheets[0]['cells'][57][2],$data->sheets[0]['cells'][57][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,122,$semana,$data->sheets[0]['cells'][58][2],$data->sheets[0]['cells'][58][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,123,$semana,$data->sheets[0]['cells'][59][2],$data->sheets[0]['cells'][59][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,124,$semana,$data->sheets[0]['cells'][60][2],$data->sheets[0]['cells'][60][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,125,$semana,$data->sheets[0]['cells'][61][2],$data->sheets[0]['cells'][61][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,126,$semana,$data->sheets[0]['cells'][62][2],$data->sheets[0]['cells'][62][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,127,$semana,$data->sheets[0]['cells'][63][2],$data->sheets[0]['cells'][63][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,46,932,$semana,$data->sheets[0]['cells'][64][2],$data->sheets[0]['cells'][64][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,118,$semana,$data->sheets[0]['cells'][66][2],$data->sheets[0]['cells'][66][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,119,$semana,$data->sheets[0]['cells'][67][2],$data->sheets[0]['cells'][67][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,120,$semana,$data->sheets[0]['cells'][68][2],$data->sheets[0]['cells'][68][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,121,$semana,$data->sheets[0]['cells'][69][2],$data->sheets[0]['cells'][69][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,122,$semana,$data->sheets[0]['cells'][70][2],$data->sheets[0]['cells'][70][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,123,$semana,$data->sheets[0]['cells'][71][2],$data->sheets[0]['cells'][71][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,124,$semana,$data->sheets[0]['cells'][72][2],$data->sheets[0]['cells'][72][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,125,$semana,$data->sheets[0]['cells'][73][2],$data->sheets[0]['cells'][73][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,126,$semana,$data->sheets[0]['cells'][74][2],$data->sheets[0]['cells'][74][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,127,$semana,$data->sheets[0]['cells'][75][2],$data->sheets[0]['cells'][75][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,47,932,$semana,$data->sheets[0]['cells'][76][2],$data->sheets[0]['cells'][76][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,48,118,$semana,$data->sheets[0]['cells'][78][2],$data->sheets[0]['cells'][78][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,48,120,$semana,$data->sheets[0]['cells'][79][2],$data->sheets[0]['cells'][79][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,48,121,$semana,$data->sheets[0]['cells'][80][2],$data->sheets[0]['cells'][80][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,48,125,$semana,$data->sheets[0]['cells'][81][2],$data->sheets[0]['cells'][81][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,49,118,$semana,$data->sheets[0]['cells'][83][2],$data->sheets[0]['cells'][83][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,49,120,$semana,$data->sheets[0]['cells'][84][2],$data->sheets[0]['cells'][84][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,49,121,$semana,$data->sheets[0]['cells'][85][2],$data->sheets[0]['cells'][85][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,49,125,$semana,$data->sheets[0]['cells'][86][2],$data->sheets[0]['cells'][86][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,118,$semana,$data->sheets[0]['cells'][88][2],$data->sheets[0]['cells'][88][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,119,$semana,$data->sheets[0]['cells'][89][2],$data->sheets[0]['cells'][89][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,120,$semana,$data->sheets[0]['cells'][90][2],$data->sheets[0]['cells'][90][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,121,$semana,$data->sheets[0]['cells'][91][2],$data->sheets[0]['cells'][91][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,122,$semana,$data->sheets[0]['cells'][92][2],$data->sheets[0]['cells'][92][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,123,$semana,$data->sheets[0]['cells'][93][2],$data->sheets[0]['cells'][93][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,124,$semana,$data->sheets[0]['cells'][94][2],$data->sheets[0]['cells'][94][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,125,$semana,$data->sheets[0]['cells'][95][2],$data->sheets[0]['cells'][95][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,126,$semana,$data->sheets[0]['cells'][96][2],$data->sheets[0]['cells'][96][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,127,$semana,$data->sheets[0]['cells'][97][2],$data->sheets[0]['cells'][97][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,50,932,$semana,$data->sheets[0]['cells'][98][2],$data->sheets[0]['cells'][98][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,51,119,$semana,$data->sheets[0]['cells'][100][2],$data->sheets[0]['cells'][100][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,51,122,$semana,$data->sheets[0]['cells'][101][2],$data->sheets[0]['cells'][101][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,51,123,$semana,$data->sheets[0]['cells'][102][2],$data->sheets[0]['cells'][102][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,51,124,$semana,$data->sheets[0]['cells'][103][2],$data->sheets[0]['cells'][103][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,51,126,$semana,$data->sheets[0]['cells'][104][2],$data->sheets[0]['cells'][104][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,51,127,$semana,$data->sheets[0]['cells'][105][2],$data->sheets[0]['cells'][105][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,51,932,$semana,$data->sheets[0]['cells'][106][2],$data->sheets[0]['cells'][106][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,52,128,$semana,$data->sheets[0]['cells'][109][2],$data->sheets[0]['cells'][109][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,52,129,$semana,$data->sheets[0]['cells'][110][2],$data->sheets[0]['cells'][110][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,52,130,$semana,$data->sheets[0]['cells'][111][2],$data->sheets[0]['cells'][111][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,52,131,$semana,$data->sheets[0]['cells'][112][2],$data->sheets[0]['cells'][112][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,52,132,$semana,$data->sheets[0]['cells'][113][2],$data->sheets[0]['cells'][113][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,52,133,$semana,$data->sheets[0]['cells'][114][2],$data->sheets[0]['cells'][114][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,52,134,$semana,$data->sheets[0]['cells'][115][2],$data->sheets[0]['cells'][115][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,52,933,$semana,$data->sheets[0]['cells'][116][2],$data->sheets[0]['cells'][116][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,53,128,$semana,$data->sheets[0]['cells'][118][2],$data->sheets[0]['cells'][118][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,53,129,$semana,$data->sheets[0]['cells'][119][2],$data->sheets[0]['cells'][119][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,53,130,$semana,$data->sheets[0]['cells'][120][2],$data->sheets[0]['cells'][120][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,53,131,$semana,$data->sheets[0]['cells'][121][2],$data->sheets[0]['cells'][121][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,53,132,$semana,$data->sheets[0]['cells'][122][2],$data->sheets[0]['cells'][122][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,53,133,$semana,$data->sheets[0]['cells'][123][2],$data->sheets[0]['cells'][123][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,53,134,$semana,$data->sheets[0]['cells'][124][2],$data->sheets[0]['cells'][124][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,53,933,$semana,$data->sheets[0]['cells'][125][2],$data->sheets[0]['cells'][125][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,54,128,$semana,$data->sheets[0]['cells'][127][2],$data->sheets[0]['cells'][127][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,54,129,$semana,$data->sheets[0]['cells'][128][2],$data->sheets[0]['cells'][128][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,54,130,$semana,$data->sheets[0]['cells'][129][2],$data->sheets[0]['cells'][129][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,54,131,$semana,$data->sheets[0]['cells'][130][2],$data->sheets[0]['cells'][130][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,54,132,$semana,$data->sheets[0]['cells'][131][2],$data->sheets[0]['cells'][131][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,54,133,$semana,$data->sheets[0]['cells'][132][2],$data->sheets[0]['cells'][132][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,54,134,$semana,$data->sheets[0]['cells'][133][2],$data->sheets[0]['cells'][133][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,54,933,$semana,$data->sheets[0]['cells'][134][2],$data->sheets[0]['cells'][134][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,55,128,$semana,$data->sheets[0]['cells'][136][2],$data->sheets[0]['cells'][136][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,55,129,$semana,$data->sheets[0]['cells'][137][2],$data->sheets[0]['cells'][137][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,55,130,$semana,$data->sheets[0]['cells'][138][2],$data->sheets[0]['cells'][138][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,55,131,$semana,$data->sheets[0]['cells'][139][2],$data->sheets[0]['cells'][139][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,55,132,$semana,$data->sheets[0]['cells'][140][2],$data->sheets[0]['cells'][140][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,55,133,$semana,$data->sheets[0]['cells'][141][2],$data->sheets[0]['cells'][141][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,55,134,$semana,$data->sheets[0]['cells'][142][2],$data->sheets[0]['cells'][142][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,55,933,$semana,$data->sheets[0]['cells'][143][2],$data->sheets[0]['cells'][143][4]));
            

            }catch(Exception $e)

            {
                $respuesta= $e;
            };

            } else {$respuesta =  "La semana seleccionada no coincide con la semana en el archivo o la semana en el nombre del archivo" ;};

            return $respuesta;


            //echo '<script language="javascript">alert("'.$respuesta.'");</script>'; 
            //echo "<script> location.href='http://10.30.17.62:80/Entel/public/index.php/DatosDatos'; </script>";

    }


    public function postisp(){
            

            $filename = $_FILES['sel_file']['tmp_name'];
            $fname = $_FILES['sel_file']['name'];

            $data = new Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('CP1251');
            $data->read($filename);
            
            // semana y anÃ±o del excel
            $week=$data->sheets[0]['cells'][1][4];

            if (strlen($week) == 1) {
                $week="0".$week;
            }

            $year=$data->sheets[0]['cells'][1][6];
            $anho_semana=$year."".$week;
            //
            //echo "anho_semana del excel".$anho_semana;

            $week2=$_POST['semanac']; // semana concatenada
            $year2=$_POST['anhosc']; // aÃ±o solito del select
            //echo "wee2 ".$week2;
            
            $chk2 = explode("_", $fname);  
            $chk3 = end($chk2);
            $chk4 = explode(".", $chk3);
            // aÃ±o y semana concatenados, la semana es la que aparece en el nombre del archivo
            $week3= $year2."".$chk4[0];         

            if ($anho_semana == $week2 && $week2 == $week3 ) {
                # code...
            

            $semana=$week2;
            //echo $semana;
            $id_supervision=$_POST['id_tec'];

            //echo $id_supervision;
            
           
            try {

            //DB::INSERT("INSERT INTO semana_superv (id_suprv,anho,semana,anho_semana) values (?,?,?,?);",array( $id_supervision,$year2,$week,$anho_semana));
            
           

            $target_path = "documentos/isp/";
            $target_path = $target_path . basename( $_FILES['sel_file']['name']); 
            $target_path_2 = "../".$target_path;
            $fecha_registro=date("Y-m-d H:i:s");
            if(move_uploaded_file($_FILES['sel_file']['tmp_name'], $target_path)) { 
                //echo "El archivo ". basename( $_FILES['sel_file']['name']). " ha sido subido";

                DB::INSERT("INSERT INTO documentos (id_superv,nombre,ruta,fecha_registro,usuario,semana) values (?,?,?,?,?,?)",array($id_supervision,basename( $_FILES['sel_file']['name']),$target_path_2,$fecha_registro,$_SESSION['usuario'],$anho_semana));              

                $respuesta =  "Datos cargados a la BD, archivo: ".$fname.", ISP" ;
            } else{
                $respuesta= "Ha ocurrido un error, trate de nuevo!";
            }

             

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,161,713,$semana,$data->sheets[0]['cells'][6][2],$data->sheets[0]['cells'][6][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,161,714,$semana,$data->sheets[0]['cells'][7][2],$data->sheets[0]['cells'][7][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,161,974,$semana,$data->sheets[0]['cells'][8][2],$data->sheets[0]['cells'][8][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,161,715,$semana,$data->sheets[0]['cells'][9][2],$data->sheets[0]['cells'][9][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,162,716,$semana,$data->sheets[0]['cells'][12][2],$data->sheets[0]['cells'][12][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,162,717,$semana,$data->sheets[0]['cells'][13][2],$data->sheets[0]['cells'][13][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,162,718,$semana,$data->sheets[0]['cells'][14][2],$data->sheets[0]['cells'][14][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,163,716,$semana,$data->sheets[0]['cells'][16][2],$data->sheets[0]['cells'][16][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,163,717,$semana,$data->sheets[0]['cells'][17][2],$data->sheets[0]['cells'][17][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,163,718,$semana,$data->sheets[0]['cells'][18][2],$data->sheets[0]['cells'][18][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,164,716,$semana,$data->sheets[0]['cells'][20][2],$data->sheets[0]['cells'][20][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,164,717,$semana,$data->sheets[0]['cells'][21][2],$data->sheets[0]['cells'][21][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,162,719,$semana,$data->sheets[0]['cells'][24][2],$data->sheets[0]['cells'][24][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,162,720,$semana,$data->sheets[0]['cells'][25][2],$data->sheets[0]['cells'][25][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,163,719,$semana,$data->sheets[0]['cells'][27][2],$data->sheets[0]['cells'][27][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,163,720,$semana,$data->sheets[0]['cells'][28][2],$data->sheets[0]['cells'][28][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,165,721,$semana,$data->sheets[0]['cells'][31][2],$data->sheets[0]['cells'][31][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,165,722,$semana,$data->sheets[0]['cells'][32][2],$data->sheets[0]['cells'][32][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,165,723,$semana,$data->sheets[0]['cells'][33][2],$data->sheets[0]['cells'][33][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,165,724,$semana,$data->sheets[0]['cells'][34][2],$data->sheets[0]['cells'][34][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,165,725,$semana,$data->sheets[0]['cells'][35][2],$data->sheets[0]['cells'][35][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,165,726,$semana,$data->sheets[0]['cells'][36][2],$data->sheets[0]['cells'][36][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,166,721,$semana,$data->sheets[0]['cells'][38][2],$data->sheets[0]['cells'][38][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,166,722,$semana,$data->sheets[0]['cells'][39][2],$data->sheets[0]['cells'][39][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,166,723,$semana,$data->sheets[0]['cells'][40][2],$data->sheets[0]['cells'][40][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,166,724,$semana,$data->sheets[0]['cells'][41][2],$data->sheets[0]['cells'][41][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,166,725,$semana,$data->sheets[0]['cells'][42][2],$data->sheets[0]['cells'][42][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,166,726,$semana,$data->sheets[0]['cells'][43][2],$data->sheets[0]['cells'][43][4]));
                      
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,727,$semana,$data->sheets[0]['cells'][46][2],$data->sheets[0]['cells'][46][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,728,$semana,$data->sheets[0]['cells'][47][2],$data->sheets[0]['cells'][47][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,729,$semana,$data->sheets[0]['cells'][48][2],$data->sheets[0]['cells'][48][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,730,$semana,$data->sheets[0]['cells'][49][2],$data->sheets[0]['cells'][49][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,731,$semana,$data->sheets[0]['cells'][50][2],$data->sheets[0]['cells'][50][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,732,$semana,$data->sheets[0]['cells'][51][2],$data->sheets[0]['cells'][51][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,733,$semana,$data->sheets[0]['cells'][52][2],$data->sheets[0]['cells'][52][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,734,$semana,$data->sheets[0]['cells'][53][2],$data->sheets[0]['cells'][53][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,735,$semana,$data->sheets[0]['cells'][54][2],$data->sheets[0]['cells'][54][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,975,$semana,$data->sheets[0]['cells'][55][2],$data->sheets[0]['cells'][55][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,736,$semana,$data->sheets[0]['cells'][56][2],$data->sheets[0]['cells'][56][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,737,$semana,$data->sheets[0]['cells'][57][2],$data->sheets[0]['cells'][57][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,976,$semana,$data->sheets[0]['cells'][58][2],$data->sheets[0]['cells'][58][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,738,$semana,$data->sheets[0]['cells'][59][2],$data->sheets[0]['cells'][59][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,739,$semana,$data->sheets[0]['cells'][60][2],$data->sheets[0]['cells'][60][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,740,$semana,$data->sheets[0]['cells'][61][2],$data->sheets[0]['cells'][61][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,741,$semana,$data->sheets[0]['cells'][62][2],$data->sheets[0]['cells'][62][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,742,$semana,$data->sheets[0]['cells'][63][2],$data->sheets[0]['cells'][63][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,743,$semana,$data->sheets[0]['cells'][64][2],$data->sheets[0]['cells'][64][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,977,$semana,$data->sheets[0]['cells'][65][2],$data->sheets[0]['cells'][65][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,744,$semana,$data->sheets[0]['cells'][66][2],$data->sheets[0]['cells'][66][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,745,$semana,$data->sheets[0]['cells'][67][2],$data->sheets[0]['cells'][67][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,746,$semana,$data->sheets[0]['cells'][68][2],$data->sheets[0]['cells'][68][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,747,$semana,$data->sheets[0]['cells'][69][2],$data->sheets[0]['cells'][69][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,748,$semana,$data->sheets[0]['cells'][70][2],$data->sheets[0]['cells'][70][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,749,$semana,$data->sheets[0]['cells'][71][2],$data->sheets[0]['cells'][71][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,167,750,$semana,$data->sheets[0]['cells'][72][2],$data->sheets[0]['cells'][72][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,751,$semana,$data->sheets[0]['cells'][73][2],$data->sheets[0]['cells'][73][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,752,$semana,$data->sheets[0]['cells'][74][2],$data->sheets[0]['cells'][74][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,753,$semana,$data->sheets[0]['cells'][75][2],$data->sheets[0]['cells'][75][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,754,$semana,$data->sheets[0]['cells'][76][2],$data->sheets[0]['cells'][76][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,755,$semana,$data->sheets[0]['cells'][77][2],$data->sheets[0]['cells'][77][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,756,$semana,$data->sheets[0]['cells'][78][2],$data->sheets[0]['cells'][78][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,757,$semana,$data->sheets[0]['cells'][79][2],$data->sheets[0]['cells'][79][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,758,$semana,$data->sheets[0]['cells'][80][2],$data->sheets[0]['cells'][80][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,759,$semana,$data->sheets[0]['cells'][81][2],$data->sheets[0]['cells'][81][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,760,$semana,$data->sheets[0]['cells'][82][2],$data->sheets[0]['cells'][82][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,761,$semana,$data->sheets[0]['cells'][83][2],$data->sheets[0]['cells'][83][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,762,$semana,$data->sheets[0]['cells'][84][2],$data->sheets[0]['cells'][84][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,763,$semana,$data->sheets[0]['cells'][85][2],$data->sheets[0]['cells'][85][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,764,$semana,$data->sheets[0]['cells'][86][2],$data->sheets[0]['cells'][86][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,765,$semana,$data->sheets[0]['cells'][87][2],$data->sheets[0]['cells'][87][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,766,$semana,$data->sheets[0]['cells'][88][2],$data->sheets[0]['cells'][88][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,767,$semana,$data->sheets[0]['cells'][89][2],$data->sheets[0]['cells'][89][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,768,$semana,$data->sheets[0]['cells'][90][2],$data->sheets[0]['cells'][90][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,769,$semana,$data->sheets[0]['cells'][91][2],$data->sheets[0]['cells'][91][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,770,$semana,$data->sheets[0]['cells'][92][2],$data->sheets[0]['cells'][92][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,771,$semana,$data->sheets[0]['cells'][93][2],$data->sheets[0]['cells'][93][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,772,$semana,$data->sheets[0]['cells'][94][2],$data->sheets[0]['cells'][94][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,168,773,$semana,$data->sheets[0]['cells'][95][2],$data->sheets[0]['cells'][95][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,727,$semana,$data->sheets[0]['cells'][97][2],$data->sheets[0]['cells'][97][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,728,$semana,$data->sheets[0]['cells'][98][2],$data->sheets[0]['cells'][98][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,729,$semana,$data->sheets[0]['cells'][99][2],$data->sheets[0]['cells'][99][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,730,$semana,$data->sheets[0]['cells'][100][2],$data->sheets[0]['cells'][100][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,731,$semana,$data->sheets[0]['cells'][101][2],$data->sheets[0]['cells'][101][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,732,$semana,$data->sheets[0]['cells'][102][2],$data->sheets[0]['cells'][102][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,733,$semana,$data->sheets[0]['cells'][103][2],$data->sheets[0]['cells'][103][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,734,$semana,$data->sheets[0]['cells'][104][2],$data->sheets[0]['cells'][104][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,735,$semana,$data->sheets[0]['cells'][105][2],$data->sheets[0]['cells'][105][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,975,$semana,$data->sheets[0]['cells'][106][2],$data->sheets[0]['cells'][106][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,736,$semana,$data->sheets[0]['cells'][107][2],$data->sheets[0]['cells'][107][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,737,$semana,$data->sheets[0]['cells'][108][2],$data->sheets[0]['cells'][108][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,976,$semana,$data->sheets[0]['cells'][109][2],$data->sheets[0]['cells'][109][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,738,$semana,$data->sheets[0]['cells'][110][2],$data->sheets[0]['cells'][110][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,739,$semana,$data->sheets[0]['cells'][111][2],$data->sheets[0]['cells'][111][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,740,$semana,$data->sheets[0]['cells'][112][2],$data->sheets[0]['cells'][112][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,741,$semana,$data->sheets[0]['cells'][113][2],$data->sheets[0]['cells'][113][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,742,$semana,$data->sheets[0]['cells'][114][2],$data->sheets[0]['cells'][114][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,743,$semana,$data->sheets[0]['cells'][115][2],$data->sheets[0]['cells'][115][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,977,$semana,$data->sheets[0]['cells'][116][2],$data->sheets[0]['cells'][116][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,744,$semana,$data->sheets[0]['cells'][117][2],$data->sheets[0]['cells'][117][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,745,$semana,$data->sheets[0]['cells'][118][2],$data->sheets[0]['cells'][118][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,746,$semana,$data->sheets[0]['cells'][119][2],$data->sheets[0]['cells'][119][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,747,$semana,$data->sheets[0]['cells'][120][2],$data->sheets[0]['cells'][120][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,748,$semana,$data->sheets[0]['cells'][121][2],$data->sheets[0]['cells'][121][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,749,$semana,$data->sheets[0]['cells'][122][2],$data->sheets[0]['cells'][122][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,169,750,$semana,$data->sheets[0]['cells'][123][2],$data->sheets[0]['cells'][123][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,751,$semana,$data->sheets[0]['cells'][124][2],$data->sheets[0]['cells'][124][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,752,$semana,$data->sheets[0]['cells'][125][2],$data->sheets[0]['cells'][125][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,753,$semana,$data->sheets[0]['cells'][126][2],$data->sheets[0]['cells'][126][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,754,$semana,$data->sheets[0]['cells'][127][2],$data->sheets[0]['cells'][127][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,755,$semana,$data->sheets[0]['cells'][128][2],$data->sheets[0]['cells'][128][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,756,$semana,$data->sheets[0]['cells'][129][2],$data->sheets[0]['cells'][129][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,757,$semana,$data->sheets[0]['cells'][130][2],$data->sheets[0]['cells'][130][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,758,$semana,$data->sheets[0]['cells'][131][2],$data->sheets[0]['cells'][131][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,759,$semana,$data->sheets[0]['cells'][132][2],$data->sheets[0]['cells'][132][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,760,$semana,$data->sheets[0]['cells'][133][2],$data->sheets[0]['cells'][133][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,761,$semana,$data->sheets[0]['cells'][134][2],$data->sheets[0]['cells'][134][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,762,$semana,$data->sheets[0]['cells'][135][2],$data->sheets[0]['cells'][135][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,763,$semana,$data->sheets[0]['cells'][136][2],$data->sheets[0]['cells'][136][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,764,$semana,$data->sheets[0]['cells'][137][2],$data->sheets[0]['cells'][137][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,765,$semana,$data->sheets[0]['cells'][138][2],$data->sheets[0]['cells'][138][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,766,$semana,$data->sheets[0]['cells'][139][2],$data->sheets[0]['cells'][139][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,767,$semana,$data->sheets[0]['cells'][140][2],$data->sheets[0]['cells'][140][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,768,$semana,$data->sheets[0]['cells'][141][2],$data->sheets[0]['cells'][141][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,769,$semana,$data->sheets[0]['cells'][142][2],$data->sheets[0]['cells'][142][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,770,$semana,$data->sheets[0]['cells'][143][2],$data->sheets[0]['cells'][143][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,771,$semana,$data->sheets[0]['cells'][144][2],$data->sheets[0]['cells'][144][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,772,$semana,$data->sheets[0]['cells'][145][2],$data->sheets[0]['cells'][145][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,170,773,$semana,$data->sheets[0]['cells'][146][2],$data->sheets[0]['cells'][146][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,774,$semana,$data->sheets[0]['cells'][149][2],$data->sheets[0]['cells'][149][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,978,$semana,$data->sheets[0]['cells'][150][2],$data->sheets[0]['cells'][150][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,775,$semana,$data->sheets[0]['cells'][151][2],$data->sheets[0]['cells'][151][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,776,$semana,$data->sheets[0]['cells'][152][2],$data->sheets[0]['cells'][152][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,777,$semana,$data->sheets[0]['cells'][153][2],$data->sheets[0]['cells'][153][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,778,$semana,$data->sheets[0]['cells'][154][2],$data->sheets[0]['cells'][154][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,779,$semana,$data->sheets[0]['cells'][155][2],$data->sheets[0]['cells'][155][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,780,$semana,$data->sheets[0]['cells'][156][2],$data->sheets[0]['cells'][156][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,781,$semana,$data->sheets[0]['cells'][157][2],$data->sheets[0]['cells'][157][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,782,$semana,$data->sheets[0]['cells'][158][2],$data->sheets[0]['cells'][158][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,783,$semana,$data->sheets[0]['cells'][159][2],$data->sheets[0]['cells'][159][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,784,$semana,$data->sheets[0]['cells'][160][2],$data->sheets[0]['cells'][160][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,979,$semana,$data->sheets[0]['cells'][161][2],$data->sheets[0]['cells'][161][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,785,$semana,$data->sheets[0]['cells'][162][2],$data->sheets[0]['cells'][162][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,786,$semana,$data->sheets[0]['cells'][163][2],$data->sheets[0]['cells'][163][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,787,$semana,$data->sheets[0]['cells'][164][2],$data->sheets[0]['cells'][164][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,788,$semana,$data->sheets[0]['cells'][165][2],$data->sheets[0]['cells'][165][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,789,$semana,$data->sheets[0]['cells'][166][2],$data->sheets[0]['cells'][166][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,980,$semana,$data->sheets[0]['cells'][167][2],$data->sheets[0]['cells'][167][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,790,$semana,$data->sheets[0]['cells'][168][2],$data->sheets[0]['cells'][168][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,791,$semana,$data->sheets[0]['cells'][169][2],$data->sheets[0]['cells'][169][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,792,$semana,$data->sheets[0]['cells'][170][2],$data->sheets[0]['cells'][170][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,171,793,$semana,$data->sheets[0]['cells'][171][2],$data->sheets[0]['cells'][171][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,794,$semana,$data->sheets[0]['cells'][172][2],$data->sheets[0]['cells'][172][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,795,$semana,$data->sheets[0]['cells'][173][2],$data->sheets[0]['cells'][173][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,796,$semana,$data->sheets[0]['cells'][174][2],$data->sheets[0]['cells'][174][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,797,$semana,$data->sheets[0]['cells'][175][2],$data->sheets[0]['cells'][175][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,798,$semana,$data->sheets[0]['cells'][176][2],$data->sheets[0]['cells'][176][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,799,$semana,$data->sheets[0]['cells'][177][2],$data->sheets[0]['cells'][177][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,800,$semana,$data->sheets[0]['cells'][178][2],$data->sheets[0]['cells'][178][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,801,$semana,$data->sheets[0]['cells'][179][2],$data->sheets[0]['cells'][179][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,802,$semana,$data->sheets[0]['cells'][180][2],$data->sheets[0]['cells'][180][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,803,$semana,$data->sheets[0]['cells'][181][2],$data->sheets[0]['cells'][181][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,804,$semana,$data->sheets[0]['cells'][182][2],$data->sheets[0]['cells'][182][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,805,$semana,$data->sheets[0]['cells'][183][2],$data->sheets[0]['cells'][183][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,806,$semana,$data->sheets[0]['cells'][184][2],$data->sheets[0]['cells'][184][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,807,$semana,$data->sheets[0]['cells'][185][2],$data->sheets[0]['cells'][185][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,808,$semana,$data->sheets[0]['cells'][186][2],$data->sheets[0]['cells'][186][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,809,$semana,$data->sheets[0]['cells'][187][2],$data->sheets[0]['cells'][187][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,810,$semana,$data->sheets[0]['cells'][188][2],$data->sheets[0]['cells'][188][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,811,$semana,$data->sheets[0]['cells'][189][2],$data->sheets[0]['cells'][189][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,812,$semana,$data->sheets[0]['cells'][190][2],$data->sheets[0]['cells'][190][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,813,$semana,$data->sheets[0]['cells'][191][2],$data->sheets[0]['cells'][191][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,172,814,$semana,$data->sheets[0]['cells'][192][2],$data->sheets[0]['cells'][192][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,774,$semana,$data->sheets[0]['cells'][196][2],$data->sheets[0]['cells'][196][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,978,$semana,$data->sheets[0]['cells'][197][2],$data->sheets[0]['cells'][197][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,775,$semana,$data->sheets[0]['cells'][198][2],$data->sheets[0]['cells'][198][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,776,$semana,$data->sheets[0]['cells'][199][2],$data->sheets[0]['cells'][199][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,777,$semana,$data->sheets[0]['cells'][200][2],$data->sheets[0]['cells'][200][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,778,$semana,$data->sheets[0]['cells'][201][2],$data->sheets[0]['cells'][201][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,779,$semana,$data->sheets[0]['cells'][202][2],$data->sheets[0]['cells'][202][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,780,$semana,$data->sheets[0]['cells'][203][2],$data->sheets[0]['cells'][203][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,781,$semana,$data->sheets[0]['cells'][204][2],$data->sheets[0]['cells'][204][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,782,$semana,$data->sheets[0]['cells'][205][2],$data->sheets[0]['cells'][205][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,783,$semana,$data->sheets[0]['cells'][206][2],$data->sheets[0]['cells'][206][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,784,$semana,$data->sheets[0]['cells'][207][2],$data->sheets[0]['cells'][207][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,979,$semana,$data->sheets[0]['cells'][208][2],$data->sheets[0]['cells'][208][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,785,$semana,$data->sheets[0]['cells'][209][2],$data->sheets[0]['cells'][209][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,786,$semana,$data->sheets[0]['cells'][210][2],$data->sheets[0]['cells'][210][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,787,$semana,$data->sheets[0]['cells'][211][2],$data->sheets[0]['cells'][211][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,788,$semana,$data->sheets[0]['cells'][212][2],$data->sheets[0]['cells'][212][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,789,$semana,$data->sheets[0]['cells'][213][2],$data->sheets[0]['cells'][213][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,980,$semana,$data->sheets[0]['cells'][214][2],$data->sheets[0]['cells'][214][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,790,$semana,$data->sheets[0]['cells'][215][2],$data->sheets[0]['cells'][215][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,791,$semana,$data->sheets[0]['cells'][216][2],$data->sheets[0]['cells'][216][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,792,$semana,$data->sheets[0]['cells'][217][2],$data->sheets[0]['cells'][217][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,173,793,$semana,$data->sheets[0]['cells'][218][2],$data->sheets[0]['cells'][218][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,794,$semana,$data->sheets[0]['cells'][219][2],$data->sheets[0]['cells'][219][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,795,$semana,$data->sheets[0]['cells'][220][2],$data->sheets[0]['cells'][220][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,796,$semana,$data->sheets[0]['cells'][221][2],$data->sheets[0]['cells'][221][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,797,$semana,$data->sheets[0]['cells'][222][2],$data->sheets[0]['cells'][222][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,798,$semana,$data->sheets[0]['cells'][223][2],$data->sheets[0]['cells'][223][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,799,$semana,$data->sheets[0]['cells'][224][2],$data->sheets[0]['cells'][224][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,800,$semana,$data->sheets[0]['cells'][225][2],$data->sheets[0]['cells'][225][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,801,$semana,$data->sheets[0]['cells'][226][2],$data->sheets[0]['cells'][226][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,802,$semana,$data->sheets[0]['cells'][227][2],$data->sheets[0]['cells'][227][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,803,$semana,$data->sheets[0]['cells'][228][2],$data->sheets[0]['cells'][228][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,804,$semana,$data->sheets[0]['cells'][229][2],$data->sheets[0]['cells'][229][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,805,$semana,$data->sheets[0]['cells'][230][2],$data->sheets[0]['cells'][230][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,806,$semana,$data->sheets[0]['cells'][231][2],$data->sheets[0]['cells'][231][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,807,$semana,$data->sheets[0]['cells'][232][2],$data->sheets[0]['cells'][232][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,808,$semana,$data->sheets[0]['cells'][233][2],$data->sheets[0]['cells'][233][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,809,$semana,$data->sheets[0]['cells'][234][2],$data->sheets[0]['cells'][234][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,810,$semana,$data->sheets[0]['cells'][235][2],$data->sheets[0]['cells'][235][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,811,$semana,$data->sheets[0]['cells'][236][2],$data->sheets[0]['cells'][236][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,812,$semana,$data->sheets[0]['cells'][237][2],$data->sheets[0]['cells'][237][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,813,$semana,$data->sheets[0]['cells'][238][2],$data->sheets[0]['cells'][238][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,174,814,$semana,$data->sheets[0]['cells'][239][2],$data->sheets[0]['cells'][239][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,175,815,$semana,$data->sheets[0]['cells'][244][2],$data->sheets[0]['cells'][244][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,175,816,$semana,$data->sheets[0]['cells'][245][2],$data->sheets[0]['cells'][245][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,175,817,$semana,$data->sheets[0]['cells'][246][2],$data->sheets[0]['cells'][246][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,175,818,$semana,$data->sheets[0]['cells'][247][2],$data->sheets[0]['cells'][247][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,175,819,$semana,$data->sheets[0]['cells'][248][2],$data->sheets[0]['cells'][248][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,175,820,$semana,$data->sheets[0]['cells'][249][2],$data->sheets[0]['cells'][249][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,176,815,$semana,$data->sheets[0]['cells'][251][2],$data->sheets[0]['cells'][251][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,176,816,$semana,$data->sheets[0]['cells'][252][2],$data->sheets[0]['cells'][252][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,176,817,$semana,$data->sheets[0]['cells'][253][2],$data->sheets[0]['cells'][253][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,176,818,$semana,$data->sheets[0]['cells'][254][2],$data->sheets[0]['cells'][254][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,176,819,$semana,$data->sheets[0]['cells'][255][2],$data->sheets[0]['cells'][255][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,176,820,$semana,$data->sheets[0]['cells'][256][2],$data->sheets[0]['cells'][256][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,177,815,$semana,$data->sheets[0]['cells'][258][2],$data->sheets[0]['cells'][258][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,177,816,$semana,$data->sheets[0]['cells'][259][2],$data->sheets[0]['cells'][259][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,177,817,$semana,$data->sheets[0]['cells'][260][2],$data->sheets[0]['cells'][260][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,177,818,$semana,$data->sheets[0]['cells'][261][2],$data->sheets[0]['cells'][261][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,177,819,$semana,$data->sheets[0]['cells'][262][2],$data->sheets[0]['cells'][262][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,177,820,$semana,$data->sheets[0]['cells'][263][2],$data->sheets[0]['cells'][263][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,178,821,$semana,$data->sheets[0]['cells'][266][2],$data->sheets[0]['cells'][266][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,178,822,$semana,$data->sheets[0]['cells'][267][2],$data->sheets[0]['cells'][267][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,178,823,$semana,$data->sheets[0]['cells'][268][2],$data->sheets[0]['cells'][268][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,178,824,$semana,$data->sheets[0]['cells'][269][2],$data->sheets[0]['cells'][269][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,178,825,$semana,$data->sheets[0]['cells'][270][2],$data->sheets[0]['cells'][270][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,178,826,$semana,$data->sheets[0]['cells'][271][2],$data->sheets[0]['cells'][271][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,179,821,$semana,$data->sheets[0]['cells'][273][2],$data->sheets[0]['cells'][273][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,179,822,$semana,$data->sheets[0]['cells'][274][2],$data->sheets[0]['cells'][274][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,179,823,$semana,$data->sheets[0]['cells'][275][2],$data->sheets[0]['cells'][275][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,179,824,$semana,$data->sheets[0]['cells'][276][2],$data->sheets[0]['cells'][276][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,179,825,$semana,$data->sheets[0]['cells'][277][2],$data->sheets[0]['cells'][277][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,179,826,$semana,$data->sheets[0]['cells'][278][2],$data->sheets[0]['cells'][278][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,180,821,$semana,$data->sheets[0]['cells'][280][2],$data->sheets[0]['cells'][280][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,180,822,$semana,$data->sheets[0]['cells'][281][2],$data->sheets[0]['cells'][281][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,180,825,$semana,$data->sheets[0]['cells'][282][2],$data->sheets[0]['cells'][282][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,180,826,$semana,$data->sheets[0]['cells'][283][2],$data->sheets[0]['cells'][283][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,181,827,$semana,$data->sheets[0]['cells'][286][2],$data->sheets[0]['cells'][286][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,181,828,$semana,$data->sheets[0]['cells'][287][2],$data->sheets[0]['cells'][287][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,181,829,$semana,$data->sheets[0]['cells'][288][2],$data->sheets[0]['cells'][288][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,182,827,$semana,$data->sheets[0]['cells'][290][2],$data->sheets[0]['cells'][290][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,182,828,$semana,$data->sheets[0]['cells'][291][2],$data->sheets[0]['cells'][291][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,182,829,$semana,$data->sheets[0]['cells'][292][2],$data->sheets[0]['cells'][292][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,181,830,$semana,$data->sheets[0]['cells'][295][2],$data->sheets[0]['cells'][295][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,181,831,$semana,$data->sheets[0]['cells'][296][2],$data->sheets[0]['cells'][296][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,181,832,$semana,$data->sheets[0]['cells'][297][2],$data->sheets[0]['cells'][297][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,181,833,$semana,$data->sheets[0]['cells'][298][2],$data->sheets[0]['cells'][298][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,182,830,$semana,$data->sheets[0]['cells'][300][2],$data->sheets[0]['cells'][300][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,182,831,$semana,$data->sheets[0]['cells'][301][2],$data->sheets[0]['cells'][301][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,182,832,$semana,$data->sheets[0]['cells'][302][2],$data->sheets[0]['cells'][302][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,182,833,$semana,$data->sheets[0]['cells'][303][2],$data->sheets[0]['cells'][303][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,181,834,$semana,$data->sheets[0]['cells'][306][2],$data->sheets[0]['cells'][306][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,181,835,$semana,$data->sheets[0]['cells'][307][2],$data->sheets[0]['cells'][307][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,182,834,$semana,$data->sheets[0]['cells'][309][2],$data->sheets[0]['cells'][309][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,182,835,$semana,$data->sheets[0]['cells'][310][2],$data->sheets[0]['cells'][310][4]));
           
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,836,$semana,$data->sheets[0]['cells'][313][2],$data->sheets[0]['cells'][313][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,837,$semana,$data->sheets[0]['cells'][314][2],$data->sheets[0]['cells'][314][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,838,$semana,$data->sheets[0]['cells'][315][2],$data->sheets[0]['cells'][315][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,839,$semana,$data->sheets[0]['cells'][316][2],$data->sheets[0]['cells'][316][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,840,$semana,$data->sheets[0]['cells'][317][2],$data->sheets[0]['cells'][317][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,841,$semana,$data->sheets[0]['cells'][318][2],$data->sheets[0]['cells'][318][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,842,$semana,$data->sheets[0]['cells'][319][2],$data->sheets[0]['cells'][319][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,843,$semana,$data->sheets[0]['cells'][320][2],$data->sheets[0]['cells'][320][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,844,$semana,$data->sheets[0]['cells'][321][2],$data->sheets[0]['cells'][321][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,845,$semana,$data->sheets[0]['cells'][322][2],$data->sheets[0]['cells'][322][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,846,$semana,$data->sheets[0]['cells'][323][2],$data->sheets[0]['cells'][323][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,847,$semana,$data->sheets[0]['cells'][324][2],$data->sheets[0]['cells'][324][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,848,$semana,$data->sheets[0]['cells'][325][2],$data->sheets[0]['cells'][325][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,849,$semana,$data->sheets[0]['cells'][326][2],$data->sheets[0]['cells'][326][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,850,$semana,$data->sheets[0]['cells'][327][2],$data->sheets[0]['cells'][327][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,851,$semana,$data->sheets[0]['cells'][328][2],$data->sheets[0]['cells'][328][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,183,852,$semana,$data->sheets[0]['cells'][329][2],$data->sheets[0]['cells'][329][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,853,$semana,$data->sheets[0]['cells'][330][2],$data->sheets[0]['cells'][330][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,854,$semana,$data->sheets[0]['cells'][331][2],$data->sheets[0]['cells'][331][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,855,$semana,$data->sheets[0]['cells'][332][2],$data->sheets[0]['cells'][332][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,856,$semana,$data->sheets[0]['cells'][333][2],$data->sheets[0]['cells'][333][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,857,$semana,$data->sheets[0]['cells'][334][2],$data->sheets[0]['cells'][334][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,858,$semana,$data->sheets[0]['cells'][335][2],$data->sheets[0]['cells'][335][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,859,$semana,$data->sheets[0]['cells'][336][2],$data->sheets[0]['cells'][336][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,860,$semana,$data->sheets[0]['cells'][337][2],$data->sheets[0]['cells'][337][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,861,$semana,$data->sheets[0]['cells'][338][2],$data->sheets[0]['cells'][338][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,862,$semana,$data->sheets[0]['cells'][339][2],$data->sheets[0]['cells'][339][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,863,$semana,$data->sheets[0]['cells'][340][2],$data->sheets[0]['cells'][340][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,864,$semana,$data->sheets[0]['cells'][341][2],$data->sheets[0]['cells'][341][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,865,$semana,$data->sheets[0]['cells'][342][2],$data->sheets[0]['cells'][342][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,866,$semana,$data->sheets[0]['cells'][343][2],$data->sheets[0]['cells'][343][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,867,$semana,$data->sheets[0]['cells'][344][2],$data->sheets[0]['cells'][344][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,868,$semana,$data->sheets[0]['cells'][345][2],$data->sheets[0]['cells'][345][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,184,869,$semana,$data->sheets[0]['cells'][346][2],$data->sheets[0]['cells'][346][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,836,$semana,$data->sheets[0]['cells'][348][2],$data->sheets[0]['cells'][348][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,837,$semana,$data->sheets[0]['cells'][349][2],$data->sheets[0]['cells'][349][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,838,$semana,$data->sheets[0]['cells'][350][2],$data->sheets[0]['cells'][350][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,839,$semana,$data->sheets[0]['cells'][351][2],$data->sheets[0]['cells'][351][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,840,$semana,$data->sheets[0]['cells'][352][2],$data->sheets[0]['cells'][352][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,841,$semana,$data->sheets[0]['cells'][353][2],$data->sheets[0]['cells'][353][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,842,$semana,$data->sheets[0]['cells'][354][2],$data->sheets[0]['cells'][354][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,843,$semana,$data->sheets[0]['cells'][355][2],$data->sheets[0]['cells'][355][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,844,$semana,$data->sheets[0]['cells'][356][2],$data->sheets[0]['cells'][356][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,845,$semana,$data->sheets[0]['cells'][357][2],$data->sheets[0]['cells'][357][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,846,$semana,$data->sheets[0]['cells'][358][2],$data->sheets[0]['cells'][358][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,847,$semana,$data->sheets[0]['cells'][359][2],$data->sheets[0]['cells'][359][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,848,$semana,$data->sheets[0]['cells'][360][2],$data->sheets[0]['cells'][360][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,849,$semana,$data->sheets[0]['cells'][361][2],$data->sheets[0]['cells'][361][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,850,$semana,$data->sheets[0]['cells'][362][2],$data->sheets[0]['cells'][362][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,851,$semana,$data->sheets[0]['cells'][363][2],$data->sheets[0]['cells'][363][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,185,852,$semana,$data->sheets[0]['cells'][364][2],$data->sheets[0]['cells'][364][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,853,$semana,$data->sheets[0]['cells'][365][2],$data->sheets[0]['cells'][365][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,854,$semana,$data->sheets[0]['cells'][366][2],$data->sheets[0]['cells'][366][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,855,$semana,$data->sheets[0]['cells'][367][2],$data->sheets[0]['cells'][367][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,856,$semana,$data->sheets[0]['cells'][368][2],$data->sheets[0]['cells'][368][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,857,$semana,$data->sheets[0]['cells'][369][2],$data->sheets[0]['cells'][369][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,858,$semana,$data->sheets[0]['cells'][370][2],$data->sheets[0]['cells'][370][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,859,$semana,$data->sheets[0]['cells'][371][2],$data->sheets[0]['cells'][371][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,860,$semana,$data->sheets[0]['cells'][372][2],$data->sheets[0]['cells'][372][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,861,$semana,$data->sheets[0]['cells'][373][2],$data->sheets[0]['cells'][373][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,862,$semana,$data->sheets[0]['cells'][374][2],$data->sheets[0]['cells'][374][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,863,$semana,$data->sheets[0]['cells'][375][2],$data->sheets[0]['cells'][375][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,864,$semana,$data->sheets[0]['cells'][376][2],$data->sheets[0]['cells'][376][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,865,$semana,$data->sheets[0]['cells'][377][2],$data->sheets[0]['cells'][377][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,866,$semana,$data->sheets[0]['cells'][378][2],$data->sheets[0]['cells'][378][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,867,$semana,$data->sheets[0]['cells'][379][2],$data->sheets[0]['cells'][379][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,868,$semana,$data->sheets[0]['cells'][380][2],$data->sheets[0]['cells'][380][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,186,869,$semana,$data->sheets[0]['cells'][381][2],$data->sheets[0]['cells'][381][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,187,836,$semana,$data->sheets[0]['cells'][383][2],$data->sheets[0]['cells'][383][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,187,837,$semana,$data->sheets[0]['cells'][384][2],$data->sheets[0]['cells'][384][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,187,838,$semana,$data->sheets[0]['cells'][385][2],$data->sheets[0]['cells'][385][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,187,839,$semana,$data->sheets[0]['cells'][386][2],$data->sheets[0]['cells'][386][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,187,840,$semana,$data->sheets[0]['cells'][387][2],$data->sheets[0]['cells'][387][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,187,841,$semana,$data->sheets[0]['cells'][388][2],$data->sheets[0]['cells'][388][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,187,842,$semana,$data->sheets[0]['cells'][389][2],$data->sheets[0]['cells'][389][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,187,843,$semana,$data->sheets[0]['cells'][390][2],$data->sheets[0]['cells'][390][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,188,870,$semana,$data->sheets[0]['cells'][393][2],$data->sheets[0]['cells'][393][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,188,871,$semana,$data->sheets[0]['cells'][394][2],$data->sheets[0]['cells'][394][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,188,872,$semana,$data->sheets[0]['cells'][395][2],$data->sheets[0]['cells'][395][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,188,873,$semana,$data->sheets[0]['cells'][396][2],$data->sheets[0]['cells'][396][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,188,874,$semana,$data->sheets[0]['cells'][397][2],$data->sheets[0]['cells'][397][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,188,875,$semana,$data->sheets[0]['cells'][398][2],$data->sheets[0]['cells'][398][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,188,876,$semana,$data->sheets[0]['cells'][399][2],$data->sheets[0]['cells'][399][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,188,877,$semana,$data->sheets[0]['cells'][400][2],$data->sheets[0]['cells'][400][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,189,870,$semana,$data->sheets[0]['cells'][402][2],$data->sheets[0]['cells'][402][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,189,871,$semana,$data->sheets[0]['cells'][403][2],$data->sheets[0]['cells'][403][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,189,872,$semana,$data->sheets[0]['cells'][404][2],$data->sheets[0]['cells'][404][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,189,873,$semana,$data->sheets[0]['cells'][405][2],$data->sheets[0]['cells'][405][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,189,874,$semana,$data->sheets[0]['cells'][406][2],$data->sheets[0]['cells'][406][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,189,875,$semana,$data->sheets[0]['cells'][407][2],$data->sheets[0]['cells'][407][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,189,876,$semana,$data->sheets[0]['cells'][408][2],$data->sheets[0]['cells'][408][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,189,877,$semana,$data->sheets[0]['cells'][409][2],$data->sheets[0]['cells'][409][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,190,876,$semana,$data->sheets[0]['cells'][411][2],$data->sheets[0]['cells'][411][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,190,877,$semana,$data->sheets[0]['cells'][412][2],$data->sheets[0]['cells'][412][4]));
            

            }catch(Exception $e)

            {
                $respuesta= $e;
            };

            } else {$respuesta =  "La semana seleccionada no coincide con la semana en el archivo o la semana en el nombre del archivo" ;};

            return $respuesta;


            //echo '<script language="javascript">alert("'.$respuesta.'");</script>'; 
            //echo "<script> location.href='http://10.30.17.62:80/Entel/public/index.php/DatosDatos'; </script>";

    }

    public function posttransporte(){
            

            $filename = $_FILES['sel_file']['tmp_name'];
            $fname = $_FILES['sel_file']['name'];

            $data = new Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('CP1251');
            $data->read($filename);
            
            // semana y anÃ±o del excel
            $week=$data->sheets[0]['cells'][1][4];

            if (strlen($week) == 1) {
                $week="0".$week;
            }

            $year=$data->sheets[0]['cells'][1][6];
            $anho_semana=$year."".$week;
            //
            //echo "anho_semana del excel".$anho_semana;

            $week2=$_POST['semanac']; // semana concatenada
            $year2=$_POST['anhosc']; // aÃ±o solito del select
            //echo "wee2 ".$week2;
            
            $chk2 = explode("_", $fname);  
            $chk3 = end($chk2);
            $chk4 = explode(".", $chk3);
            // aÃ±o y semana concatenados, la semana es la que aparece en el nombre del archivo
            $week3= $year2."".$chk4[0];         

            if ($anho_semana == $week2 && $week2 == $week3 ) {
                # code...
            

            $semana=$week2;
            //echo $semana;
            $id_supervision=$_POST['id_tec'];

            //echo $id_supervision;
            
           
            try {

            //DB::INSERT("INSERT INTO semana_superv (id_suprv,anho,semana,anho_semana) values (?,?,?,?);",array( $id_supervision,$year2,$week,$anho_semana));
            
           

            $target_path = "documentos/transporte/";
            $target_path = $target_path . basename( $_FILES['sel_file']['name']); 
            $target_path_2 = "../".$target_path;
            $fecha_registro=date("Y-m-d H:i:s");
            if(move_uploaded_file($_FILES['sel_file']['tmp_name'], $target_path)) { 
                //echo "El archivo ". basename( $_FILES['sel_file']['name']). " ha sido subido";

                DB::INSERT("INSERT INTO documentos (id_superv,nombre,ruta,fecha_registro,usuario,semana) values (?,?,?,?,?,?)",array($id_supervision,basename( $_FILES['sel_file']['name']),$target_path_2,$fecha_registro,$_SESSION['usuario'],$anho_semana));              

                $respuesta =  "Datos cargados a la BD, archivo: ".$fname.", Transporte" ;
            } else{
                $respuesta= "Ha ocurrido un error, trate de nuevo!";
            }

             

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,981,$semana,$data->sheets[0]['cells'][6][2],$data->sheets[0]['cells'][6][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,982,$semana,$data->sheets[0]['cells'][7][2],$data->sheets[0]['cells'][7][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,983,$semana,$data->sheets[0]['cells'][8][2],$data->sheets[0]['cells'][8][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,984,$semana,$data->sheets[0]['cells'][9][2],$data->sheets[0]['cells'][9][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,985,$semana,$data->sheets[0]['cells'][10][2],$data->sheets[0]['cells'][10][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,986,$semana,$data->sheets[0]['cells'][11][2],$data->sheets[0]['cells'][11][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,987,$semana,$data->sheets[0]['cells'][12][2],$data->sheets[0]['cells'][12][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,988,$semana,$data->sheets[0]['cells'][13][2],$data->sheets[0]['cells'][13][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,989,$semana,$data->sheets[0]['cells'][14][2],$data->sheets[0]['cells'][14][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,990,$semana,$data->sheets[0]['cells'][15][2],$data->sheets[0]['cells'][15][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,991,$semana,$data->sheets[0]['cells'][16][2],$data->sheets[0]['cells'][16][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,992,$semana,$data->sheets[0]['cells'][17][2],$data->sheets[0]['cells'][17][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,993,$semana,$data->sheets[0]['cells'][18][2],$data->sheets[0]['cells'][18][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,193,994,$semana,$data->sheets[0]['cells'][19][2],$data->sheets[0]['cells'][19][4]));

            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,995,$semana,$data->sheets[0]['cells'][21][2],$data->sheets[0]['cells'][21][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,996,$semana,$data->sheets[0]['cells'][22][2],$data->sheets[0]['cells'][22][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,997,$semana,$data->sheets[0]['cells'][23][2],$data->sheets[0]['cells'][23][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,998,$semana,$data->sheets[0]['cells'][24][2],$data->sheets[0]['cells'][24][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,999,$semana,$data->sheets[0]['cells'][25][2],$data->sheets[0]['cells'][25][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,1000,$semana,$data->sheets[0]['cells'][26][2],$data->sheets[0]['cells'][26][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,1001,$semana,$data->sheets[0]['cells'][27][2],$data->sheets[0]['cells'][27][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,1002,$semana,$data->sheets[0]['cells'][28][2],$data->sheets[0]['cells'][28][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,1003,$semana,$data->sheets[0]['cells'][29][2],$data->sheets[0]['cells'][29][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,1004,$semana,$data->sheets[0]['cells'][30][2],$data->sheets[0]['cells'][30][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,1005,$semana,$data->sheets[0]['cells'][31][2],$data->sheets[0]['cells'][31][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,194,1006,$semana,$data->sheets[0]['cells'][32][2],$data->sheets[0]['cells'][32][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1007,$semana,$data->sheets[0]['cells'][34][2],$data->sheets[0]['cells'][34][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1008,$semana,$data->sheets[0]['cells'][35][2],$data->sheets[0]['cells'][35][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1009,$semana,$data->sheets[0]['cells'][36][2],$data->sheets[0]['cells'][36][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1010,$semana,$data->sheets[0]['cells'][37][2],$data->sheets[0]['cells'][37][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1011,$semana,$data->sheets[0]['cells'][38][2],$data->sheets[0]['cells'][38][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1012,$semana,$data->sheets[0]['cells'][39][2],$data->sheets[0]['cells'][39][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1013,$semana,$data->sheets[0]['cells'][40][2],$data->sheets[0]['cells'][40][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1014,$semana,$data->sheets[0]['cells'][41][2],$data->sheets[0]['cells'][41][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1015,$semana,$data->sheets[0]['cells'][42][2],$data->sheets[0]['cells'][42][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1016,$semana,$data->sheets[0]['cells'][43][2],$data->sheets[0]['cells'][43][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1017,$semana,$data->sheets[0]['cells'][44][2],$data->sheets[0]['cells'][44][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1018,$semana,$data->sheets[0]['cells'][45][2],$data->sheets[0]['cells'][45][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,195,1019,$semana,$data->sheets[0]['cells'][46][2],$data->sheets[0]['cells'][46][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,196,1020,$semana,$data->sheets[0]['cells'][49][2],$data->sheets[0]['cells'][49][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,196,1021,$semana,$data->sheets[0]['cells'][50][2],$data->sheets[0]['cells'][50][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,196,1022,$semana,$data->sheets[0]['cells'][51][2],$data->sheets[0]['cells'][51][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,196,1023,$semana,$data->sheets[0]['cells'][52][2],$data->sheets[0]['cells'][52][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,196,1024,$semana,$data->sheets[0]['cells'][53][2],$data->sheets[0]['cells'][53][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,196,1025,$semana,$data->sheets[0]['cells'][54][2],$data->sheets[0]['cells'][54][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,196,1026,$semana,$data->sheets[0]['cells'][55][2],$data->sheets[0]['cells'][55][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,196,1027,$semana,$data->sheets[0]['cells'][56][2],$data->sheets[0]['cells'][56][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,196,1028,$semana,$data->sheets[0]['cells'][57][2],$data->sheets[0]['cells'][57][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,197,1029,$semana,$data->sheets[0]['cells'][59][2],$data->sheets[0]['cells'][59][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,197,1030,$semana,$data->sheets[0]['cells'][60][2],$data->sheets[0]['cells'][60][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,197,1031,$semana,$data->sheets[0]['cells'][61][2],$data->sheets[0]['cells'][61][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,197,1032,$semana,$data->sheets[0]['cells'][62][2],$data->sheets[0]['cells'][62][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,197,1033,$semana,$data->sheets[0]['cells'][63][2],$data->sheets[0]['cells'][63][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,197,1034,$semana,$data->sheets[0]['cells'][64][2],$data->sheets[0]['cells'][64][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,197,1035,$semana,$data->sheets[0]['cells'][65][2],$data->sheets[0]['cells'][65][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,197,1036,$semana,$data->sheets[0]['cells'][66][2],$data->sheets[0]['cells'][66][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,197,1037,$semana,$data->sheets[0]['cells'][67][2],$data->sheets[0]['cells'][67][4]));
             
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1038,$semana,$data->sheets[0]['cells'][70][2],$data->sheets[0]['cells'][70][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1039,$semana,$data->sheets[0]['cells'][71][2],$data->sheets[0]['cells'][71][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1040,$semana,$data->sheets[0]['cells'][72][2],$data->sheets[0]['cells'][72][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1041,$semana,$data->sheets[0]['cells'][73][2],$data->sheets[0]['cells'][73][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1042,$semana,$data->sheets[0]['cells'][74][2],$data->sheets[0]['cells'][74][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1043,$semana,$data->sheets[0]['cells'][75][2],$data->sheets[0]['cells'][75][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1044,$semana,$data->sheets[0]['cells'][76][2],$data->sheets[0]['cells'][76][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1045,$semana,$data->sheets[0]['cells'][77][2],$data->sheets[0]['cells'][77][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1046,$semana,$data->sheets[0]['cells'][78][2],$data->sheets[0]['cells'][78][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1047,$semana,$data->sheets[0]['cells'][79][2],$data->sheets[0]['cells'][79][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,198,1048,$semana,$data->sheets[0]['cells'][80][2],$data->sheets[0]['cells'][80][4]));
            
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1049,$semana,$data->sheets[0]['cells'][82][2],$data->sheets[0]['cells'][82][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1050,$semana,$data->sheets[0]['cells'][83][2],$data->sheets[0]['cells'][83][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1051,$semana,$data->sheets[0]['cells'][84][2],$data->sheets[0]['cells'][84][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1052,$semana,$data->sheets[0]['cells'][85][2],$data->sheets[0]['cells'][85][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1053,$semana,$data->sheets[0]['cells'][86][2],$data->sheets[0]['cells'][86][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1054,$semana,$data->sheets[0]['cells'][87][2],$data->sheets[0]['cells'][87][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1055,$semana,$data->sheets[0]['cells'][88][2],$data->sheets[0]['cells'][88][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1056,$semana,$data->sheets[0]['cells'][89][2],$data->sheets[0]['cells'][89][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1057,$semana,$data->sheets[0]['cells'][90][2],$data->sheets[0]['cells'][90][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,199,1058,$semana,$data->sheets[0]['cells'][91][2],$data->sheets[0]['cells'][91][4]));
              
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1059,$semana,$data->sheets[0]['cells'][94][2],$data->sheets[0]['cells'][94][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1060,$semana,$data->sheets[0]['cells'][95][2],$data->sheets[0]['cells'][95][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1061,$semana,$data->sheets[0]['cells'][96][2],$data->sheets[0]['cells'][96][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1062,$semana,$data->sheets[0]['cells'][97][2],$data->sheets[0]['cells'][97][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1063,$semana,$data->sheets[0]['cells'][98][2],$data->sheets[0]['cells'][98][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1064,$semana,$data->sheets[0]['cells'][99][2],$data->sheets[0]['cells'][99][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1065,$semana,$data->sheets[0]['cells'][100][2],$data->sheets[0]['cells'][100][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1066,$semana,$data->sheets[0]['cells'][101][2],$data->sheets[0]['cells'][101][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1067,$semana,$data->sheets[0]['cells'][102][2],$data->sheets[0]['cells'][102][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1068,$semana,$data->sheets[0]['cells'][103][2],$data->sheets[0]['cells'][103][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1069,$semana,$data->sheets[0]['cells'][104][2],$data->sheets[0]['cells'][104][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1070,$semana,$data->sheets[0]['cells'][105][2],$data->sheets[0]['cells'][105][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1071,$semana,$data->sheets[0]['cells'][106][2],$data->sheets[0]['cells'][106][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1072,$semana,$data->sheets[0]['cells'][107][2],$data->sheets[0]['cells'][107][4]));
            DB::INSERT("INSERT INTO producto (idsupervisiones,idgraficas,idelementos,semana,valor,comentario) values (?,?,?,?,?,?)",array($id_supervision,200,1073,$semana,$data->sheets[0]['cells'][108][2],$data->sheets[0]['cells'][108][4]));
            

            }catch(Exception $e)

            {
                $respuesta= $e;
            };

            } else {$respuesta =  "La semana seleccionada no coincide con la semana en el archivo o la semana en el nombre del archivo" ;};

            return $respuesta;


            //echo '<script language="javascript">alert("'.$respuesta.'");</script>'; 
            //echo "<script> location.href='http://10.30.17.62:80/Entel/public/index.php/DatosDatos'; </script>";

    }

       

    
}