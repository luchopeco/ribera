@extends('admin.masterAdmin')

@section('title')
<h1> Gestion De Equipos <small ></small></h1>
@endsection

@section('breadcrumb')
<li><a href="/admin/home"><i class="fa fa-home"></i> Home</a></li>
@endsection

@section('content')
@if(Session::has('mensajeOk'))
<div class="row">
  <div class="col-md-12">
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
  <div class="col-md-12">
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      {{Session::get('mensajeError')}}
    </div>
  </div>
</div>
</hr>
@endif
<div class="row">
  <div class=" col-md-12">
    <div class=" panel panel-default">
      <div class=" panel-heading">Equipos <a href="" id="btnNuevoEquipo" title="Nuevo Equipo" class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalEquipoAgregar"><i class=" fa fa-plus"></i></a>
        <div class="pull-right">
          <div class="btn-group">
            <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
              <i class="fa fa-question-circle"></i><b class="caret"></b>
            </button>
            <ul class="multiselect-container dropdown-menu pull-right">
              <li>::Desde Aqui Puede Agregar, editar o eliminar un Equipo:</li>
              <li>:Tambien Puede Agregar sus jugadores:</li>
              <li>:Agregue un equipo "Libre" En caso de necesitarlo.
                El equipo indicado como libre no suma puntos:</li>
              <li>:El campo mensaje se mostrara cuando el equipo inicie session:</li>
                <li>:Un equipo posee un Nombre de usuario, para que puedan iniciar session.
                  Este nombre de usuario se puede gestionar en la edicion del equipo. una vez Agregado este:</li>
                  <li>Haciendo click en resetear clave (icono de la llave)reseteara la clave del equipo. Por defecto es 12345678::</li>
                  <li>Torneo; indica los torneos en los que se encuentra inscripto</li>
                </ul>

              </div>
            </div>
          </div>
          <div class=" panel-body">
            <div class="table-responsive">
              <table id="editar"  class=" table table-bordered table-condensed table-hover">
                <tr>
                  <th>Equipo</th>
                  <th title="Torneos en los que esta Inscripto">Torneos</th>
                  <th title="Cantidad Jugadores">Jugadores</th>
                  <th>Usuario</th>
                  <th>Autogestion</th>
                  <th>Observaciones</th>
                  <th>Mensaje</th>
                  <th>Libre</th>
                </tr>
                @foreach($listEquipos as $equipo)
                <tr >
                  <td>{{$equipo->nombre_equipo}}</td>
                  <td>
                    @foreach($equipo->ListTorneosParaCombo() as $torneo)
                    {{$torneo->nombre_torneo.' - '}}
                    @endforeach
                  </td>
                  <td>{{$equipo->ListJugadores()->count()}}</td>
                  <td>{{$equipo->nombre_usuario}}</td>
                  <td>{{$equipo->autogestionHabilitada()}}</td>
                  <td>{{Illuminate\Support\Str::limit($equipo->observaciones,40, '...')}}</td>
                  <td>{{Illuminate\Support\Str::limit($equipo->mensaje,40, '...')}}</td>
                  <td>{{$equipo->esLibre()}}</td>
                  <td><a href="equipos/{{$equipo->idequipo}}"  class="btn btn-xs btn-primary " data-idequipo="{{$equipo->idequipo}}"  title="Editar Jugadores"> <i class="fa fa-user"></i></a></td>
                  <td><a href="#"  class="btn btn-xs btn-info editar" data-idequipo="{{$equipo->idequipo}}"  title="Editar Equipo"> <i class=" fa fa-edit"></i></a></td>
                  <td><a href="#"  class="btn btn-xs btn-warning clave" data-idequipo="{{$equipo->idequipo}}" data-equipo="{{$equipo->nombre_equipo}}"  title="Resetaer clave"><i class="fa fa-key"></i></a></td>
                  <td><a href="equipoimagen/{{$equipo->idequipo}}" title="Foto y Escudo Del Equipo" class=" btn-xs btn btn-success" ><i class=" fa fa-image"></i></a></td>
                  <td><a href="" class="btn btn-xs btn-danger eliminar" data-idequipo="{{$equipo->idequipo}}"  title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modalEquipoAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          {!!Form::open(['route'=>'admin.equipos.store','method'=>'POST', 'data-toggle='>'validator'])!!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Agregando Equipo</h4>
          </div>
          <div class="modal-body"><div class=" panel panel-info">
            <div class=" panel-heading">Equipo</div>
            <div class=" panel-body">
              <div clas="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {!!Form::label('nombre','Nombre')!!}
                    {!!Form::Text('nombre_equipo',null,['class'=>' form-control','required'])!!}
                    Es Libre
                    <div>{!!Form::checkbox('es_libre','0',false)!!}</div>
                    Observaciones
                    {!!Form::Textarea('observaciones',null,['class'=>' form-control'])!!}
                    Mensaje
                    {!!Form::Text('mensaje',null,['class'=>' form-control'])!!}
                    <span class="help-block with-errors"></span>
                  </div>

                </div>
              </div>
            </div>
          </div></div>
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
    <div class="modal fade" id="modalEquipoModificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          {!!Form::open(['route'=>'admin.equipos.update','method'=>'PUT', 'data-toggle='>'validator'])!!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Modificando Equipo</h4>
          </div>
          <div class="modal-body">
            <div class=" panel panel-default">
              <div class=" panel-heading">Equipo
                <div class="pull-right">
                  <div class="btn-group">
                    <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                      <i class="fa fa-question-circle"></i><b class="caret"></b>
                    </button>
                    <ul class="multiselect-container dropdown-menu pull-right">
                      <li>Recuerde que el nombre de usuario no debe tener espacio en blancos ni caracteres especiales.</li>
                      <li>Tampoco se puede repetir es unico para cada equipo</li>
                      <li>Si no desea asignarle un nombre de usuario a un equipo dejelo en blanco</li>
                    </ul>

                  </div>
                </div>
              </div>
              <div class=" panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      {!!Form::Text('idequipo',null,['class'=>' hidden form-control','id'=>'idequipoU'])!!}
                      {!!Form::label('nombre','Nombre')!!}
                      {!!Form::Text('nombre_equipo',null,['class'=>' form-control','id'=>'nombre_equipoU','required'])!!}
                      Es Libre
                      <div>{!!Form::checkbox('es_libre','0',false,['id'=>'es_libreU'])!!}</div>
                      Observaciones
                      {!!Form::Textarea('observaciones',null,['class'=>' form-control','id'=>'observacionesU'])!!}
                      Mensaje
                      {!!Form::Text('mensaje',null,['class'=>' form-control','id'=>'mensajeU'])!!}
                      Nombre Usuario
                      {!!Form::Text('nombre_usuario',null,['class'=>' form-control','id'=>'nombre_usuarioU'])!!}
                      <span class="help-block with-errors"></span>
                      Habilitar Autogestion
                      <div>{!!Form::checkbox('autogestion','0',false,['id'=>'autogestionU'])!!}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row ">
                <div class="col-md-12">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  {!!Form::submit('Modificar', array('class' => 'btn btn-success'))!!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>
    <div class="modal fade" id="modalArbitroEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          {!!Form::open(['route'=>['admin.equipos.destroy'],'method'=>'DELETE'])!!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Eliminando Equipo</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                {!!Form::Text('idequipo',null,['class'=>'hidden','id'=>'idequipoD'])!!}
                <h3>¿Desea Eliminar el Equipo?</h3>
                <div id="caca"></div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row ">
                <div class="col-md-12">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  {!!Form::submit('Eliminar', array('class' => 'btn btn-success'))!!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>

    <div class="modal fade" id="modalCalveResetear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          {!!Form::open(['url'=>['admin/equipos/resetearclave'],'method'=>'POST'])!!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Reseteando Clave</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                {!!Form::Text('idequipo',null,['class'=>'hidden','id'=>'idequipoC'])!!}
                <h3>¿Desea resetar la clave  del Equipo: <span id="equipoC"></span> </h3>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row ">
                <div class="col-md-12">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  {!!Form::submit('Aceptar', array('class' => 'btn btn-success'))!!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>

    @endsection
    @section('script')
    <script>
    $(function () {
      $('body').on('click', '.editar', function (event) {
        event.preventDefault();
        var id_articulo=$(this).attr('data-idequipo');
        $.ajax({
          url:"equipos/buscar",
          type: "POST",
          dataType: "json",
          data:{'idequipo': id_articulo}
        })
        .done(function(response){
          //alert(response.datos.titulo);
          $('#nombre_equipoU').val(response.datos.nombre_equipo);
          $('#idequipoU').val(response.datos.idequipo);
          $('#mensajeU').val(response.datos.mensaje);
          $('#observacionesU').val(response.datos.observaciones);
          $('#nombre_usuarioU').val(response.datos.nombre_usuario);
          if(response.datos.es_libre==1){
            $('#es_libreU').prop('checked',true);
          }
          else{
            $('#es_libreU').prop('checked',false);
          }

          if(response.datos.autogestion==1){
            $('#autogestionU').prop('checked',true);
          }
          else{
            $('#autogestionU').prop('checked',false);
          }

          $("#modalEquipoModificar").modal("show");

        })
        .fail(function(){
          alert(id_articulo);
        });
      });
      $('body').on('click', '.eliminar', function (event) {
        event.preventDefault();
        var id_arbitro=$(this).attr('data-idequipo');
        $("#idequipoD").val(id_arbitro);
        $("#modalArbitroEliminar").modal("show");
      });

      $('body').on('click', '.clave', function (event) {
        event.preventDefault();
        var id_equipo=$(this).attr('data-idequipo');
        var equipo=$(this).attr('data-equipo');
        $("#idequipoC").val(id_equipo);
        $("#equipoC").html(equipo);
        $("#modalCalveResetear").modal("show");
      });

    });

    </script>
    @endsection
