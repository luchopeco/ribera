@extends('app')
<meta property="og:url" content="http://www.ligalaribera.com.ar" />
<meta property="og:title" content="Liga La Ribera" />
<meta property="og:description" content="" />
<meta property="og:image" content="http://www.ligalaribera.com.ar/..." />
<meta property="og:image" content="http://www.ligalaribera.com.ar/imagenes/home/escudotifosi.jpg" />

<meta property="og:image" content="http://www.ligalaribera.com.ar/imagenes/" />


<meta property="og:image" content="http://www.ligalaribera.com.ar/imagenes/" />

<meta property="og:type" content="website" />
@section('title')

@endsection

@section('content')
@if(Session::has('mensajeOkContacto'))
<div class="container" style="margin-top: 100px" >
    <div class="row">
        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{Session::get('mensajeOkContacto')}}
            </div>
        </div>
    </div>
</div>
@endif
@if(Session::has('mensajeErrorContacto'))
<div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{Session::get('mensajeErrorContacto')}}
                </div>
            </div>
        </div>
</div>
@endif
<header>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="intro-text">
                    <div><h1>BIENVENIDOS A</h1></div>
                        <div class="intro-heading">LIGA LA RIBERA</div>
                    <div>
                        <p>Los que hacemos Liga La Ribera pretendemos lograr un espacio de integración<br>
                        donde las palabras <strong>"fútbol, amigos y juego limpio"</strong> sean moneda corriente.</p>
                    </div>
                    <br>
                    <div><a href="/laribera" class="page-scroll btn btn-xl " >CONOCENOS MAS</a></div>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="noticias" >
    <div class="row">
        <div class="col-md-12">
            <div id="noticias">
                <div class="container">
                    <br>
                    <div class="border-titulo-noticia"></div>
                    <h2>NOTICIAS</h2>
                    <br>
                    <div class="row">
                    @foreach($listNoticias as $noticia)
                        <div class="col-md-3 col-sm-6 text-center " style="margin-bottom: 15px">
                            <span class="fa-stack fa-4x ">
                                <img  src="/imagenes/iconosNoticias/{{$noticia->icono}}" class="img-responsive">
                            </span>
                           <div class="fecha text-left"><span>{{$noticia->fecha}}</span></div>
                            <h4 class="service-heading text-left">{{strtoupper($noticia->titulo)}}</h4>
                            <hr>
                            <p class="text-left col-noticia">{{Illuminate\Support\Str::limit($noticia->texto,100, '.........')}}</p>
                            <div class=" text-right">
                                <a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://www.ligalaribera.com.ar/noticia/{{$noticia->idnoticia}}&p[title]={{$noticia->titulo}}&p[summary]={{$noticia->texto}}&p[images][0]=http://www.ligalaribera.com.ar/imagenes/{{$noticia->imagen}}" class="btn" >
                                    <i class="fa fa-facebook-square fa-2x"></i>
                                </a>
                                <a href="#noticia{{$noticia->idnoticia}}" class=" btn btn-sm btn-warning" data-toggle="modal">Leer Más..</a>
                            </div>
                        </div>

                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="portfolio">
<div class="row">
        <div class="col-md-12">
            <div id="destacados-fecha">
                <div class="container">
                    <div class="border-titulo-noticia"></div>
                    <h2>DESTACADOS DE LA FECHA</h2>
                    <br>
                    <div class="row">
                        @foreach( $listDestacadosFecha  as $imagen )
                        <div class="col-md-3 col-sm-6 portfolio-item">
                            <img class="img-responsive" alt="" src="/imagenes/{{$imagen->imagen}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="verde">
    <div class="row">
        <div class="col-md-12">
            <div id="verde">
                 <div class="container">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border-titulo-medio"></div>
                            <h2>COMO LLEGO?</h2>
                            <br>
                            <div class="map-responsive">
                               <iframe src="https://www.google.com/maps/d/embed?mid=zdj0487fDBxk.kYA1aeXuXz0A&z=40" width="300" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border-titulo-medio"></div>
                            <h2>CONTACTANOS</h2>
                            <br>
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
                            <br>
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
                                    {!!Form::Text('celular',null,['class'=>' form-control','placeholder'=>'CELULAR','id'=>'celular'])!!}
                                    <script>
                                      var f2 = new LiveValidation('celular');
                                        f2.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea id="mensaje_contacto" name="mensaje_contacto" class="form-control" placeholder="MENSAJE" rows="5"></textarea>
                                    <script>
                                      var f20 = new LiveValidation('mensaje_contacto');
                                        f20.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12">
                                    {!!Form::submit('Enviar', array('class' => 'btn btn-warning btn-xl'))!!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</section>

@foreach($listNoticias as $noticia)
<div class="portfolio-modal modal fade" id="noticia{{$noticia->idnoticia}}" tabindex="-1" role="dialog" aria-hidden="true" style="padding-right: 0px !important;">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="modal-body">
                <div class="row text-left">
                    <div class="col-md-6">
                        <img src="/imagenes/{{$noticia->imagen}}" class="img-responsive" >
                    </div>
                    <div class="col-md-6">
                        <div class="fecha"><p>{{$noticia->fecha}}</p></div>
                        <h1>{{$noticia->titulo}}</h1>
                        <p>{{$noticia->texto}}</p>
                        <div class="fecha">
                            <a href="#" class="">
                                <i class="fa fa-facebook-square fa-2x"></i> COMPARTIR
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('script')

@endsection