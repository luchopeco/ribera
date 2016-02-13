 @foreach($torneo->ListFechas as $fecha)
 <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
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
    <div @if($jugado==true) class="fechas-wrapper-jugado text-center col-fechas" @else class="fechas-wrapper text-center col-fechas" @endif>
        <h2>{{$fecha->numero_fecha}}</h2>
            @foreach($fecha->ListPartidos as $partido)
            <div class="row ">
                <div class="col-xs-5 text-right">
                    {{$partido->EquipoLocal->nombre_equipo}}
                    <div><small>{{date('d/m/Y', strtotime($fecha->fecha))}}</small></div>
                </div>
                <div class="col-xs-2 col-resultado" >
                @if($partido->fue_jugado==false)
                    <div class="versus">VS</div>
                @else
                    {{$partido->goles_local}} - {{$partido->goles_visitante}}
                @endif
                </div>
                <div class="col-xs-5 text-left">
                    {{$partido->EquipoVisitante->nombre_equipo}}
                    <div><small>{{$partido->hora}}</small></div>
                </div>
            </div>
             {{--<td>{{$partido->hora}}</td>--}}
             {{--<td>{{$partido->EquipoLocal->nombre_equipo}}</td>--}}
             {{--<td>{{$partido->EquipoVisitante->nombre_equipo}}</td>--}}
             {{--<td>{{$partido->goles_local}} - {{$partido->goles_visitante}}</td>--}}
             {{--<td>{{$partido->Arbitro->nombre}}</td>--}}
             @endforeach
    </div>
 </div>
 @endforeach