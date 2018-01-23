@extends('../ViewParent')


@section('homedisaster')
@parent
<!--<script src="https://code.highcharts.com/highcharts.js"></script> -->
<?php session_start ();?>

<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

<section class="wrapper">

          <section id="main-content">

               <section class="wrapper" style="text-align:center; ">
               	<h3><b>Gerencia O&M Redes Core, Transporte y Plataformas</b></h3>
               	<br></br>
               

	            <CENTER> 	

					     <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalNuevoEvento" >CREAR NUEVO EVENTO</button>
              <hr>

              <div id="tabla_eventos" name="tabla_eventos" class="table-responsive">
                
              </div>
	                

	            </CENTER>

               </section>
           </section>    
</section>

<!-- Modal Nuevo Evento -->
<div class="modal fade" id="ModalNuevoEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#0174DF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color: #FFFFFF;">Nuevo Evento</h4>
      </div>



      <div class="modal-body">

      	<form action="crearEvento" method="post" enctype="multipart/form-data">

          <input id="nombre_evento" name="nombre_evento" type="text" class="form-control" placeholder="Nombre del evento">
          <br>
      		<h5>Descripci&oacute;n del Evento:</h5>
    			<br>
    			<textarea id="descripcion_evento" name="descripcion_evento" class="form-control" rows="4" ></textarea>
          <br>
          <input id="fecha_inicio" name="fecha_inicio" style='width:200px;' type="text"  class="form-control"  value="<?php echo date('Y-m-d H:i:s',strtotime('-5 hour', strtotime(date('Y-m-d H:i:s',time()))));?>" >
          <br>
          <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['usuario'];?>">
          <input type="hidden" id="nombre" name="nombre" value="<?php echo $_SESSION['nombre'];?>">
          <input type="hidden" id="fecha_registro" name="fecha_registro" value="<?php echo date('Y-m-d H:i:s',strtotime('-5 hour', strtotime(date('Y-m-d H:i:s',time()))));?>">
    		
    
        
          </div>
          <div class="modal-footer">
          	
            <input type="submit" class="btn btn-primary" value="Guardar y Activar">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

          
          </div>

      </form>

    </div>
  </div>
</div>


<!-- Detalle del Evento -->
<div class="modal fade" id="ModalDetalleEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#0174DF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color: #FFFFFF;">Detalle del Evento </h4>
      </div>
      <div class="modal-body">

          <input type="hidden" id="id_evento" name="id_evento" >

          <input id="nombre_evento_d" name="nombre_evento_d" type="text" class="form-control" >
          <br>

      		<h5>Creado por : </h5>
      		<br>
          <input id="nombre_usuario_d" name="nombre_usuario_d" type="text" disabled="true" class="form-control" >
          <br>

      		<h5>Fecha de Creaci&oacute;n : </h5>

      		<input id="fecha_registro_d" name="fecha_registro_d" style='width:200px;' disabled="true" type="text"  class="form-control" > 
      		
      		<p></p>

      		<h5>Descripci&oacute;n del Evento:</h5>
			
					
			   <textarea id="descripcion_d" name="descripcion_d" class="form-control" rows="4"  value=""> </textarea>


    		  <h5>Fecha de Inicio : </h5>

      		<input id="fecha_inicio_d" name="fecha_inicio_d" style='width:200px;' type="text"   class="form-control" > 
      		
      		<h5>Fecha de Fin : </h5>

      		<input id="fecha_fin_d" name="fecha_fin_d" style='width:200px;' type="text" disabled="true"  class="form-control" value=" "> 
      		
      	
      		
      	
        
      </div>
      <div class="modal-footer">
      	
        <button type="button" class="btn btn-info" data-dismiss="modal" onclick="actualizarDetalle()">Actualizar y Cerrar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      
      </div>

    </div>
  </div>
</div>




<script> 

  function verDetalle(id_evento){

    $.get(ip+"getEvento_id" , {"id_evento" : id_evento} ).done(function(data){
     
     $('#nombre_evento_d').val(data["data"][0]["nombre_evento"]);
     $('#nombre_usuario_d').val(data["data"][0]["nombre_usuario_creador"]);
     $('#fecha_registro_d').val(data["data"][0]["fecha_registro"]);
     $('#descripcion_d').val(data["data"][0]["descripcion"]);
     $('#fecha_inicio_d').val(data["data"][0]["fecha_inicio"]);
     $('#fecha_fin_d').val(data["data"][0]["fecha_fin"]);
     $('#id_evento').val(id_evento);
   })

  }

  function actualizarDetalle(){

    var nombre_evento=$('#nombre_evento_d').val();
    var descripcion=$('#descripcion_d').val();
    var fecha_inicio=$('#fecha_inicio_d').val();
    var id_evento=$('#id_evento').val();

    $.get(ip+"actualizarDetalle",{ "id_evento" : id_evento, "nombre_evento" : nombre_evento, "descripcion" : descripcion, "fecha_inicio" : fecha_inicio }).done(function(data){

    })


  }

	$(document).ready(function () {

		
		
		$('#fecha_inicio').datetimepicker({
      format: 'Y-m-d H:i:s'
    })

    $('#fecha_inicio_d').datetimepicker({
      format: 'Y-m-d H:i:s'
    })

    $('#fecha_registro_d').datetimepicker({
      format: 'Y-m-d H:i:s'
    })

    $('#fecha_fin_d').datetimepicker({
      format: 'Y-m-d H:i:s'
    })



    $.get(ip+"getEventos").done(function(data){

                //console.log(data);
                  
              var n_data=data["data"].length;
                      //console.log(n_data);
              var html='';
              html += '<table id="tabla_historial" name="tabla_historial" style="font-size:14px" >'
              html += '<thead>'
              html += '<tr>'
              html += '<th>ID</th>'
              html += '<th>Evento</th>'
              html += '<th>Fecha de Registro</th>'
              html += '<th>Detalle</th>'
              html += '<th>Estado</th>'
              html += '<th>Abrir</th>'
              html += '</tr>'
              html += '</thead>'
                
              html += '<tbody>'

                //console.log(html);

              for(var i = 0; i < n_data; i++){

                html += '<tr>'
                              html += '<td>'+data["data"][i]["id_evento"]+'</td>'
                              html += '<td>'+data["data"][i]["nombre_evento"]+'</td>'
                              html += '<td>'+data["data"][i]["fecha_registro"]+'</td>'
                              html += '<td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalDetalleEvento" OnClick="verDetalle('+data["data"][i]["id_evento"]+')" >Detalle </button></td>'
                              
                              if (data["data"][i]["estado"] == 'Activo') {
                                var color='btn-success'
                              } else{ var color='btn-danger'};

                              html += '<td><button type="button" class="btn '+color+'">'+data["data"][i]["estado"]+'</button></td>'
                              html += '<td><a href="Disaster?id_evento='+data["data"][i]["id_evento"]+'&fecha_inicio='+data["data"][i]["fecha_inicio"]+'"">Link</a></td>'


                              
              }

                html += '</tr>';
                html += '</tbody>';
                html += '</table>';

                //console.log(html)
                $("#tabla_eventos").html(html);

                $('#tabla_historial').DataTable();

    })
		
	})






</script>


@stop