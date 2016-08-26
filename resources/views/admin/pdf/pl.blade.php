<!DOCTYPE html>
<html lang="es">
<head>
<style>
@page {
  margin-top: 7mm;
  margin-left: 7mm;

  margin-bottom: 7mm;
}
body{
  font-family: verdana, sans-serif;
  font-size: 12px;
  margin: 0px;
}
table{
  border-spacing: 0px;
  /*border-collapse:collapse;*/
  text-align: left;

}
td,th{
  border-spacing: 0px;
  border: 1px solid #000000;
}
tr{
  border: 1px solid #fff !important;
}
.border-2{
  border: 2px solid #000000!important;
}
.sin-borde{
  border: 1px solid #fff !important;
}
.alto-8{
  height: 0.67cm;
  min-height: 0.67cm;
  max-height: 0.67cm;
}
.alto-10{
  height: 10mm;
  min-height: 10mm;
  max-height: 10mm;
}
.alto-3{
  height: 1mm;
  min-height: 1mm;
  max-height: 1mm;
}
.alto-4{
  height: 4mm;
  min-height: 4mm;
  max-height: 4mm;
}

.ancho-40{
  width: 40mm;
  max-width: 40mm;
  min-width: 40mm;
  overflow: hidden;
}
.ancho-133{
  width: 133mm;
  max-width: 133mm;
  min-width: 133mm;
}
.ancho-17{
  width: 17mm;
  max-width: 17mm;
  min-width: 17mm;
}
.ancho-30{
  width: 30mm;
  max-width: 30mm;
  min-width: 30mm;
}
.ancho-75{
  width: 75mm;
  max-width: 75mm;
  min-width: 75mm;
}
.ancho-39{
  width: 39mm;
  max-width: 39mm;
  min-width: 39mm;
}
.ancho-97{
  width: 97mm;
  max-width: 97mm;
  min-width: 97mm;
}
.ancho-16{
  width: 16mm;
  max-width: 16mm;
  min-width: 16mm;
}
.ancho-120{
  width: 120mm;
  max-width: 120mm;
  min-width: 120mm;
}
.ancho-22{
  width: 22mm;
  max-width: 22mm;
  min-width: 22mm;
}
.ancho-5{
  width: 5mm;
  max-width: 5mm;
  min-width: 5mm;
}
.ancho-6{
  width: 0.6cm;
  max-width: 0.6cm;
  min-width: 0.6cm;
}
.ancho-19{
  width: 19mm;
  max-width: 19mm;
  min-width: 19mm;
}
.ancho-58{
  width: 50mm;
  max-width: 50mm;
  min-width: 50mm;
  font-weight: bold;
}
.ancho-11{
  width: 11mm;
  max-width: 11mm;
  min-width: 11mm;
}
.ancho-28{
  width: 28mm;
  max-width: 28mm;
  min-width: 28mm;
}
.ancho-85{
  width: 88mm;
  max-width: 88mm;
  min-width: 88mm;
    overflow: hidden;
}
.ancho-44{
  width: 44mm;
  max-width: 44mm;
  min-width: 44mm;
}
.ancho-89{
  width: 89mm;
  max-width: 89mm;
  min-width: 89mm;
}
.ancho-17{
  width: 17mm;
  max-width: 17mm;
  min-width: 17mm;
}
.text-center{
  text-align: center;
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
@foreach($fecha->ListPartidos as $p)
    @if(isset($cont))
        <div style="page-break-after: always;"></div>
    @else
        <?php $cont=1; ?>
    @endif
<body>
  <table>
    <tr >
      <td class="ancho-40 alto-8">
        <strong style="font-size: 12pt">{{$fecha->numero_fecha}}</strong>
      </td>
      <td class="sin-borde ancho-85">

      </td>
      <td valign="top" rowspan="2"  class="ancho-17 text-center border-2" style="text-decoration: underline;">
        CANCHA
      </td>
      <td  class="ancho-30 sin-borde">

      </td>
      <td rowspan="2" class="ancho-58 sin-borde">
        HORARIO: <strong style="font-size: 18px">{{$p->hora}}</strong>
      </td>
      <td rowspan="2"  class="sin-borde">
        FECHA: {{date('d/m/Y', strtotime($fecha->fecha))}}
      </td>
    </tr>
    <tr>
      <td colspan="2" class="alto-8  sin-borde">
        ARBITRO:...............................................................................
      </td>

      <td class=" ancho-30 sin-borde">

      </td>
    </tr>
  </table>
    <table>
      <tr>
        <td colspan="17" class="alto-3 sin-borde">

        </td>
      </tr>
      <tr>
        <td colspan="5" class="alto-8">
          EQUIPO: <strong style="font-size: 18px">{{$p->EquipoLocal->nombre_equipo}}</strong>
        </td>
        <td colspan="2" class="ancho-11 alto-8 text-center sin-borde">
          GOLES
        </td>
        <td class="alto-8 ancho-22 border-2">

        </td>
        <td class=" alto-8 ancho-5 sin-borde">

        </td>
        <td colspan="5" class="alto-8">
          EQUIPO: <strong style="font-size: 18px">{{$p->EquipoVisitante->nombre_equipo}}</strong>
        </td>
        <td colspan="2" class="ancho-11 alto-8 text-center sin-borde">
          GOLES
        </td>
        <td class="alto-8 ancho-22 border-2">

        </td>
      </tr>
      <tr>
        <td colspan="17" class="alto-3 sin-borde">

        </td>
      </tr>
        <tr>
          <td class="alto-8 ancho-6 text-center border-2">
           <strong> G</strong>
          </td>
          <td class="alto-8 ancho-6 text-center border-2">
             <strong>A</strong>
          </td>
          <td class="alto-8 ancho-6 text-center border-2">
            <strong> R</strong>
          </td>
          <td class="alto-8 ancho-19 text-center border-2">
             <strong>DNI</strong>
          </td>
          <td class="alto-8 ancho-58 text-center border-2">
            NOMBRE
          </td>
          <td class="alto-8 ancho-11 text-center border-2">
            <strong> N</strong>
          </td>
          <td colspan="2" class="alto-8 ancho-28 text-center border-2">
             <strong>FIRMA</strong>
          </td>
          <td class="alto-8 ancho-5 sin-borde">

          </td>
          <td class="alto-8 ancho-6 text-center border-2">
            <strong> G</strong>
          </td>
          <td class="alto-8 ancho-6 text-center border-2">
             <strong>A</strong>
          </td>
          <td class="alto-8 ancho-6 text-center border-2">
             <strong>R</strong>
          </td>
          <td class="alto-8 ancho-19 text-center border-2">
             <strong>DNI</strong>
          </td>
          <td class="alto-8 ancho-58 text-center border-2">
            NOMBRE
          </td>
          <td class="alto-8 ancho-11 text-center border-2">
             <strong>N</strong>
          </td>
          <td colspan="2" class="alto-8 ancho-28 text-center border-2">
             <strong>FIRMA</strong>
          </td>
        </tr>
        <tr>
          <td class="alto-8 ancho-6">

          </td>
          <td class="alto-8 ancho-6">

          </td>
          <td class="alto-8 ancho-6">

          </td>
          <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoLocal->ListJugadores[0]->dni; } catch(\Exception $e) {}?>
          </td>
          <td class="alto-8 ancho-58">
            <?php try{  echo $p->EquipoLocal->ListJugadores[0]->NombreApellido(); } catch(\Exception $e) {}?>
          </td>
          <td class="alto-8 ancho-11">

          </td>
          <td colspan="2" class="alto-8 ancho-28">

          </td>
          <td class="alto-8 ancho-5 sin-borde">

          </td>
          <td class="alto-8 ancho-6">

          </td>
          <td class="alto-8 ancho-6">

          </td>
          <td class="alto-8 ancho-6">

          </td>
          <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoVisitante->ListJugadores[0]->dni; } catch(\Exception $e) {}?>
          </td>
          <td class="alto-8 ancho-58">
           <?php try{  echo $p->EquipoVisitante->ListJugadores[0]->NombreApellido(); } catch(\Exception $e) {}?>
          </td>
          <td class="alto-8 ancho-11">

          </td>
          <td colspan="2" class="alto-8 ancho-28">

          </td>
        </tr>
        <tr>
           <td class="alto-8 ancho-5">

           </td>
           <td class="alto-8 ancho-5">

           </td>
           <td class="alto-8 ancho-5">

           </td>
           <td class="alto-8 ancho-19 text-center">
              <?php try{  echo $p->EquipoLocal->ListJugadores[1]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
            <?php try{  echo $p->EquipoLocal->ListJugadores[1]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-5">

           </td>
           <td class="alto-8 ancho-5">

           </td>
           <td class="alto-8 ancho-5">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[1]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
            <?php try{  echo $p->EquipoVisitante->ListJugadores[1]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoLocal->ListJugadores[2]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
            <?php try{  echo $p->EquipoLocal->ListJugadores[2]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[2]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[2]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoLocal->ListJugadores[3]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[3]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[3]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[3]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoLocal->ListJugadores[4]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[4]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[4]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
            <?php try{  echo $p->EquipoVisitante->ListJugadores[4]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoLocal->ListJugadores[5]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[5]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[5]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[5]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoLocal->ListJugadores[6]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[6]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[6]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
            <?php try{  echo $p->EquipoVisitante->ListJugadores[6]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoLocal->ListJugadores[7]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[7]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[7]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[7]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
           <?php try{  echo $p->EquipoLocal->ListJugadores[8]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[8]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoVisitante->ListJugadores[8]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[8]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoLocal->ListJugadores[9]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[9]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[9]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[9]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoLocal->ListJugadores[10]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[10]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[10]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[10]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoLocal->ListJugadores[11]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[11]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[11]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[11]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
            <?php try{  echo $p->EquipoLocal->ListJugadores[12]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[12]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[12]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[12]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoLocal->ListJugadores[13]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[13]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[13]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
            <?php try{  echo $p->EquipoVisitante->ListJugadores[13]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoLocal->ListJugadores[14]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
            <?php try{  echo $p->EquipoLocal->ListJugadores[14]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[14]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[14]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoLocal->ListJugadores[15]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[15]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[15]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[15]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
         </tr>
         <tr>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-6">

           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoLocal->ListJugadores[16]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoLocal->ListJugadores[16]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">

           </td>
           <td colspan="2" class="alto-8 ancho-28">

           </td>
           <td class="alto-8 ancho-5 sin-borde">
    
           </td>
           <td class="alto-8 ancho-6">
    
           </td>
           <td class="alto-8 ancho-6">
    
           </td>
           <td class="alto-8 ancho-6">
    
           </td>
           <td class="alto-8 ancho-19 text-center">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[16]->dni; } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-58">
             <?php try{  echo $p->EquipoVisitante->ListJugadores[16]->NombreApellido(); } catch(\Exception $e) {}?>
           </td>
           <td class="alto-8 ancho-11">
            
           </td>
           <td colspan="2" class="alto-8 ancho-28">
    
           </td>
         </tr>
         <tr>
           <td colspan="17" class="alto-3 sin-borde">
    
           </td>
         </tr>
         <tr>
           <td colspan="3" class="alto-8 sin-borde text-center">
             DT
           </td>
           <td>
    
           </td>
           <td>
            {{$p->EquipoLocal->director_tecnico}}
           </td>
           <td colspan="3">
    
           </td>
           <td class="alto-8 ancho-5 sin-borde">
    
           </td>
           <td colspan="3" class="alto-8 sin-borde text-center">
             DT
           </td>
           <td>
    
           </td>
           <td>
            {{$p->EquipoVisitante->director_tecnico}}
           </td>
           <td colspan="3">
    
           </td>
         </tr>
         <tr>
           <td colspan="8" class="sin-borde">
             PECHERAS ............................................................................
           </td>
           <td class="alto-8 ancho-5 sin-borde">
    
           </td>
           <td colspan="8" class="sin-borde">
             PECHERAS ............................................................................
           </td>
         </tr>
        <tr>
          <td colspan="17" class="sin-borde">
            Observaciones
          </td>
        </tr>
    </table>
@endforeach
</body>
</html>
