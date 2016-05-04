<?php //var_dump($torneo); ?>
<section id="blanco" >
    <div class="row" id="">
        <div class="col-md-12">
            <div id="blanco">
                <div class="container">
                    <div class="row">
                        <div style="height:10px;"></div>
                            <div class="row">
                                <div style="height:10px;"></div>
                                <div class="col-md-1">
                                    <img class="img img-responsive" src="imagenes/iconosNoticias/trofeo.png">
                                </div>
                                <div class="col-md-11">
                                    <h2 style="color:rgb(15, 112, 75)">{{$torneo->nombre_torneo}}</h2>
                                </div>
                            </div>
                              <div style="height:10px;"></div>
                    <?php

                    if($torneo->tablas_x_torneo==1){   ?>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="">
                            <div  class="fechas-wrapper col-fechas">
                                <div class="table-responsive">
                                    <div class="border-titulo-medio" style="width: 100%;"></div>
                                    <table class="table ">
                                       <tr >
                                           <th>EQUIPO</th>
                                           <th>PTS</th>
                                           <th>J</th>
                                           <th>G</th>
                                           <th>E</th>
                                           <th>P</th>
                                           <th>GF</th>
                                           <th>GC</th>
                                           <th>DIF</th>
                                       </tr>

                                       @foreach($torneo->TablaPosiciones() as $tabla)

                                           <tr >
                                               <td>{{$tabla->nombre_equipo}}</td>
                                               <td>{{$tabla->pun}}</td>
                                               <td>{{$tabla->pj}}</td>
                                               <td>{{$tabla->gan}}</td>
                                               <td>{{$tabla->emp}}</td>
                                               <td>{{$tabla->per}}</td>
                                               <td>{{$tabla->gf}}</td>
                                               <td>{{$tabla->gc}}</td>
                                               <td>{{$tabla->df}}</td>
                                           </tr>
                                       @endforeach
                                    </table>
                                </div>
                            </div>
                         </div>
                      <?php
                      }
                      else{ // es por zonas
                          foreach ($torneo->ListZonas as $zona) {    ?>
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="">
                                  <div  class="fechas-wrapper col-fechas">
                                      <div class="table-responsive">
                                          <div class="border-titulo-medio" style="width: 100%;"></div>
                                          <table class=" table ">
                                             <tr >
                                                 <th style="color:#FBC01C">{{ $zona->nombre }}</th>
                                                 <th>PTS</th>
                                                 <th>J</th>
                                                 <th>G</th>
                                                 <th>E</th>
                                                 <th>P</th>
                                                 <th>GF</th>
                                                 <th>GC</th>
                                                 <th>DIF</th>
                                             </tr>

                                             @foreach($zona->TablaPosiciones() as $tabla)
                                                 <tr >
                                                     <td>{{$tabla->nombre_equipo}}</td>
                                                     <td>{{$tabla->pun}}</td>
                                                     <td>{{$tabla->pj}}</td>
                                                     <td>{{$tabla->gan}}</td>
                                                     <td>{{$tabla->emp}}</td>
                                                     <td>{{$tabla->per}}</td>
                                                     <td>{{$tabla->gf}}</td>
                                                     <td>{{$tabla->gc}}</td>
                                                     <td>{{$tabla->df}}</td>
                                                 </tr>
                                             @endforeach
                                          </table>
                                      </div>
                                  </div>
                               </div>
                            <?php   }   ?>
                        <?php   } ?>
                    <!-- Fin tabla posiciones -->
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

<br><br>
<!-- Estadísticas -->
<section id="verde" >
    <div class="row" id="">
        <div class="col-md-12">
            <div id="verde">
                <div class="container">
                    <div class="row">
                        <?php
                        if($torneo->estadisticas_x_torneo==1){ ?>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="">

                                <div class="row">
                                   <div style="height:10px;"></div>
                                  <div class="col-md-2">
                                        <img class="img img-responsive" src="imagenes/iconosNoticias/pelota.png">
                                  </div>
                                  <div class="col-md-10">
                                      <h3 style="color:#ffffff">GOLEADORES <!--{{$torneo->nombre_torneo}} --></h3>
                                  </div>

                                </div>
                                <div style="height:10px;"></div>
                                <div class="row">
                                  <div class="fechas-wrapper col-fechas">
                                      <div class="border-titulo-medio" style="width: 98%;"></div>
                                      <div class="table-responsive">
                                           <table class=" table goleadores">
                                             <tr>
                                                 <th>GOLEADOR</th>
                                                 <th>EQUIPO</th>
                                                 <th>GOLES</th>
                                             </tr>

                                             @foreach($torneo->Goleadores() as $goleador)
                                                 <tr >
                                                     <td >{{$goleador->nombre_jugador}}</td>
                                                     <td>{{$goleador->nombre_equipo}}</td>
                                                     <td >{{$goleador->goles}}</td>
                                                 </tr>
                                             @endforeach
                                         </table>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="">

                                <div class="row">
                                   <div style="height:10px;"></div>
                                  <div class="col-md-2">
                                        <img class="img img-responsive" src="imagenes/iconosNoticias/sanciones.png">
                                  </div>
                                  <div class="col-md-10">
                                      <h3 style="color:#ffffff">SANCIONADOS <!-- {{$torneo->nombre_torneo}} --></h3>
                                  </div>

                                </div>
                                <div style="height:10px;"></div>
                                <div class="row">
                                  <div class="fechas-wrapper col-fechas">
                                      <div class="border-titulo-medio" style="width: 98%;"></div>
                                      <div class="table-responsive">
                                           <table class=" table goleadores">
                                                 <tr>
                                                     <th>SANCIONADO</th>
                                                     <th>EQUIPO</th>
                                                     <th>FECHAS</th>
                                                 </tr>

                                                 <?php ?>
                                                 @foreach($torneo->Sancionados() as $goleador)
                                                     <tr>
                                                         <td>{{$goleador->jugador}}</td>
                                                         <td>{{$goleador->nombre_equipo}}</td>
                                                         <td>{{$goleador->fechas_restantes}}</td>
                                                     </tr>
                                                 @endforeach
                                           </table>
                                      </div>
                                  </div>
                                  <div style="float:right;" >F-> Fechas a Cumplir</div>

                                </div>


                            </div>

                         <?php
                        }
                        else{ // estadisticas por zonas      ?>

                        <!-- GOLEADORES POR ZONAS -->
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">

                                <div class="row">
                                   <div style="height:10px;"></div>
                                  <div class="col-md-2">
                                        <img class="img img-responsive" src="imagenes/iconosNoticias/pelota.png">
                                  </div>
                                  <div class="col-md-10">
                                      <h3 style="color:#ffffff">GOLEADORES <!--{{$torneo->nombre_torneo}} --></h3>
                                  </div>

                                </div>




                              <?php
                              foreach ($torneo->listZonas as $zona) { ?>

                                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="">
                                      <div class="fechas-wrapper col-fechas">
                                          <div style="height:30px;"><h4>{{$zona->nombre}}</h4></div>
                                          <div class="border-titulo-medio" style="width: 100%;"></div>
                                          <div class="table-responsive">

                                               <table class=" table goleadores ">

                                                 <tr>
                                                     <th>GOLEADOR</th>
                                                     <th>EQUIPO</th>
                                                     <th>GOLES</th>
                                                 </tr>

                                                  @foreach($zona->Goleadores() as $goleador)
                                                     <tr>
                                                         <td>{{$goleador->nombre_jugador}}</td>
                                                         <td>{{$goleador->nombre_equipo}}</td>
                                                         <td >{{$goleador->goles}}</td>
                                                     </tr>
                                                  @endforeach
                                             </table>
                                          </div>
                                      </div>
                                  </div>

                                <?php

                                }

                                ?>


                            </div>

                            <?php
                            } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


 


<style type="text/css">
  #contenidoEstadistica {
      color: #000 !important;


  }

  table th{
    color:rgb(15, 112, 75);
    border: 0;
  }
    .table.goleadores th{color:white;}
   .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    
    border: 0;
  }
</style>