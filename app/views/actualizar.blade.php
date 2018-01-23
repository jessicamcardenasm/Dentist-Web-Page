<html>
<head>
  {{HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');}}
  {{HTML::script('assets/js/jquery.alerts.js');}}
  {{HTML::script('assets/js/jquery.ui.draggable.js');}}
  {{HTML::style('assets/css/jquery.alerts.css');}}
  {{HTML::style('assets/css/bootstrap.css');}}
  <title> Actualizar </title>

</head>
<body>

  

  <script>
    var semanas = "<?php echo $_GET['semanas']; ?>" ;
    var idsupervision="<?php echo $_GET['idsupervision']; ?>" ;
    var idgrafica="<?php echo $_GET['idgrafica']; ?>" ;
    var nombre_grafica;
    
    var semanas2=[];
    var semanas3=[];
    
    $(function () {

        $(document).ready(function() {

       

          
          var s="";
          var aux="";
          var cont=0;

          for (var i = 0; i < semanas.length; i++) {

            s=s+semanas[i];
            aux=aux+semanas[i];
            cont++;

            if (cont==4) {aux=aux+"-"};

            if (cont==6) {
              cont=0;
              semanas2.push(s);
              semanas3.push(aux);
              s="";
              aux="";
              i++;
            }
            
              }

             

              $("#semana").empty();
              $("#semana").append("<option value='' disabled selected > Semanas ... </option> ");           

              for (var i = 0; i < semanas2.length; i++) {

                            $("#semana").append('<option value="'+semanas2[i]+'">'+semanas3[i]+ '</option>');

                          }

          
          $.get( "http://127.0.0.1/Entel/public/index.php/getelementos", { "idsupervision": idsupervision  , "idgrafica" : idgrafica} ).done(function( ne ) {

              
              $("#elemento").empty();
              $("#elemento").append("<option value='' disabled selected > NE's ... </option> "); 

                var nombre_grafica=ne['grafica'][0]['nombre'];
                var limite_grafica=ne['grafica'][0]['limite'];
               

              $("#nombre_g").append('<h3>'+nombre_grafica+'</h3>');

              $('#limite_g').val(limite_grafica);
                    

              for (var i = 0; i < ne["ne"].length; i++) {

                $("#elemento").append('<option value="'+ne['ne'][i]['idelementos']+'">'+ ne['ne'][i]['nombre_elemento']+ '</option>');

              }

          });

      });

    });


    $(function() {

      $(".btnactualizar").on('click', function() {
                var week=$('#semana').val();
                var element=$('#elemento').val();
                var coment=$('#comentario').val();
              
                $.get( "http://127.0.0.1/Entel/public/index.php/updatecomentario", { "idsupervision": idsupervision, "idgrafica": idgrafica, "semana": week, "idelemento": element , "comentario" : coment } ).done(function(resultado) {

                 jAlert(resultado["resultado"],'OK');

                });
          });

    });


    $(function() {

      $(".btnactualizar2").on('click', function() {
               
                var limite_update=parseInt($('#limite_g').val());
              
                $.get( "http://127.0.0.1/Entel/public/index.php/updatelimite", {  "idgrafica": idgrafica, "limite" : limite_update } ).done(function(resultado) {

                 jAlert(resultado["resultado"],'OK'); 

                });
          });

    });



    $(function() {

      $("#elemento").on('change', function() { 

        var week2=$('#semana').val();
        var element2=$('#elemento').val();


        $.get( "http://127.0.0.1/Entel/public/index.php/getcomentario", { "idsupervision": idsupervision, "idgrafica": idgrafica, "semana": week2, "idelemento": element2 } ).done(function(comentario_actual) {
 
             
              $('#comentario').val(comentario_actual['comentario_actual'][0]['comentario']);

        });


      });


       $("#semana").on('change', function(){

            var week2=$('#semana').val();
            var element2=$('#elemento').val();

            $.get( "http://127.0.0.1/Entel/public/index.php/getcomentario", { "idsupervision": idsupervision, "idgrafica": idgrafica, "semana": week2, "idelemento": element2 } ).done(function(comentario_actual) {
 
              $('#comentario').val(comentario_actual['comentario_actual'][0]['comentario']);

            });

        })


    });
    


  </script>


    <div id="nombre_g" name="nombre_g" style="position:relative;left:20px"></div>
    <P></P>

  
    
    <p></p>

    <div id="demoMed" style="position:absolute;left:30px; color: #076EDC;">

      <h4>Comentarios</h4>

    
      <select  name="semana" id="semana"  class="form-control" required="required" style="width:200px;" left: 50px;></select>
      <p></p>
      <select  name="elemento" id="elemento"  class="form-control" required="required" style="width:200px;" left: 50px;></select>
      <p></p>
      <TEXTAREA name="comentario" id="comentario" style="width:200px; height:100px;"> </TEXTAREA>
      <p></p>
      <button style="background-color:#076EDC; color: white; border: 3px solid orange; width:200px;" class="btnactualizar" id="btnactualizar" name="btnactualizar">Actualizar Comentario</button>
    

      <br></br>
      <h4>Limite</h4>
       
      <input type="text" name="limite_g" id="limite_g" class="form-control"/>
      <p></p>
      <button style="background-color:#076EDC; color: white; border: 3px solid orange; width:200px;" class="btnactualizar2" id="btnactualizar2" name="btnactualizar2">Actualizar Limite</button>
    


    </div>

    <p></p>

    

</body>
</html>