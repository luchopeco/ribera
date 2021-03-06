<?php $aux =0; ?>
@foreach($torneo->ListZonas as $zona)
    <?php $aux = $aux+1; ?>
    <section @if( $aux%2 ==0) id="verde" @else id="blanco" @endif >
        <div class="row" id="fixture">
            <div class="col-md-12">
                <div @if( $aux%2 ==0) id="verde" @else id="blanco" @endif>
                    <div class="container col-480">
                        <h1>{{$zona->nombre}}</h1>
                        <div class="row">
                            @foreach($zona->ListFechas as $fecha)
                                <div class="col-lg-4 col-md-6 col-480" style="min-height: 400px">
                                    <!-- Segun si la fecha fue jugada o no cambio el color del borde-->
                                    <?php $jugado=false;?>
                                    @foreach($fecha->ListPartidos as $partido)
                                        <?php
                                        if($partido->fue_jugado==true)
                                        {
                                            $jugado= $partido->fue_jugado;
                                        }
                                        ?>
                                    @endforeach
                                    <div>
                                        <div class="border-fecha ">
                                            <div class="row">
                                                <div class="col-xs-7">
                                                    <h2 class="text-left @if($jugado==true) @if($aux%2 !=0) txt-verde @else txt-blanco @endif   @else txt-amarillo @endif  ">{{$fecha->numero_fecha}} </h2>
                                                </div>
                                                <div class="col-xs-5"><h4 style="color: #000000; margin-top: 30px" class="text-right">  {{date('d/m/Y', strtotime($fecha->fecha))}}</h4> </div>
                                            </div>

                                        </div>
                                        @foreach($fecha->ListPartidos as $partido)
                                            <div class="row ">
                                                @if($partido->fue_jugado==true)
                                                    <a href="#" class="btn-partido" data-idpartido="{{$partido->idpartido}}">
                                                        @endif
                                                        <div class="col-xs-5 text-left">
                                                            <div @if($aux%2 !=0) class="txt-negro" @else class="txt-blanco" @endif ><strong>{{$partido->EquipoLocal->nombre_equipo}}</strong></div>
                                                        </div>
                                                        <div class="col-xs-2 col-resultado text-center" >
                                                            @if($partido->fue_jugado==false)
                                                                <div class="txt-amarillo"><strong>VS</strong></div>
                                                            @else
                                                                <div @if($aux%2 !=0) class="txt-verde" @else class="txt-negro" @endif >
                                                                    <strong>{{$partido->goles_local}} - {{$partido->goles_visitante}}</strong>
                                                                </div>
                                                                @if($partido->Fecha->es_play_off==1 && $partido->goles_local == $partido->goles_visitante)
                                                                    <div class="txt-amarillo">
                                                                        <small>({{$partido->penales_local}}-{{$partido->penales_visitante}})</small>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                            <div class="txt-amarillo"><small>{{$partido->hora}}</small></div>
                                                        </div>
                                                        <div class="col-xs-5 text-right">
                                                            <div @if($aux%2 !=0) class="txt-negro" @else class="txt-blanco" @endif ><strong>{{$partido->EquipoVisitante->nombre_equipo}}</strong></div>

                                                        </div>
                                                        @if($partido->fue_jugado==true)
                                                    </a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br><br>
@endforeach
