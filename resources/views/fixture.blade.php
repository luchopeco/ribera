@extends('app')
@section('meta')
<meta property="og:url" content="http://www.ligatifosi.com/fixture" />
<meta property="og:title" content="Fixture de la Liga" />
<meta property="og:description" content="Visite el fixture de la liga" />
<meta property="og:image" content="http://www.ligatifosi.com/imagenes/fb/fb-fixture1.JPG" />
<meta property="og:type" content="website" />
@endsection
@section('title')
..::Tifosi::..
@endsection
@section('content')
<div id="fixture" class="margin-top">
<section id="services">
    <div class="container">
        <div class="row text-center header">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                <h3>Fixture</h3>
                <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 scroll-me">
                    <a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://www.ligatifosi.com/fixture" class=" btn button-custom btn-custom-two"><i class="fa fa-facebook"></i> Compartir</a>
                </div>
            </div>
        </div>
        <div class="row animate-in" data-anim-type="fade-in-up">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="fechas-wrapper  text-center">
                        <div class="row">
                            <div class=" col-sm-2 col-xs-12">
                            <div id="imagentorneo"></div>

                            </div>
                            <div class="col-sm-4 col-xs-12 text-center">
                                <h3 class="text-center">ELEGIR TORNEO</h3>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                               {!!Form::select('idtipo_torneo', $listTiposTorneosCombo,null,array('class' => 'form-control','onchange'=>'buscarTorneoXTipoTorneo()','id'=>'idtipo_torneo'))!!}
                            </div>
                        </div>
                    </div>
              </div>

             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="fechas-wrapper  text-center">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <h3 class="text-cener">ELEGIR CATEGORIA</h3>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                        <div id="combotorneo"></div>

                        </div>
                    </div>
                </div>
             </div>
        </div>
        <div class="row animate-in" data-anim-type="fade-in-up">
             <div id="contenidoFixture">

             </div>
        </div>
    </div>
</section>
</div>
<div id="modalMensaje"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h3 class="text-danger">No se ha encontrado una Categoria </h3>
            </div>
            <div class=" modal-body ">
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
function buscarTorneoXTipoTorneo()
 {
  //Añadimos la imagen de carga en el contenedor
  $('#cargando').html('<button class="btn btn-default btn-lg"><i class="fa fa-spinner fa-spin"></i>Cargando....</button>');

    var id_articulo=$("#idtipo_torneo").val();
    $.ajax({
         url:"/torneoportipotorneofixture/"+id_articulo,
         type: "GET",
         dataType: "HTML"
        })
    .done(function(response){
           $("#combotorneo").html(response);
           if(id_articulo==1)
           {
                $("#imagentorneo").html("<img class='img-responsive center-block' src='/imagenes/home/escudotifosi.png'>");
           }
           else if(id_articulo==2)
           {
               $("#imagentorneo").html("<img class='img-responsive center-block' style='padding-top: 5px' src='/imagenes/home/ragazza02.png'>");
           }
           buscarFixtureXTorneo();
           $('#cargando').html('');
        })
        .fail(function(){
            $('#cargando').html('');
            alert(id_articulo);
        });

 }
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
   buscarTorneoXTipoTorneo();
 });
 </script>
@endsection