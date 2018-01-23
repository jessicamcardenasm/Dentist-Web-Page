<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"anho"=>"year",
"semI"=>"semana",
"semF"=>"semana"
);


function conectar()
{
	mysql_connect("127.0.0.1","root","");
	mysql_select_db("cockpit_entel");
}

function desconectar()
{
	mysql_close();
}




function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}



$selectDestino=$_GET["select1"]; $opcionSeleccionada=$_GET["opcion1"];

//echo "select Destino ".$selectDestino;
//echo "opcion seleccionada".$opcionSeleccionada;

if(validaSelect($selectDestino))
{
	$tabla=$listadoSelects[$selectDestino];
	
	conectar();

//	echo $selectDestino;


	if ($selectDestino == "semI") {
		$consulta=mysql_query("SELECT id, week FROM $tabla WHERE year='$opcionSeleccionada'") or die(mysql_error());
		

	}


//	echo $selectDestino;

	if ($selectDestino == "semF") {
		$consulta=mysql_query("SELECT id, week FROM $tabla WHERE week>'$opcionSeleccionada'") or die(mysql_error());
//		echo "bingo!";
	}
	


	
	desconectar();
	
	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' id='".$selectDestino."' class='form-control' required='required' style='width:200px;'  onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Seleccionar semana ... </option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[1]."'>".$registro[1]."</option>";
	}			
	echo "</select>";
}
?>