<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>

<!-- Basic Page Needs ================================================== 
================================================== -->

<meta charset="utf-8">
<title>Entel Peru</title>
<meta name="description" content="Place to put your description text">
<meta name="author" content="">
<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<!-- Mobile Specific Metas ================================================== 
================================================== -->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

<!-- CSS ==================================================
================================================== -->

{{HTML::style('assets/css/bootstrap.css');}}
{{HTML::style('assets/css/login.css');}} 
{{HTML::script('assets/js/jquery.js');}}
{{HTML::script('assets/js/jquery-1.8.3.min.js');}}
{{HTML::script('assets/js/bootstrap.min.js');}}
{{HTML::script('assets/js/jquery.dcjqaccordion.2.7.js');}}
{{HTML::script('assets/js/login.js');}} 

<!-- Google Fonts ==================================================
================================================== -->

<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
</head>

<body>
<body background= {{asset('/assets/img/Cockpit/fondo.jpg');}}>

<!-- econtainer ends here --> 
<!-- About Content Part - Box Two ==================================================
================================================== -->
<div class="container">
  <div class="sepContainer1"></div>
  

 <section id="main-content">

  <p></p>
 

      <section class="wrapper">
        <p> </p>
      <div class="container">
       
        <p></p>
      <div class="row">
        <p></p>

      <div class="col-md-6 col-md-offset-3">

        <p></p>
       
        <div class="panel panel-login">
          
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" class="active" id="login-form-link"><img src={{asset('/assets/img/Cockpit/entel2.png');}}  width="200"></a>
              </div>
             <!--
              <div class="col-xs-6">
                <a href="#" id="register-form-link">Registrarse</a>
              </div>-->
           
            </div>
            <hr>
          </div>

          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <!-- aqui se muestra el Login del formulario-->
                <form id="login-form" action="postLogin" method="POST" role="form" style="display: block;">
                  
                  <div class="form-group text-center">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Usuario" value="" >
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña">
                  </div>

                  <div class="form-group text-center">
                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember" >
                    <label for="remember" style="color:black"> Recordar credenciales</label>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                      </div>
                    </div>
                  </div>

                  
                </form>

                <form id="register-form" action="createUser" method="POST" role="form" style="display: none;">
                  
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Usuario" value="">
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Dirección Email" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña">
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirmar Contraseña">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrarse ahora">
                      </div>
                    </div>
                  </div>
                </form>
                @foreach($errors->all() as $mensaje)
                  <li>{{$mensaje}}</li>
                @endforeach
                @if(Session::get('msg'))
                {{Session::get('msg')}}
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- ENDS Toggle --> 
</div>


</body>

</html>