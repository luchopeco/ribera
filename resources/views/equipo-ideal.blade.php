@extends('app')
@section('meta')
<meta property="og:url" content="http://www.ligatifosi.com/equipo-ideal" />
<meta property="og:title" content="Equipo Ideal" />
<meta property="og:description" content="Visitá el Equipo Ideal" />
@foreach($listEquipoIdeal as $fig)
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/{{$fig->imagen}}" />
@endforeach
<meta property="og:type" content="website" />
@endsection
@section('title')
..::Tifosi::..
@endsection
@section('content')
<section id="grid" class="margin-top" >
    <div class="container" >
        <div class="row text-center header" >
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                  <h3>Equipo Ideal</h3>
                  <hr>
              </div>
        </div>
        <div class="row pad-bottom animate-in" data-anim-type="fade-in-up">
         @foreach($listEquipoIdeal as $fig)
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                            <a class="fancybox-media" href="/imagenes/{{$fig->imagen}}">
                                <img class="img-responsive" src="/imagenes/{{$fig->imagen}}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
         @endforeach
        </div>
    </div>
</section>
@endsection
@section('script')

@endsection