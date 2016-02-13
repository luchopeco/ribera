@extends('app')
@section('meta')
<meta property="og:url" content="http://ligatifosi.com/inscripcion" />
<meta property="og:title" content="Inscripción a la liga" />
<meta property="og:description" content="Inscribir a tu equipo es fácil, tienes que seguir los siguientes pasos:
- Completa el formulario a continuación, tienes que tener en cuenta que solo el delegado del equipo puede llenar este formulario.
- Una vez que lo hayas llenado, espera a que nos contactemos con vos. De esta manera podrás concretar una cita para abonar la inscripción al torneo.
- En la reunión te brindaran un usuario y contraseña con el que podrás registrarte en esta web para poder llenar la lista de buena fe de tu equipo." />
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/fb/fb-inscripcion.JPG" />
<meta property="og:type" content="website" />
@endsection

@section('title')
..::Tifosi::..
@endsection
@section('css')

@endsection
@section('content')
<section id="inscripcion" class="margin-top">
    <div class="container">
        <div class="row text-center header">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                <h3>INSCRIPCIÓN</h3>
                 <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 scroll-me">
                    <a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://www.ligatifosi.com/inscripcion" class=" btn button-custom btn-custom-two"><i class="fa fa-facebook"></i> Compartir</a>
                </div>
            </div>
        </div>
        @if(Session::has('mensajeOk'))
                <div class="row">
                    <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{Session::get('mensajeOk')}}
                        </div>
                    </div>
                </div>
                </hr>
         @endif
        <div class="row animate-in text-center" data-anim-type="fade-in-up">

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6  ">
                <div class="work-wrapper altoMinimo">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                        <h3>¿CÓMO INSCRIBIR MI EQUIPO?</h3>
                        <hr />
                    </div>
                    <div class=" row text-left">
                        <div class="col-xs-12">
                            <p>Inscribir a tu equipo es fácil, tienes que seguir los siguientes pasos:</p>
                             <p>- Completa el formulario a continuación, tienes que tener en cuenta que solo el delegado
                                del equipo puede llenar este formulario.</p>
                                <p>- Una vez que lo hayas llenado, espera a que nos contactemos con vos. De esta manera podrás concretar una cita
                                para abonar la inscripción al torneo.</p>
                                <p>- En la reunión te brindaran un usuario y contraseña con el que podrás registrarte en esta
                                web para poder llenar la lista de buena fe de tu equipo.</p>
                         </div>
                     </div>
                     <br>
                    <div class="row">
                        <div class="col-xs-6"><img class="img-responsive" src="imagenes/logos/logos/tifosiprincipal.png"></div>
                        <div class="col-xs-6"><img class="img-responsive" src="imagenes/logos/logos/ragazza02.png"></div>
                    </div>
                    <div class="row">
                        <div class=" col-xs-offset-1 col-xs-10">
                        <a class="btn btn-danger btn-block" href="/archivos/autorizaciondemenores2015.doc" title="Descargar Autorización para menores"><i class="fa fa-download"></i> Autorización para menores</a>
                        </div>
                    </div>
					<br>
					 <div class="row">
                        <div class=" col-xs-offset-1 col-xs-10">
                        <a class="btn btn-danger btn-block" href="/archivos/reglamento.pdf" target="_blank" title="Descargar reglamento Liga Tifosi"><i class="fa fa-download"></i> Descargar reglamento Liga Tifosi</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                <div class="work-wrapper altoMinimo">
                    <div class="row text-center  animate-in" data-anim-type="fade-in-up">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3>DATOS EQUIPO</h3>
                            <hr />
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                         {!!Form::open(['url'=>'/inscribirequipo','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                         <input type="text" id="validador" name="validador" value=""  class="hidden">
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="torneo" class="form-control" id="torneo">
                                        <option value="" selected="selected"> Torneo a inscribirse </option>
                                        <option value="Tifosi">Tifosi</option>
                                        <option value="Ragazza">Ragazza</option>
                                        <option value="Nocturno">Nocturno</option>
                                    </select>
                                    <script>
                                      var f0 = new LiveValidation('torneo');
                                        f0.add(Validate.Presence, {failureMessage: "Seleccione un torneo"});
                                    </script>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="nombre_equipo" name="nombre_equipo" value=""  placeholder="Nombre equipo" class="form-control">
                                    <script>
                                        var f1= new LiveValidation('nombre_equipo', { validMessage: ' ', wait: 500});
                                        f1.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                <h3>DATOS DELEGADO</h3>
                                <hr />
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    {!!Form::Text('nombre',null,['class'=>'form-control','placeholder'=>'NOMBRE Y APELLIDO DELEGADO','id'=>'nombre'])!!}
                                    <script>
                                        var f2= new LiveValidation('nombre', { validMessage: ' ', wait: 500});
                                        f2.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                            </div>
                            <div class="sep"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    {!!Form::Text('dni',null,['class'=>' form-control','placeholder'=>'DNI','id'=>'dni'])!!}
                                    <script>
                                        var f22= new LiveValidation('dni', { validMessage: ' ', wait: 500});
                                        f22.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                                <div class="col-md-6">
                                    {!!Form::Text('celular',null,['class'=>' form-control','placeholder'=>'CELULAR','id'=>'celular'])!!}
                                    <script>
                                        var f23= new LiveValidation('celular', { validMessage: ' ', wait: 500});
                                        f23.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                            </div>
                            <div class="sep"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    {!!Form::Text('mail',null,['class'=>' form-control','placeholder'=>'EMAIL','id'=>'mail'])!!}
                                    <script>
                                      var f5 = new LiveValidation('mail');
                                        f5.add( Validate.Email, {failureMessage: "Ingrese un mail Válido"} );
                                        f5.add(Validate.Presence, {failureMessage: "Obligatorio"});
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
                            <div class="sep"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    {!!Form::Text('telefono_alternativo',null,['class'=>' form-control','placeholder'=>'TELÉFONO ALTERNATIVO','id'=>'telefono_alternativo'])!!}
                                    <script>
                                        var f25= new LiveValidation('telefono_alternativo', { validMessage: ' ', wait: 500});
                                        f25.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                    </script>
                                </div>
                            </div>
                            <div class="sep"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea id="mensaje" name="mensaje" class="form-control" placeholder="MENSAJE" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="sep"></div>
                            <div class="row">
                                <div class="col-xs-12">
                                    {!!Form::submit('Enviar', array('class' => 'btn btn-danger btn-block'))!!}
                                </div>
                            </div>
                            <div class="sep"></div>
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