@extends('app')
@section('title')
..::Tifosi::..
@endsection
@section('css')
 <link href="/css/flexslider.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section id="sucursales" class="margin-top">
    <div class="container">
        <div class="row text-center header">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                <h3>SUCURSALES</h3>
                <hr>
            </div>
        </div>
        <div class="animate-in" data-anim-type="fade-in-up">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="work-wrapper alto">
                        <a class="fancybox-media" href="/imagenes/sucursales/norte/003grande.jpg">
                            <img class="img-responsive" src="/imagenes/sucursales/norte/003grande.jpg">
                        </a>
                        <div class="row">
                            <div class="contenedor">
                                <h4>Zona Norte</h4>
                                <div>
                                    <span class="subtitulo">Dirección:</span> Don Orione 690
                                </div>
                                <div>
                                    <span class="subtitulo">Características del Predio:</span>5000 metros, cubiertos, 300cocheras exclusivas para clientes,
                                    5 canchas de fútbol 5 y de 6, parrilleros, vestuarios, bufete, seguridad privada.
                                </div>
                                <br>
                                <div class="telefono">
                                   <i class="fa fa-phone-square fa-lg"></i> Tel: (0341)-156 56 3365/153 43 0596
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="work-wrapper alto">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="contenedor">
                                <h4>TIFOSI CUENTA CON 10 AÑOS DE EXPERIENCIA VINCULANDO EL ENTRENAMIENTO Y EL DEPORTE EN LA CIUDAD DE ROSARIO</h4>
                            </div>
                        </div>
                         <div class="col-xs-12">
                            <div class="contenedor">
                               <p>
                               En nuestros complejos vas a poder encontrar instalaciones pensadas y preparadas
                               profesionalmente, con cocheras privadas, vestuarios personalizados, canchas con
                               medidas reglamentarias, una zona de bufete y parrilleros al aire libre y techados equipados
                               para disfrutar entre amigos un agradable tercer tiempo.</p>
                               <p>Las personas que hacemos Tifosi sentimos el deporte como estilo de vida, nos apasiona, es por eso que cada evento es un nuevo desafío para el staff. Nuestros años de
                               experiencia avalan la calidad de trabajo con la que respondemos a los que confian en nosotros.</p>
                               <p>Son varias las razones que te pueden acercar a nuestros complejos, puede ser porque
                               quieras alquilar una de nuestras canchas para 5,6,7, o 9 jugadores o podes participar
                               de nuestras ligas de fútbol masculinas y femeninas, o si sos de los que trabajan
                               mucho, organizamos torneos nocturnos y entre semana. También podes llegar a
                               nosotros para armar eventos empresariales o cumpleaños infantiles en cualquiera de
                               nuestros 2 predios.
                               </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="work-wrapper alto">
                        <a class="fancybox-media" href="/imagenes/sucursales/funes/002grande.jpg">
                            <img class="img-responsive" src="/imagenes/sucursales/funes/002grande.jpg">
                        </a>
                        <div class="row">
                            <div class="contenedor">
                                <h4>Funes City</h4>
                                <div>
                                    <span class="subtitulo">Dirección:</span> Roundeau 591
                                </div>
                                <div>
                                    <span class="subtitulo">Características del Predio:</span> 9500 metros cuadrados, 7 canchas de fútbol 5-7-9, cocheras para 85 autos,
                                    bufete, parrilleros, vestuario, seguridad privada.
                                </div>
                                <br>
                                <div class="telefono">
                                    <i class="fa fa-phone-square fa-lg"></i> Tel: (0341)-156 56 3365/153 43 0596
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="work-wrapper altominimo">
                    <div class="row"><div class="contenedor"><h4>Galeria de Imagenes Zona Norte</h4></div></div>
                       <div class="flexslider">
                         <ul class="slides">
                            <?php
                            $directorio = opendir("imagenes/sucursales/norte"); //ruta actual
                            while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                            {
                                if (! (is_dir($archivo)))//verificamos si es o no un directorio
                                {

                            ?>
                                 <li>
                                     <a class="fancybox-media" href="imagenes/sucursales/norte/<?php echo $archivo; ?>">
                                      <img src="imagenes/sucursales/norte/<?php echo $archivo; ?>" />
                                      </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                         </ul>
                       </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="work-wrapper altominimo">
                     <div class="row"><div class="contenedor"><h4>Galeria de Imagenes Funes City</h4></div></div>
                          <div class="flexslider">
                             <ul class="slides">
                                <?php
                                $directorio = opendir("imagenes/sucursales/funes"); //ruta actual
                                while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                                {
                                    if (! (is_dir($archivo)))//verificamos si es o no un directorio
                                    {

                                ?>
                                     <li>
                                         <a class="fancybox-media" href="imagenes/sucursales/funes/<?php echo $archivo; ?>">
                                          <img src="imagenes/sucursales/funes/<?php echo $archivo; ?>" />
                                          </a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                             </ul>
                           </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="js/jquery.flexslider-min.js"></script>
<script>
$(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 210,
        itemMargin: 5,
        controlNav: false,
        minItems: 1,
        maxItems: 2
      });
    });
</script>
@endsection
