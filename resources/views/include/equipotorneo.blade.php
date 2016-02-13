
<div class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-6 col-md-offset-0">

    @if($torneo->deleted_at!='')
    <div class="equipos-wrapper text-center">
        <h1 class="text-danger">TORNEO FINALIZADO</h1>
    </div>
    @endif

    <div class="equipos-wrapper">
          <div class="table-responsive">
                <table class=" table table-hover">
                       <tr>
                           <th>JUGADOR</th>
                           <th class="text-center">GOLES</th>
                           <th class="text-center">TA</th>
                           <th class="text-center">TAZ</th>
                           <th class="text-center">TR</th>
                           <th class="text-center">SANCION</th>
                       </tr>
                       @foreach($equipo->ListJugadores as $j)
                           <tr >
                               <td>{{$j->nombre_jugador}}</td>
                               <td class="text-center">{{$j->goles($torneo->idtorneo)}}</td>
                               <td class="text-center">{{$j->tarjetasAmarillas($torneo->idtorneo)}}</td>
                               <td class="text-center">{{$j->tarjetasAzules($torneo->idtorneo)}}</td>
                               <td class="text-center">{{$j->tarjetasRojas($torneo->idtorneo)}}</td>
                               <td class="text-center">{{$j->fechasSancion($torneo->idtorneo)}}</td>
                           </tr>
                       @endforeach
                </table>
          </div>
    </div>

        <div class="row">
            @if($equipo->autogestion==1)
                <div class="col-md-6">
                    <a href="#" data-toggle="modal" data-target="#modalJugador" class=" btn btn-danger btn-block">AGREGAR JUGADORES</a>
                </div>
                <div class="col-md-6">

                </div>
                <br/>
            @endif
        </div>

        <?php $uf=null;
              $pf=null;
              $time = date("Y-m-d ", time());
        ?>
        @foreach($torneo->ListFechas as $fecha)
            @if($fecha->fecha < $time )
            <?php $uf = $fecha; ?>
            @endif
            @if($fecha->fecha >  $time)
                @if($pf==null)
                    <?php $pf = $fecha; ?>
                @endif
            @endif
        @endforeach
        <div class="row">
            <br>
            <div class="col-sm-6 col-xs-12">
                  <div class="equipos-wrapper">
                    <div class="text-center"> <h5>ÚLTIMA FECHA</h5> </div>
                    <div class="resultado">
                        @if($uf!=null)
                            @foreach($uf->ListPartidos as $partido)
                                @if($partido->EquipoLocal->idequipo == $equipo->idequipo || $partido->EquipoVisitante->idequipo == $equipo->idequipo)
                                {{$partido->EquipoLocal->nombre_equipo}} <span class="text-danger">{{$partido->goles_local}}</span> -vs- <span class="text-danger">{{$partido->goles_visitante}}</span> {{$partido->EquipoVisitante->nombre_equipo}}
                                @endif
                            @endforeach
                        @endif
                    </div>

                  </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                    <div class="equipos-wrapper">
                        <div class="text-center">
                            <h5>
                                @if($pf!=null)
                                   @foreach($pf->ListPartidos as $partido)
                                      @if($partido->EquipoLocal->idequipo == $equipo->idequipo || $partido->EquipoVisitante->idequipo == $equipo->idequipo)
                                      <small>{{date('d/m/Y', strtotime($pf->fecha))}} -</small>
                                      @endif
                                   @endforeach
                                @endif
                                PRÓXIMA FECHA
                                @if($pf!=null)
                                   @foreach($pf->ListPartidos as $partido)
                                      @if($partido->EquipoLocal->idequipo == $equipo->idequipo || $partido->EquipoVisitante->idequipo == $equipo->idequipo)
                                     <small>- {{$partido->hora}}</small>
                                      @endif
                                   @endforeach
                                @endif
                            </h5>
                        </div>
                        <div class="resultado">
                            @if($pf!=null)
                               @foreach($pf->ListPartidos as $partido)
                                  @if($partido->EquipoLocal->idequipo == $equipo->idequipo || $partido->EquipoVisitante->idequipo == $equipo->idequipo)
                                  {{$partido->EquipoLocal->nombre_equipo}} -<span class="text-danger">vs</span>- {{$partido->EquipoVisitante->nombre_equipo}}
                                  @endif
                               @endforeach
                            @endif
                        </div>
                    </div>
            </div>
        </div>

</div>
<div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-3 col-md-offset-0">
@foreach($torneo->TablaPosiciones() as $pos=> $tabla)
    @if($tabla->nombre_equipo == $equipo->nombre_equipo)
        <div class="row estadistica">
            <div class="col-xs-2 col-estadistica text-center">
            {{$pos+1}}
            </div>
            <div class="col-xs-10"> POSICION</div>
        </div>
        <div class="row estadistica ">
            <div class="col-xs-2 col-estadistica text-center">
            {{$tabla->pj}}
            </div>
            <div class="col-xs-10"> PARTIDOS</div>
        </div>
        <div class="row estadistica ">
            <div class="col-xs-2 col-estadistica text-center">
            {{$tabla->gan}}
            </div>
            <div class="col-xs-10"> GANADOS</div>
        </div>
        <div class="row estadistica ">
            <div class="col-xs-2 col-estadistica text-center">
           {{$tabla->emp}}
            </div>
            <div class="col-xs-10"> EMPATADOS</div>
        </div>
        <div class="row estadistica ">
            <div class="col-xs-2 col-estadistica text-center">
            {{$tabla->per}}
            </div>
            <div class="col-xs-10"> PERDIDOS</div>
        </div>
        <div class="row estadistica ">
            <div class="col-xs-2 col-estadistica text-center">
            {{$tabla->gf}}
            </div>
            <div class="col-xs-10"> GOLES FAVOR</div>
        </div>
        <div class="row estadistica ">
            <div class="col-xs-2 col-estadistica text-center">
           {{$tabla->gc}}
            </div>
            <div class="col-xs-10"> GOLES CONTRA</div>
        </div>

   @endif
@endforeach

</div>