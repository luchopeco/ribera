        @extends('admin.masterAdmin')

        @section('title')
        <h1>Gestion de Jugadores <small >Equipo: {{$equipo->nombre_equipo}} </small></h1>
        @endsection

        @section('breadcrumb')
        <li><a href="/admin/home"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/admin/equipos"> <i class="fa fa-futbol-o"></i>Equipos</a></li>
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
                    <div class=" panel-heading"><strong>Jugadores</strong>  <a href="" id="btnNuevoJugador" title="Agregar Jugadores"
                    class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalJugadorAgregar"><i class=" fa fa-plus"></i></a>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                    <i class="fa fa-question-circle"></i><b class="caret"></b>
                                </button>
                                <ul class="multiselect-container dropdown-menu pull-right">
                                    <li>Desde Aqui Puede Agregar modificar o eliminar los jugadores del equipo</li>
                                       <li>Tambien puede poner el jugador en lista negra</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" panel-body">
                        <div class="table-responsive">
                            <table id="editar"  class=" table table-bordered table-condensed table-hover">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Es Delegado</th>
                                    <th>Entrego Certificado</th>
                                    <th>Observaciones</th>
                                </tr>
                                    @foreach($equipo->ListJugadores as $jugador)
                                <tr >
                                    <td>{{$jugador->NombreApellido()}}</td>
                                    <td>{{$jugador->dni}}</td>
                                    <td>{{date('d/m/Y', strtotime($jugador->fecha_nacimiento))}}</td>
                                    <td>{{$jugador->esDelegado()}}</td>
                                    <td>{{$jugador->entregoCertificado()}}</td>
                                    <td>{{$jugador->observaciones}}</td>
                                    <td><a href="#"  class="btn btn-xs btn-lista-negra listanegra" data-idjugador="{{$jugador->idjugador}}" data-idequipo="{{$equipo->idequipo}}"  title="Poner en Lista Negra"><i class="fa fa-thumbs-down"></i></a></td>
                                    <td><a href="" class="btn btn-xs btn-info editar" data-idjugador="{{$jugador->idjugador}}" data-idequipo="{{$equipo->idequipo}}"  title="Modificar"> <i class=" fa fa-edit"></i></a></td>
                                    <td><a href="" class="btn btn-xs btn-danger eliminar" data-idjugador="{{$jugador->idjugador}}" data-idequipo="{{$equipo->idequipo}}"  title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                                </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalJugadorAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                    <div class="modal-content">
                          {!!Form::open(['route'=>'admin.jugadores.store','method'=>'POST', 'data-toggle='>'validator'])!!}
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myModalLabel">Agregando Jugador</h4>
                              </div>
                              <div class="modal-body">
                                <div class=" panel panel-info">
                                    <div class=" panel-heading">Jugador</div>
                                    <div class=" panel-body">
                                      <div clas="row">
                                          <div class="col-md-12">
                                                {!!Form::Text('idequipo',$equipo->idequipo,['class'=>'hidden'])!!}
                                                <div class="form-group">
                                                    Nombre
                                                    {!!Form::Text('nombre_jugador',null,['class'=>'form-control','required'])!!}
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                                <div class="form-group">
                                                    Apellido
                                                    {!!Form::Text('apellido_jugador',null,['class'=>'form-control','required'])!!}
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                                <div class="form-group">
                                                     Documento
                                                     {!!Form::Text('dni',null,['class'=>'form-control','required'])!!}
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                                <div class="form-group">
                                                   Fecha Nacimiento
                                                    {!!Form::Text('fecha_nacimiento',null,['class'=>'form-control datepicker','required'])!!}
                                                    <span class="help-block with-errors"></span>
                                                </div>

                                                Es Delegado
                                                <div>{!!Form::checkbox('delegado','0',false)!!}</div>
                                                Entrego Certificado
                                                <div>{!!Form::checkbox('certificado','0',false)!!}</div>
                                                <div class="form-group">
                                                     Tel/Cel
                                                     {!!Form::Text('telefono',null,['class'=>'form-control'])!!}
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                                <div class="form-group">
                                                     Grupo Sanguineo
                                                     {!!Form::Text('grupo_sanguineo',null,['class'=>'form-control','required'])!!}
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                                <div class="form-group">
                                                     Mail
                                                     {!!Form::Text('mail',null,['class'=>'form-control'])!!}
                                                </div>
                                                <div class="form-group">
                                                     Direccion
                                                     {!!Form::Text('direccion',null,['class'=>'form-control'])!!}
                                                </div>
                                                <div class="form-group">
                                                     Obra Social
                                                     {!!Form::Text('obra_social',null,['class'=>'form-control'])!!}
                                                </div>
                                                Observaciones
                                                {!!Form::Text('observaciones',null,['class'=>'form-control'])!!}
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
        <div class="modal fade" id="modaljugadorModificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                            <div class="modal-content">
                                  {!!Form::open(['route'=>'admin.jugadores.update','method'=>'PUT', 'data-toggle='>'validator'])!!}
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          <h4 class="modal-title" id="myModalLabel">Modificando Jugador</h4>
                                      </div>
                                      <div class="modal-body"><div class=" panel panel-info">
                                      <div class=" panel-heading">Jugador</div>
                                         <div class=" panel-body">
                                          <div clas="row">
                                              <div class="col-md-12">
                                                    {!!Form::Text('idequipo',null,['class'=>'hidden','id'=>'idequipoU'])!!}
                                                    {!!Form::Text('idjugador',null,['class'=>'hidden','id'=>'idjugadorU'])!!}
                                                    <div class="form-group">
                                                        Nombre
                                                        {!!Form::Text('nombre_jugador',null,['class'=>'form-control','id'=>'nombre_jugadorU','required'])!!}
                                                        <span class="help-block with-errors"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        Apellido
                                                        {!!Form::Text('apellido_jugador',null,['class'=>'form-control','id'=>'apellido_jugadorU','required'])!!}
                                                        <span class="help-block with-errors"></span>
                                                    </div>
                                                    Documento
                                                    {!!Form::Text('dni',null,['class'=>'form-control','id'=>'dniU','required'])!!}
                                                    <div class="form-group">
                                                        Fecha Nacimiento
                                                     {!!Form::Text('fecha_nacimiento',null,['class'=>'form-control datepicker','id'=>'fecha_nacimientoU','required'])!!}
                                                        <span class="help-block with-errors"></span>
                                                    </div>
                                                    Es Delegado
                                                    <div>{!!Form::checkbox('delegado','0',false,['id'=>'delegadoU'])!!}</div>
                                                    Entrego Certificado
                                                    <div>{!!Form::checkbox('certificado','0',false,['id'=>'certificadoU'])!!}</div>
                                                    <div class="form-group">
                                                         Tel/Cel
                                                         {!!Form::Text('telefono',null,['class'=>'form-control','id'=>'telefonoU'])!!}
                                                        <span class="help-block with-errors"></span>
                                                    </div>
                                                    <div class="form-group">
                                                         Grupo Sanguineo
                                                         {!!Form::Text('grupo_sanguineo',null,['class'=>'form-control','required','id'=>'grupo_sanguineoU'])!!}
                                                        <span class="help-block with-errors"></span>
                                                    </div>
                                                    <div class="form-group">
                                                         Mail
                                                         {!!Form::Text('mail',null,['class'=>'form-control','id'=>'mailU'])!!}
                                                    </div>
                                                    <div class="form-group">
                                                         Direccion
                                                         {!!Form::Text('direccion',null,['class'=>'form-control','id'=>'direccionU'])!!}
                                                    </div>
                                                    <div class="form-group">
                                                         Obra Social
                                                         {!!Form::Text('obra_social',null,['class'=>'form-control','id'=>'obra_socialU'])!!}
                                                    </div>
                                                    Observaciones
                                                    {!!Form::Text('observaciones',null,['class'=>'form-control','id'=>'observacionesU'])!!}
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
        <div class="modal fade" id="modalJugadorEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      {!!Form::open(['route'=>['admin.jugadores.destroy'],'method'=>'DELETE'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Eliminando Jugador</h4>
                        </div>
                        <div class="modal-body">
                               <div class="row">
                                    <div class="col-md-12">
                                        {!!Form::Text('idequipo',null,['class'=>'hidden','id'=>'idequipoD'])!!}
                                        {!!Form::Text('idjugador',null,['class'=>'hidden','id'=>'idjugadorD'])!!}
                                        <h3>¿Desea Eliminar el Jugador del Equipo?</h3>
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


        <div class="modal fade" id="modalJugadorListaNegra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!!Form::open(['url'=>['admin/jugadores/baja'],'method'=>'POST'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Poniendo Jugador En Lista Negra</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!!Form::Text('idequipo',null,['class'=>'hidden','id'=>'idequipoL'])!!}
                                    {!!Form::Text('idjugador',null,['class'=>'hidden','id'=>'idjugadorL'])!!}
                                    <h3>¿Desea poner el Jugador en Lista Negra?</h3>
                                    <div id="caca"></div>
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
                        var id_articulo=$(this).attr('data-idjugador');
                        $.ajax({
                             url:"../jugadores/buscar",
                             type: "POST",
                             dataType: "json",
                            data:{'idjugador': id_articulo}
                            })
                        .done(function(response){
                                //alert(response.datos.titulo);
                                $('#nombre_jugadorU').val(response.datos.nombre_jugador);
                                 $('#apellido_jugadorU').val(response.datos.apellido_jugador);
                                $('#dniU').val(response.datos.dni);
                                $('#observacionesU').val(response.datos.observaciones);
                                $('#idequipoU').val(response.datos.idequipo);
                                $('#idjugadorU').val(response.datos.idjugador);
                                $('#fecha_nacimientoU').val(response.datos.fecha_nacimiento);
                                $('#telefonoU').val(response.datos.telefono);
                                $('#grupo_sanguineoU').val(response.datos.grupo_sanguineo);
                                $('#mailU').val(response.datos.mail);
                                $('#direccionU').val(response.datos.direccion);
                                 $('#obra_socialU').val(response.datos.obra_social);


                                if(response.datos.delegado==1){
                                    $('#delegadoU').prop('checked',true);
                                    }
                                    else{
                                    $('#delegadoU').prop('checked',false);
                                    }

                                 if(response.datos.certificado==1){
                                    $('#certificadoU').prop('checked',true);
                                    }
                                    else{
                                    $('#certificadoU').prop('checked',false);
                                    }

                                $("#modaljugadorModificar").modal("show");
                            })
                            .fail(function(){
                                alert(id_articulo);
                            });
                    });
            $('body').on('click', '.eliminar', function (event) {
                event.preventDefault();
                var id_jugador=$(this).attr('data-idjugador');
                var id_equipo=$(this).attr('data-idequipo');
                $("#idjugadorD").val(id_jugador);
                $("#idequipoD").val(id_equipo);
                $("#modalJugadorEliminar").modal("show");
            });
                $('body').on('click', '.listanegra', function (event) {
                            event.preventDefault();
                            var id_jugador=$(this).attr('data-idjugador');
                            var id_equipo=$(this).attr('data-idequipo');
                            $("#idjugadorL").val(id_jugador);
                            $("#idequipoL").val(id_equipo);
                            $("#modalJugadorListaNegra").modal("show");
                        });

        });

        </script>
        @endsection
