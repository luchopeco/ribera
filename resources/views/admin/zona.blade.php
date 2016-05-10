 @extends('admin.masterAdmin')

@section('title')
<h1>Zona: {{$z->nombre}}<small >Torneo: {{$z->Torneo->nombre_torneo}} - {{$z->Torneo->TipoTorneo->nombre_tipo_torneo}} </small></h1>
@endsection

@section('breadcrumb')
<li><a href="/admin/home"><i class="fa fa-home"></i> Home</a></li>
<li><a href="/admin/torneos"><i class="fa fa-trophy"></i> Torneos</a></li>
<li><a href="/admin/torneos/{{$z->Torneo->idtorneo}}"><i class="fa fa-trophy"></i> {{$z->Torneo->nombre_torneo}}</a></li>
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
    <div class="col-md-6">
        <div class=" panel panel-default">
            <div class=" panel-heading"><strong>Fechas</strong>  <a href="" id="btnNuevaFecha" title="Agregar Fechas"
            class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalFechaAgregar"><i class=" fa fa-plus"></i></a>
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                            <i class="fa fa-question-circle"></i><b class="caret"></b>
                        </button>
                        <ul class="multiselect-container dropdown-menu pull-right">
                            <li>Desde Aqui Puede Agregar o eliminar Fechas de un torneo</li>
                             <li>Las fechas Play Off NO SUMAN PUNTOS, SI computan goles</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class=" panel-body">
                <div class="table-responsive">
                    <table id="editar"  class=" table table-bordered table-condensed table-hover">
                        <tr>
                            <th>Fecha</th>
                             <th>Dia</th>
                             <th>Observaciones</th>
                              <th>Es Play Off</th>
                        </tr>
                            @foreach($z->ListFechas as $fecha)
                        <tr >
                            <td>{{$fecha->numero_fecha}}</td>
                            <td>{{date('d/m/Y', strtotime($fecha->fecha))}}</td>
                            <td>{{$fecha->observaciones}}</td>
                            <td>{{$fecha->esPlayOff()}}</td>
                            <td><a href="../fechas/planilla/{{$fecha->idfecha}}" class=" btn btn-xs btn-info" title="Imprimir Planilla Fecha" target="_blank"> <i class="fa fa-print"></i></a></td>
                            <td><a href="../fechas/{{$fecha->idfecha}}" class="btn btn-xs btn-primary " data-idtorneo="{{$fecha->idtorneo}}" data-idfecha="{{$fecha->idfecha}}"  title="Gestionar Partidos"> <i class="fa fa-futbol-o"></i></a></td>
                            <td><a href="" class="btn btn-xs btn-info editarfecha" data-idtorneo="{{$fecha->idtorneo}}" data-idfecha="{{$fecha->idfecha}}"  title="Editar"> <i class=" fa fa-edit"></i></a></td>
                            <td><a href="../fecha/{{$fecha->idfecha}}" title="Imagenes de la  Fecha" class=" btn-xs btn btn-success" ><i class=" fa fa-image"></i></a></td>
                            <td><a href="" class="btn btn-xs btn-danger eliminarfecha" data-idtorneo="{{$fecha->idtorneo}}" data-idfecha="{{$fecha->idfecha}}"  title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                        </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class=" panel panel-default">
            <div class=" panel-heading"><strong>Equipos</strong> <a href="" id="btnNuevoEquipo" title="Agregar equipo al torneo" class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalEquipoAgregar"><i class=" fa fa-plus"></i></a>
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                            <i class="fa fa-question-circle"></i><b class="caret"></b>
                        </button>
                        <ul class="multiselect-container dropdown-menu pull-right">
                            <li>Desde Aqui Puede Agregar o eliminar equipos a un torneo,</li>
                            <li>Si desea Modificar el Equipo debe hacer desde la seccion equipo</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class=" panel-body">
                <div class="table-responsive">
                    <table id="editar"  class=" table table-bordered table-condensed table-hover">
                        <tr>
                            <th>Equipos</th>
                        </tr>
                        @foreach($z->ListEquipos as $equipo)
                            <tr >
                                <td>{{$equipo->nombre_equipo}}</td>
                                <td><a href="" class="btn btn-xs btn-danger eliminar"  data-idequipo="{{$equipo->idequipo}}"  title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if($z->Torneo->tablas_x_torneo==0)
<div class="row">
    <div class="col-md-12">
        <div class=" panel panel-default">
            <div class=" panel-heading">
                <strong>Tabla de Posiciones</strong>
            </div>
            <div class=" panel-body">
               <div class="table-responsive">
                   <table id="editar"  class=" table table-bordered table-condensed table-hover">
                       <tr>
                           <th>Equipo</th>
                           <th>Pts</th>
                           <th>Pj</th>
                           <th>Gf</th>
                           <th>GC</th>
                           <th>Df</th>
                       </tr>
                       @foreach($z->TablaPosiciones() as $tabla)
                           <tr >
                               <td>{{$tabla->nombre_equipo}}</td>
                               <td>{{$tabla->pun}}</td>
                               <td>{{$tabla->pj}}</td>
                               <td>{{$tabla->gf}}</td>
                               <td>{{$tabla->gc}}</td>
                               <td>{{$tabla->df}}</td>
                           </tr>
                       @endforeach
                   </table>
               </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($z->Torneo->estadisticas_x_torneo==0)
<div class="row">
    <div class="col-md-6">
        <div class=" panel panel-default">
            <div class=" panel-heading">
                <strong>Goleadores</strong>
            </div>
            <div class=" panel-body">
                <div class="table-responsive">
                    <table id="editar"  class=" table table-bordered table-condensed table-hover">
                        <tr>
                            <th>Jugador</th>
                            <th>Equipo</th>
                            <th>Goles</th>
                        </tr>
                        @foreach($z->Goleadores() as $goleador)
                        <tr >
                            <td>{{$goleador->nombre_jugador}}</td>
                            <td>{{$goleador->nombre_equipo}}</td>
                            <td>{{$goleador->goles}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    <div class=" panel panel-default">
        <div class=" panel-heading">
            <strong>Tarjetas</strong>
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="modal" data-target="#modalAyudaTarjetas"  title="Ayuda">
                        <i class="fa fa-question-circle"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class=" panel-body">
            <div class="table-responsive">
                <table id="editar"  class=" table table-bordered table-condensed table-hover">
                    <tr>
                        <th>Jugador</th>
                        <th>Equipo</th>
                        <th>Ult. Fecha Am.</th>
                        <th>Tar. Amarillas</th>
                        <th>Ult. Fecha Az.</th>
                        <th>Tar. Azules</th>
                        <th>Ult. Fecha Ro.</th>
                        <th>Tar. Rojas</th>
                    </tr>
                    @foreach($z->Tarjetas() as $goleador)
                      <?php
                        $azulmasamarillo = 0;
                        if($goleador->ta != null && $goleador->ta % 4 !=0 && $goleador->ta % 2 ==0 && $goleador->taz % 2 !=0 && $goleador->taz!=null ){
                        $azulmasamarillo = 1;
                        }
                      ?>
                    <tr >
                        <td>{{$goleador->nombre_jugador}}</td>
                        <td>{{$goleador->nombre_equipo}}</td>
                        <td @if($goleador->ta % 4 ==0 && $goleador->ta!=null) class="danger" @endif @if($azulmasamarillo ==1) class="danger" @endif>
                            @if($goleador->fecha_ta!=null) {{date('d/m/Y', strtotime($goleador->fecha_ta))}}@endif
                        </td>
                        <td @if($goleador->ta % 4 ==0 && $goleador->ta!=null)  class="danger" @endif @if($azulmasamarillo ==1) class="danger" @endif>
                            {{$goleador->ta}}
                        </td>
                        <td @if($goleador->taz % 2 ==0 && $goleador->taz!=null) class="danger" @endif @if($azulmasamarillo ==1) class="danger" @endif>
                            @if($goleador->fecha_taz!=null)  {{date('d/m/Y', strtotime($goleador->fecha_taz))}} @endif
                        </td>
                        <td @if($goleador->taz % 2 ==0 && $goleador->taz!=null) class="danger" @endif @if($azulmasamarillo ==1) class="danger" @endif>
                            {{$goleador->taz}}
                        </td>
                        <td @if($goleador->tar!=null) class="danger" @endif >
                            @if($goleador->fecha_tr!=null)  {{date('d/m/Y', strtotime($goleador->fecha_tr))}} @endif
                        </td>
                        <td @if($goleador->tar!=null) class="danger" @endif >
                            {{$goleador->tar}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endif

<!-- MDOALESSSSSSS -->
<div class="modal fade" id="modalFechaAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!!Form::open(['route'=>'admin.fechas.store','method'=>'POST', 'data-toggle='>'validator'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Agregando Fecha</h4>
                </div>
                <div class="modal-body">
                    <div class=" panel panel-info">
                        <div class=" panel-heading">Fecha</div>
                        <div class=" panel-body">
                            <div clas="row">
                                <div class="col-md-12">
                                    {!!Form::Text('idzona',$z->idzona,['class'=>'hidden'])!!}
                                    <div class="form-group">
                                        Descripcion Fecha
                                        {!!Form::Text('numero_fecha',null,['class'=>'form-control','required'])!!}
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="form-group">
                                        Dia
                                        {!!Form::Text('fecha',null,['class'=>'form-control datepicker','required'])!!}
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    Observaciones
                                    {!!Form::Text('observaciones',null,['class'=>'form-control'])!!}
                                    Es Play Off
                                    <div>{!!Form::checkbox('es_play_off','0',false)!!}</div>
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

<div class="modal fade" id="modalFechaModificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!!Form::open(['route'=>'admin.fechas.update','method'=>'PUT', 'data-toggle='>'validator'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Modificando Fecha</h4>
                </div>
                <div class="modal-body">
                    <div class=" panel panel-info">
                        <div class=" panel-heading">Fecha</div>
                        <div class=" panel-body">
                            <div clas="row">
                                <div class="col-md-12">
                                    {!!Form::Text('idfecha',null,['class'=>'form-control hidden','id'=>'idfechaU'])!!}
                                    <div class="form-group">
                                        Descripcion Fecha
                                        {!!Form::Text('numero_fecha',null,['class'=>'form-control','id'=>'numero_fechaU','required'])!!}
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="form-group">
                                        Dia
                                        {!!Form::Text('fecha',null,['class'=>'form-control datepicker','id'=>'fechaU','required'])!!}
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    Observaciones
                                    {!!Form::Text('observaciones',null,['class'=>'form-control','id'=>'observacionesU'])!!}
                                    Es Play Off
                                   <div> {!!Form::checkbox('es_play_off','0',false,['id'=>'es_play_offU'])!!}</div>
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

<div class="modal fade" id="modalFechaEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  {!!Form::open(['route'=>'admin.fechas.destroy','method'=>'DELETE'])!!}
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title" id="myModalLabel">Eliminando Fecha</h4>
                      </div>
                      <div class="modal-body"><div class=" panel panel-info">
                      <div class=" panel-heading">Eliminar Fecha</div>
                         <div class=" panel-body">
                          <div clas="row">
                              <div class="col-md-12">
                                    {!!Form::Text('idfecha',null,['class'=>'form-control hidden','id'=>'idfechaD'])!!}
                                   ¿Desea Eliminar La Fecha?
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

<div class="modal fade" id="modalEquipoAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
              {!!Form::open(['url'=>'admin/torneos/storeequipo','method'=>'POST'])!!}
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title" id="myModalLabel">Agregando Equipo</h4>
                  </div>
                  <div class="modal-body"><div class=" panel panel-info">
                  <div class=" panel-heading">Equipo</div>
                     <div class=" panel-body">
                      <div clas="row">
                          <div class="col-md-12">
                                {!!Form::Text('idzona',$z->idzona,['class'=>'hidden'])!!}
                              {!!Form::select('idequipo', $listEquipos,null,array('class' => 'form-control'))!!}
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

<div class="modal fade" id="modalEquipoEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!!Form::open(['url'=>['admin/torneos/destroyequipo'],'method'=>'POST'])!!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Eliminando Equipo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!!Form::Text('idzona',$z->idzona,['class'=>'hidden'])!!}
                        {!!Form::Text('idequipo',null,['class'=>'hidden','id'=>'idequipoD'])!!}
                        <h3>¿Desea Eliminar el Equipo del Torneo?</h3>
                    </div>
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

<div class="modal fade" id="modalAyudaTarjetas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Acerca de las Tarjetas</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                  <i class="fa fa-question-circle"></i>
                                  <h3 class="box-title">Se colorean de ROJO.</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                  <ul>
                                    <li>Los jugadores que sumen tarjetas rojas multipos de 1</li>
                                    <li>Los jugadores que sumen tarjestas amarillas multiplos de 4</li>
                                    <li>Los jugadores que sumen tarjetas azules multiplos de 2</li>
                                    <li>Los jugadores que sumen tarjetas azules impares, y tarjetas amarillas multiplo de 2 pero no de 4. </li>
                                  </ul>
                                </div><!-- /.box-body -->
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-danger">
                                Cabe aclarar que las tarjetas se acumulan. Que esten coloreados en rojo, no quiere decir que el jugador este inhabilitado de jugar.
                                Para esto se indica la ultima fecha en la que recibio la tarjeta, para que exista mas informacion al respecto.
                            </p>
                            <p class="text-danger"> Por ejemplo, el jugador puede acumular 4 tarjetas amarillas durante las cuatro primeras fechas, pero luego no recibir mas tarjetas. En este caso,
                            el jugador siempre aparecera coloreado de rojo, luego de la fecha 4.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row ">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('script')
<script>
$(function () {
    $('body').on('click', '.editarfecha', function (event) {
        event.preventDefault();
        var id_articulo=$(this).attr('data-idfecha');
        $.ajax({
            url:"../fechas/buscar",
            type: "POST",
            dataType: "json",
            data:{'idfecha': id_articulo}
            })
        .done(function(response){
            //alert(response.datos.titulo);
            $('#numero_fechaU').val(response.datos.numero_fecha);
            $('#idfechaU').val(response.datos.idfecha);
            $('#fechaU').val(response.datos.fecha);
            $('#observacionesU').val(response.datos.observaciones);
            if(response.datos.es_play_off==1){
                $('#es_play_offU').prop('checked',true);
                }
            else{
                $('#es_play_offU').prop('checked',false);
                }
            $("#modalFechaModificar").modal("show");
        })
        .fail(function(){
            alert(id_articulo);
        });
    });
    $('body').on('click', '.eliminarfecha', function (event) {
        event.preventDefault();
        var id_articulo=$(this).attr('data-idfecha');
        $.ajax({
             url:"../fechas/buscar",
             type: "POST",
             dataType: "json",
            data:{'idfecha': id_articulo}
            })
        .done(function(response){
                //alert(response.datos.titulo);
                $('#idfechaD').val(response.datos.idfecha);
                $("#modalFechaEliminar").modal("show");
            })
            .fail(function(){
                alert(id_articulo);
            });
    });

    $('body').on('click', '.eliminar', function (event) {
        event.preventDefault();
        var id_equipo=$(this).attr('data-idequipo');
        $("#idequipoD").val(id_equipo);
        $("#modalEquipoEliminar").modal("show");
    });

});
</script>
@endsection
