        @extends('admin.masterAdmin')

        @section('title')
        <h1>Torneo: {{$fecha->Torneo->nombre_torneo}} - {{$fecha->Torneo->TipoTorneo->nombre_tipo_torneo}} - Zona: {{$fecha->Zona->nombre}} - Fecha: {{$fecha->numero_fecha}}<small > </small></h1>
        @endsection

        @section('breadcrumb')
        <li><a href="/admin/home"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/admin/torneos"><i class="fa fa-trophy"></i> Torneos</a></li>
        <li><a href="/admin/torneos/{{$fecha->Torneo->idtorneo}}"><i class="fa fa-trophy"></i>{{$fecha->Torneo->nombre_torneo}}- {{$fecha->Torneo->TipoTorneo->nombre_tipo_torneo}}</a></li>
        <li><a href="/admin/zonas/{{$fecha->Zona->idzona}}"><i class="fa fa-trophy"></i>{{$fecha->Zona->nombre}}</a></li>
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
            <div class="col-md-12">
                <div class=" panel panel-default">
                    <div class=" panel-heading"><strong>Partidos</strong>  <a href="" id="btnNuevaFecha" title="Agregar Partido"
                    class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalPartidoAgregar"><i class=" fa fa-plus"></i></a>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                    <i class="fa fa-question-circle"></i><b class="caret"></b>
                                </button>
                                <ul class="multiselect-container dropdown-menu pull-right">
                                    <li>Desde Aqui puede agregar, eliminar partidos y resultados de una fecha</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" panel-body">
                        <div class="table-responsive">
                            <table id="editar"  class=" table table-bordered table-condensed table-hover">
                                <tr>
                                    <th>Hora</th>
                                    <th>Local</th>
                                    <th>Visitante</th>
                                    <th>Resultado</th>
                                    <th>Arbitro</th>
                                </tr>
                                @foreach($fecha->ListPartidos as $partido)
                                <tr >
                                     <td>{{$partido->hora}}</td>
                                     <td>{{$partido->EquipoLocal->nombre_equipo}}</td>
                                     <td>{{$partido->EquipoVisitante->nombre_equipo}}</td>
                                     <td>{{$partido->goles_local}} - {{$partido->goles_visitante}}</td>
                                     <td>{{$partido->Arbitro->nombre}}</td>
                                     <td><a href="../partidos/{{$partido->idpartido}}" class="btn btn-xs btn-primary" data-idpartido="{{$partido->idpartido}}"  title=" Editar Resultado"><i class="fa fa-calculator"></i></a></td>
                                     <td><a href="" class="btn btn-xs btn-info editar" data-idpartido="{{$partido->idpartido}}"  title="Modificar Partido"> <i class=" fa fa-edit"></i></a></td>
                                     <td><a href="" class="btn btn-xs btn-danger eliminar" data-idpartido="{{$partido->idpartido}}"  title="Eliminar"><i class=" fa fa-close"></i></a></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalPartidoAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                            <div class="modal-content">
                                  {!!Form::open(['route'=>'admin.partidos.store','method'=>'POST'])!!}
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          <h4 class="modal-title" id="myModalLabel">Agregando Partido</h4>
                                      </div>
                                      <div class="modal-body"><div class=" panel panel-info">
                                      <div class=" panel-heading">Partido</div>
                                         <div class=" panel-body">
                                          <div clas="row">
                                              <div class="col-md-12">
                                                {!!Form::Text('idzona',$fecha->idzona,['class'=>'hidden'])!!}
                                                {!!Form::Text('idfecha',$fecha->idfecha,['class'=>'hidden'])!!}
                                                Hora
                                                {!!Form::Text('hora',null,['class'=>' form-control'])!!}
                                                Local
                                               {!!Form::select('idequipo_local', $listEquipos,null,array('class' => 'form-control'))!!}
                                                Visitante
                                                {!!Form::select('idequipo_visitante', $listEquipos,null,array('class' => 'form-control'))!!}
                                                Arbitro
                                                {!!Form::select('idarbitro', $listArbitros,null,array('class' => 'form-control'))!!}

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
        <div class="modal fade" id="modalPartidoModificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                    <div class="modal-content">
                          {!!Form::open(['route'=>'admin.partidos.update','method'=>'PUT'])!!}
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myModalLabel">Modificando Partido</h4>
                              </div>
                              <div class="modal-body"><div class=" panel panel-info">
                              <div class=" panel-heading">Partido</div>
                                 <div class=" panel-body">
                                  <div clas="row">
                                      <div class="col-md-12">
                                        {!!Form::Text('idpartido',null,['class'=>'hidden','id'=>'idpartidoU'])!!}
                                        {!!Form::Text('idzona',null,['class'=>'hidden','id'=>'idzonaU'])!!}
                                        {!!Form::Text('idfecha',null,['class'=>'hidden','id'=>'idfechaU'])!!}
                                        Hora
                                        {!!Form::Text('hora',null,['class'=>' form-control','id'=>'horaU'])!!}
                                        Local
                                       {!!Form::select('idequipo_local', $listEquipos,null,array('class' => 'form-control','id'=>'idequipo_localU'))!!}
                                        Visitante
                                        {!!Form::select('idequipo_visitante', $listEquipos,null,array('class' => 'form-control','id'=>'idequipo_visitanteU'))!!}
                                        Arbitro
                                        {!!Form::select('idarbitro', $listArbitros,null,array('class' => 'form-control','id'=>'idarbitroU'))!!}
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
        <div class="modal fade" id="modalPartidoResultado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!!Form::open(['url'=>'admin/partidos/resultado','method'=>'POST'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Resultado Partido</h4>
                        </div>
                        <div class="modal-body">
                            <div class=" panel panel-info">
                                <div class=" panel-heading">Partido</div>
                                <div class=" panel-body">
                                    <div clas="row">
                                        {!!Form::Text('idpartido',null,['class'=>'hidden','id'=>'idpartidoR'])!!}
                                        {!!Form::Text('idzona',null,['class'=>'hidden','id'=>'idzonaR'])!!}
                                        {!!Form::Text('idfecha',null,['class'=>'hidden','id'=>'idfechaR'])!!}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            Hora
                                            {!!Form::Text('hora',null,['class'=>' form-control','id'=>'horaR','disabled'])!!}
                                        </div>
                                        <div class="col-md-6">
                                            Arbitro
                                            {!!Form::select('idarbitro', $listArbitros,null,array('class' => 'form-control','id'=>'idarbitroR','disabled'))!!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            Local
                                            {!!Form::select('idequipo_local', $listEquipos,null,array('class' => 'form-control','id'=>'idequipo_localR','disabled'))!!}
                                        </div>
                                        <div class="col-xs-2">
                                            .
                                            {!!Form::Text('goles_local',null,['class'=>' form-control','id'=>'goles_localR','title'=>'Goles'])!!}
                                        </div>
                                        <div class="col-xs-4">
                                            Visitante
                                            {!!Form::select('idequipo_visitante', $listEquipos,null,array('class' => 'form-control','id'=>'idequipo_visitanteR','disabled'))!!}
                                        </div>
                                        <div class="col-xs-2">
                                            .
                                            {!!Form::Text('goles_visitante',null,['class'=>' form-control','id'=>'goles_visitanteR','title'=>'Goles'])!!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12"><h3>Goles Jugadores</h3></div>
                                        <div class="col-xs-4">
                                            <div >Nombre</div>
                                        </div>
                                        <div class="col-xs-2"></div>
                                        <div class="col-xs-4">
                                            <div >Nombre</div>
                                        </div>
                                        <div class="col-xs-2"></div>
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
        <div class="modal fade" id="modalPartidoEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                {!!Form::open(['route'=>['admin.partidos.destroy'],'method'=>'DELETE'])!!}
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Eliminando el Partido</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!!Form::Text('idpartido',null,['class'=>'hidden','id'=>'idpartidoD'])!!}
                                                <h3>¿Desea Eliminar el Partido?</h3>
                                                <p class=" text-danger">El partido no se podrá recuperar.</p>
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
                                var id_articulo=$(this).attr('data-idpartido');
                                $.ajax({
                                     url:"../partidos/buscar",
                                     type: "POST",
                                     dataType: "json",
                                    data:{'idpartido': id_articulo}
                                    })
                                .done(function(response){
                                        //alert(response.datos.titulo);
                                         $('#idpartidoU').val(response.datos.idpartido);
                                        $('#idzonaU').val(response.datos.idzona);
                                        $('#idfechaU').val(response.datos.idfecha);
                                        $('#horaU').val(response.datos.hora);
                                        $('#idequipo_localU').val(response.datos.idequipo_local);
                                        $('#idequipo_visitanteU').val(response.datos.idequipo_visitante);
                                        $('#idarbitroU').val(response.datos.idarbitro);
                                        $("#modalPartidoModificar").modal("show");
                                    })
                                    .fail(function(){
                                        alert(id_articulo);
                                    });
                            });
            $('body').on('click', '.resultado', function (event) {
                event.preventDefault();
                var id_articulo=$(this).attr('data-idpartido');
                $.ajax({
                     url:"../partidos/buscar",
                     type: "POST",
                     dataType: "json",
                    data:{'idpartido': id_articulo}
                    })
                .done(function(response){
                        //alert(response.datos.titulo);
                         $('#idpartidoR').val(response.datos.idpartido);
                        $('#idzonaR').val(response.datos.idzona);
                        $('#idfechaR').val(response.datos.idfecha);
                        $('#horaR').val(response.datos.hora);
                        $('#idequipo_localR').val(response.datos.idequipo_local);
                        $('#idequipo_visitanteR').val(response.datos.idequipo_visitante);
                        $('#idarbitroR').val(response.datos.idarbitro);
                        $("#modalPartidoResultado").modal("show");
                    })
                    .fail(function(){
                        alert(id_articulo);
                    });
            });
            $('body').on('click', '.eliminar', function (event) {
                                    event.preventDefault();
                                    var id_arbitro=$(this).attr('data-idpartido');
                                    $("#idpartidoD").val(id_arbitro);
                                    $("#modalPartidoEliminar").modal("show");
                        });
             $('.datepicker').datepicker({
                 format: 'mm/dd/yyyy',
                 startDate: '-3d'
             })

        });

        </script>
        @endsection
