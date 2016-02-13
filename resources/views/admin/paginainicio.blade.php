        @extends('admin.masterAdmin')

        @section('title')
        <h1> Gestion Imagenes<small ></small></h1>
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
                    <div class=" panel-heading">Imagenes <a href="" id="btnNuevoSlider" title="Nuevo Slider" class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalSliderAgregar"><i class=" fa fa-plus"></i></a>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                    <i class="fa fa-question-circle"></i><b class="caret"></b>
                                </button>
                                <ul class="multiselect-container dropdown-menu pull-right">
                                    <li>Desde aqui puede gestionar las imagenes del Slider de la Home, de los datos de la ultima fecha, y del equipo ideal</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" panel-body">
                        <div class="table-responsive">
                            <table id="editar"  class=" table table-bordered table-condensed table-hover">
                                <tr>
                                    <th>Titulo</th>
                                    <th>Tipo Imagen</th>
                                    <th>Activo</th>
                                    <th>Imagen</th>
                                </tr>
                                @foreach($listSlider as $slider)
                                    <tr >
                                        <td>{{$slider->titulo}}</td>
                                        <td>{{$slider->TipoImagen->descripcion}}</td>
                                        <td>{{$slider->Activo()}}</td>
                                        <td>{{$slider->imagen}}</td>
                                        <td><a href="#"  class="btn btn-xs btn-info editar" data-idslider="{{$slider->idimagen}}"  title="Editar Datos Slider"> <i class=" fa fa-edit"></i></a></td>
                                        <td><a href="imagenes/{{$slider->idimagen}}" title="Editar Imagen Slider" class=" btn-xs btn btn-success" ><i class=" fa fa-image"></i></a></td>
                                        <td><a href="" class="btn btn-xs btn-danger eliminar" data-idslider="{{$slider->idimagen}}"  title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
               </div>
            </div>
        </div>


        <div class="modal fade" id="modalSliderAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                    <div class="modal-content">
                          {!!Form::open(['route'=>'admin.imagenes.store','method'=>'POST', 'data-toggle='>'validator'])!!}
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myModalLabel">Agregando Imagen</h4>
                              </div>
                              <div class="modal-body"><div class=" panel panel-info">
                              <div class=" panel-heading">Imagen</div>
                                 <div class=" panel-body">
                                  <div clas="row">
                                      <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                Primero seleccione el tipo de imagen y agregue un titulo.
                                                Una vez agregado, podra Agregar la imagen.
                                            </div>
                                            <div class="form-group">
                                                {!!Form::label('nombre','Titulo')!!}
                                                {!!Form::Text('titulo',null,['class'=>' form-control','required'])!!}
                                                 Tipo Imagen
                                                 {!!Form::select('idtipo_imagen', $listTipoImagen,null,array('class' => 'form-control'))!!}
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
        <div class="modal fade" id="modalSliderModificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      {!!Form::open(['route'=>'admin.imagenes.update','method'=>'PUT', 'data-toggle='>'validator'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Modificando Imagen</h4>
                        </div>
                        <div class="modal-body">
                                <div class=" panel panel-default">
                                <div class=" panel-heading">Imagen</div>
                                     <div class=" panel-body">
                                         <div class="row">
                                              <div class="col-md-12">
                                                    <div class="form-group">
                                                         {!!Form::Text('idimagen',null,['class'=>' hidden form-control','id'=>'idimagenU'])!!}
                                                         {!!Form::label('nombre','Titulo')!!}
                                                         {!!Form::Text('titulo',null,['class'=>' form-control','id'=>'tituloU','required'])!!}
                                                         Tipo Imagen
                                                            {!!Form::select('idtipo_imagen', $listTipoImagen,null,array('class' => 'form-control','id'=>'idtipo_imagenU'))!!}
                                                         Activado
                                                         {!!Form::checkbox('mostrar','0',false,['class'=>' form-control','id'=>'mostrarU'])!!}
                                                         <span class="help-block with-errors"></span>
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
        <div class="modal fade" id="modalSliderEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              {!!Form::open(['route'=>['admin.imagenes.destroy'],'method'=>'DELETE'])!!}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Eliminando Slider</h4>
                                </div>
                                <div class="modal-body">
                                       <div class="row">
                                            <div class="col-md-12">
                                                {!!Form::Text('idimagen',null,['class'=>'hidden','id'=>'idimagenD'])!!}
                                                <h3>¿Desea Eliminar el slider?</h3>
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
                var id_articulo=$(this).attr('data-idslider');
                $.ajax({
                     url:"imagenes/buscar",
                     type: "POST",
                     dataType: "json",
                    data:{'idimagen': id_articulo}
                    })
                .done(function(response){
                        //alert(response.datos.titulo);
                        $('#tituloU').val(response.datos.titulo);
                        $('#idimagenU').val(response.datos.idimagen);
                        $('#idtipo_imagenU').val(response.datos.idtipo_imagen);
                        if(response.datos.mostrar==1){
                        $('#mostrarU').prop('checked',true);
                        }
                        else{
                        $('#mostrarU').prop('checked',false);
                        }
                        $("#modalSliderModificar").modal("show");
                    })
                    .fail(function(){
                        alert(id_articulo);
                    });
            });
            $('body').on('click', '.eliminar', function (event) {
                event.preventDefault();
                var id_arbitro=$(this).attr('data-idslider');
                $("#idimagenD").val(id_arbitro);
                $("#modalSliderEliminar").modal("show");
            });

        });

        </script>
        @endsection
