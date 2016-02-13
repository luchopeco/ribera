
 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div  class="fechas-wrapper col-fechas">
        <div class="table-responsive">
            <table class=" table table-hover">
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
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
    <div class="fechas-wrapper col-fechas">
        <div class="table-responsive">
             <table class=" table table-hover">
               <tr>
                   <th>Goleador</th>
                   <th>Equipo</th>
                   <th>G</th>
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
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
    <div class="fechas-wrapper col-fechas">
        <div class="table-responsive">
             <table class=" table table-hover">
                   <tr>
                       <th>Sancionado</th>
                       <th>Equipo</th>
                       <th>F</th>
                   </tr>
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
     <div>F-> Fechas a Cumplir</div>
</div>


