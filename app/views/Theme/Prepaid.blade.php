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
    <title>Highcharts Example</title>



   
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
                      <a href="javascript:; Prepaid">
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

          





  <!-- ////////////////////////////////////////////FIN DEL CONTENIDO DE SOLICITAR COTIZACIONES ///////////////////////////////////////////-->




    <!-- js placed at the end of the document so the pages load faster -->
    <!--<script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script> -->
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

