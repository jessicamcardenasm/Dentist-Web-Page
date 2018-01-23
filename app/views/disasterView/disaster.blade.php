@extends('../ViewParent')


@section('disaster')
@parent
<!--<script src="https://code.highcharts.com/highcharts.js"></script> -->

<?php session_start ();

// Refresh la pagina cada 120 segundos

  header("Refresh:300"); 


?>

<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

<style type="text/css">
	body {
	    color: #797979;
		background: #FFFFFF;
	    font-family: 'Ruda', sans-serif;
	    padding: 0px !important;
	    margin: 0px !important;
	    font-size:13px;
	}


	.highcharts-title {
    fill: #434348;
    font-weight: bold;
    letter-spacing: 0.1em;
    font-size: 3em;
	}
</style>
<script >



	
	$(function () {

    var gaugeOptions = {

        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#f2f2f2',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                [0.1, '#DF5353']
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };



    var gaugeOptions2 = {

        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#f2f2f2',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                
                [0.5, '#DDDF0D']
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };



    var gaugeOptions3 = {

        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#f2f2f2',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                
                [0.9, '#55BF3B'] // red #55BF3B
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };


    function graficar(container,gaugeOption,title,data) {

        var chartSpeed =Highcharts.chart(container, Highcharts.merge(gaugeOption, {
            
            yAxis: {
                min: 0,
                max: 100
                /*title: {
                    text: title
                }*/
            },

            credits: {
                enabled: false
            },

            series: [{
                name: 'Speed',
                data: data,
                dataLabels: {
                    format: '<div style="text-align:center"><span style="font-size:16px;color:' +
                        ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                           '<span style="font-size:12px;color:silver">%</span></div>'
                },
                tooltip: {
                    valueSuffix: '%'
                }
            }]

        }));

        return chartSpeed

    }

    // Graficas Servicios Voz


    var chartSpeed11 = graficar('container-speed11', gaugeOptions3, 'OK', [0]);
    var chartSpeed12 = graficar('container-speed12', gaugeOptions2, 'En revisión', [0]);
    var chartSpeed13 = graficar('container-speed13', gaugeOptions, 'Pendiente',[0]);


   // Datos - IP Datacomm

    var chartSpeed21 = graficar('container-speed21', gaugeOptions3, 'OK', [0]);
    var chartSpeed22 = graficar('container-speed22', gaugeOptions2, 'En revisión', [0]);
    var chartSpeed23 = graficar('container-speed23', gaugeOptions, 'Pendiente', [0]);

    // VAS - Plataformas

    var chartSpeed31 = graficar('container-speed31', gaugeOptions3, 'OK', [0]);
    var chartSpeed32 = graficar('container-speed32', gaugeOptions2, 'En revisión', [0]);
    var chartSpeed33 = graficar('container-speed33', gaugeOptions, 'Pendiente', [0]);

    // ISP Transporte

    var chartSpeed41 = graficar('container-speed41', gaugeOptions3, 'OK', [0]);
    var chartSpeed42 = graficar('container-speed42', gaugeOptions2, 'En revisión', [0]);
    var chartSpeed43 = graficar('container-speed43', gaugeOptions, 'Pendiente', [0]);


  

    // Bring life to the dials
    setInterval(function () {
        // Speed
        var point,
            newVal,
            inc;

       

        $.get(ip+"getValorNuevo", { "id_evento" : <?php echo $_GET['id_evento'];?>, "id_superv1" : 1, "id_superv2" : 2 }).done(function(data){
            if (chartSpeed11) {
            
                point = chartSpeed11.series[0].points[0];
                newVal = data["ok"]
                point.update(newVal);
            } 

            if (chartSpeed12) {
                point = chartSpeed12.series[0].points[0];
                newVal = data["revision"]
                point.update(newVal);
            }


            if (chartSpeed13) {
                point = chartSpeed13.series[0].points[0];
                newVal = data["pendiente"]
                point.update(newVal);
            }

        })


        $.get(ip+"getValorNuevo", { "id_evento" : <?php echo $_GET['id_evento'];?>, "id_superv1" : 3, "id_superv2" : 4 }).done(function(data){
            if (chartSpeed21) {
                point = chartSpeed21.series[0].points[0];
                newVal = data["ok"]
                point.update(newVal);
            }

            if (chartSpeed22) {
                point = chartSpeed22.series[0].points[0];
                newVal = data["revision"]
                point.update(newVal);
            }


            if (chartSpeed23) {
                point = chartSpeed23.series[0].points[0];
                newVal =data["pendiente"]
                point.update(newVal);
            }

        })

        $.get(ip+"getValorNuevo", { "id_evento" : <?php echo $_GET['id_evento'];?>, "id_superv1" : 5, "id_superv2" : 6 }).done(function(data){
            if (chartSpeed31) {
                point = chartSpeed31.series[0].points[0];
                newVal = data["ok"]
                point.update(newVal);
            }

            if (chartSpeed32) {
                point = chartSpeed32.series[0].points[0];
                newVal = data["revision"]
                point.update(newVal);
            }


            if (chartSpeed33) {
                point = chartSpeed33.series[0].points[0];
                newVal = data["pendiente"]
                point.update(newVal);
            }


        })
        
        $.get(ip+"getValorNuevo", { "id_evento" : <?php echo $_GET['id_evento'];?>, "id_superv1" : 7, "id_superv2" : 8 }).done(function(data){
            if (chartSpeed41) {
                point = chartSpeed41.series[0].points[0];
                newVal = data["ok"]
                point.update(newVal);
            }

            if (chartSpeed42) {
                point = chartSpeed42.series[0].points[0];
                newVal = data["revision"]
                point.update(newVal);
            }


            if (chartSpeed43) {
                point = chartSpeed43.series[0].points[0];
                newVal =  data["pendiente"]
                point.update(newVal);
            }


        })

       

          
    }, 2000);

    

});


</script>

<section class="wrapper">

          <section id="main-content">

               <section class="wrapper" style="text-align:center; ">
               	<h5><b>Gerencia O&M Redes Core, Transporte y Plataformas</b></h5>
               	<h5><b>Fecha de Inicio : <?php echo $_GET['fecha_inicio'];?></b></h5>
               	<hr>
                

	              <CENTER> 	

                  <div style="width: 1110px; height: 150px; ">

					<div style="width: 540px; height: 150px; float: left; ">

					   
						<a data-toggle="modal" href="#Modal" onclick="getModal(1,2,<?php echo $_GET['id_evento'];?>,'<?php echo $_SESSION['nombre'];?>','<?php echo $_SESSION['correo'];?>')"><center><h5>Servicios de Voz</h5></center></a>
					    <div id="container-speed11" style="width: 170px; height: 130px; float: left"></div>
                        <div id="container-speed12" style="width: 170px; height: 130px; float: left"></div>
                        <div id="container-speed13" style="width: 170px; height: 130px; float: left"></div>
	                	
	                

	                </div>
                    <div style="width: 30px; height: 150px; float: left"> 
                    </div>
                    <div style="width: 540px; height: 150px; float: left">

                       
                        <a data-toggle="modal" href="#Modal" onclick="getModal(3,4,<?php echo $_GET['id_evento'];?>,'<?php echo $_SESSION['nombre'];?>','<?php echo $_SESSION['correo'];?>')" ><center><h5>Datos IP Datacomm</h5></center></a>
                        <div id="container-speed21" style="width: 170px; height: 130px; float: left"></div>
                        <div id="container-speed22" style="width: 170px; height: 130px; float: left"></div>
                        <div id="container-speed23" style="width: 170px; height: 130px; float: left"></div>
                        
                        

                    </div>

                </div>
                    <div style="width: 30px; height: 40px; "> 
                    </div>

                <div style="width: 1110px; height: 150px; ">
                
	                <div style="width: 540px; height: 150px; float: left; ">

                       
                        <a data-toggle="modal" href="#Modal" href="#Modal" onclick="getModal(6,5,<?php echo $_GET['id_evento'];?>,'<?php echo $_SESSION['nombre'];?>','<?php echo $_SESSION['correo'];?>')"><center><h5>VAS Plataformas</h5></center></a>
                        <div id="container-speed31" style="width: 170px; height: 130px; float: left"></div>
                        <div id="container-speed32" style="width: 170px; height: 130px; float: left"></div>
                        <div id="container-speed33" style="width: 170px; height: 130px; float: left"></div>
                        
                        

                    </div>
                     <div style="width: 30px; height: 150px; float: left"> 
                    </div>

                    <div style="width: 540px; height: 150px; float: left; ">

                       
                        <a data-toggle="modal" href="#Modal" onclick="getModal(8,7,<?php echo $_GET['id_evento'];?>,'<?php echo $_SESSION['nombre'];?>','<?php echo $_SESSION['correo'];?>')"><center><h5>ISP Transporte</h5></center></a>
                        <div id="container-speed41" style="width: 170px; height: 130px; float: left"></div>
                        <div id="container-speed42" style="width: 170px; height: 130px; float: left"></div>
                        <div id="container-speed43" style="width: 170px; height: 130px; float: left"></div>
                        
                        

                    </div>

                </div>

                <hr>


                    <div style="width: 800px; height: 300px; margin: 0 auto">
                        
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="" onclick="cerrarEvento(<?php echo $_GET['id_evento'];?>)">CERRAR EVENTO</button>
                    </div>

	               </CENTER>

               </section>
           </section>    
</section>



<!-- Modal  -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width:1000px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#0174DF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div id="div_titulo_modal" name="div_titulo_modal" style="color: #FFFFFF;"> </div>
      </div>
      <div class="modal-body">

            <div id="div_titulo_tabla1" name="div_titulo_tabla1"> </div>
             
                <div id="div_tabla1" name="div_tabla1">  </div>

            <br>

            <div id="div_titulo_tabla2" name="div_titulo_tabla2"> </div>
             
                <div id="div_tabla2" name="div_tabla2"> </div>
            
        
      </div>
      <div class="modal-footer">
        
       
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        

      </div>

    </div>
  </div>
</div>






<!-- Modal Observacion -->
<div class="modal fade" id="ModalObservacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#0174DF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color: #FFFFFF;">

        <div id="div_nombre_ne_observacion" name="div_nombre_ne_observacion">
            
        </div></h4>
      </div>
      <div class="modal-body">


        <form accept-charset="utf-8">
            <h5>Revisión de servicio</h5>
            <br>
                    
            <textarea id="observacion_logica" name="observacion_logica" class="form-control" rows="4" ></textarea>

            <br>

        
            <h5>Revisión física</h5>
            <br>
                    
            <textarea id="observacion_fisica" name="observacion_fisica" class="form-control" rows="4" ></textarea>

            <br>

            <input type="hidden" id="id_evento" name="id_evento">
        
        
              </div>
              <div class="modal-footer">
                
                <button type="button" class="btn btn-default" onclick="postObservacion()" data-dismiss="modal" >Guardar y Cerrar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              
              </div>
        </form> 
    </div>
  </div>
</div>

<script> 

$(document).ready(function () {

    $('#datetimepicker').datetimepicker();
        
    });

    function resultado2(idDiv,nombre1,correo1,ideventodetalle,tipo) {

      	$("#"+idDiv).empty();
        var idDiv2="'"+idDiv+"'";
        var nombre="'"+nombre1+"'"
        var correo="'"+correo1+"'"
        $("#"+idDiv).append('<button type="button" class="btn btn-success" style="font-size:12px" onclick="resultado3('+idDiv2+','+nombre+','+correo+','+ideventodetalle+','+tipo+')"> OK </button><p>'+nombre1+' / '+correo1); 
         nuevoEstado(ideventodetalle,2,nombre1,correo1,tipo)


    }


    function resultado(idDiv,nombre1,correo1,ideventodetalle,tipo) {

      	$("#"+idDiv).empty();
      	var idDiv2="'"+idDiv+"'";
        var nombre="'"+nombre1+"'"
        var correo="'"+correo1+"'"
        $("#"+idDiv).append(' <button type="button" class="btn btn-warning" style="font-size:12px" onclick="resultado2('+idDiv2+','+nombre+','+correo+','+ideventodetalle+','+tipo+')"> En revisión </button><p>'+nombre1+' / '+correo1); 
        
        nuevoEstado(ideventodetalle,1,nombre1,correo1,tipo)


    }

    function resultado3(idDiv,nombre1,correo1,ideventodetalle,tipo) {

        $("#"+idDiv).empty();
        var idDiv2="'"+idDiv+"'";
         var nombre="'"+nombre1+"'"
        var correo="'"+correo1+"'"
        $("#"+idDiv).append(' <button type="button" class="btn btn-danger" style="font-size:12px" onclick="resultado('+idDiv2+','+nombre+','+correo+','+ideventodetalle+','+tipo+')"> Pendiente </button> '); 
        nuevoEstado(ideventodetalle,0,'-','-',tipo)
    }


    function getModal(id_superv1,id_superv2,id_evento,nombre1,correo1) {

        var nombre="'"+nombre1+"'"
        var correo="'"+correo1+"'"

        $.get(ip+"getTitulos", { "id_superv1" : id_superv1, "id_superv2" : id_superv2 }).done(function(data){

            $("#div_titulo_modal").text(data["jefatura"])
            $("#div_titulo_tabla1").text(data["superv1"])
            $("#div_titulo_tabla2").text(data["superv2"])

        })


        $.get(ip+"getTabla_evento", { "id_superv" : id_superv1, "id_evento" : id_evento }).done(function(data){

                //console.log(data);
                  
              var n_data=data["data"].length;
                      //console.log(n_data);
              var html='';
              html += '<table id="tabla_ne_1" name="tabla_ne_1" class="table table-striped" style="font-size:14px; text-align: center;">'
              html += '<thead style="background-color: #0174DF; color: #FFFFFF; ">'
              html += '<tr>'
              html += '<th>Prioridad</th>'
              html += '<th>NE</th>'
              html += '<th>Revisi&oacute;n de Servicio</th>'
              html += '<th>Revisi&oacute;n F&iacute;sica</th>'
              html += '<th>Observación</th>'
              html += '</tr>'
              html += '</thead>'
                
              html += '<tbody>'

                //console.log(html);

              for(var i = 0; i < n_data; i++){

                html += '<tr>'
                              html += '<td>'+data["data"][i]["prioridad"]+'</td>'
                              html += '<td>'+data["data"][i]["nombre_ne"]+'</td>'

                              var id_div="'div1"+i+"'";
                              if (data["data"][i]["estado_logico"] == 0) {

                                html += '<td> <div id="div1'+i+'" name="div1'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-danger" style="font-size:12px" onclick="resultado('+id_div+','+nombre+','+correo+','+data["data"][i]["id_evento_detalle"]+',1)"> Pendiente</button> </div> </td>'
                              
                              } else{ if (data["data"][i]["estado_logico"] == 1) {

                                    html += '<td> <div id="div1'+i+'" name="div1'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-warning" style="font-size:12px" onclick="resultado2('+id_div+','+nombre+','+correo+','+data["data"][i]["id_evento_detalle"]+',1)"> En revisión </button> <p> '+data["data"][i]["usuario_revision_logica"]+' / '+ data["data"][i]["correo_usuario_revision_logica"]+' </div> </td>'
                                  
                                  } else{

                                    html += '<td> <div id="div1'+i+'" name="div1'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-success" style="font-size:12px" > OK </button> <p> '+data["data"][i]["usuario_revision_logica"]+' / '+ data["data"][i]["correo_usuario_revision_logica"]+' </div> </td>'

                                  };
                              };

                              var id_div="'div3"+i+"'";
                              if (data["data"][i]["estado_fisico"] == 0) {

                                html += '<td> <div id="div3'+i+'" name="div3'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-danger" style="font-size:12px" onclick="resultado('+id_div+','+nombre+','+correo+','+data["data"][i]["id_evento_detalle"]+',2)"> Pendiente </button> </div> </td>'
                              
                              } else{ if (data["data"][i]["estado_fisico"] == 1) {

                                    html += '<td> <div id="div3'+i+'" name="div3'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-warning" style="font-size:12px" onclick="resultado2('+id_div+','+nombre+','+correo+','+data["data"][i]["id_evento_detalle"]+',2)"> En revisión </button> <p> '+data["data"][i]["usuario_revision_fisica"]+' / '+ data["data"][i]["correo_usuario_revision_fisica"]+' </div> </td>'
                                  
                                  } else{

                                    html += '<td> <div id="div3'+i+'" name="div3'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-success" style="font-size:12px" > OK </button> <p> '+data["data"][i]["usuario_revision_fisica"]+' / '+ data["data"][i]["correo_usuario_revision_fisica"]+' </div> </td>'

                                  };
                              };


                              var nombre_ne="'"+data["data"][i]["nombre_ne"]+"'"
                              var observacion_logica="'"+data["data"][i]["observacion_revision_logica"]+"'"
                              var observacion_fisica="'"+data["data"][i]["observacion_revision_fisica"]+"'"


                              html += '<td> <button type="button" class="btn btn-info" style="font-size:12px" data-toggle="modal" data-target="#ModalObservacion" onclick="mostrar_observacion('+data["data"][i]["id_evento_detalle"]+','+nombre_ne+','+observacion_logica+','+observacion_fisica+')"> Agregar </button>  </td>'

                              

                              
              }

                html += '</tr>';
                html += '</tbody>';
                html += '</table>';

                //console.log(html)
                $("#div_tabla1").html(html);

               

        })

        $.get(ip+"getTabla_evento", { "id_superv" : id_superv2, "id_evento" : id_evento }).done(function(data){

                //console.log(data);
                  
              var n_data=data["data"].length;
                      //console.log(n_data);
              var html='';
              html += '<table id="tabla_ne_2" name="tabla_ne_2" class="table table-striped" style="font-size:14px; text-align: center;" >'
              html += '<thead style="background-color: #0174DF; color: #FFFFFF; ">'
              html += '<tr>'
              html += '<th>Prioridad</th>'
              html += '<th>NE</th>'
              html += '<th>Revisi&oacute;n de Servicio</th>'
              html += '<th>Revisi&oacute;n F&iacute;sica</th>'
              html += '<th>Observación</th>'
              html += '</tr>'
              html += '</thead>'
                
              html += '<tbody>'

                //console.log(html);

              for(var i = 0; i < n_data; i++){

                html += '<tr>'
                              html += '<td>'+data["data"][i]["prioridad"]+'</td>'
                              html += '<td>'+data["data"][i]["nombre_ne"]+'</td>'

                              var id_div="'div2"+i+"'";
                              if (data["data"][i]["estado_logico"] == 0) {

                                html += '<td> <div id="div2'+i+'" name="div2'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-danger" style="font-size:12px" onclick="resultado('+id_div+','+nombre+','+correo+','+data["data"][i]["id_evento_detalle"]+',1)"> Pendiente </button> </div> </td>'
                              
                              } else{ if (data["data"][i]["estado_logico"] == 1) {

                                    html += '<td> <div id="div2'+i+'" name="div2'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-warning" style="font-size:12px" onclick="resultado2('+id_div+','+nombre+','+correo+','+data["data"][i]["id_evento_detalle"]+',1)"> En revisión </button> <p> '+data["data"][i]["usuario_revision_logica"]+' / '+ data["data"][i]["correo_usuario_revision_logica"]+' </div> </td>'
                                  
                                  } else{

                                    html += '<td> <div id="div2'+i+'" name="div2'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-success" style="font-size:12px" > OK </button> <p> '+data["data"][i]["usuario_revision_logica"]+' / '+ data["data"][i]["correo_usuario_revision_logica"]+' </div> </td>'

                                  };
                              };


                              var id_div="'div4"+i+"'";
                              if (data["data"][i]["estado_fisico"] == 0) {

                                html += '<td> <div id="div4'+i+'" name="div4'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-danger" style="font-size:12px" onclick="resultado('+id_div+','+nombre+','+correo+','+data["data"][i]["id_evento_detalle"]+',2)"> Pendiente </button> </div> </td>'
                              
                              } else{ if (data["data"][i]["estado_fisico"] == 1) {

                                    html += '<td> <div id="div4'+i+'" name="div4'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-warning" style="font-size:12px" onclick="resultado2('+id_div+','+nombre+','+correo+','+data["data"][i]["id_evento_detalle"]+',2)"> En revisión </button> <p> '+data["data"][i]["usuario_revision_fisica"]+' / '+ data["data"][i]["correo_usuario_revision_fisica"]+' </div> </td>'
                                  
                                  } else{

                                    html += '<td> <div id="div4'+i+'" name="div4'+i+'" style="vertical-align:middle;" > <button type="button" class="btn btn-success" style="font-size:12px" > OK </button> <p> '+data["data"][i]["usuario_revision_fisica"]+' / '+ data["data"][i]["correo_usuario_revision_fisica"]+' </div> </td>'

                                  };
                              };

                              var nombre_ne="'"+data["data"][i]["nombre_ne"]+"'"
                              var observacion_logica="'"+data["data"][i]["observacion_revision_logica"]+"'"
                              var observacion_fisica="'"+data["data"][i]["observacion_revision_fisica"]+"'"

                              html += '<td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalObservacion" style="font-size:12px" onclick="mostrar_observacion('+data["data"][i]["id_evento_detalle"]+','+nombre_ne+','+observacion_logica+','+observacion_fisica+')"> Agregar </button>  </td>'

                              

                              
              }

                html += '</tr>';
                html += '</tbody>';
                html += '</table>';

                //console.log(html)
                $("#div_tabla2").html(html);

                
        })

    }
  

    function nuevoEstado(id_evento_detalle,estado,nombre,correo,tipo){

        $.get(ip+"postEstadoNuevo", { "id_evento_detalle" : id_evento_detalle, "estado" : estado, "nombre" : nombre, "correo" : correo , "tipo" : tipo }).done()


    }


    function mostrar_observacion(id_evento,nombre_ne,observacion_logica,observacion_fisica){


        $('#div_nombre_ne_observacion').text(nombre_ne);
        $('#id_evento').val(id_evento);
        $.get(ip+"getObservacion", { "id_evento" : id_evento }).done(function(data){

            $('#observacion_logica').val(data["data"][0]["observacion_revision_logica"]);
            $('#observacion_fisica').val(data["data"][0]["observacion_revision_fisica"]);

        })

        
        
        

    }

    function postObservacion(){
        var id_evento=$('#id_evento').val();
        var observacion_logica=$('#observacion_logica').val();
        var observacion_fisica=$('#observacion_fisica').val();

        $.get(ip+"postObservacion", { "id_evento" : id_evento, "observacion_logica" : observacion_logica, "observacion_fisica" : observacion_fisica }).done(function(data){


        })

    }

    function cerrarEvento(id_evento) {

        bootbox.confirm({
        message: '¿Esta seguro de cerrar el evento?',
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


                $.get(ip+"cerrarEvento", { "id_evento" : id_evento}).done(function(respuesta){
                    bootbox.alert(respuesta,function(){location.reload();});
                })


            } else{
                console.log('no')

            };

        }

        

        });



       
    }


</script>
@stop