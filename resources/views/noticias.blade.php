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
Noticias
@endsection

@section('content')
<section id="section-page">
<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-titulo-medio"></div>
                    <h2>NOTICIAS</h2>
                    <br>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
</section>
<?php $idxNoticia =0; ?>
@for($i = 0; $i < $cantidadSecciones; $i++)
    @if($i == ($cantidadSecciones-1))
       <?php $cant =  $cantidadNoticias - $idxNoticia; ?>
    @else
       <?php $cant = 4; ?>
    @endif
    @if(($i%2)==0)
        <section id="noticias" >
            <div class="row">
                <div class="col-md-12">
                    <div id="noticias">
                        <div class="container">
                            <br>
                            <div class="row">
                                @for($ii = 0; $ii < $cant; $ii++)
                                    <div class="col-md-3 col-sm-6 text-center ">
                                        <span class="fa-stack fa-4x ">
                                            <img  src="/imagenes/iconosNoticias/{{$listNoticias[$idxNoticia]->icono}}" class="img-responsive">
                                        </span>
                                       <div class="fecha text-left"><span>{{$listNoticias[$idxNoticia]->fecha}}</span></div>
                                        <h4 class="service-heading text-left">{{strtoupper($listNoticias[$idxNoticia]->titulo)}}</h4>
                                        <hr>
                                        <p class="text-left col-noticia">{{Illuminate\Support\Str::limit($listNoticias[$idxNoticia]->texto,100, '.........')}}</p>
                                        <div class=" text-right">
                                            <a href="#" class="btn">
                                                <i class="fa fa-facebook-square fa-2x"></i>
                                            </a>
                                            <a href="#" class=" btn btn-sm btn-warning">Leer Más..</a>
                                        </div>
                                    </div>
                                    <?php $idxNoticia ++; ?>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section id="noticias" >
            <div class="row">
                <div class="col-md-12">
                    <div id="noticias">
                        <div class="container">
                            <br>
                            <div class="row">
                                @for($iii = 0; $iii < $cant; $iii++)
                                    <div class="col-md-3 col-sm-6 text-center ">
                                        <span class="fa-stack fa-4x ">
                                            <img  src="/imagenes/iconosNoticias/{{$listNoticias[$idxNoticia]->icono}}" class="img-responsive">
                                        </span>
                                       <div class="fecha text-left"><span>{{$listNoticias[$idxNoticia]->fecha}}</span></div>
                                        <h4 class="service-heading text-left">{{strtoupper($listNoticias[$idxNoticia]->titulo)}}</h4>
                                        <hr>
                                        <p class="text-left col-noticia">{{Illuminate\Support\Str::limit($listNoticias[$idxNoticia]->texto,100, '.........')}}</p>
                                        <div class=" text-right">
                                            <a href="#" class="btn">
                                                <i class="fa fa-facebook-square fa-2x"></i>
                                            </a>
                                            <a href="#" class=" btn btn-sm btn-warning">Leer Más..</a>
                                        </div>
                                    </div>
                                    <?php $idxNoticia ++; ?>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endfor
@endsection

@section('script')

@endsection