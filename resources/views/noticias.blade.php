@extends('app')
@section('meta')
<meta property="og:url" content="http://www.ligalaribera.com.ar" />
<meta property="og:title" content="Liga La Ribera" />
<meta property="og:description" content="" />
<meta property="og:image" content="http://www.ligalaribera.com.ar/img/logo.png" />
<meta property="og:type" content="website" />
@endsection
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
                    <div class="border-titulo-noticia"></div>
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
                                            <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=http://www.ligalaribera.com.ar/noticia/{{$listNoticias[$idxNoticia]->idnoticia}}&p[title]={{$listNoticias[$idxNoticia]->titulo}}&p[summary]={{$listNoticias[$idxNoticia]->texto}}&p[images][0]=http://www.ligalaribera.com.ar/imagenes/{{$listNoticias[$idxNoticia]->imagen}}" class="btn" >
                                                <i class="fa fa-facebook-square fa-2x"></i>
                                            </a>
                                             <a href="#noticia{{$listNoticias[$idxNoticia]->idnoticia}}" class=" btn btn-sm btn-warning" data-toggle="modal">Leer Más..</a>
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
        <section id="noticias-verde" >
            <div class="row">
                <div class="col-md-12">
                    <div id="noticias-verde">
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
                                            <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=http://www.ligalaribera.com.ar/noticia/{{$listNoticias[$idxNoticia]->idnoticia}}&p[title]={{$listNoticias[$idxNoticia]->titulo}}&p[summary]={{$listNoticias[$idxNoticia]->texto}}&p[images][0]=http://www.ligalaribera.com.ar/imagenes/{{$listNoticias[$idxNoticia]->imagen}}" class="btn" >
                                                <i class="fa fa-facebook-square fa-2x"></i>
                                            </a>
                                              <a href="#noticia{{$listNoticias[$idxNoticia]->idnoticia}}" class=" btn btn-sm btn-warning" data-toggle="modal">Leer Más..</a>
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
                            <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=http://www.ligalaribera.com.ar/noticia/{{$noticia->idnoticia}}&p[title]={{$noticia->titulo}}&p[summary]={{$noticia->texto}}&p[images][0]=http://www.ligalaribera.com.ar/imagenes/{{$noticia->imagen}}" class="btn">
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