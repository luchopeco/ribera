        @extends('admin.masterAdmin')

        @section('title')
        <h1> Lista Negra de Jugadores<small ></small></h1>
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
                    <div class=" panel-heading">Jugadores en Lista Negra
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                    <i class="fa fa-question-circle"></i><b class="caret"></b>
                                </button>
                                <ul class="multiselect-container dropdown-menu pull-right">
                                    <li>Los Jugadores en lista negra no pueden volver a inscribirse. Esto se valida mediante el numero de documento.</li>
                                    <li>Desde aqui los puede consultar y los puede volver a activar</li>
                                    <li>Para poner un jugador en lista negra, busquelo en el equipo y haga click en poner en lista negra.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" panel-body">
                        <div class="table-responsive">
                            <table id="editar"  class=" table table-bordered table-condensed table-hover table-responsive">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Email</th>
                                    <th>Tel/cel</th>
                                    <th>Direccion</th>
                                </tr>
                                @foreach($listJugador as $jugador)
                                    <tr >
                                        <td>{{$jugador->nombre_jugador}}</td>
                                        <td>{{$jugador->dni}}</td>
                                        <td>{{$jugador->mail}}</td>
                                        <td>{{$jugador->telefono}}</td>
                                        <td>{{$jugador->direccion}}</td>
                                        <td><a href="#"  class="btn btn-xs btn-success alta" data-idjugador="{{$jugador->idjugador}}"  title="Quitar De Lista Negra"><i class="fa fa-thumbs-up"></i></a></td>
                                        <td><a href="#" data-toggle="modal" data-target="#modalImagen{{$jugador->idjugador}}" title="Imagen Jugador" class=" btn-xs btn btn-success" ><i class=" fa fa-image"></i></a></td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        <div class="modal fade" id="modalalta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              {!!Form::open(['url'=>['admin/jugadores/alta'],'method'=>'POST'])!!}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Quitar Jugador de Lista Negra</h4>
                                </div>
                                <div class="modal-body">
                                       <div class="row">
                                            <div class="col-md-12">
                                                {!!Form::Text('idjugador',null,['class'=>'hidden','id'=>'idjugadorL'])!!}
                                                <h3>¿Desea Quitar el Jugador De la Lista Negra?</h3>
                                                <div id="caca"></div>
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
        @foreach($listJugador as $jugador)
        <div id="modalImagen{{$jugador->idjugador}}"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×</button>
                    <h3>Modificando Imagen del jugador</h3>
                </div>
                <div class=" modal-body ">
                    <div class="row">
                        <div class="col-md-12">
                             @if($jugador->pathfoto!=null)
                                    <div class="col-md-12">
                                        <a class="thumbnail" ><img src="/imagenes/{{$jugador->pathfoto}}" ></a>
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::open(['url'=>'admin/listanegra/imagenjugadorborrar','method'=>'POST'])!!}
                                        {!!Form::Text('idjugador',$jugador->idjugador,['class'=>'hidden'])!!}
                                        {!!Form::submit('Borrar Imagen', array('class' => 'btn btn-success'))!!}
                                        {!! Form::close() !!}
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <form method="POST" action="listanegra/imagenjugadorguardar" class="dropzone" id="upload" enctype="multipart/form-data">
                                            <input type="hidden" value="{{$jugador->idjugador}}" name="idjugador">
                                            <input type="hidden" value="{{ csrf_token() }}" name="file">
                                            <div class="dz-message">
                                                 Arrastra y suelta aqui tu archivo. O simplemente haz click<br />
                                            </div>
                                        </form>
                                    </div>
                                @endif




                        </div>
                        <div class="col-md-12">
                            <div class="text-danger text-center">Luego de subir la imagen. Refrescar la página para ver los  cambios</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endsection
        @section('script')
        <script src="/js/dropzone.js" type="text/javascript"></script>
        <script>
        $(function () {
            $('body').on('click', '.alta', function (event) {
                event.preventDefault();
                var id_arbitro=$(this).attr('data-idjugador');
                $("#idjugadorL").val(id_arbitro);
                $("#modalalta").modal("show");
            });

        });

        </script>
        @endsection
