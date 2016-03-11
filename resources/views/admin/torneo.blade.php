        @extends('admin.masterAdmin')

        @section('title')
        <h1>Torneo: {{$torneo->nombre_torneo}} - {{$torneo->TipoTorneo->nombre_tipo_torneo}}<small > </small></h1>
         <span class="label label-info">{{$torneo->MensajeConfiguracion()}}</span>
        @endsection

        @section('breadcrumb')
        <li><a href="/admin/home"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/admin/torneos"><i class="fa fa-trophy"></i> Torneos</a></li>
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
                    <div class=" panel-heading"><strong>Zonas</strong> <a href="" id="btnNuevaZona" title="Agregar una Nueva Zona. Es Obligatorio agregar al menos una zona" class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalZonaAgregar"><i class=" fa fa-plus"></i></a>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                    <i class="fa fa-question-circle"></i><b class="caret"></b>
                                </button>
                                <ul class="multiselect-container dropdown-menu pull-right">
                                    <li>Desde Aqui Puede Agregar o Eliminar las zonas a un torneo</li>
                                    <li>Las Propiedades Tablas Por Torneo y Estadisticas por torneo, indican si estas se calculan por torneo o por zonas</li>
                                    <li>La propiedad Orden  en la zona indica el orden a mostrarse. El numero mas chico se muestra primero. Por Favor indicar,
                                    solo numeros correlativos. Por el momento el sistema no valida si la posicion (orden) existe</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" panel-body">
                        <div class="table-responsive">
                            <table id="editar"  class=" table table-bordered table-condensed table-hover">
                                <tr>
                                    <th>Zona</th>
                                    <th>Orden a Mostrar</th>
                                </tr>
                                @foreach($torneo->ListZonas as $z)
                                    <tr >
                                        <td>{{$z->nombre}}</td>
                                        <td>{{$z->orden}}</td>
                                        <td><a href="../zonas/{{$z->idzona}}"  class="btn btn-xs btn-primary" title="Configurar Zona"><i class="fa fa-cog"></i></a></td>
                                        <td><a href="" class="btn btn-xs btn-danger eliminar" data-idzona="{{$z->idzona}}" title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            @if($torneo->tablas_x_torneo==1)
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
                               @foreach($torneo->TablaPosiciones() as $tabla)
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
            @endif
            </div>
            @if($torneo->estadisticas_x_torneo==1)
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
                                @foreach($torneo->Goleadores() as $goleador)
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
                                @foreach($torneo->Tarjetas() as $goleador)
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
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            Imagen del Torneo
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                        <i class="fa fa-question-circle"></i><b class="caret"></b>
                                    </button>
                                    <ul class="multiselect-container dropdown-menu pull-right">
                                        <li>Imagen q se vera en la seccion fixture o estadisticas. Deberia usarse en el momento de existir los play off</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                        @if($torneo->imagen!=null)
                            <div class="col-md-12">
                                <a class="thumbnail" ><img src="/imagenes/{{$torneo->imagen}}" ></a>
                            </div>
                            <div class="col-md-12">
                                  <a href="#" data-toggle="modal" data-target="#modalFotoEliminar" class="btn btn-danger"><i class="fa fa-close"></i>Borrar Imagen</a>
                            </div>
                        @else
                            <div class="col-md-12">
                                <form method="POST" action="torneoimagenguardar" class="dropzone" id="upload" enctype="multipart/form-data">
                                <input type="hidden" value="{{ $torneo->idtorneo }}" name="idtorneo">
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


<div class="modal fade" id="modalFotoEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Eliminando la Imagen Del Torneo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>¿Desea Eliminar La Imagen del  Torneo?</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row ">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            {!!Form::open(['url'=>'admin/torneos/torneoimagenborrar','method'=>'POST'])!!}
                             {!!Form::Text('idtorneo',$torneo->idtorneo,['class'=>'hidden'])!!}
                             {!!Form::submit('Borrar imagen', array('class' => 'btn btn-success'))!!}
                             {!! Form::close() !!}
                        </div>
                    </div>
                </div>

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
<div class="modal fade" id="proximamenteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Proximamente</h4>
                </div>
                <div class="modal-body">
                    Aqui se imprimirá la planilla por fecha
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


<div class="modal fade" id="modalZonaAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                   {!!Form::open(['route'=>['admin.zonas.store'],'method'=>'POST'])!!}
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title" id="myModalLabel">Agregando Zona</h4>
                      </div>
                      <div class="modal-body"><div class=" panel panel-info">
                      <div class=" panel-heading">Zona</div>
                         <div class=" panel-body">
                          <div clas="row">
                              <div class="col-md-12">
                                  {!!Form::Text('idtorneo',$torneo->idtorneo,['class'=>'hidden'])!!}
                                  Nombre
                                  {!!Form::Text('nombre',"",['class'=>'form-control'])!!}
                                  Orden a Mostrar
                                  {!!Form::Text('orden',"",['class'=>'form-control'])!!}
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




@endsection
@section('script')
<script src="/js/dropzone.js" type="text/javascript"></script>
<script>
$(function () {
        $('.datepicker').datepicker({
         format: 'mm/dd/yyyy',
         startDate: '-3d'
     });
});

</script>
@endsection
