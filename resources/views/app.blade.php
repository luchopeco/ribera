<?php
$listImagen=\torneo\Imagen::where('idtipo_imagen', 1)->where('mostrar',1)->get();
$ruta= Route::currentRouteAction();

?>
<!DOCTYPE html>
<html lang="es" class="no-js" >
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Liga La Ribera">
    <meta name="author" content="Wiphala Sistemas">
    <link rel="shortcut icon" href="/faviconPublico.ico" />
    @yield('meta')
    <title> @yield('title')Liga La Ribera</title>
    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/agency.css" rel="stylesheet">
    <link href="/css/css.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <script src="/js/livevalidation_standalone.compressed.js" type="text/javascript"></script>

    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top" class="index" style="background:black;">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand page-scroll" href="#page-top"><img id="imagenNormal" class="img-responsive text-left" src="/img/logo.png" style="display:block;"></a>
                <a class="navbar-brand page-scroll" href="#page-top"><img id="imagenChica"  class="img-responsive text-left" src="/img/minilogo.png" style="display:none;height:80px;width:160px;margin-top:-20px;"></a>

            </div>

           


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if($ruta=='torneo\Http\Controllers\HomeController@index')
                        <li class="active"><a class="page-scroll" href="/">HOME</a></li>
                    @else
                        <li><a class="page-scroll" href="/">HOME</a></li>
                    @endif

                     @if($ruta=='torneo\Http\Controllers\HomeController@laribera')
                        <li class="active"><a class="page-scroll" href="/laribera">LA RIBERA</a></li>
                    @else
                        <li ><a class="page-scroll" href="/laribera" >LA RIBERA</a></li>
                    @endif
                    @if($ruta=='torneo\Http\Controllers\HomeController@estadisticas')
                        <li class="active"><a class="page-scroll" href="/estadisticas">ESTADÍSTICAS</a></li>
                    @else
                        <li ><a class="page-scroll" href="/estadisticas" >ESTADÍSTICAS</a></li>
                    @endif
                    @if($ruta=='torneo\Http\Controllers\HomeController@fixture')
                        <li class="active"><a class="page-scroll" href="/fixture">FIXTURE</a></li>
                    @else
                        <li ><a class="page-scroll" href="/fixture" >FIXTURE</a></li>
                    @endif
                    @if($ruta=='torneo\Http\Controllers\HomeController@inscripcion')
                        <li class="active"><a class="page-scroll" href="/inscripcion">INSCRIPCIÓN</a></li>
                    @else
                        <li ><a class="page-scroll" href="/inscripcion" >INSCRIPCIÓN</a></li>
                    @endif
                    @if($ruta=='torneo\Http\Controllers\HomeController@noticias')
                        <li class="active"><a class="page-scroll" href="/noticias">NOTICIAS</a></li>
                    @else
                        <li ><a class="page-scroll" href="/noticias" >NOTICIAS</a></li>
                    @endif
                    @if($ruta=='torneo\Http\Controllers\HomeController@equipo')
                        <li class="active"><a class="page-scroll" href="/equipo">EQUIPOS</a></li>
                    @else
                        <li ><a class="page-scroll" href="/equipo" >EQUIPOS</a></li>
                    @endif
                    {{--<li>--}}
                        {{--<a class="page-scroll" href="#" style="cursor:not-allowed">CONTACTO</a>--}}
                    {{--</li>--}}


                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div id="cargando" style="position: fixed; top: 2%; left: 50%; z-index: 1051;">
    </div>

    @yield('content')
    

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-4">
                    <img class="img-responsive" src="/imagenes/footer/auckland.png">
                </div>
                <div class="col-md-2 col-sm-4">
                    <img class="img-responsive" src="/imagenes/footer/espana.png">
                </div>
                <div class="col-md-2 col-sm-4">
                    <img class="img-responsive" src="/imagenes/footer/house.png">
                </div>
                <div class="col-md-2 col-sm-4">
                    <img class="img-responsive" src="/imagenes/footer/rumah.png">
                </div>
                <div class="col-md-2 col-sm-4">
                    <img class="img-responsive" src="/imagenes/footer/sts.png">
                </div>
                <div class="col-md-2 col-sm-4">
                    <img class="img-responsive" src="/imagenes/footer/txr.png">
                </div>


            </div>
            <div class="row">
                <div class="col-md-4">
                    {{--<span class="copyright">Copyright &copy; Your Website 2014</span>--}}
                </div>
                <div class="col-md-4">
                    {{--<ul class="list-inline social-buttons">--}}
                        {{--<li><a href="#"><i class="fa fa-twitter"></i></a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#"><i class="fa fa-facebook"></i></a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#"><i class="fa fa-linkedin"></i></a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="http://www.shoutsidestudio.com.ar" target="_blank">Fabrica</a>
                        </li>
                        <li><a href="#">/</a></li>
                        <li><a href="http://www.wiphalasistemas.com.ar" target="_blank">Wiphala Sistemas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->





    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="/js/classie.js"></script>
    <script src="/js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="/js/jqBootstrapValidation.js"></script>
    <script src="/js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/agency.js"></script>

    <!-- EASING SCROLL SCRIPTS PLUGIN -->
    <script src="/js/vegas/jquery.vegas.min.js"></script>
    <!-- VEGAS SLIDESHOW SCRIPTS -->
    <script src="/js/jquery.easing.min.js"></script>

    <script>
        $(function () {

            $.vegas('slideshow', {
                backgrounds: [
                    @foreach($listImagen as $imagen)
                    { src: '/imagenes/{{$imagen->imagen}}', fade: 1000, delay: 9000},
                    @endforeach
                ]
            })('overlay', {
            //SLIDESHOW OVERLAY IMAGE
            //src: '/js/vegas/overlays/06.png' // THERE ARE TOTAL 01 TO 15 .png IMAGES AT THE PATH GIVEN, WHICH YOU CAN USE HERE
            });

            
    });
    </script>



    <script type="text/javascript">
        $(function () {
              var $win = $(window);
              // definir mediente $pos la altura en píxeles desde el borde superior de la ventana del navegador y el elemento
              var $pos = 103;
              $win.scroll(function () {

                    //alert($( window ).width());

                     if ($win.scrollTop() <= $pos){                             
                        $('#imagenNormal').css('display','block');
                        $('#imagenChica').css('display','none');
                     }               
                     else {                
                        $('#imagenChica').css('display','block');
                        $('#imagenNormal').css('display','none');
                    }
               });
        });
    </script>

    @yield('script')
</body>

</html>





