        @extends('admin.masterAdmin')

        @section('title')
        <h1> Gestion De Noticias <small ></small></h1>
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
                    <div class=" panel-heading">Noticias <a href="" id="btnNuevoNoticia" title="Nuevo noticia" class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalNoticiaAgregar"><i class=" fa fa-plus"></i></a>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                    <i class="fa fa-question-circle"></i><b class="caret"></b>
                                </button>
                                <ul class="multiselect-container dropdown-menu pull-right">
                                    <li>Desde Aqui Puede Agregar (Click en "+"), editar o eliminar una noticia</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" panel-body">
                        <div class="table-responsive">
                            <table id="editar"  class=" table table-bordered table-condensed table-hover ">
                                <tr>
                                    <th>Titulo</th>
                                    <th>Fecha</th>
                                    <th>Contenido</th>
                                    <th>Imagen</th>
                                    <th>Mostrar en Home</th>
                                    <th>Mostrar en sección</th>
                                    <th>Link</th>
                                </tr>
                                @foreach($listNoticias as $noticia)
                                    <tr >
                                        <td>{{$noticia->titulo}}</td>
                                        <td>{{$noticia->fecha}}</td>
                                        <td>{{Illuminate\Support\Str::limit($noticia->texto,30, '...')}}</td>
                                        <td>{{$noticia->imagen}}</td>
                                        <td>{{$noticia->mostrar_en_home}}</td>
                                        <td>{{$noticia->mostrar_en_seccion}}</td>
                                        <td>{{$noticia->link}}</td>
                                        <td><a href="#"  class="btn btn-xs btn-info editar" data-idnoticia="{{$noticia->idnoticia}}"  title="Editar"> <i class=" fa fa-edit"></i></a></td>
                                       <td><a href="noticiaimagen/{{$noticia->idnoticia}}" title="Editar Imagen " class=" btn-xs btn btn-success" ><i class=" fa fa-image"></i></a></td>
                                        <td><a href="" class="btn btn-xs btn-danger eliminar" data-idnoticia="{{$noticia->idnoticia}}"  title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
               </div>
            </div>
        </div>

        <div class="modal fade" id="modalNoticiaAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                    <div class="modal-content">
                          {!!Form::open(['route'=>'admin.noticias.store','method'=>'POST'])!!}
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myModalLabel">Agregando noticia</h4>
                              </div>
                              <div class="modal-body"><div class=" panel panel-info">
                              <div class=" panel-heading">Noticia</div>
                                 <div class=" panel-body">
                                  <div clas="row">
                                      <div class="col-md-12">
                                              {!!Form::label('titulo','Titulo')!!}
                                              {!!Form::Text('titulo',null,['class'=>' form-control'])!!}
                                      </div>
                                   </div>
                                   <div clas="row">
                                      <div class="col-md-12">
                                              {!!Form::label('fecha','Fecha')!!}
                                              {!!Form::Text('fecha',null,['class'=>' form-control'])!!}
                                      </div>
                                   </div>
                                   <div clas="row">
                                     <div class="col-md-12">
                                             {!!Form::label('link','Link')!!}
                                             {!!Form::Text('link',null,['class'=>' form-control'])!!}
                                     </div>
                                  </div>
                                   <div clas="row">
                                      <div class="col-md-12">
                                              {!!Form::label('texto','Contenido')!!}
                                              <!-- {!!Form::Text('texto',null,['class'=>' form-control'])!!} -->

                                              <textarea id="texto" name="texto" class="form-control" rows="3"></textarea>

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
        <div class="modal fade" id="modalNoticiaModificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      {!!Form::open(['route'=>'admin.noticias.update','method'=>'PUT'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Modificando noticia</h4>
                        </div>
                        <div class="modal-body">
                                <div class=" panel panel-default">
                                <div class=" panel-heading">Noticia</div>
                                     <div class=" panel-body">
                                         <div class="row">
                                              <div class="col-md-12">
                                                    {!!Form::Text('idnoticia',null,['class'=>' hidden form-control','id'=>'idnoticiaU'])!!}
                                                    {!!Form::label('titulo','Titulo')!!}
                                                    {!!Form::Text('titulo',null,['class'=>' form-control','id'=>'tituloU'])!!}
                                              </div>
                                         </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                                {!!Form::label('fecha','Fecha')!!}
                                                {!!Form::Text('fecha',null,['class'=>' form-control','id'=>'fechaU'])!!}
                                        </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-md-12">
                                                 {!!Form::label('link','Link')!!}
                                                 {!!Form::Text('link',null,['class'=>' form-control','id'=>'linkU'])!!}
                                         </div>
                                      </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                                {!!Form::label('texto','Contenido')!!}
                                                <textarea id="textoU" name="texto" class="form-control" rows="3"></textarea>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                         Mostrar en home
                                         <div>{!!Form::checkbox('mostrar_en_home','0',false,['class'=>'','id'=>'mostrar_en_homeU'])!!}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                         Mostrar en Seccion
                                         <div>{!!Form::checkbox('mostrar_en_seccion','0',false,['class'=>'','id'=>'mostrar_en_seccionU'])!!}</div>
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
        <div class="modal fade" id="modalNoticiaEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              {!!Form::open(['route'=>['admin.noticias.destroy'],'method'=>'DELETE'])!!}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Eliminando noticia</h4>
                                </div>
                                <div class="modal-body">
                                       <div class="row">
                                            <div class="col-md-12">
                                                {!!Form::Text('idnoticia',null,['class'=>'hidden','id'=>'idnoticiaD'])!!}
                                                <h3>¿Desea Eliminar el noticia?</h3>
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

        @endsection
        @section('script')
        <script>
        $(function () {
            $('body').on('click', '.editar', function (event) {
                event.preventDefault();
                var id_articulo=$(this).attr('data-idnoticia');
                $.ajax({
                     url:"noticias/buscar",
                     type: "POST",
                     dataType: "json",
                    data:{'idnoticia': id_articulo}
                    })
                .done(function(response){
                        //alert(response.datos.titulo);
                        $('#tituloU').val(response.datos.titulo);
                        $('#fechaU').val(response.datos.fecha);
                        $('#textoU').val(response.datos.texto);
                        $('#linkU').val(response.datos.link);
                        $('#idnoticiaU').val(response.datos.idnoticia);
                        if(response.datos.mostrar_en_home==1){
                        $('#mostrar_en_homeU').prop('checked',true);
                        }
                        else{
                        $('#mostrar_en_homeU').prop('checked',false);
                        }
                        if(response.datos.mostrar_en_seccion==1){
                        $('#mostrar_en_seccionU').prop('checked',true);
                        }
                        else{
                        $('#mostrar_en_seccionU').prop('checked',false);
                        }
                        $("#modalNoticiaModificar").modal("show");
                    })
                    .fail(function(){
                        alert(id_articulo);
                    });
            });
            $('body').on('click', '.eliminar', function (event) {
                event.preventDefault();
                var id_noticia=$(this).attr('data-idnoticia');
                $("#idnoticiaD").val(id_noticia);
                $("#modalNoticiaEliminar").modal("show");
            });

        });

        </script>
        @endsection
