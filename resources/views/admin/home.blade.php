        @extends('admin.masterAdmin')

        @section('title')
        <h1> Bienvenidos al Sistema de Gestion de Torneos <small ><a href="http://www.ligalaribera.com.ar/" target="_blank">www.ligalaribera.com.ar</a></small></h1>
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
            <br>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-trophy"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Torneos Activos</span>
                      <span class="info-box-number">{{$listTorneos->count()}}</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-futbol-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Equipos sin Inscripcion</span>
                  <span class="info-box-number">{{count($listEquipos)}}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header">
                        <div class="box-title">Torneos Activos</div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                             @foreach($listTorneos as $torneo)
                             <div class="col-sm-4">
                                 <div class="panel panel-default">
                                    <div class="panel-heading">
                                        {{$torneo->nombre_torneo}} - {{$torneo->TipoTorneo->nombre_tipo_torneo}}
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="editar"  class=" table table-bordered table-condensed table-hover table-responsive">
                                                <tr>
                                                    <th>{{$torneo->ListEquipos->count()}} -  Equipos</th>
                                                </tr>
                                                @foreach($torneo->ListEquipos as $equipo)
                                                <tr >
                                                    <td>{{$equipo->nombre_equipo}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                 </div>
                             </div>
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <div class="box-title">Equipos Sin Inscripción</div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                             <div class="col-sm-12">
                                 <div class="panel panel-default">
                                    <div class="panel-heading">
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table  class=" table table-bordered table-condensed table-hover table-responsive">
                                                <tr>
                                                    <th>{{count($listEquipos)}} -  Equipo</th>
                                                </tr>
                                                @foreach($listEquipos as $equipo)
                                                <tr >
                                                    <td>{{$equipo->nombre_equipo}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection
        @section('script')
        <script>

        </script>
        @endsection
