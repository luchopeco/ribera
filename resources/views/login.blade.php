@extends('app')
@section('meta')
<meta property="og:url" content="http://ligatifosi.com/equipo" />
<meta property="og:title" content="Inicia sesion con tu equipo" />
<meta property="og:description" content="Inicia sesion con tu equipo, solicita el usuario y la contraseña, enterate de novedades, y consulta los datos de tu equipo en los torneos que participaste." />
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/fb/fb-equipo.JPG" />
<meta property="og:type" content="website" />
@endsection
@section('title')
..::Tifosi::..
@endsection
@section('content')
<div class="margin-top">
<section id="login">
    <div >
        <div class="container">
            <div class="row text-center header animate-in" data-anim-type="fade-in-up">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3>LOGIN EQUIPOS</h3>
                     <hr>
                </div>
            </div>
             @if(Session::has('mensajeError'))
                    <div class="row">
                        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   {{Session::get('mensajeError')}}
                            </div>
                        </div>
                    </div>
                    </hr>
            @endif
            <div class="row animate-in" data-anim-type="fade-in-up">
                <div class=" col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                    {!!Form::open(['url'=>'/loginequipo','method'=>'POST'])!!}
                    <div class="contact-wrapper text-center">
                        <h3>INICIAR SESION</h3>
                        <div class="row">
                            <div class="col-md-12">
                            NOMBRE DE USUARIO
                                {!!Form::Text('nombre_usuario',null,['class'=>' form-control','placeholder'=>'NOMBRE DE USUARIO '])!!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                            Clave
                               <input type="password" class="form-control" name="clave">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-12">
                                {!!Form::submit('INGRESAR', array('class' => 'btn btn-danger btn-block'))!!}
                            </div>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</section>
</div>

@endsection
@section('script')

@endsection