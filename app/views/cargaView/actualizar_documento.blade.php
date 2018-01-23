<html>
<head>
  {{HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');}}
  {{HTML::script('assets/js/jquery.alerts.js');}}
  {{HTML::script('assets/js/jquery.ui.draggable.js');}}
  {{HTML::style('assets/css/jquery.alerts.css');}}
  {{HTML::style('assets/css/bootstrap.css');}}
  {{HTML::script('assets/js/bootstrap.min.js');}}
  {{HTML::script('assets/js/bootbox.min.js');}}
  
<title> Actualizar </title>

</head>

<body>

<div  style="position:relative;left:20px"> <h4> <font color="orange">Actualizar documento semana <?php echo $_GET['semana']; ?></font></h4></div>
<hr>

 

    <div id="demoMed" style="position:absolute;left:30px; color: #076EDC;">

    <form id='FormActualizarDocumento' name='FormActualizarDocumento' action='postDataActualizar' method='post' enctype="multipart/form-data">
	    <input  type='file' name='sel_file' size='20'>
	    <input type="hidden" id="semanac" name="semanac" value="<?php echo $_GET['semana'];?>">
	    <input type="hidden" id="id_documento" name="id_documento" value="<?php echo $_GET['id_documento'];?>">
	    <input type="hidden" id="id_tec" name="id_tec" value="<?php echo $_GET['id_superv'];?>">
	     <input type="hidden" id="anhosc" name="anhosc" value="<?php $anho=substr($_GET['semana'], 0, 4); echo $anho?>">
	    
	    <p></p> 
	    <button type="button" class="btn btn-primary">Submit</button>
	</form>
      

    </div>

    <p></p>

<script type="text/javascript">
$(function(){

 $(".btn").on('click', function() {

 	var semana = "<?php echo $_GET['semana']; ?>" ;
 	var id_documento = "<?php echo $_GET['id_documento']; ?>" ;
 	var id_superv = "<?php echo $_GET['id_superv']; ?>" ;

	bootbox.confirm({
	    message: '¿Esta seguro de actualizar el archivo y los datos de la semana '+semana+'?',
	    buttons: {
	        confirm: {
	            label: 'Si',
	            className: 'btn-success'
	        },
	        cancel: {
	            label: 'No',
	            className: 'btn-danger'
	        }
	    },
	    callback: function (result) {
        
        	if (result) {
        		console.log('sí')
        		var fichero=document.forms.FormActualizarDocumento.sel_file;
        		//console.log(fichero.value);

        		if (fichero.value!="") {
	        		$.get("http://127.0.0.1/Entel/public/index.php/postEliminar", {"semana": semana, "id_documento": id_documento, "id_superv": id_superv}, function(respuesta) {})
	        		//bootbox.alert(respuesta,function(){location.reload();});});
					document.forms.FormActualizarDocumento.submit()
	        		
	        		//bootbox.alert("Datos actualizados correctamente",function(){location.reload()})
        		} else{bootbox.alert("No existe archivo adjunto",function(){location.reload()})
        		}
        	


        	} else{
        		console.log('no')

        	}

    	}

    })

})

})

</script>

</body>
</html>
	