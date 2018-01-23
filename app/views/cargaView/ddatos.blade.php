@extends('../ViewParent')


@section('ddatos')
@parent


<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide-full.min.js"></script>
<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="http://www.highcharts.com/highslide/highslide.css" />
<script> var idSup= <?php echo $id_tec; ?>;</script>
<section class="wrapper">

          <section id="main-content">


               <section class="wrapper">
                <h3 >  

                	<?php 
					    echo $nombre;
					?>

               
                <p></p>

                <hr>
                <h4><font color="orange">Plantilla: &nbsp; &nbsp; <a style="color: #428bca;" target="_blanck" href="<?php echo $ruta; ?>" download='<?php echo $nombre_p; ?>'><?php echo $nombre_p; ?></a></font></h4>


                <hr>
                <br>
                
                <h4><b>Cargar datos:</b></h4>
               

                	<div class="form-group">
					    <form action='postData' method='post' enctype="multipart/form-data">

					    <div style=" width:1000px">
					    	
					    	

				            <div style= "float: left; margin: 10px;">

					           <?php 

				              echo "<select name='anhosc'   style='width:200px;' id='anhosc' class='form-control' >";
				              echo "<option value='' disabled selected > Año  </option>";
				  
				              echo "{{";

				              foreach ($anhos as $a){ 
				                echo    "<option value={$a["year"]}>{$a["year"]}</option>";
				                };
				              echo "}}";
				              echo "</select>";  
				            ?>
				            </div>



				            <div style= "float: left; margin: 10px;">

					            <select name="semanac" style='width:200px;' id='semanac' class='form-control'>
					            	<option value="" disable selected> Semana </option>
					            	
					            </select>
				            </div>

				            <div style= "float: left; margin: 10px;">
					            <input  type='file' name='sel_file' size='20'>
							   <br>
							   <input type="hidden" id="id_tec" name="id_tec" value="<?php echo $id_tec;?>">
							</div>
								<input type="hidden" id="respuest_eliminar" name="respuesta_eliminarc" value="0">
							<div style= "float: left; margin: 10px;">
							   <input class='btn btn-primary' type='submit' name='submit' id='submit' value='submit' disabled="true">
						    </div>
						    <br>
						   	<br>
						   	<br>
						   	
				            
				        </div>

				     	</form>
				    </div>
				 
				 <hr>


				<center>

					<div name="tabla" id="tabla" class="table-responsive">
					</div>

				</center>
				
				</section>

			</section>

</section>

<script type="text/javascript" src={{asset('assets/js/SelectMultiple/Select.js');}}></script>
<script type="text/javascript" src={{asset('assets/js/Actualizar/Actualizar.js');}}></script>
  

<script>
  	$(document).ready(function () {

  		$.get(ip+"getDocumentos", {"idSup": idSup }).done(function(data){

  						  //console.log(data);
		        		  
		                  var n_data=data["data"].length;
		                  //console.log(n_data);
						  var html='';
							html += '<table id="tabla_documentos" name="tabla_documentos" >'
							html += '<thead>'
							html += '<tr>'
							html += '<th>Nombre del Archivo</th>'
							html += '<th>Fecha de Registro</th>'
							html += '<th>Usuario</th>'
							html += '<th>Actualizar</th>'
							html += '<th>Eliminar</th>'
		            		html += '</tr>'
	            			html += '</thead>'
    						
    						html += '<tbody>'

    						//console.log(html);

    						for(var i = 0; i < n_data; i++){



								html += '<tr>'
	                            html += '<td><a style="color: #428bca;" target="_blanck" href= "'+data["data"][i]["ruta"]+'" download="'+data["data"][i]["nombre"]+'">'+data["data"][i]["nombre"]+'</td>'
	                            html += '<td>'+data["data"][i]["fecha_registro"]+'</td>'
	                            html += '<td>'+data["data"][i]["usuario"]+'</td>'
	                            html += '<td> <input type="button" name="Actualizarbtn" value="Actualizar" class="btn btn-warning" OnClick="actualizar_documento('+data["data"][i]["id"]+','+data["data"][i]["id_superv"]+','+data["data"][i]["semana"]+')"> </td>'
	                            html += '<td><input type="button" name="Eliminarbtn" value="Eliminar" class="btn btn-danger" OnClick="eliminar_documento('+data["data"][i]["id"]+','+data["data"][i]["id_superv"]+','+data["data"][i]["semana"]+');"></td>'
	                            
	                            }

                            html += '</tr>';
						    html += '</tbody>';
						    html += '</table>';

						    //console.log(html)
						    $("#tabla").html(html);

							$('#tabla_documentos').DataTable();

		});
	
	

  	});
	
	var respuesta="";

	function actualizar_documento (id_documento,id_superv,semana){
		
        var url="actualizarDocumentoView?id_documento="+id_documento+"&id_superv="+id_superv+"&semana="+semana;
        open(url,"","top=300,left=300,width=500,height=200") ;
	}

	function eliminar_documento (id_documento,id_superv,semana){

		//console.log(id_documento);
		//console.log(id_superv);
		//console.log(semana);
		bootbox.confirm({
	    message: '¿Desea eliminar el archivo y los datos de la semana '+semana+'?',
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
        		$.get(ip+"postEliminar", {"semana": semana, "id_documento": id_documento, "id_superv": id_superv}, function(respuesta) {
        		bootbox.alert(respuesta,function(){location.reload();});

        		});


        	} else{
        		console.log('no')

        	};

    	}

    	

		});


	};


	

</script>


  
@stop