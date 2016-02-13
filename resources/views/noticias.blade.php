@extends('app')
@section('title')
..::Tifosi::..
@endsection
@section('content')
<!--Noticias SECTION START-->
<section id="team" class="margin-top" >
    <div class="container">
        <div class="row text-center header animate-in" data-anim-type="fade-in-up">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3>Otras Noticias </h3>
                <hr />
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
@endsection
@section('script')

@endsection