@extends('app')
<meta property="og:url" content="http://www.ligatifosi.com" />
<meta property="og:title" content="Tifosi" />
<meta property="og:description" content="" />
<meta property="og:image" content="http://www.ligalaribera.com.ar/..." />
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/home/escudotifosi.jpg" />

<meta property="og:image" content="http://www.ligatifosi.com/imagenes/" />


<meta property="og:image" content="http://www.ligatifosi.com/imagenes/" />

<meta property="og:type" content="website" />
@section('title')

@endsection

@section('content')

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
                    <div><a href="#services" class="page-scroll btn btn-xl">CONOCENOS MAS</a></div>
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
                    <div class="border-titulo-noticia"></div>
                    <h2>NOTICIAS</h2>
                    <br>
                    <div class="row">
                    @foreach($listNoticias as $noticia)
                        <div class="col-md-3 col-sm-6 text-center">
                            <span class="fa-stack fa-4x ">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                            </span>
                           <div class="fecha text-left"><span>{{$noticia->fecha}}</span></div>
                            <h4 class="service-heading text-left">{{strtoupper($noticia->titulo)}}</h4>
                            <hr>
                            <p class="text-left">{{Illuminate\Support\Str::limit($noticia->texto,100, '.........')}}</p>
                            <div class=" text-right"><a href="#" class=" btn btn-sm btn-warning">Leer Más..</a></div>
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
                            <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content">
                                        <i class="fa fa-plus fa-3x"></i>
                                    </div>
                                </div>
                                <img class="img-responsive" alt="" src="/imagenes/{{$imagen->imagen}}">
                            </a>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border-titulo-medio"></div>
                            <h2>COMO LLEGO?</h2>
                            <br>
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
                                    <textarea id="mensaje_contacto" name="mensaje_contacto" class="form-control" placeholder="MENSAJE" rows="1"></textarea>
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
@endsection

@section('script')

@endsection