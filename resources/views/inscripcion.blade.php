@extends('app')
@section('title')
..::Tifosi::..
@endsection
@section('content')
    <section id="inscripcion" class="margin-top">
    <div class="container">
        <div class="row text-center header">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                <h3>INSCRIPCIÓN</h3>
                <hr>
            </div>
        </div>
        <div class="row animate-in text-center" data-anim-type="fade-in-up">

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="work-wrapper">
                <H2>    COMO INSCRIBIR MI EQUIPO?</H2>
                <hr/>
                <p>
                
                    Inscribir a tu equipo es fácil, tienes que seguir los siguientes pasos:
                    - Completa el formulario a continuación, tienes que tener en cuenta que solo el delegado 
                    del equipo puede llenar este formulario.
                    - Una vez que lo hayas llenado, espera a que nos contactemos con vos. De esta manera podrás concretar una cita
                    para abonar la inscripción al torneo.
                    - En la reunión te brindaran un usuario y contraseña con el que podrás registrarte en esta
                    web para poder llenar la lista de buena fe de tu equipo. 
                </p>


                   <img class="img-responsive" src="imagenes/logos/logos/tifosiprincipal.png">


                   <img class="img-responsive" src="imagenes/logos/logos/ragazza02.png">

                </div>
            </div>

             <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="work-wrapper">   
               
                    <div class="row text-center header animate-in" data-anim-type="fade-in-up">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3>Datos equipo</h3>
                            <hr />
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           

                            <div class="row" style="height:40px;">
                                <div class="col-md-6">                 
                                   <select name="torneo" style="color:black">
                                       <option value="0" selected="selected"> Torneo a inscribirse </option>                                        
                                       <option value="Tifossi">Tifossi</option>
                                       <option value="Ragazza">Ragazza</option>
                                       <option value="Nocturno">Nocturno</option>
                                        
                                   </select>   
                                </div>
                                <div class="col-md-6">                 
                                     <input type="text" id="nombre_equipo" name="nombre_equipo" value="" required="required" placeholder="Nombre equipo">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                <h3>Datos delegado</h3>
                                <hr />
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    {!!Form::Text('nombre',null,['class'=>' form-control','required','placeholder'=>'NOMBRE Y APELLIDO DELEGADO'])!!}
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    {!!Form::Text('dni',null,['class'=>' form-control','required','placeholder'=>'DNI'])!!}
                                </div>
                                <div class="col-md-6">
                                    {!!Form::Text('celular',null,['class'=>' form-control','required','placeholder'=>'CELULAR'])!!}
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    {!!Form::Text('email',null,['class'=>' form-control','required','placeholder'=>'EMAIL'])!!}
                                </div>
                                <div class="col-md-6">
                                    {!!Form::Text('domicilio',null,['class'=>' form-control','required','placeholder'=>'DOMICILIO'])!!}
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                    {!!Form::Text('telefono_alternativo',null,['class'=>' form-control','required','placeholder'=>'TELÉFONO ALTERNATIVO'])!!}
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    {!!Form::submit('Enviar', array('class' => 'btn btn-danger btn-block'))!!}
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