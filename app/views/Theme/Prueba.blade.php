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
                      <a class="active" href="">
                          <i class="fa fa-desktop"></i>
                          <span >VAS </span>
                      </a>
                  </li>

                  

                  <li class="sub" >
                      <a href="javascript:; login">
                          <i class="fa fa-desktop"></i>
                          <span>Prepaid</span>
                      </a>
                      
                  </li>

                  <li class="sub" >
                      <a href="javascript:; login">
                          <i class="fa fa-desktop"></i>
                          <span>Datacomm</span>
                      </a>
                      
                  </li>

                  <li class="sub" >
                      <a href="javascript:; login">
                          <i class="fa fa-desktop"></i>
                          <span>Voz</span>
                      </a>
                      
                  </li>

                  <li class="sub" >
                      <a href="javascript:; login">
                          <i class="fa fa-desktop"></i>
                          <span>Datos</span>
                      </a>
                      
                  </li>
                  <li class="sub" >
                      <a href="javascript:; login">
                          <i class="fa fa-desktop"></i>
                          <span>RAN</span>
                      </a>
                      
                  </li>
                  <li class="sub" >
                      <a href="javascript:; login">
                          <i class="fa fa-desktop"></i>
                          <span>ISP</span>
                      </a>
                      
                  </li>
                  <li class="sub" >
                      <a href="javascript:; login">
                          <i class="fa fa-desktop"></i>
                          <span>Transporte</span>
                      </a>
                      
                  </li>
                  
               

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>

<!-- /////////////////////////////////////////////////CONTENIDO DEL HOME ///////////////////////////////////////-->

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
$(function () {
        $('#grafica').highcharts({
            title: {
                text: 'Monthly Average Temperature',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: WorldClimate.com',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '°C'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'New York',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Berlin',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }, {
                name: 'London',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]
        });
    });
    

        </script>
<script src="assets/js/highcharts.js"></script>
<script src="assets/js/exporting.js"></script>

<div id="grafica" ></div>


<!-- ////////////////////////////////////////////FIN DEL CONTENIDO DE SOLICITAR COTIZACIONES ///////////////////////////////////////////-->




    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
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


	</body>
</html>
