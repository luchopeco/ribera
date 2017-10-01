@extends('admin.masterAdmin')

@section('title')
    <h1> Gestion De Arbitros <small ></small></h1>
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
        <div class=" col-md-12">
            <div class=" panel panel-default">
                <div class=" panel-heading">Arbitros <a href="" id="btnNuevoArbitro" title="Nuevo Arbitro" class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalArbitroAgregar"><i class=" fa fa-plus"></i></a>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                <i class="fa fa-question-circle"></i><b class="caret"></b>
                            </button>
                            <ul class="multiselect-container dropdown-menu pull-right">
                                <li>Desde Aqui Puede Agregar (Click en "+"), editar o eliminar un arbitro</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" panel-body">
                    <div class="table-responsive">
                        <table id="editar"  class=" table table-bordered table-condensed table-hover table-responsive">
                            <tr>
                                <th>Nombre</th>
                            </tr>
                            @foreach($listArbitros as $arbitro)
                                <tr >
                                    <td>{{$arbitro->nombre}}</td>
                                    <td><a href="#"  class="btn btn-xs btn-info editar" data-idarbitro="{{$arbitro->idarbitro}}"  title="Editar"> <i class=" fa fa-edit"></i></a></td>
                                    <td><a href="" class="btn btn-xs btn-danger eliminar" data-idarbitro="{{$arbitro->idarbitro}}"  title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {
            $('body').on('click', '.editar', function (event) {
                event.preventDefault();
                var id_articulo=$(this).attr('data-idarbitro');
                $.ajax({
                    url:"arbitros/buscar",
                    type: "POST",
                    dataType: "json",
                    data:{'idarbitro': id_articulo}
                })
                        .done(function(response){
                            //alert(response.datos.titulo);
                            $('#nombreU').val(response.datos.nombre);
                            $('#idarbitroU').val(response.datos.idarbitro);
                            $("#modalArbitroModificar").modal("show");
                        })
                        .fail(function(){
                            alert(id_articulo);
                        });
            });
            $('body').on('click', '.eliminar', function (event) {
                event.preventDefault();
                var id_arbitro=$(this).attr('data-idarbitro');
                $("#idarbitroD").val(id_arbitro);
                $("#modalArbitroEliminar").modal("show");
            });

        });

    </script>
@endsection
