        @extends('admin.masterAdmin')

        @section('title')
        <h1> Gestion De Torneos <small ></small></h1>
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
                    <div class=" panel-heading">Torneos <a href="" id="btnNuevoTorneo" title="Nuevo Torneo" class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalTorneoAgregar"><i class=" fa fa-plus"></i></a>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                    <i class="fa fa-question-circle"></i><b class="caret"></b>
                                </button>
                                <ul class="multiselect-container dropdown-menu pull-right">
                                    <li>Desde Aqui Puede Agregar (Click en "+"), editar , inactivar o eliminar un Torneo</li>
                                    <li>Un torneo inactivo no se muestra en la web publica</li>
                                    <li>Haciendo click en configurar torneo,puede configurarlo, agregando fechas equipos, Resultados,etc</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" panel-body">
                        <div class="table-responsive">
                            <table id="editar"  class=" table table-bordered table-condensed table-hover">
                                <tr>
                                    <th>Torneo</th>
                                    <th>Tipo Torneo</th>
                                      <th>Observaciones</th>
                                      <th title="Calcular Tabla de Posiciones Por Torneo. O por Zona">Tab.x.Torneo</th>
                                      <th title="Calcular Goleadores y Sancionados Por Torneo. O por Zona">Estad.x.Torneo</th>
                                      <th>Activo</th>
                                </tr>
                                @foreach($listTorneos as $torneo)
                                    <tr >
                                        <td>{{$torneo->nombre_torneo}}</td>
                                        <td>{{$torneo->TipoTorneo->nombre_tipo_torneo}}</td>
                                        <td>{{$torneo->observaciones_torneo}}</td>
                                        <td>{{$torneo->TablasXTorneo()}}</td>
                                        <td>{{$torneo->EstadisticasXTorneo()}}</td>
                                        <td>{{$torneo->Activo()}}</td>
                                        <td><a href="torneos/{{$torneo->idtorneo}}"  class="btn btn-xs btn-primary" data-idtorneo="{{$torneo->idtorneo}}"  title="Configurar Torneo"><i class="fa fa-cog"></i></a></td>
                                        <td><a href="#"  class="btn btn-xs btn-info editar" data-idtorneo="{{$torneo->idtorneo}}"  title="Editar"> <i class=" fa fa-edit"></i></a></td>
                                        @if($torneo->deleted_at==null)
                                        <td><a href="#"  class="btn btn-xs btn-warning baja" data-idtorneo="{{$torneo->idtorneo}}"  title="Dar de Baja"><i class="fa fa-thumbs-down"></i></a></td>
                                        @else
                                        <td><a href="#"  class="btn btn-xs btn-warning alta" data-idtorneo="{{$torneo->idtorneo}}"  title="Dar de Alta"><i class="fa fa-thumbs-up"></i></a></td>
                                        @endif
                                        <td><a href="" class="btn btn-xs btn-danger eliminar" data-idtorneo="{{$torneo->idtorneo}}"  title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
               </div>
            </div>
        </div>

        <div class="modal fade" id="modalTorneoAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                    <div class="modal-content">
                          {!!Form::open(['route'=>'admin.torneos.store','method'=>'POST' , 'data-toggle='>'validator'])!!}
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myModalLabel">Agregando Torneo</h4>
                              </div>
                              <div class="modal-body">
                                  <div class=" panel panel-info">
                                    <div class=" panel-heading">Torneo</div>
                                    <div class=" panel-body">
                                        <div clas="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                Nombre
                                                {!!Form::Text('nombre_torneo',null,['class'=>' form-control','required'])!!}
                                                <span class="help-block with-errors"></span>
                                            </div>
                                            Tipo Torneo
                                            {!!Form::select('idtipo_torneo', $listTipoToneo,null,array('class' => 'form-control'))!!}
                                            Observaciones
                                            {!!Form::Text('observaciones_torneo',null,['class'=>' form-control'])!!}
                                            Tabla de Posiciones por Torneo
                                            <div>{!!Form::checkbox('tablas_x_torneo','0',false)!!}</div>
                                            Estadisticas por Torneo (Goleadores y sancionados)
                                            <div>{!!Form::checkbox('estadisticas_x_torneo','0',false)!!}</div>
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
        <div class="modal fade" id="modalTorneoModificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      {!!Form::open(['route'=>'admin.torneos.update','method'=>'PUT', 'data-toggle='>'validator'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Modificando Torneo</h4>
                        </div>
                        <div class="modal-body">
                            <div class=" panel panel-default">
                                <div class=" panel-heading">Torneo</div>
                                 <div class=" panel-body">
                                     <div class="row">
                                          <div class="col-md-12">
                                                {!!Form::Text('idtorneo',null,['class'=>' hidden form-control','id'=>'idtorneoU'])!!}
                                                <div class="form-group">
                                                    Torneo
                                                    {!!Form::Text('nombre_torneo',null,['class'=>' form-control','id'=>'nombre_torneoU','required'])!!}
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                                Tipo Torneo
                                                {!!Form::select('idtipo_torneo', $listTipoToneo,null,array('class' => 'form-control','id'=>'idtipo_torneoU'))!!}
                                                Observaciones
                                                {!!Form::Text('observaciones_torneo',null,['class'=>' form-control','id'=>'observaciones_torneoU'])!!}
                                                 Tabla de Posiciones por Torneo
                                                <div>{!!Form::checkbox('tablas_x_torneo','0',false,['id'=>'tablas_x_torneoU'])!!}</div>
                                                Estadisticas por Torneo (Goleadores y sancionados)
                                                <div>{!!Form::checkbox('estadisticas_x_torneo','0',false,['id'=>'estadisticas_x_torneoU'])!!}</div>
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
        <div class="modal fade" id="modalTorneoBaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      {!!Form::open(['url'=>['admin/torneos/baja'],'method'=>'POST'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Dando de Baja el Torneo</h4>
                        </div>
                        <div class="modal-body">
                               <div class="row">
                                    <div class="col-md-12">
                                        {!!Form::Text('idtorneo',null,['class'=>'hidden','id'=>'idtorneoB'])!!}
                                        <h3>¿Desea dar de baja el Torneo?</h3>
                                        <p class=" text-danger">El torneo no se mostrara en la web publica. Luego puede activar el torneo nuevamente</p>
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
        <div class="modal fade" id="modalTorneoAlta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!!Form::open(['url'=>['admin/torneos/alta'],'method'=>'POST'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Dando de Alta el Torneo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!!Form::Text('idtorneo',null,['class'=>'hidden','id'=>'idtorneoA'])!!}
                                    <h3>¿Desea dar de Alta el Torneo?</h3>
                                    <p class=" text-danger">El torneo se mostrara en la web publica. Luego puede dar de baja el torneo nuevamente</p>
                                </div>
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
        <div class="modal fade" id="modalTorneoEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!!Form::open(['route'=>['admin.torneos.destroy'],'method'=>'DELETE'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Eliminando el Torneo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!!Form::Text('idtorneo',null,['class'=>'hidden','id'=>'idtorneoD'])!!}
                                    <h3>¿Desea Eliminar el Torneo?</h3>
                                    <p class=" text-danger">El torneo no se podra recuperar y se perdera todo su contenido</p>
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
        @endsection
        @section('script')
        <script>
        $(function () {
            $('body').on('click', '.editar', function (event) {
                event.preventDefault();
                var id_articulo=$(this).attr('data-idtorneo');
                $.ajax({
                     url:"torneos/buscar",
                     type: "POST",
                     dataType: "json",
                    data:{'idtorneo': id_articulo}
                    })
                .done(function(response){
                        //alert(response.datos.nombre_torneo);
                        $('#nombre_torneoU').val(response.datos.nombre_torneo);
                        $('#idtorneoU').val(response.datos.idtorneo);
                        $('#idtipo_torneoU').val(response.datos.idtipo_torneo);
                        $('#observaciones_torneoU').val(response.datos.observaciones_torneo);

                        if(response.datos.tablas_x_torneo==1){
                        $('#tablas_x_torneoU').prop('checked',true);
                        }
                        else{
                        $('#tablas_x_torneoU').prop('checked',false);
                        }

                        if(response.datos.estadisticas_x_torneo==1){
                        $('#estadisticas_x_torneoU').prop('checked',true);
                        }
                        else{
                        $('#estadisticas_x_torneoU').prop('checked',false);
                        }

                        $("#modalTorneoModificar").modal("show");
                    })
                .fail(function(){
                    alert(id_articulo);
                });
            });
            $('body').on('click', '.baja', function (event) {
                event.preventDefault();
                var id_arbitro=$(this).attr('data-idtorneo');
                $("#idtorneoB").val(id_arbitro);
                $("#modalTorneoBaja").modal("show");
            });
            $('body').on('click', '.alta', function (event) {
                            event.preventDefault();
                            var id_arbitro=$(this).attr('data-idtorneo');
                            $("#idtorneoA").val(id_arbitro);
                            $("#modalTorneoAlta").modal("show");
                        });
            $('body').on('click', '.eliminar', function (event) {
                        event.preventDefault();
                        var id_arbitro=$(this).attr('data-idtorneo');
                        $("#idtorneoD").val(id_arbitro);
                        $("#modalTorneoEliminar").modal("show");
            });

        });

        </script>
        @endsection
