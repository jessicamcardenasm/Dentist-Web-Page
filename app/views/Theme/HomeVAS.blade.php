


<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    <title> Cockpit Home </title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

  

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    <style type="text/css">
      h1.tree{
          border-width: 1px;
          border-style: solid;
          background-color: #68dff0;
          border-color: yellow;
          font-size: 30px;
      }

    </style> 

  </head>

  <body>

	<!-- ////////////////////////////////// MENÚ DE NOTIFICACIONES ///////////////////////////////////////////////////-->

	<section id="container" >

	<header class="header black-bg" background-color: #ffd777>
              <div class="sidebar-toggle-box" >
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation" ></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo">  <img src="assets/img/Cockpit/entel.png"  width="150"></a>

           
            
            <div class="top-menu"  >
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="login.html">Logout</a></li>
            	</ul>
            </div>
  </header>

  
  <!-- ////////////////////////////////////////////// MENÚ PRINCIPAL /////////////////////////////////////////////////-->

   <aside>
          <div id="sidebar"  class="nav-collapse " >
              <!-- sidebar menu start-->
              <ul background-color: #f7982c class="sidebar-menu" id="nav-accordion" >
              
                  <p class="centered"><a href="profile.html"><img src="assets/img/Cockpit/icono.png" class="img-circle" width="150"></a></p>
                  <h5 class="centered"><b>COCKPIT</b></h5>
                    
                  <li class="mt">
                      <a class="active" href="VAS">
                          <i class="fa fa-desktop"></i>
                          <span >VAS </span>
                      </a>
                  </li>

                  

                  <li class="sub" >
                      <a href="Prepaid">
                          <i class="fa fa-desktop"></i>
                          <span>Prepaid</span>
                      </a>
                      
                  </li>

                  <li class="sub" >
                      <a href="Datacomm">
                          <i class="fa fa-desktop"></i>
                          <span>Datacomm</span>
                      </a>
                      
                  </li>

                  <li class="sub" >
                      <a href="Voz">
                          <i class="fa fa-desktop"></i>
                          <span>Voz</span>
                      </a>
                      
                  </li>

                  <li class="sub" >
                      <a href="Datos">
                          <i class="fa fa-desktop"></i>
                          <span>Datos</span>
                      </a>
                      
                  </li>
                  <li class="sub" >
                      <a href="RAN">
                          <i class="fa fa-desktop"></i>
                          <span>RAN</span>
                      </a>
                      
                  </li>
                  <li class="sub" >
                      <a href="ISP">
                          <i class="fa fa-desktop"></i>
                          <span>ISP</span>
                      </a>
                      
                  </li>
                  <li class="sub" >
                      <a href="Transporte">
                          <i class="fa fa-desktop"></i>
                          <span>Transporte</span>
                      </a>
                      
                  </li>
                  
               

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>




  <!-- /////////////////////////////////////////////////CONTENIDO DEL HOME ///////////////////////////////////////-->

 <section class="wrapper">

             



<section id="main-content">

<section class="wrapper">
<h3 >Cockpit VAS</h3>
  
        <script type="text/javascript">
        $(function () {  

          var category;
          var Data;
 
          $(".btn").on('click', function() {
                var week_1=$('#semana_1').val();
                var week_2=$('#semana_2').val();
                
              $.get( "http://localhost:8080/LindaDemo/public/getdata", { "week_1": week_1, "week_2": week_2 } ).done(function( data ) {
                        Data=[{data:[],name:'cohosted 1'},
                        {data:[],name:'cohosted 2'}];
                        category=[];
                        for (var i = 0; i < data["data"].length; i++) {
                           Data[0]['data'].push(parseFloat(data['data'][i]['cohosted1mu']));
                           Data[1]['data'].push(parseFloat(data['data'][i]['cohosted2mu']));
                        };
                        for (var i = 0; i < data["week"].length; i++) {
                          category.push(data["week"][i]["week"]);
                        }
                        $('#grafica').highcharts({
                    title: {
                        text: 'SMSC Memory Usage',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Mes: Septiembre    Semana 36',
                        x: -20
                    },
                    xAxis: {
                        categories: category
                    },
                    yAxis: {
                        title: {
                            text: 'Percentage (%)'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: '%'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: Data
                    });


                });

                              });      

          });
          /*optional stuff to do after success */
          

/*
        $('#grafica').highcharts({
            title: {
                text: 'SMSC Memory Usage',
                x: -20 //center
            },
            subtitle: {
                text: 'Mes: Septiembre    Semana 36',
                x: -20
            },
            xAxis: {
                categories: ['W25', 'W26', 'W27', 'W28', 'W29',
                    'W30', 'W31', 'W32', 'W33', 'W34', 'W35', 'W36']
            },
            yAxis: {
                title: {
                    text: 'Percentage (%)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Cohosted 1',
                data: [32.50, 32.50, 34.80, 34.40, 34.40, 34.80, 34.80, 34.80, 34.80, 34.80, 34.80, 34.40]
            }, {
                name: 'Cohosted 2',
                data: [32.00, 32.10, 32.10, 32.10, 32.20, 32.10, 32.10, 32.10, 32.10, 32.10, 32.10, 32.70]
            }, {
                name: 'SFE 1',
                data: [64.30, 73.70, 80.00, 80.00, 80.00, 80.00, 80.00, 80.00, 80.00, 80.00, 80.00, 20.00]
            }, {
                name: 'SFE 2',
                data: [87.60, 85.50, 87.20, 87.20, 87.20, 87.20, 87.20, 87.20, 87.20, 73.30, 73.70, 21.00]
            }, {
                name: 'OMU 2A',
                data: [47.30, 47.50, 47.70, 47.60, 47.60, 47.50, 47.70, 47.70, 47.70, 47.70, 47.70, 47.70]
            }, {
                name: 'OMU 2B',
                data: [42.90, 43.10, 43.50, 43.70, 43.70, 43.50, 43.70, 43.60, 43.70, 43.60, 43.60, 43.60]
            }]
        });
    });
    
*/
        </script>



<select id="semana_1" class="form-control" required="required">
  {{
    <?php foreach ($semanas as $s): ?>
      <option value={{$s["week"]}}>{{$s["week"]}}</option>
    <?php endforeach ?>
  }}
</select>
 
<select id="semana_2" class="form-control" required="required">
  {{
    <?php foreach ($semanas as $s): ?>

      <option value={{$s["week"]}}>{{$s["week"]}}</option>
    <?php endforeach ?>
  }}
</select>

<button class="btn">enviar</button>
<div id="grafica" ></div>


  <!-- ////////////////////////////////////////////FIN DEL CONTENIDO  ///////////////////////////////////////////-->




    <!-- js placed at the end of the document so the pages load faster -->
    
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
    <script src="assets/js/zabuto_calendar.js"></script>  


  <!-- #######################################################################################################################################-->
  

  
    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>



  </body>

  </html>

