@extends('app')
@section('meta')
<meta property="og:url" content="http://ligalaribera.com.ar/equipo" />
<meta property="og:title" content="Inicia sesion con tu equipo" />
<meta property="og:description" content="Inicia sesion con tu equipo, solicita el usuario y la contraseña, enterate de novedades, y consulta los datos de tu equipo en los torneos que participaste." />
<meta property="og:image" content="http://www.ligalaribera.com/imagenes" />
<meta property="og:type" content="website" />
@endsection
@section('title')
Equipos
@endsection
@section('content')
<section id="section-page">
<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-titulo-noticia"></div>
                    <h2>LOGIN EQUIPOS</h2>
                    <br>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
</section>
@if(Session::has('mensajeOk'))
<div class="container" >
    <div class="row">
        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{Session::get('mensajeOk')}}
            </div>
        </div>
    </div>
</div>
@endif
@if(Session::has('mensajeError'))
<div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <div class="text-center">{{Session::get('mensajeError')}}</div>
                </div>
            </div>
        </div>
</div>
@endif
<section id="inscripcion">
    <div class="row" >
        <div class="col-md-12">
            <div id="blanco">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            {!!Form::open(['url'=>'/loginequipo','method'=>'POST'])!!}
                            <h3>INICIAR SESION</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    {!!Form::Text('nombre_usuario',null,['class'=>' form-control text-center','placeholder'=>'USUARIO '])!!}
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="password" class="form-control text-center" placeholder="CONTRASEÑA" name="clave">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12">
                                    {!!Form::submit('INGRESAR', array('class' => 'btn btn-warning btn-block'))!!}
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