<!DOCTYPE html>
<html lang="es">
<head>
<style>
body{
  font-family: verdana, sans-serif;
  font-size: 12px;
  margin: 0px;
}
table{
 border-spacing: 0px;
    /*border-collapse:collapse;*/
  text-align: center;
}
table,td,th{
 border-spacing: 0px;

  border: 1px solid #000000;

}
th{
  height: 25px;
  text-align: center;
  border-collapse:collapse;
}
td{
  height: 21px;
  padding-left: 5px;
  border-collapse:collapse;
}
div{
  padding: 5px;
  text-align: left;
  margin: 0;
}
.text-center{
  text-align: center;
}
.separador{
  color: #ffffff;
}
.ancho30{
  width:237px !important;
}
.ancho20{
  width:158px !important;
}
.ancho40{
  width: 370px !important;
}
.ancho50{
  width: 510px !important;
}
.ancho10{
  width: 79px !important;
}
.ancho-separador-equipo{
  width: 53px !important;
}
.ancho-separador-equipo-cabecera{
  width: 47px !important;
}
.ancho100{
  width: 1123px !important;
}
.ancho-garn{
  width: 15px !important;

}
.ancho-dni
{
  width: 70px !important;

}
.ancho-firma
{
  width: 100px !important;

}
.ancho-nombre
{
  width: 200px !important;

}
.bordesnegros{
  border: 1px solid #000000;

}
.float{
  float: left;
}
.clear{
  clear: both;
}
.color-blanco{
color: #ffffff;
}
</style>
<!-- Bootstrap 3.3.2 -->

<!-- Theme style -->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body>
@foreach($fecha->ListPartidos as $p)
    @if(isset($cont))
        <div style="page-break-after: always;"></div>
    @else
        <?php $cont=1; ?>
    @endif
<div>
    <div class=" float ancho20 bordesnegros" >FECHA N°: {{$fecha->numero_fecha}} </div>
    <div class="float ancho30 separador">.</div>
    <div class="float ancho10 bordesnegros text-center">
        <h3>CANCHA<br><span class="color-blanco">....</span></h3>
    </div>
    <div class=" float ancho20 text-center  " >HORARIO: {{$p->hora}}</div>
    <div class=" float ancho20 text-center " >FECHA: {{date('d/m/Y', strtotime($fecha->fecha))}} </div>
</div>
<div class="clear"></div>
<div>
    <div>ARBITRO:.........................</div>
</div>
<div>
    <div class=" float ancho40 bordesnegros" >EQUIPO: {{$p->EquipoLocal->nombre_equipo}} </div>
    <div class=" float ancho10 " >GOLES: </div>
    <div class="float ancho10 ancho-separador-equipo-cabecera">.</div>
    <div class=" float ancho40 bordesnegros" >EQUIPO: {{$p->EquipoVisitante->nombre_equipo}} </div>
    <div class=" float ancho10 " >GOLES: </div>
</div>
<div class="clear"></div>
<div>
    <div class="float ancho50">
        <table>
            <tr>
                <th class="ancho-garn">G</th>
                <th class="ancho-garn">A </th>
                <th class="ancho-garn">R</th>
                <th class=" ancho-dni">DNI</th>
                <th class="ancho-nombre">NOMBRE</th>
                <th class="ancho-garn">N°</th>
                <th class="ancho-firma">FIRMA</th>
            </tr>
            @foreach($p->EquipoLocal->ListJugadores as $j)
            <tr>
                <td class="color-blanco">....</td>
                <td class="color-blanco">....</td>
                <td class="color-blanco">....</td>
                <td>{{$j->dni}}</td>
                <td>{{$j->NombreApellido()}}</td>
                <td class="color-blanco">....</td>
                <td class="color-blanco">....</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="float ancho50">
        <table>
            <tr>
                <th class="ancho-garn">G</th>
                <th class="ancho-garn">A </th>
                <th class="ancho-garn">R</th>
                <th class="ancho-dni">DNI</th>
                <th class="ancho-nombre">NOMBRE</th>
                <th class="ancho-garn">N°</th>
                <th class="ancho-firma">FIRMA</th>
            </tr>
            @foreach($p->EquipoVisitante->ListJugadores as $j)
            <tr>
                <td class="color-blanco">....</td>
                <td class="color-blanco">....</td>
                <td class="color-blanco">....</td>
                <td>{{$j->dni}}</td>
                <td>{{$j->NombreApellido()}}</td>
                <td class="color-blanco">....</td>
                <td class="color-blanco">....</td>
            </tr>
            @endforeach
        </table>
     </div>

</div>
 <div class="clear"></div>
 <br>
 <div>
     <div class="float ancho50">DT: {{$p->EquipoLocal->director_tecnico}}</div>
     <div class="float ancho50">DT: {{$p->EquipoVisitante->director_tecnico}}</div>
 </div>
 <div class="clear"></div>
 <div>OBSERVACIONES:..............................................................................................</div>
@endforeach

</body>
</html>
