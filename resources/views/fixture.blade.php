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
                    <div class="border-titulo-medio"></div>
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
        <div id="contenidoFixture"></div>
    </div>
</div>
</section>

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
 });
 </script>

@endsection