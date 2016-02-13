@extends('app')
@section('meta')
<meta property="og:url" content="http://www.ligatifosi.com/jugadores-de-la-fecha" />
<meta property="og:title" content="Jugadores de la Última Fecha" />
<meta property="og:description" content="Visitá los jugadores de la última fecha" />
@foreach($listFiguras as $fig)
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/{{$fig->imagen}}" />
@endforeach
<meta property="og:type" content="website" />
@endsection
@section('title')
..::Tifosi::..
@endsection
@section('content')
<section id="services" class="margin-top" >
    <div class="container">
        <div class="row text-center header">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                <h3> JUGADORES DE LA ULTIMA FECHA</h3>
                <hr>
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
@endsection
@section('script')

@endsection