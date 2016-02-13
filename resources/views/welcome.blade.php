@extends('app')
<meta property="og:url" content="http://www.ligatifosi.com" />
<meta property="og:title" content="Tifosi" />
<meta property="og:description" content="" />
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/home/ragazza02.jpg" />
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/home/escudotifosi.jpg" />
 @foreach($listFiguras as $fig)
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/{{$fig->imagen}}" />
@endforeach
@foreach($listEquipoIdeal as $fig)
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/{{$fig->imagen}}" />
@endforeach
<meta property="og:type" content="website" />
@section('title')
..::Tifosi::..
@endsection
@section('content')
<!--HOME SECTION START-->
<div id="home" >
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 ">
                  <div id="carousel-slider" data-ride="carousel" class="carousel slide  animate-in" data-anim-type="fade-in-up">
                      <div class="carousel-inner">
                          <div class="item active ">
                                <div class="row">
                                    <div class="col-xs-6"><img class="img-responsive center-block" src="/imagenes/home/escudotifosi.png"></div>
                                    <div class="col-xs-6"><img class="img-responsive center-block" src="/imagenes/home/ragazza02.png"></div>

                                </div>
                              <h1>
                              <strong>10 AÑOS DE EXPERIENCIA VINCULANDO
                                      EL ENTRETENIMIENTO Y EL DEPORTE
                                      EN LA CIUDAD DE ROSARIO.</strong>
                              </h1>
                              <p>
                              En nuestros complejos vas a poder encontrar instalaciones pensadas y preparadas
                              profesionalmente, con cocheras privadas, vestuarios personalizados, canchas con
                              medidas reglamentarias, una zona de bufete y parrilleros al aire libre y techados
                              equipados para disfrutar entre amigos un agradable tercer tiempo.
                              </p>
                          </div>
                      </div>
                  </div>
            </div>
        </div>
        <div class="row animate-in" data-anim-type="fade-in-up">
            <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 scroll-me">
                <a href="/sucursales" class=" btn button-custom btn-custom-two">CONOCE NUESTRAS SUCURSALES</a>
            </div>
        </div>
    </div>
</div>
<!--HOME SECTION END-->

<!--Noticias SECTION START-->
<section id="team" >
    <div class="container">
        <div class="row text-center header animate-in" data-anim-type="fade-in-up">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3>Noticias </h3>

                <hr />


            <!-- boton facebook para compartir una web <div class="fb-share-button" data-href="#team" data-layout="icon_link"></div>-->
            </div>
        </div>
        <div class="row animate-in" data-anim-type="fade-in-up">
        @foreach($listNoticias as $noticia)
            <div class="col-xs-offset-1 col-xs-10 col-sm-offset-0 col-sm-4 col-md-3 col-lg-3">
                <div class="team-wrapper">
                   <div class="team-inner" style="background-image: url('/imagenes/{{$noticia->imagen}}')" >
                      <a  href="http://www.facebook.com/sharer.php?s=100&p[url]=http://www.ligatifosi.com/noticia/{{$noticia->idnoticia}}&p[title]={{$noticia->titulo}}&p[summary]={{$noticia->texto}}&p[images][0]=http://www.ligatifosi.com/imagenes/{{$noticia->imagen}}">
                       <i class="fa fa-facebook-f" ></i>
                    </a>

                    <!--<div class="fb-share-button" data-href="#team" data-layout="icon_link"></div>-->
                    </div>
                    <div class="description">
                        <h3> {{$noticia->titulo}}</h3>
                        <!--<h5> <strong> Developer & Designer </strong></h5>-->
                        <p>
                        {{Illuminate\Support\Str::limit($noticia->texto,100, '.........')}}
                        <a href="#"data-toggle="modal" data-target="#modalNoticia{{$noticia->idnoticia}}">(Leer mas)</a>
                        </p>
                        @if($noticia->link!="")
                        <a href="{{$noticia->link}}" target="_blank">(Todavía Más)</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>
<!--NoticiasSECTION END-->

<!--Modales noticias-->

     @foreach($listNoticias as $noticia)
    <div id="modalNoticia{{$noticia->idnoticia}}"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h3 id="addModalLabel">
                    {{$noticia->titulo}} <small>{{$noticia->fecha}}</small></h3>
            </div>
            <div class=" modal-body ">
            {{$noticia->texto}}
            </div>
        </div>
    </div>
      @endforeach

<!--Fin Modales noticias-->


<section id="services">
    <div class="container">
        <div class="row text-center header">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                <h3> JUGADORES DE LA ULTIMA FECHA</h3>
                <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 scroll-me">
                    <a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://www.ligatifosi.com/jugadores-de-la-fecha" class=" btn button-custom btn-custom-two"><i class="fa fa-facebook"></i> Compartir</a>
                </div>
            </div>
        </div>
        <div class="row animate-in" data-anim-type="fade-in-up">
            @foreach($listFiguras as $fig)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="services-wrapper">
                <a class="fancybox-media" href="/imagenes/{{$fig->imagen}}">
                    <img class="img-responsive" src="/imagenes/{{$fig->imagen}}">
                </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<section id="grid">
    <div class="container">
        <div class="col-md-6 col-xs-12">
            <div class="row text-center header" >
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                      <h3>Equipo Ideal</h3>
                      <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 scroll-me">
                          <a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://www.ligatifosi.com/equipo-ideal" class=" btn button-custom btn-custom-two"><i class="fa fa-facebook"></i> Compartir</a>
                      </div>
                  </div>
            </div>
            <div class="row pad-bottom animate-in" data-anim-type="fade-in-up">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                            <div class="col-xs-12">
                               @foreach($listEquipoIdeal as $fig)
                                <a class="fancybox-media" href="/imagenes/{{$fig->imagen}}">
                                    <img class="img-responsive" src="/imagenes/{{$fig->imagen}}">
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-md-6 col-xs-12">
                <div class="row text-center header" >
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                          <h3>Pronostico</h3>
                          <hr>
                      </div>
                </div>
                <div class="row pad-bottom animate-in" data-anim-type="fade-in-up">

                    <div class="pronostico-wrapper">


<!-- yr.no -->
<!--
<script src="http://www.yr.no/place/Argentina/Santa_Fe/Rosario/external_box_three_days.js"></script><noscript><a href="http://www.yr.no/place/Argentina/Santa_Fe/Rosario/">yr.no: Clima en  Rosario</a></noscript>
-->

<!--tutiempo-->
                 <!--
                  <div style="width:315px;background-color:white;">
                   
                                     <div id="TT_tBsAbBYxt2IKdFxAjAzzzjzDDWaA1EClbtEd1syoKkz"><a href="http://www.tutiempo.net">El Tiempo</a></div>
                                     <script type="text/javascript" src="http://www.tutiempo.net/widget/eltiempo_tBsAbBYxt2IKdFxAjAzzzjzDDWaA1EClbtEd1syoKkz"></script>
                  </div>
                  -->


                  <!-- meteored-->



            <div id="climaHorizontal">
                  <div id="cont_ade9062ccc1b67e7b6b7d24660c317a5" class="center-block">
                    <span id="h_ade9062ccc1b67e7b6b7d24660c317a5"><a id="a_ade9062ccc1b67e7b6b7d24660c317a5" href="http://www.meteored.com.ar/" target="_blank" style="color:#808080;font-family:Helvetica;font-size:14px;"></a></span>
                    <script type="text/javascript" async src="http://www.meteored.com.ar/wid_loader/ade9062ccc1b67e7b6b7d24660c317a5"></script>
                  </div>
            </div>
  
              <div id="climaVertical" style="">
                <div id="cont_5cdc0e075415ad9136e5ba8c40edef92" class="center-block">
                  <span id="h_5cdc0e075415ad9136e5ba8c40edef92"><a id="a_5cdc0e075415ad9136e5ba8c40edef92" href="http://www.meteored.com.ar/tiempo-en_Rosario-America+Sur-Argentina-Santa+Fe--1-13586.html" target="_blank" rel="nofollow" style="color:#ffffff;font-family:Helvetica;font-size:14px;"></a></span>
                  <script type="text/javascript" async src="http://www.meteored.com.ar/wid_loader/5cdc0e075415ad9136e5ba8c40edef92"></script>
                </div>
  
              </div>
              

                </div>

             </div>
          </div>
    </div>
</section>

@endsection
@section('script')

@endsection