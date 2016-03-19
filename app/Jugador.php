<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Jugador extends Model{

    use SoftDeletes;

    protected $table='jugadores';

    protected $fillable = ['nombre_jugador','dni','pathfoto','idequipo','observaciones','certificado','delegado','direccion','mail','obra_social','telefono','grupo_sanguineo','apellido_jugador'];

    protected $primaryKey = 'idjugador';

    public function NombreApellido()
    {
        return $this->nombre_jugador." ".$this->apellido_jugador;
    }

    public function Equipo()
    {
        return $this->hasOne('torneo\Equipo', 'idequipo','idequipo');
    }

    public $goles_favor;
    public $goles_contra;
    public $cantidad_fechas_sancion;

    public function esDelegado()
    {
        if($this->delegado ==1)
        {
            return 'SI';
        }
        else
        {
            return 'NO';
        }
    }
    public function entregoCertificado()
    {
        if($this->certificado ==1)
        {
            return 'SI';
        }
        else
        {
            return 'NO';
        }
    }
    public function goles($idtorneo)
    {

        $goles =  DB::select(DB::raw("SELECT COALESCE( sum(phj.goles_favor),0) goles
                                    FROM partido_has_jugador phj
                                    INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                    INNER JOIN fechas f ON f.idfecha = p.idfecha
                                    WHERE f.idtorneo= :p1
                                    AND phj.idjugador=:p2"), array('p1' => $idtorneo, 'p2' => $this->idjugador));
        foreach($goles as $g)
        {
            $gol = $g->goles;
        }
        return $gol;
    }

    public function tarjetasAmarillas($idtorneo)
    {
        $ta =  DB::select(DB::raw("SELECT COALESCE( sum(phj.tarjeta_amarilla),0) ta
                                    FROM partido_has_jugador phj
                                    INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                    INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                    INNER JOIN fechas f ON f.idfecha = p.idfecha
                                    INNER JOIN equipos e ON e.idequipo = j.idequipo
                                    WHERE f.idtorneo= :p1
                                    AND j.idjugador= :p2"), array('p1' => $idtorneo, 'p2' => $this->idjugador));
        foreach($ta as $t)
        {
            $tarjeta = $t->ta;
        }
        return $tarjeta;
    }
    public function tarjetasAzules($idtorneo)
    {
        $ta =  DB::select(DB::raw("SELECT COALESCE( sum(phj.tarjeta_azul),0) ta
                                    FROM partido_has_jugador phj
                                    INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                    INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                    INNER JOIN fechas f ON f.idfecha = p.idfecha
                                    INNER JOIN equipos e ON e.idequipo = j.idequipo
                                    WHERE f.idtorneo= :p1
                                    AND j.idjugador= :p2"), array('p1' => $idtorneo, 'p2' => $this->idjugador));
        foreach($ta as $t)
        {
            $tarjeta = $t->ta;
        }
        return $tarjeta;
    }
    public function tarjetasRojas($idtorneo)
    {
        $ta =  DB::select(DB::raw("SELECT COALESCE( sum(phj.tarjeta_roja),0) ta
                                    FROM partido_has_jugador phj
                                    INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                    INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                    INNER JOIN fechas f ON f.idfecha = p.idfecha
                                    INNER JOIN equipos e ON e.idequipo = j.idequipo
                                    WHERE f.idtorneo= :p1
                                    AND j.idjugador= :p2"), array('p1' => $idtorneo, 'p2' => $this->idjugador));
        foreach($ta as $t)
        {
            $tarjeta = $t->ta;
        }
        return $tarjeta;
    }
    public function fechasSancion($idtorneo)
    {
        $ta =  DB::select(DB::raw("SELECT  COALESCE( (aux1.sancion - ((SELECT count(*) FROM fechas f2 WHERE f2.fecha BETWEEN aux1.fecha AND CURRENT_DATE AND  f2.idtorneo=:p1)-1)) , 0 ) fechas
                                      FROM
                                    (
                                        SELECT jugador, sancion, fecha, nombre_equipo FROM
                                    (SELECT j.nombre_jugador jugador, sum(phj.cantidad_fechas_sancion) sancion , f.fecha fecha, e.nombre_equipo
                                    FROM partidos p
                                    INNER JOIN fechas f ON f.idfecha = p.idfecha
                                    LEFT JOIN partido_has_jugador phj  ON p.idpartido = phj.idpartido
                                    left JOIN jugadores j ON j.idjugador = phj.idjugador
                                    LEFT JOIN equipos e ON e.idequipo = j.idequipo
                                    WHERE p.fue_jugado=1 and f.fecha<= CURRENT_DATE AND f.idtorneo=:p2 AND j.idjugador=:p3
                                    GROUP BY j.nombre_jugador, phj.cantidad_fechas_sancion, f.fecha) AS aux
                                    WHERE EXISTS (SELECT count(*) FROM fechas f WHERE f.fecha BETWEEN aux.fecha AND CURRENT_DATE AND f.idtorneo=:p4 HAVING count(*) <=aux.sancion )
                                    )AS aux1"), array('p1' => $idtorneo,'p2' => $idtorneo,'p3' => $this->idjugador,'p4' => $idtorneo));
        $tarjeta=0;
        foreach($ta as $t)
        {
            $tarjeta = $t->fechas;
        }
        return $tarjeta;
    }

    public  function validaralta()
    {
        $jug = Jugador::onlyTrashed()->where('dni', $this->dni)->first();
        if($jug!=null)
        {
            throw new \Exception(env('MSJ_ERRORJUGADOR'));
        }
    }

}