@extends('app')
@section('meta')
<meta property="og:url" content="http://www.ligalaribera.com.ar" />
<meta property="og:title" content="Liga La Ribera" />
<meta property="og:description" content="" />
<meta property="og:image" content="http://www.ligalaribera.com.ar/img/logo.png" />
<meta property="og:type" content="website" />
@endsection
@section('title')
..::EQUIPOS::..
@endsection
@section('css')

 <link href="/css/dropzone.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')


<!--Estadísticas SECTION START-->
<section id="section-page" >

       <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="border-titulo-medio"></div>
                            <h2 >{{$equipo->nombre_equipo}}</h2>
                            <br>
                        </div>
                        <div class="col-md-2">
                           
                        </div>
                        <div class="col-md-5">
                            <div style="font-size:15px;float:right; font-weight: bold">
                                <div>BIENVENIDO: {{$equipo->nombre_equipo}}</div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-3"><a href="#" data-toggle="modal" data-target="#modalClave" title="Modificar Clave" class=" btn btn-warning btn-block"><i class="fa fa-key"></i></a></div>
                                    <div class="col-md-6 col-sm-3"><a href="/equiposalir" title="Salir" class=" btn btn-danger btn-block"><i class="fa fa-times"></i> </a></div>
                                </div>
                            </div>
                            <br>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
</section>


<section id="blanco" >
  <div class="row" id="">
    <div class="col-md-12">
      <div id="blanco">
        <div class="container">
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


           <div class="row"> 



             <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-3 col-md-offset-0 ">
               <div class="equipos-wrapper">
                    <div class="row">
                        <h3 class="text-center">TORNEO</h3>
                        <select class="form-control" onchange="buscarZonas()" id="idtorneo">
                            @foreach($equipo->ListTorneosParaCombo() as $torneo)
                            <option value="{{$torneo->idtorneo}}">{{$torneo->nombre_torneo}}</option>
                            @endforeach
                        </select>
                        <h3 class="text-center">ZONA</h3>
                        <select class="form-control" onchange="buscarEquipoXZonas()" id="idzona">
                            <option>Seleccionar zona</option>                            
                        </select>
                        
                    </div>
                   <div class="row">
                       @if($equipo->escudo=='')
                            <img class="img-responsive center-block" style="max-height: 200px" src="imagenes/escudo-generico.png">
                       @else
                            <img class="img-responsive center-block" style="max-height: 200px"  src="imagenes/{{$equipo->escudo}}">
                       @endif
                         @if($equipo->foto=='')
                               <img class="img-responsive center-block" src="imagenes/equipo-generico.png">
                          @else
                               <img class="img-responsive center-block" src="imagenes/{{$equipo->foto}}">
                          @endif
                        <div class="col-xs-6 col-md-7"><a href="#" data-toggle="modal" data-target="#modalEscudo" style="color:#196A4A;font-size:12px" >CAMBIAR ESCUDO</a></div>
                        <div class="col-xs-6  col-md-5 text-right"><a href="#" data-toggle="modal" data-target="#modalFoto" style="color:#196A4A;font-size:12px">CAMBIAR FOTO</a></div>
                   </div>
               </div>

             </div>

            
             <div class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-6 col-md-offset-0">
                <div class="equipos-wrapper-redondo riberaInforma alto50">
                    <div class="tituloEstilo"> LIGA LA RIBERA TE INFORMA: </div>
                    <span style="">{{$equipo->mensaje}} </span>
                </div>

                <div style="height:20px;"></div>

                <div id="tablaPosiciones"></div>
             </div>

             <div class="col-md-3">
               
                  <div id="equipo_torneo">

    
                   </div>
             </div>


          
           </div>
            


        </div>
      </div>
    </div>    
  </div>
</section>


<div style="height:50px;"></div>



</div>
<div id="modalEscudo"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×</button>
            <h3>Modificando Escudo</h3>
        </div>
        <div class=" modal-body ">
            <div class="row">
                <div class="col-md-12">

                    <form method="POST" action="equipoescudoguardar" class="dropzone" id="upload" enctype="multipart/form-data">
                    <input type="hidden" value="{{ $equipo->idequipo }}" name="idequipo" id="idequipoid">
                         <input type="hidden" value="{{ csrf_token() }}" name="file">
                         <div class="dz-message">
                             Arrastra y suelta aqui tu archivo. O simplemente haz click<br />
                         </div>
                      </form>
                </div>
                <div class="col-md-12">
                    <div class="text-danger text-center">Luego de subir la imagen. Refrescar la página para ver los  cambios</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalFoto"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×</button>
            <h3>Modificando Foto del Equipo</h3>
        </div>
        <div class=" modal-body ">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="equipofotoguardar" class="dropzone" id="upload" enctype="multipart/form-data">
                    <input type="hidden" value="{{ $equipo->idequipo }}" name="idequipof">
                         <input type="hidden" value="{{ csrf_token() }}" name="file">
                         <div class="dz-message">
                             Arrastra y suelta aqui tu archivo. O simplemente haz click<br />
                         </div>
                      </form>
                </div>
                <div class="col-md-12">
                    <div class="text-danger text-center">Luego de subir la imagen. Refrescar la página para ver los  cambios</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalJugador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  {!!Form::open(['url'=>'/agregarjugador','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title" id="myModalLabel">Agregando Jugador</h4>
                      </div>
                      <div class="modal-body">
                        <div class=" panel panel-default">
                            <div class=" panel-heading">Jugador</div>
                            <div class=" panel-body">
                              <div clas="row">
                                  <div class="col-md-12">
                                        <input type="hidden" value="{{ $equipo->idequipo }}" name="idequipoJ">
                                        <div class="form-group">
                                            Nombre y Apellido
                                            {!!Form::Text('nombre_jugador',null,['class'=>'form-control','id'=>'nombre_jugador'])!!}
                                            <script>
                                                var f1= new LiveValidation('nombre_jugador', { validMessage: ' ', wait: 500});
                                                f1.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                            </script>
                                        </div>
                                        <div class="form-group">
                                             Documento
                                             {!!Form::Text('dni',null,['class'=>'form-control','id'=>'dni'])!!}
                                             <script>
                                                 var f2= new LiveValidation('dni', { validMessage: ' ', wait: 500});
                                                 f2.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                             </script>
                                        </div>
                                        <div class="form-group">
                                             Tel/Cel
                                             {!!Form::Text('telefono',null,['class'=>'form-control','id'=>'telefono'])!!}
                                            <script>
                                                 var f3= new LiveValidation('telefono', { validMessage: ' ', wait: 500});
                                                 f3.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                             </script>
                                        </div>
                                        <div class="form-group">
                                             Grupo Sanguineo
                                             {!!Form::Text('grupo_sanguineo',null,['class'=>'form-control','id'=>'grupo_sanguineo'])!!}
                                            <script>
                                                 var f4= new LiveValidation('grupo_sanguineo', { validMessage: ' ', wait: 500});
                                                 f4.add(Validate.Presence, {failureMessage: "Obligatorio"});
                                             </script>
                                        </div>
                                        <div class="form-group">
                                             Mail
                                             {!!Form::Text('mail',null,['class'=>'form-control','id'=>'mail'])!!}
                                              <script>
                                                  var f5 = new LiveValidation('mail');
                                                    f5.add( Validate.Email, {failureMessage: "Ingrese un mail Válido"} );
                                              </script>


                                        </div>
                                        <div class="form-group">
                                             Direccion
                                             {!!Form::Text('direccion',null,['class'=>'form-control'])!!}
                                        </div>
                                        <div class="form-group">
                                             Obra Social
                                             {!!Form::Text('obra_social',null,['class'=>'form-control'])!!}
                                        </div>
                                  </div>
                               </div>
                      </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          {!!Form::submit('Aceptar', array('class' => 'btn btn-success','name'=>'submit'))!!}
                      </div>
                  {!! Form::close() !!}
            </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modalClave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  {!!Form::open(['url'=>'/modificarclave','method'=>'POST', 'data-toggle='>'validator'])!!}
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title" id="myModalLabel">Modificando Clave</h4>
                      </div>
                      <div class="modal-body">
                        <div class=" panel panel-default">
                            <div class=" panel-heading">Clave</div>
                            <div class=" panel-body">
                              <div clas="row">
                                  <div class="col-md-12">
                                        <input type="hidden" value="{{ $equipo->idequipo }}" name="idequipoC">
                                        <div class="form-group">
                                            Clave Actual
                                            <input type="password" class="form-control" name="clave-actual">
                                            <span class="help-block with-errors"></span>
                                        </div>
                                        <div class="form-group">
                                             Clave Nueva
                                             <input type="password" class="form-control" name="clave-nueva">
                                            <span class="help-block with-errors"></span>
                                        </div>
                                        <div class="form-group">
                                             Reingresar Clave Nueva
                                             <input type="password" class="form-control" name="clave-nueva-2">
                                            <span class="help-block with-errors"></span>
                                        </div>
                                  </div>
                               </div>
                      </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          {!!Form::submit('Aceptar', array('class' => 'btn btn-success'))!!}
                      </div>
                  {!! Form::close() !!}
            </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
@endsection
@section('script')

<script src="/js/dropzone.js" type="text/javascript"></script>
<script type="text/javascript">
function buscarEquipoXTorneo()
 {
 $('#cargando').html('<button class="btn btn-default btn-lg"><i class="fa fa-spinner fa-spin"></i>Cargando....</button>');
    var id_articulo=$("#idtorneo").val();
    $.ajax({
         url:"/equipotorneo/"+id_articulo,
         type: "GET",
         dataType: "HTML"
        })
    .done(function(response){
        $('#cargando').html('');
           $("#equipo-torneo").html(response);
        })
        .fail(function(){
            //alert(id_articulo);
        });

 }
function buscarZonas()
 {
 $('#cargando').html('<button class="btn btn-default btn-lg"><i class="fa fa-spinner fa-spin"></i>Cargando....</button>');
    var id_articulo=$("#idtorneo").val();

    var id_equipo=$("#idequipoid").val();
    
    //alert('id equipo='+id_equipo+' - id_torneo:'+id_articulo);

    $.ajax({
         url:"/buscarzonas/"+id_articulo+"/"+id_equipo,
         type: "GET",
         dataType: "HTML"
        })
    .done(function(response){
        $('#cargando').html('');
           $("#idzona").html(response);
           buscarTablaPosiciones();
        })
        .fail(function(){
            //alert(id_articulo);
        });

 }

 function buscarTablaPosiciones()
 {
 $('#cargando').html('<button class="btn btn-default btn-lg"><i class="fa fa-spinner fa-spin"></i>Cargando....</button>');
    var id_zona=$("#idzona").val();
    var id_torneo=$("#idtorneo").val();
     var id_equipo=$("#idequipoid").val();
    
      $.ajax({
         url:"/buscarequipoestadisticas/"+id_equipo+"/"+id_zona+"/"+id_torneo,
         type: "GET",
         dataType: "HTML"
        })
    .done(function(response){
        $('#cargando').html('');
           $("#tablaPosiciones").html(response);
           completarEstadisticas();
        })
        .fail(function(){
            //alert(id_equipo);
        });

 }

 function completarEstadisticas(){
     $('#cargando').html('<button class="btn btn-default btn-lg"><i class="fa fa-spinner fa-spin"></i>Cargando....</button>');
      var id_zona=$("#idzona").val();
      var id_torneo=$("#idtorneo").val();
      var id_equipo=$("#idequipoid").val();
      
        $.ajax({
           url:"/completarestadisticas/"+id_equipo+"/"+id_zona+"/"+id_torneo,
           type: "GET",
           dataType: "HTML"
          })
          .done(function(response){
            $('#cargando').html('');
             $("#equipo_torneo").html(response);             
          })
          .fail(function(){
              //alert(id_equipo);
          });

 }



  $(function() {
     buscarZonas();

  });
 </script>

 <style type="text/css">
.datoEstilo{
     background-color: #FBC01C !important;
    color: #ffffff !important;
    text-transform: uppercase;
    font-weight: 700;
    border: none !important;
    font-size: 18px !important;
    min-height: 40px;
    margin: 10px 0 0 0;
    BORDER-RADIUS: 4PX;
    PADDING: 7PX;
    padding-right: 16px;
    padding-left: 16px;
}
.tituloEstilo{
      color: #196A4A !important;
    text-align: left;
    text-transform: uppercase;
    font-weight: 700;
    border: none !important;
    font-size: 14px !important;
    min-height: 40px;
    margin: 10px 0 0 0;
    BORDER-RADIUS: 4PX;
    PADDING: 6PX;
}

.riberaInforma{
     background-color: #FBC01C !important;
    color: #ffffff !important;
    text-transform: uppercase;
    font-weight: 700;
    border: none !important;
    font-size: 18px !important;
    min-height: 40px;
    margin: 10px 0 0 0;
    BORDER-RADIUS: 4PX;
    PADDING: 7PX;
    padding-right: 16px;
    padding-left: 16px;
}
 </style>
}
}
@endsection