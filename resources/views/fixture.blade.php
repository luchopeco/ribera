@extends('app')
@section('meta')
<meta property="og:url" content="http://www.ligalaribera.com.ar" />
<meta property="og:title" content="Liga La Ribera" />
<meta property="og:description" content="" />
<meta property="og:image" content="http://www.ligalaribera.com.ar/img/logo.png" />
<meta property="og:type" content="website" />
@endsection
@section('title')
Fixture
@endsection

@section('content')

<section id="section-page">
<div class="row">
    <div class="col-md-12">

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="border-titulo-noticia"></div>
                    <h2>FIXTURE</h2>
                    <br>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    {!!Form::select('idtorneo', $listTorneosCombo,null,array('class' => 'form-control','onchange'=>'buscarFixtureXTorneo()','id'=>'idtorneo'))!!}
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
</section>

<div id="contenidoFixture">

</div>

<div class="modal fade" id="modalDetallePartido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Detalle Partido</h4>
            </div>
            <div class="modal-body">
                <div id="detallePartido">

                </div>
            </div>
            <div class="modal-footer">
                <div class="row ">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>


@endsection

@section('script')
<script>
function buscarFixtureXTorneo()
 {
    $('#cargando').html('<button class="btn btn-default btn-lg"><i class="fa fa-spinner fa-spin"></i>Cargando....</button>');
    var id_articulo=$("#idtorneo").val();
    $.ajax({
         url:"/fixturetorneo/"+id_articulo,
         type: "GET",
         dataType: "HTML"
        })
    .done(function(response){
            $('#cargando').html('');
            $("#contenidoFixture").html(response);
        })
        .fail(function(){
            $('#cargando').html('');
            //alert(id_articulo);
            $("#contenidoFixture").html('');
            $("#modalMensaje").modal("show");
        });
 }
 $(function() {
    buscarFixtureXTorneo();
    $('body').on('click', '.btn-partido', function (event) {
        event.preventDefault();
        var id_partido=$(this).attr('data-idpartido');
        //alert( id_partido);
        $.ajax({
         url:"/detallepartido/"+id_partido,
         type: "GET",
         dataType: "HTML"
        })
    .done(function(response){
            $('#cargando').html('');
            $("#detallePartido").html(response);
            $("#modalDetallePartido").modal("show");
        })
        .fail(function(){
            $('#cargando').html('');
            //alert(id_articulo);           
            $("#modalMensaje").modal("show");
        });
  
    });
 });
 </script>

@endsection