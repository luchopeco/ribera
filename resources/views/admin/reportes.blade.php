@extends('admin.masterAdmin')

@section('title')
    <h1> Reportes Varios <small ></small></h1>
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
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-file-excel-o" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Listado De Jugadores</span>
                <span class="info-box-number"><a href="/admin/reportes/listadojugadores" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</a></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
@endsection
@section('script')
    <script>

    </script>
@endsection
