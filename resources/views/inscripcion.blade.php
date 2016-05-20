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
Inscripcion
@endsection

@section('content')


<section id="section-page">
<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-titulo-noticia"></div>
                    <h2>Inscripcion</h2>
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
@if(Session::has('mensajeErrorContacto'))
<div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{Session::get('mensajeErrorContacto')}}
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
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-xs-2"><img src="imagenes/iconosNoticias/cancha.png" class="img-responsive"></div>
                                <div class="col-xs-10"><h2>¿CÓMO INSCRIBIR MI EQUIPO?</h2></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Inscribir a tu equipo es fácil, tienes que seguir los siguientes pasos:</p>
                                    <p>- Completa el formulario a continuación, tienes que tener en
                                       cuenta que solo el delegado del equipo puede llenar este formulario.</p>
                                    <p>- Una vez que lo hayas llenado, espera a que nos contactemos con
                                       vos. De esta manera podrás concretar una cita para abonar la
                                       inscripción al torneo.</p>
                                    <p>- En la reunión te brindaran un usuario y contraseña con el que
                                       podrás registrarte en esta web para poder llenar la lista de buena
                                       fe de tu equipo.</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6"><a href="/descargar/AutorizacionMenores.pdf" target="_blank" class=" btn btn-block btn-warning">AUTORIZACION MENORES</a></div>
                                <div class="col-md-6"><a href="/descargar/DESLINDE-DE-RESPONSABILIDADultimo.pdf" target="_blank" class=" btn btn-block btn-warning">DESLINDE RESPONSABILIDAD</a></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12"><a href="/descargar/REGLAMENTO.pdf" target="_blank" class=" btn btn-block btn-warning">DESCARGAR REGLAMENTO LIGA LA RIBERA</a></div>
                            </div>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-xs-2"><img src="imagenes/iconosNoticias/jugador.png" class="img-responsive"></div>
                                <div class="col-xs-10"><h2>Datos Del Equipo</h2></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    {!!Form::open(['url'=>'/inscribirequipo','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                                        <input type="text" id="validador" name="validador" value=""  class="hidden">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" id="nombre_equipo" name="nombre_equipo" value=""  placeholder="NOMBRE EQUIPO" class="form-control">
                                                <script>
                                                    var f1= new LiveValidation('nombre_equipo', { validMessage: ' ', wait: 500});
                                                    f1.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                                </script>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                {!!Form::Text('nombre',null,['class'=>'form-control','placeholder'=>'NOMBRE Y APELLIDO DELEGADO','id'=>'nombre'])!!}
                                                <script>
                                                    var f2= new LiveValidation('nombre', { validMessage: ' ', wait: 500});
                                                    f2.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                                </script>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!!Form::Text('celular',null,['class'=>' form-control','placeholder'=>'CELULAR','id'=>'celular'])!!}
                                                <script>
                                                    var f23= new LiveValidation('celular', { validMessage: ' ', wait: 500});
                                                    f23.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                                </script>
                                            </div>
                                            <div class="col-md-6">
                                                {!!Form::Text('mail',null,['class'=>' form-control','placeholder'=>'EMAIL','id'=>'mail'])!!}
                                                <script>
                                                  var f5 = new LiveValidation('mail');
                                                    f5.add( Validate.Email, {failureMessage: "Ingrese un mail Válido"} );
                                                    f5.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                                </script>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!!Form::Text('telefono_alternativo',null,['class'=>' form-control','placeholder'=>'TELÉFONO ALTERNATIVO','id'=>'telefono_alternativo'])!!}
                                                <script>
                                                    var f25= new LiveValidation('telefono_alternativo', { validMessage: ' ', wait: 500});
                                                    f25.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                                </script>
                                            </div>
                                            <div class="col-md-6">
                                                {!!Form::Text('domicilio',null,['class'=>' form-control','placeholder'=>'DOMICILIO','id'=>'domicilio'])!!}
                                                <script>
                                                    var f24= new LiveValidation('domicilio', { validMessage: ' ', wait: 500});
                                                    f24.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                                </script>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea id="mensaje" name="mensaje" class="form-control" placeholder="MENSAJE" rows="1"></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!!Form::submit('ENVIAR', array('class' => 'btn btn-warning btn-block'))!!}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
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
<script>

 </script>

@endsection