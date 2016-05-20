@extends('app')
@section('meta')
<meta property="og:url" content="http://www.ligalaribera.com.ar/noticia/{{$n->idnoticia}}" />
<meta property="og:title" content="{{$n->titulo}}" />
<meta property="og:description" content="Noticias de la Liga" />
<meta property="og:image" content="http://www.ligalaribera.com.ar/imagenes/{{$n->imagen}}" />
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
                    <h2>NOTICIA</h2>
                    <br>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
</section>
<section id="noticias" >
    <div class="row">
        <div class="col-md-12">
            <div id="noticias">
                <div class="container">
                    <br>
                    <div class="row">
                          <div class="row text-left">
                             <div class="col-md-6">
                                 <img src="/imagenes/{{$n->imagen}}" class="img-responsive" >
                             </div>
                             <div class="col-md-6">
                                 <div class="fecha"><p>{{$n->fecha}}</p></div>
                                 <h1>{{$n->titulo}}</h1>
                                 <p>{{$n->texto}}</p>
                                 <div class="fecha">
                                     <a href="http://www.facebook.com/sharer/sharer.php?u=http://www.ligalaribera.com.ar/noticia/{{$n->idnoticia}}&p[title]={{$n->titulo}}&p[summary]={{$n->texto}}&p[images][0]=http://www.ligalaribera.com.ar/imagenes/{{$n->imagen}}" class="btn" >
                                         <i class="fa fa-facebook-square fa-2x"></i> COMPARTIR
                                     </a>
                                 </div>
                             </div>
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