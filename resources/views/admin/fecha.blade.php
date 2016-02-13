        @extends('admin.masterAdmin')

        @section('title')
        <h1>Fecha: {{$fecha->numero_fecha}}<small> Torneo : {{$fecha->Torneo->nombre_torneo}} - {{$fecha->Torneo->TipoTorneo->nombre_tipo_torneo}}</small></h1>
        @endsection

        @section('breadcrumb')
        <li><a href="/admin/home"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/admin/torneos"><i class="fa fa-trophy"></i> Torneos</a></li>
        <li><a href="/admin/torneos/{{$fecha->Torneo->idtorneo}}"><i class="fa fa-trophy"></i>{{$fecha->Torneo->nombre_torneo}}- {{$fecha->Torneo->TipoTorneo->nombre_tipo_torneo}}</a></li>
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
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Imagen de la fecha</div>
                    <div class="panel-body">
                    @if($fecha->imagen_fecha!=null)
                        <div class="col-md-12">
                            <a class="thumbnail" ><img src="/imagenes/{{$fecha->imagen_fecha}}" ></a>
                        </div>
                        <div class="col-md-12">
                              <a href="#" data-toggle="modal" data-target="#modalImagenEliminar" class="btn btn-danger"><i class="fa fa-close"></i>Borrar Imagen</a>
                        </div>
                    @else
                        <div class="col-md-12">
                            <form method="POST" action="../fecha/imagenguardar" class="dropzone" id="upload" enctype="multipart/form-data">
                            <input type="hidden" value="{{ $fecha->idfecha }}" name="idfecha">
                                 <input type="hidden" value="{{ csrf_token() }}" name="file">
                                 <div class="dz-message">
                                     Arrastra y suelta aqui tu archivo. O simplemente haz click<br />
                                 </div>
                              </form>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Imagen Equipo Ideal</div>
                                <div class="panel-body">
                                @if($fecha->imagen_equipo_ideal!=null)
                                    <div class="col-md-12">
                                        <a class="thumbnail" ><img src="/imagenes/{{$fecha->imagen_equipo_ideal}}" ></a>
                                    </div>
                                    <div class="col-md-12">
                                          <a href="#" data-toggle="modal" data-target="#modalImagenEquipoEliminar" class="btn btn-danger"><i class="fa fa-close"></i>Borrar Imagen</a>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <form method="POST" action="../fecha/imagenequipoguardar" class="dropzone" id="upload" enctype="multipart/form-data">
                                        <input type="hidden" value="{{ $fecha->idfecha }}" name="idfecha">
                                             <input type="hidden" value="{{ csrf_token() }}" name="file">
                                             <div class="dz-message">
                                                 Arrastra y suelta aqui tu archivo. O simplemente haz click<br />
                                             </div>
                                          </form>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Imagen Figura de la  Fecha</div>
                    <div class="panel-body">
                    @if($fecha->imagen_figura_fecha !=null)
                        <div class="col-md-12">
                            <a class="thumbnail" ><img src="/imagenes/{{$fecha->imagen_figura_fecha}}" ></a>
                        </div>
                        <div class="col-md-12">
                              <a href="#" data-toggle="modal" data-target="#modalImagenFiguraEliminar" class="btn btn-danger"><i class="fa fa-close"></i>Borrar Imagen</a>
                        </div>
                    @else
                        <div class="col-md-12">
                            <form method="POST" action="../fecha/imagenfiguraguardar" class="dropzone" id="upload" enctype="multipart/form-data">
                            <input type="hidden" value="{{ $fecha->idfecha }}" name="idfecha">
                                 <input type="hidden" value="{{ csrf_token() }}" name="file">
                                 <div class="dz-message">
                                     Arrastra y suelta aqui tu archivo. O simplemente haz click<br />
                                 </div>
                              </form>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalImagenEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Eliminando la imagen de la fecha</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>¿Desea Eliminar La imagen de la fecha?</h3>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row ">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    {!!Form::open(['url'=>'admin/fecha/imagenborrar','method'=>'POST'])!!}
                                     {!!Form::Text('idfecha',$fecha->idfecha,['class'=>'hidden'])!!}
                                     {!!Form::submit('Borrar Imagen', array('class' => 'btn btn-success'))!!}
                                     {!! Form::close() !!}
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modalImagenEquipoEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Eliminando la imagen del Equipo Ideal</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>¿Desea Eliminar La imagen del Equipo Ideal?</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            {!!Form::open(['url'=>'admin/fecha/imagenequipoborrar','method'=>'POST'])!!}
                                             {!!Form::Text('idfecha',$fecha->idfecha,['class'=>'hidden'])!!}
                                             {!!Form::submit('Borrar Imagen', array('class' => 'btn btn-success'))!!}
                                             {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
        <div class="modal fade" id="modalImagenFiguraEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Eliminando la imagen de la Figura de la fecha</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>¿Desea Eliminar la imagen de la figura de la fecha</h3>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row ">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    {!!Form::open(['url'=>'admin/fecha/imagenfiguraborrar','method'=>'POST'])!!}
                                     {!!Form::Text('idfecha',$fecha->idfecha,['class'=>'hidden'])!!}
                                     {!!Form::submit('Borrar Imagen', array('class' => 'btn btn-success'))!!}
                                     {!! Form::close() !!}
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
        <script src="/js/dropzone.js" type="text/javascript"></script>
        <script>
                $(function () {
                    Dropzone.options.upload = {
                         paramName : 'file',
                         uploadMultiple : false,
                         maxFiles:1,
                         acceptedFiles: ".jpg, .gif, .png, .bmp, .jpeg"

                     };
                });
                </script>
        @endsection
