
$(function() {

  $("#anhoI").on('change', function() {

  var anho_1=$('#anhoI').val();
 

  $.get( ip+"getdataSemIAnhoF", { "anho_1": anho_1 } ).done(function( dataSelect ) {

         


            $("#semF").empty();
            $("#semF").append("<option value='' disabled selected > Semana final ... </option> "); 



            $("#semI").empty();
            $("#semI").append("<option value='' disabled selected > Semana Inicial ... </option> ");           

            for (var i = 0; i < dataSelect["weeksI"].length; i++) {

                          $("#semI").append('<option value="'+dataSelect['weeksI'][i]['week']+'">'+dataSelect['weeksI'][i]['month'] +' W'+dataSelect['weeksI'][i]['week']+ '</option>');

                        }


            $("#anhoF").empty();
            $("#anhoF").append("<option value='' disabled selected > Año final ... </option> ");           

            for (var i = 0; i < dataSelect["anhoF"].length; i++) {

                          $("#anhoF").append('<option value="'+dataSelect['anhoF'][i]['year']+'">'+ dataSelect['anhoF'][i]['year']+ '</option>');

                        }


      })


  })
})

$(function() {

  $("#anhoF").on('change', function() {

  var anho_1=$('#anhoI').val();
  

  var anho_2=$('#anhoF').val();
  

  var sem_1=$('#semI').val();
  


      if (anho_1==anho_2) {

      



        $.get( ip+"getdataSemF1", { "anho_1": anho_1 , "sem_1": sem_1 } ).done(function( dataSelect2 ) {


            $("#semF").empty();
            $("#semF").append("<option value='' disabled selected > Semana Final ... </option> ");           

            for (var i = 0; i < dataSelect2["weeksF"].length; i++) {

                          $("#semF").append('<option value="'+dataSelect2['weeksF'][i]['week']+'">'+dataSelect2['weeksF'][i]['month'] +' W'+ dataSelect2['weeksF'][i]['week']+ '</option>');

                        }


        })




       }

      else { 

        $("#semF").empty();
        $("#semF").append("<option value='' disabled selected > Semana Final ... </option> ");


        $.get( ip+"getdataSemF2", { "anho_2": anho_2  } ).done(function( dataSelect3 ) {


            $("#semF").empty();
            $("#semF").append("<option value='' disabled selected > Semana Final ... </option> ");           

            for (var i = 0; i < dataSelect3["weeksF"].length; i++) {

                          $("#semF").append('<option value="'+dataSelect3['weeksF'][i]['week']+'">'+dataSelect3['weeksF'][i]['month'] +' W'+ dataSelect3['weeksF'][i]['week']+ '</option>');

                        }


        })

      }

  })
})


$(function(){

  $("#anhosc").on('change', function() {

    console.log(idSup);
    var anhoc=$("#anhosc").val(); 
    console.log(anhoc);

    $.get(ip+"getSemanaSup", {"idSup": idSup , "anhoc" : anhoc }).done(function(data){

        $("#semanac").empty();
        $("#semanac").append("<option value='' disabled selected > Semanas </option> ");   
        console.log(data);        

        for (var i = 0; i < data["semanasSuperv"].length; i++) {

          $("#semanac").append('<option value="'+data['semanasSuperv'][i]['semana']+'">'+data['semanasSuperv'][i]['month'] +' W'+ data['semanasSuperv'][i]['week']+ '</option>');

        }


    });


  })

});

$(function(){

  $("#semanac").on('change', function() {

    $('#submit').attr('disabled', false);

  })

});




$(function() {

  $("#semI").on('change', function() {

  var anho_1=$('#anhoI').val();
  

  var anho_2=$('#anhoF').val();
  

  var sem_1=$('#semI').val();
  


      if (anho_1==anho_2) {

      



        $.get( ip+"getdataSemF1", { "anho_1": anho_1 , "sem_1": sem_1 } ).done(function( dataSelect2 ) {


            $("#semF").empty();
            $("#semF").append("<option value='' disabled selected > Semana Final ... </option> ");           

            for (var i = 0; i < dataSelect2["weeksF"].length; i++) {

                          $("#semF").append('<option value="'+dataSelect2['weeksF'][i]['week']+'">'+dataSelect2['weeksF'][i]['month'] +' W'+ dataSelect2['weeksF'][i]['week']+ '</option>');

                        }


        })




       }

      else { 

        $("#semF").empty();
        $("#semF").append("<option value='' disabled selected > Semana Final ... </option> ");

    
        $.get( ip+"getdataSemF2", { "anho_2": anho_2  } ).done(function( dataSelect3 ) {


            $("#semF").empty();
            $("#semF").append("<option value='' disabled selected > Semana Final ... </option> ");           

            for (var i = 0; i < dataSelect3["weeksF"].length; i++) {

                          $("#semF").append('<option value="'+dataSelect3['weeksF'][i]['week']+'">'+dataSelect3['weeksF'][i]['month'] +' W'+ dataSelect3['weeksF'][i]['week']+ '</option>');

                        }


        })       



      }

  })
})


