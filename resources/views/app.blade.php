<?php
$listImagen=\torneo\Imagen::where('idtipo_imagen', 1)->where('mostrar',1)->get();
$ruta= Route::currentRouteAction();
?>
<!DOCTYPE html>
<html lang="es" class="no-js" >
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="Tifosi" />
<meta name="author" content="Wiphala Sistemas" />
@yield('meta')
<link rel="shortcut icon" href="/faviconPublico.ico" />
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<title> @yield('title')</title>
<!-- BOOTSTRAP CORE CSS -->
<link href="/assets/css/bootstrap.css" rel="stylesheet" />
<!-- ION ICONS STYLES -->
<link href="/assets/css/ionicons.css" rel="stylesheet" />
<!-- FONT AWESOME ICONS STYLES -->
<link href="/assets/css/font-awesome.css" rel="stylesheet" />
<!-- FANCYBOX POPUP STYLES -->
<link href="/assets/js/source/jquery.fancybox.css" rel="stylesheet" />
<!-- STYLES FOR VIEWPORT ANIMATION -->
<link href="/assets/css/animations.min.css" rel="stylesheet" />
<!-- CUSTOM CSS -->
<link href="/assets/css/style-red.css" rel="stylesheet" />
<link href="/assets/css/css.css" rel="stylesheet" />

<script src="/assets/js/livevalidation_standalone.compressed.js" type="text/javascript"></script>
@yield('css')


<!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body data-spy="scroll" data-target="#menu-section">
<!--MENU SECTION START-->
<div class="navbar navbar-inverse navbar-fixed-top scroll-me" id="menu-section" >
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="/">

<img src="/imagenes/logo.png">

</a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right">
@if($ruta=='torneo\Http\Controllers\WelcomeController@index')
<li class="active"><a href="/">HOME</a></li>
@else
<li><a href="/">HOME</a></li>
@endif
@if($ruta=='torneo\Http\Controllers\WelcomeController@instalaciones')
<li class="active" ><a href="/sucursales">SUCURSALES</a></li>
@else
<li><a href="/sucursales">SUCURSALES</a></li>
@endif

@if($ruta=='torneo\Http\Controllers\WelcomeController@inscripcion')
<li class="active"><a href="/inscripcion">INSCRIPCION</a></li>
@else
<li><a href="/inscripcion">INSCRIPCION</a></li>
@endif

@if($ruta=='torneo\Http\Controllers\WelcomeController@fixture')
<li class="active"><a href="/fixture">FIXTURE</a></li>
@else
<li><a href="/fixture">FIXTURE</a></li>
@endif

@if($ruta=='torneo\Http\Controllers\WelcomeController@estadisticas')
<li class="active"><a href="/estadisticas">ESTADISTICAS</a></li>
@else
<li><a href="/estadisticas">ESTADISTICAS</a></li>
@endif

@if($ruta=='torneo\Http\Controllers\WelcomeController@noticias')
<li class="active"><a href="/noticias">NOTICIAS</a></li>
@else
<li><a href="/noticias">NOTICIAS</a></li>
@endif

@if($ruta=='torneo\Http\Controllers\WelcomeController@equipo')
<li class="active"><a href="/equipo">EQUIPOS</a></li>
@else
<li><a href="/equipo">EQUIPOS</a></li>
@endif

</ul>
</div>

</div>
</div>
@if(Session::has('mensajeOkContacto'))
<div class="container" style="padding-top: 150px">
    <div class="row">
        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{Session::get('mensajeOkContacto')}}
            </div>
        </div>
    </div>
    </hr>
</div>
@endif
@if(Session::has('mensajeErrorContacto'))
<div class="container" style="padding-top: 150px">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{Session::get('mensajeErrorContacto')}}
                </div>
            </div>
        </div>
</div>
        </hr>
@endif
<div id="cargando" style="position: fixed; top: 2%; left: 50%; z-index: 1051;">

</div>
@yield('content')

<!--CONTACT SECTION START-->
<section id="contact" >
    <div id="contacto">
        <div class="container">
            <div class="row text-center header animate-in" data-anim-type="fade-in-up">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3>Contacto</h3>
                    <hr />
                </div>
            </div>
            <div class="row animate-in" data-anim-type="fade-in-up">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="contact-wrapper text-center">
                        <h3>COMPLETE NUESTRO FORMULARIO</h3>
                        {!!Form::open(['url'=>'/mailcontacto','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                        <input type="text" id="validador_contacto" name="validador_contacto" value=""  class="hidden">
                            <div class="row">
                                <div class="col-md-12">
                                    {!!Form::Text('nombre_contacto',null,['class'=>' form-control','placeholder'=>'NOMBRE Y APELLIDO','id'=>'nombre_contacto'])!!}
                                    <script>
                                      var f1 = new LiveValidation('nombre_contacto');
                                        f1.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    {!!Form::Text('mail_contacto',null,['class'=>' form-control mi-input','placeholder'=>'MAIL','id'=>'mail_contacto'])!!}
                                    <script>
                                      var f5 = new LiveValidation('mail_contacto');
                                        f5.add( Validate.Email, {failureMessage: "Ingrese un mail Válido"} );
                                        f5.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                                <div class="col-md-6">
                                    {!!Form::Text('ciudad_contacto',null,['class'=>' form-control','placeholder'=>'CIUDAD','id'=>'ciudad_contacto'])!!}
                                    <script>
                                      var f2 = new LiveValidation('ciudad_contacto');
                                        f2.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea id="mensaje_contacto" name="mensaje_contacto" class="form-control" placeholder="MENSAJE" rows="1"></textarea>
                                    <script>
                                      var f20 = new LiveValidation('mensaje_contacto');
                                        f20.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12">
                                    {!!Form::submit('Enviar', array('class' => 'btn btn-danger btn-block'))!!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="contact-wrapper">
                        <h3>Contacto Rapido</h3>
                        <h4><strong>Email : </strong> ligatifosi@hotmail.com</h4>
                        <h4><strong>Tel : </strong>(0341)-156 56 3365/153 43 0596</h4>
                        <h3>Datos Personales</h3>
                        <h4><strong>ZONA NORTE: Don Orione 690</strong></h4>
                        <h4><strong>FUNES CITY: Rondeau 591</strong></h4>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <div class="contact-wrapper" >
                         <img class="img-responsive center-block " src="/imagenes/footer/gatorade.png">
                    </div>
                </div>
            </div>
            <div class="row animate-in" data-anim-type="fade-in-up">
                <div class="col-xs-12">
                    <div class="marcas row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-xs-3"><img src="/imagenes/logo.png" class="img-responsive inline" alt="Responsive image"/></div>
                                <div class="col-xs-3"><img src="/imagenes/footer/sts.png" class="img-responsive inline" alt="Responsive image"/></div>
                                <div class="col-xs-3"><img src="/imagenes/footer/quilmes.png" class="img-responsive inline" alt="Responsive image"/></div>
                                <div class="col-xs-3"><img src="/imagenes/footer/pepsi.png" class="img-responsive inline" alt="Responsive image"/></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="row">
                                        <div class="col-xs-4"><img src="/imagenes/footer/auckland.png" class="img-responsive inline" alt="Responsive image"/></div>
                                        <div class="col-xs-4"><img src="/imagenes/footer/photoclub.png" class="img-responsive inline" alt="Responsive image"/></div>
                                        <div class="col-xs-4"><img src="/imagenes/footer/laprida.png" class="img-responsive inline" alt="Responsive image"/></div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="row">
                                         <div class="col-xs-6"><img src="/imagenes/footer/nassau.png" class="img-responsive inline" alt="Responsive image"/></div>
                                         <div class="col-xs-6"><img src="/imagenes/footer/northland.png" class="img-responsive inline" alt="Responsive image"/></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row animate-in" data-anim-type="fade-in-up">
                <div class="col-xs-12">
                    <div class="powerby text-center">
                    2015-TODOS LOS DERECHOS RESERVADOS -DISEÑO <a target="_blank" href="http://shoutside.com.ar/contacto.php">FABRICA</a> // DESARROLLO <a target="_blank" href="http://www.wiphalasistemas.com.ar">Wiphala Sistemas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--CONTACT SECTION END-->

<!--Social-->
<div class="social-buton social-buton-f">
    <a href="https://es-la.facebook.com/tifosi.rosario" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
</div>
<!--Social Fin-->

<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME -->
<!-- CORE JQUERY -->
<script src="/assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="/assets/js/bootstrap.js"></script>
<!-- EASING SCROLL SCRIPTS PLUGIN -->
<script src="/assets/js/vegas/jquery.vegas.min.js"></script>
<!-- VEGAS SLIDESHOW SCRIPTS -->
<script src="/assets/js/jquery.easing.min.js"></script>
<!-- FANCYBOX PLUGIN -->
<script src="/assets/js/source/jquery.fancybox.js"></script>
<!-- ISOTOPE SCRIPTS -->
<script src="/assets/js/jquery.isotope.js"></script>
<!-- VIEWPORT ANIMATION SCRIPTS   -->
<script src="/assets/js/appear.min.js"></script>
<script src="/assets/js/animations.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="/assets/js/custom.js"></script>

<script>
  $(function () {
       $.vegas('slideshow', {
       backgrounds: [
           @foreach($listImagen as $imagen)
          { src: '/imagenes/{{$imagen->imagen}}', fade: 1000, delay: 9000},
           @endforeach
       //{ src: 'assets/img/2.jpg', fade: 1000, delay: 9000 },
       ]
       })('overlay', {
       /** SLIDESHOW OVERLAY IMAGE **/
       src: '/assets/js/vegas/overlays/06.png' // THERE ARE TOTAL 01 TO 15 .png IMAGES AT THE PATH GIVEN, WHICH YOU CAN USE HERE
       });
});

</script>

    @yield('script')
</body>

</html>
