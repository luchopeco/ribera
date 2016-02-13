@extends('app')
@section('meta')
<meta property="og:url" content="http://www.ligatifosi.com/noticia/{{$noticias->idnoticia}}" />
<meta property="og:title" content="{{$noticias->titulo}}" />
<meta property="og:description" content="{{Illuminate\Support\Str::limit($noticias->texto,150, '')}}" />
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/{{$noticias->imagen}}" />
<meta property="og:type" content="website" />
@endsection
@section('title')
..::Tifosi::..
@endsection
@section('content')

<!--Noticias SECTION START-->
<section id="team" class="margin-top" >
    <div class="container">
        <div class="row text-center header animate-in" data-anim-type="fade-in-up">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3>NOTICIAS </h3>
                <hr />
            </div>
        </div>
        <div class="row animate-in" data-anim-type="fade-in-up">
            <div class="col-xs-offset-1 col-xs-10 col-sm-offset-3 col-sm-6">
                <div class="team-wrapperr">
                   <div class="team-innerr" style="background-image: url('/imagenes/{{$noticias->imagen}}')" >
                    <a  href="http://www.facebook.com/sharer.php?s=100&p[url]=http://www.ligatifosi.com/noticia/{{$noticias->idnoticia}}&p[title]={{$noticias->titulo}}&p[summary]={{Illuminate\Support\Str::limit($noticias->texto,150, '')}}&p[images][0]=http://www.ligatifosi.com/imagenes/{{$noticias->imagen}}">
                       <i class="fa fa-facebook-f" ></i>
                    </a>
                    </div>
                    <div class="description">
                        <h3> {{$noticias->titulo}}</h3>
                        <p>
                        {{$noticias->texto}}
                        </p>
                        @if($noticias->link!="")
                        <a href="{{$noticias->link}}" target="_blank">(Más)</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--NoticiasSECTION END-->
@endsection
@section('script')

@endsection