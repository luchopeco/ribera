@extends('app')
@section('meta')
<meta property="og:url" content="http://www.ligalaribera.com.ar" />
<meta property="og:title" content="Liga La Ribera" />
<meta property="og:description" content="" />
<meta property="og:image" content="http://www.ligalaribera.com.ar/..." />
<meta property="og:image" content="http://www.ligalaribera.com.ar/imagenes/home/escudotifosi.jpg" />
<meta property="og:image" content="http://www.ligalaribera.com.ar/imagenes/" />
<meta property="og:type" content="website" />
@endsection
@section('title')
..::Estadísticas::..
@endsection
@section('content')

<!--
<section id="section-page">
<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-titulo-medio"></div>
                    <h2>NOTICIAS</h2>
                    <br>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
</section>
-->


<!--Estadísticas SECTION START-->
<section id="section-page" >

       <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border-titulo-medio"></div>
                            <h2 >ESTADÍSTICAS</h2>
                            <br>
                        </div>
                        <div class="col-md-6">
                             {!!Form::select('idtorneo', $listTorneos,null,array('class' => 'form-control','onchange'=>'buscarEstadisticaXTorneo()','id'=>'idtorneo'))!!}   
                        </div>

                        <br>
                    </div>
                </div>
            </div>
        </div>
</section>

<div id="contenidoEstadisticas"></div>


@endsection
@section('script')
<script type="text/javascript">
function buscarEstadisticaXTorneo()
 {
    $('#cargando').html('<button class="btn btn-default btn-lg"><i class="fa fa-spinner fa-spin"></i>Cargando....</button>');
    var id_articulo=$("#idtorneo").val();
    $.ajax({
         url:"/estadisticastorneo/"+id_articulo,
         type: "GET",
         dataType: "HTML"
        })
    .done(function(response){
            $('#cargando').html('');
           $("#contenidoEstadisticas").html(response);
        })
        .fail(function(){
            $('#cargando').html('');
           // alert(id_articulo);
             $("#contenidoEstadisticas").html('');
              $("#modalMensaje").modal("show");
        });
 }
 $(function() {
    buscarEstadisticaXTorneo();

 });
 </script>
@endsection

