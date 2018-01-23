<?php
global $usuario;
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'On');
session_start ();

if (isset($_SESSION['usuario']) and (!empty($_SESSION['usuario']))) {
    echo "<script>console.log('listo')</script>";
    $usuario= $_SESSION['usuario'];
    $gerencia=$_SESSION['gerente'];
    $nombre=$_SESSION['nombre'];
    $correo=$_SESSION['correo'];

    $idsupervision=$_SESSION['idsupervision'];
    echo "<script>console.log('Este es  $usuario ')</script>";
    echo "<script>console.log('Este es  $gerencia ')</script>";
    echo "<script>console.log('Este es  $idsupervision ')</script>";

?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">


    <title> Cockpit OM Redes Core, Transporte y Plataforma</title>

    {{HTML::style('assets/css/bootstrap.css');}} 
    {{HTML::style('assets/css/select.css');}}  
    {{HTML::style('assets/css/select.css');}}
    {{HTML::style('assets/font-awesome/css/font-awesome.css');}}  
    {{HTML::style('assets/css/zabuto_calendar.css');}}
    {{HTML::style('assets/js/gritter/css/jquery.gritter.css');}}
    {{HTML::style('assets/css/style.css');}}
    {{HTML::style('assets/css/style-responsive.css');}}
    {{HTML::style('assets/lineicons/style.css');}}

         
    {{HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');}}
    {{HTML::script('http://code.highcharts.com/highcharts.js');}}
    
    <!--<script src="http://code.highcharts.com/modules/exporting.js"></script>-->
   
    
    {{HTML::script('assets/js/jquery.dataTables.min.js');}}
    {{HTML::style('assets/css/jquery.dataTables.min.css');}}

    
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


<div>

  <header class="header black-bg" background-color: #ffd777>
              <div class="sidebar-toggle-box" >
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation" ></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo">  <img src={{asset('/assets/img/Cockpit/entel.png');}}  width="150"></a>
        <div class="top-menu">
              <ul class="nav pull-right top-menu">
              <li><h3 style="color:#F2F2F2;" > <?php echo$_SESSION['nombre']?> &nbsp;&nbsp; </h3>
                </li>
                <li><a class="logout" href="http://10.30.17.62:80/Cockpit/logout.php" style="color:black;">Cerrar Sesión</a></li>
               
              </ul>
            </div>
  </header>



  
  <!-- ////////////////////////////////////////////// MENÚ PRINCIPAL /////////////////////////////////////////////////-->

      <aside>
          <div id="sidebar"  class="nav-collapse " style="overflow: scroll;">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href=""><img src={{asset('assets/img/Cockpit/icono.png');}} class="img-circle" width="150"></a></p>

                  <h5 class="centered">COCKPIT</h5> 
                    
                  <li class="mt" >
                      <a href="HomeCockpit">
                          <i class="fa fa-home"></i>
                          <span>Home</span>
                      </a>
                  </li>

                  <?php if ($_SESSION['usuario'] == 'czorrillac' || $_SESSION['usuario'] == 'lanicamam' ) {?>

                  <li class="mt" style="background-color: red;">
                      <center><a href="HomeDisaster" >
                         
                          <span><b> <font style='color: white;'><big>¡ D
                          isaster ! </big></font></b></span>
                      </a>
                      </center>
                     
                  </li>

                  <?php };?>
                  <p></p>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Mayorista </span>
                      </a>
                      <ul class="sub">
                          
                          <li><a  href="HomeRoaming">KPI's</a></li>
                          
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>VAS</span>
                      </a>
                      <ul class="sub">
                          
                          <li><a  href="HomeVasSmsc">SMSC</a></li>
                          <li><a  href="HomeVasUssd">USSD</a></li>
                          <li><a  href="HomeVasDmm">DMM</a></li>
                          <li><a  href="HomeVasMmsc">MMSC</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >  
                          <i class="fa fa-desktop"></i>
                          <span>Prepaid</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="HomePrepaidServices" >Services</a></li>
                          <li><a  href="HomePrepaidIcc">ICC</a></li>
                          <li><a  href="HomePrepaidLicense">License</a></li>
                          
                      </ul>
                  </li>


                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Datacomm</span>
                      </a>

                      <ul class="sub">
                       
                          <li><a  href="HomeDatacommNE">Equipos</a></li>
                          <li><a  href="HomeDatacommEnlaces">Enlaces</a></li>
                         
                         
                      </ul>
                      
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Datos</span>
                      </a>
                      <ul class="sub">
                       
                          <li><a  href="HomeDatosUsn">USN</a></li>
                          <li><a  href="HomeDatosUgw">UGW</a></li>
                          <li><a  href="HomeDatosCpu">CPU Usage</a></li>
                         
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Voz</span>
                      </a>
                      <ul class="sub">
                    
                          <li><a  href="HomeVozMsc">MSC Pool</a></li>
                          <li><a  href="HomeVozGmsc">GMSC / HSS / SG</a></li>
                          <li><a  href="HomeVozUmgs">UMGS / MGW Pool</a></li>
                          <li><a  href="HomeVozBicc">BICC</a></li>
                          <li><a  href="HomeVozTroncales">Troncales</a></li>
                          <li><a  href="HomeVozLicencias">Licencias</a></li>
                         
                         
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>RAN</span>
                      </a>
                      <ul class="sub">
                       
                          <li><a  href="HomeRanIden">iDEN</a></li>
                          <li><a  href="HomeRanRnc">RNC</a></li>
                          <li><a  href="HomeRanBsc">BSC</a></li>
                         
                         
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>ISP</span>
                      </a>
                      <ul class="sub">
                       
                          <li><a  href="HomeIsp1">Provider - IGR - ACS - EGR</a></li>
                          <li><a  href="HomeIsp2">RAN</a></li>
                          <li><a  href="HomeIsp3">P-RAN</a></li>
                          <li><a  href="HomeIsp4">DNS</a></li>
                          <li><a  href="HomeIsp5">Barracuda/CITRIX/RADWARE/Central LAN</a></li>
                          <li><a  href="HomeIsp6">RED LEGACY</a></li>
                         
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Transporte</span>
                      </a>
                      <ul class="sub">
                       
                          <li><a  href="TransporteNorte">Enlaces Norte</a></li>
                          <li><a  href="TransporteCentro">Enlaces Centro</a></li>
                          <li><a  href="TransporteSur">Enlaces Sur</a></li>
                          <li><a  href="TransporteLima">Enlaces Lima Provincias</a></li>
                          
                         
                         
                      </ul>
                  </li>

                  <?php if ($gerencia=="O&M REDES CORE, TRNSP. Y PLATF."  and $idsupervision != 0) {?>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Carga de datos</span>
                      </a>
                      <ul class="sub">
                       
                          
                          <li><a  href="DatosDatos">Upload</a></li>
                         
                          
                         
                         
                      </ul>
                  </li>
                 <?php };?>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>


  
  @section('Home')
    
  @show

 
  <script type="text/javascript"> var ip="http://10.30.17.62:80/Entel/public/index.php/";</script>


   <!-- ===========================VISTAS DISASTER ================================= -->

    @section('disaster')
    
     @show

     @section('homedisaster')
    
     @show


   <!-- ===========================VISTAS VAS ================================= -->


  @section('smsc')
    
  @show

  @section('ussd')
    
  @show

  @section('dmm')
    
  @show

  @section('mmsc')
    
  @show

 <!-- ===========================VISTAS Prepaid ================================= -->

  @section('services')
    
  @show

  @section('icc')
    
  @show

  @section('license')
    
  @show

   <!-- ===========================VISTAS Datacomm ================================= -->


   @section('ne')
    
  @show

  @section('enlaces')
    
  @show

   <!-- ===========================VISTAS datos ================================= -->


  @section('usn')
    
  @show

  @section('ugw')
    
  @show

  @section('cpu')
    
  @show


   <!-- ===========================VISTAS transporte ================================= -->


  @section('TransporteNorte')
    
  @show

  @section('TransporteCentro')
    
  @show

  @section('TransporteSur')
    
  @show

  @section('TransporteLima')
    
  @show

  <!-- ===========================VISTAS RAN ================================= -->


  @section('iden')
    
  @show

  @section('rnc')
    
  @show

  @section('bsc')
    
  @show


  <!-- ===========================VISTAS VOZ ================================= -->


  @section('msc')
    
  @show

  @section('gmsc')
    
  @show

  @section('umgs')
    
  @show

  @section('bicc')
    
  @show

  @section('troncales')
    
  @show

  @section('vlicense')
    
  @show


<!-- ===========================VISTAS ISP ================================= -->


  @section('isp1')
    
  @show

  @section('isp2')
    
  @show

  @section('isp3')
    
  @show

  @section('isp4')
    
  @show

  @section('isp5')
    
  @show

  @section('isp6')
    
  @show


<!-- ===========================VISTA DE CARGA ================================= -->


 

  @section('ddatos')
    
  @show

  <!-- ===========================VISTA DE ROAMING ================================= -->


 

  @section('roaming')
    
  @show

 

</div>

  
 
  
    {{HTML::script('assets/js/bootstrap.min.js');}}
    {{HTML::script('assets/js/bootbox.min.js');}}
    {{HTML::script('assets/js/jquery.dcjqaccordion.2.7.js');}}
    {{HTML::script('assets/js/jquery.scrollTo.min.js');}}
    <!--{{HTML::script('assets/js/jquery.nicescroll.js')}};-->
    {{HTML::script('assets/js/jquery.sparkline.js');}}
    {{HTML::script('assets/js/jquery.datetimepicker.full.min.js');}}
    {{HTML::style('assets/css/jquery.datetimepicker.css');}}




    <!--common script for all pages-->
    {{HTML::script('assets/js/common-scripts.js');}}
    
    {{HTML::script('assets/js/gritter/js/jquery.gritter.js');}}
    {{HTML::script('assets/js/gritter-conf.js');}}

    <!--script for this page-->
    {{HTML::script('assets/js/sparkline-chart.js');}}    
    {{HTML::script('assets/js/zabuto_calendar.js');}} 
    {{HTML::script('assets/js/chart-master/Chart.js');}} 



    <!--{{HTML::script('assets/js/chartjs-conf.js');}} 
   


 

<script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  -->




<script type="application/javascript">

      var nombre="<?php echo $nombre?>";
      var correo="<?php echo $correo?>";

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


        function abrirVentana(id1,id2,semanas){
        console.log(semanas);
        var url="actualizar?semanas="+semanas+"&idsupervision="+id1+"&idgrafica="+id2;
        open(url,"","top=300,left=300,width=300,height=500") ;  
      }




      function getcategory(c){  

                        var var1=c+''; 
                        var var2="";
                        var contador=0;
                        var resultado=[];

                        for (var i = 0; i < var1.length; i++) {

                            
                            var2=var2+var1[i];
                            contador++;

                              if (contador==4) {var2=var2+"-"};

                              if (contador==6) {
                                contador=0;
                                resultado.push(var2);
                                var2="";
                                i++;
                              }
                        
                          }

                          return resultado;

                        };


      
    </script>



</body>
</html>
<?php }else {
    echo "<script>location.href='http://localhost/Cockpit/login.php';</script>";

    //echo "<script>location.href='http://localhost/Cockpit/login.php';</script>";
}
?>
