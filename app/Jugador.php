<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Jugador extends Model{

    use SoftDeletes;

    protected $table='jugadores';

    protected $fillable = ['nombre_jugador','dni','pathfoto','idequipo','observaciones','certificado','delegado','direccion','mail','obra_social','telefono','grupo_sanguineo','apellido_jugador','fecha_nacimiento'];

    protected $primaryKey = 'idjugador';

    public function NombreApellido()
    {
        return $this->apellido_jugador.", " .$this->nombre_jugador;
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

        $goles =  DB::select(DB::raw("SELECT
                                            COALESCE(sum(phj.goles_favor), 0) goles
                                        FROM
                                            partido_has_jugador phj
                                            INNER JOIN partidos p
                                                ON   p.idpartido = phj.idpartido
                                            INNER JOIN fechas f
                                                ON   f.idfecha = p.idfecha
                                                INNER JOIN zonas z ON z.idzona = f.idzona
                                        WHERE
                                            z.idtorneo = :p1
                                            AND phj.idjugador = :p2"), array('p1' => $idtorneo, 'p2' => $this->idjugador));
        foreach($goles as $g)
        {
            $gol = $g->goles;
        }
        return $gol;
    }
    public function golesxZona($idzona)
    {

        $goles =  DB::select(DB::raw("SELECT
                                            COALESCE(sum(phj.goles_favor), 0) goles
                                        FROM
                                            partido_has_jugador phj
                                            INNER JOIN partidos p
                                                ON   p.idpartido = phj.idpartido
                                            INNER JOIN fechas f
                                                ON   f.idfecha = p.idfecha
                                                INNER JOIN zonas z ON z.idzona = f.idzona
                                        WHERE
                                            z.idzona = :p1
                                            AND phj.idjugador = :p2"), array('p1' => $idzona, 'p2' => $this->idjugador));
        foreach($goles as $g)
        {
            $gol = $g->goles;
        }
        return $gol;
    }


    public function tarjetasAmarillas($idtorneo)
    {
        $ta =  DB::select(DB::raw("SELECT
                                    COALESCE(sum(phj.tarjeta_amarilla), 0) ta
                                FROM
                                    partido_has_jugador phj
                                    INNER JOIN jugadores j
                                        ON   j.idjugador = phj.idjugador
                                    INNER JOIN partidos p
                                        ON   p.idpartido = phj.idpartido
                                    INNER JOIN fechas f
                                        ON   f.idfecha = p.idfecha
                                    INNER JOIN zonas z ON z.idzona = f.idzona
                                    INNER JOIN equipos e
                                        ON   e.idequipo = j.idequipo
                                WHERE
                                    z.idtorneo = :p1
                                    AND j.idjugador = :p2"), array('p1' => $idtorneo, 'p2' => $this->idjugador));
        foreach($ta as $t)
        {
            $tarjeta = $t->ta;
        }
        return $tarjeta;
    }
    public function tarjetasAmarillasxZona($idzona)
    {
        $ta =  DB::select(DB::raw("SELECT
                                    COALESCE(sum(phj.tarjeta_amarilla), 0) ta
                                FROM
                                    partido_has_jugador phj
                                    INNER JOIN jugadores j
                                        ON   j.idjugador = phj.idjugador
                                    INNER JOIN partidos p
                                        ON   p.idpartido = phj.idpartido
                                    INNER JOIN fechas f
                                        ON   f.idfecha = p.idfecha
                                    INNER JOIN zonas z ON z.idzona = f.idzona
                                    INNER JOIN equipos e
                                        ON   e.idequipo = j.idequipo
                                WHERE
                                    z.idzona = :p1
                                    AND j.idjugador = :p2"), array('p1' => $idzona, 'p2' => $this->idjugador));
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
                                    INNER JOIN zonas z ON z.idzona = f.idzona
                                    INNER JOIN equipos e ON e.idequipo = j.idequipo
                                    WHERE z.idtorneo= :p1
                                    AND j.idjugador= :p2"), array('p1' => $idtorneo, 'p2' => $this->idjugador));
        foreach($ta as $t)
        {
            $tarjeta = $t->ta;
        }
        return $tarjeta;
    }
    public function tarjetasAzulesxZonas($idzona)
    {
        $ta =  DB::select(DB::raw("SELECT COALESCE( sum(phj.tarjeta_azul),0) ta
                                    FROM partido_has_jugador phj
                                    INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                    INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                    INNER JOIN fechas f ON f.idfecha = p.idfecha
                                    INNER JOIN zonas z ON z.idzona = f.idzona
                                    INNER JOIN equipos e ON e.idequipo = j.idequipo
                                    WHERE z.idzona= :p1
                                    AND j.idjugador= :p2"), array('p1' => $idzona, 'p2' => $this->idjugador));
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
                                    INNER JOIN zonas z ON z.idzona = f.idzona
                                    INNER JOIN equipos e ON e.idequipo = j.idequipo
                                    WHERE z.idtorneo= :p1
                                    AND j.idjugador= :p2"), array('p1' => $idtorneo, 'p2' => $this->idjugador));
        foreach($ta as $t)
        {
            $tarjeta = $t->ta;
        }
        return $tarjeta;
    }
    public function tarjetasRojasxZonas($idzona)
    {
        $ta =  DB::select(DB::raw("SELECT COALESCE( sum(phj.tarjeta_roja),0) ta
                                    FROM partido_has_jugador phj
                                    INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                    INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                    INNER JOIN fechas f ON f.idfecha = p.idfecha
                                    INNER JOIN zonas z ON z.idzona = f.idzona
                                    INNER JOIN equipos e ON e.idequipo = j.idequipo
                                    WHERE z.idzona= :p1
                                    AND j.idjugador= :p2"), array('p1' => $idzona, 'p2' => $this->idjugador));
        foreach($ta as $t)
        {
            $tarjeta = $t->ta;
        }
        return $tarjeta;
    }

    public function fechasSancion($idtorneo)
    {
        $ta =  DB::select(DB::raw("SELECT
	(
		aux1.sancion -(
			(
				SELECT
					COUNT(*)
				FROM
					fechas f2
					INNER JOIN zonas z2
						ON   z2.idzona = f2.idzona
				WHERE
					f2.fecha >= aux1.fecha
					AND f2.fecha < CURRENT_DATE
					AND z2.idtorneo = :p1
			) -1
		)
	)     fechas_restantes
FROM
	(
		SELECT
			jugador,
			sancion,
			fecha,
			nombre_equipo
		FROM
			(
				SELECT
					CONCAT(
						COALESCE(j.apellido_jugador, ''),
						', ',
						COALESCE(j.nombre_jugador, '')
					)           jugador,
					SUM(phj.cantidad_fechas_sancion) sancion,
					f.fecha     fecha,
					e.nombre_equipo
				FROM
					partidos p
					INNER JOIN fechas f
						ON   f.idfecha = p.idfecha
					INNER JOIN zonas z
						ON   z.idzona = f.idzona
					LEFT JOIN partido_has_jugador phj
						ON   p.idpartido = phj.idpartido
					LEFT JOIN jugadores j
						ON   j.idjugador = phj.idjugador
					LEFT JOIN equipos e
						ON   e.idequipo = j.idequipo
				WHERE
					p.fue_jugado = 1
					AND f.fecha <= CURRENT_DATE
					AND z.idtorneo = :p2
					AND j.idjugador= :p3
				GROUP BY
					j.nombre_jugador,
					j.apellido_jugador,
					e.nombre_equipo,
					f.fecha
			) AS aux
		WHERE
			EXISTS (
				SELECT
					COUNT(*)
				FROM
					fechas f
					INNER JOIN zonas z
						ON   z.idzona = f.idzona
				WHERE
					(
						f.fecha BETWEEN aux.fecha AND (CURRENT_DATE - INTERVAL 1 DAY)
					)
					AND z.idtorneo = :p4
				HAVING COUNT(*) <=aux.sancion
				AND
					COUNT(*) > 0
			)
	)  AS aux1"), array('p1' => $idtorneo,'p2' => $idtorneo,'p3' => $this->idjugador,'p4' => $idtorneo));
        $tarjeta=0;
        foreach($ta as $t)
        {
            $tarjeta = $t->fechas_restantes;
        }
        return $tarjeta;
    }
    public function fechasSancionXzona($idzona)
    {
        $ta =  DB::select(DB::raw("SELECT  COALESCE( (aux1.sancion - ((SELECT count(*) FROM fechas f2 INNER JOIN zonas z ON z.idzona = f2.idzona WHERE f2.fecha BETWEEN aux1.fecha AND CURRENT_DATE AND  z.idzona=:p1)-1)) , 0 ) fechas
                                      FROM
                                    (
                                        SELECT jugador, sancion, fecha, nombre_equipo FROM
                                    (SELECT j.nombre_jugador jugador, sum(phj.cantidad_fechas_sancion) sancion , f.fecha fecha, e.nombre_equipo
                                    FROM partidos p
                                    INNER JOIN fechas f ON f.idfecha = p.idfecha
                                    INNER JOIN zonas z ON z.idzona = f.idzona
                                    LEFT JOIN partido_has_jugador phj  ON p.idpartido = phj.idpartido
                                    left JOIN jugadores j ON j.idjugador = phj.idjugador
                                    LEFT JOIN equipos e ON e.idequipo = j.idequipo
                                    WHERE p.fue_jugado=1 and f.fecha<= CURRENT_DATE AND z.idzona=:p2 AND j.idjugador=:p3
                                    GROUP BY j.nombre_jugador, phj.cantidad_fechas_sancion, f.fecha) AS aux
                                    WHERE EXISTS (SELECT count(*) FROM fechas f INNER JOIN zonas z ON z.idzona = f.idzona WHERE f.fecha BETWEEN aux.fecha AND CURRENT_DATE AND z.idzona=:p4 HAVING count(*) <=aux.sancion )
                                    )AS aux1"), array('p1' => $idzona,'p2' => $idzona,'p3' => $this->idjugador,'p4' => $idzona));
        $tarjeta=0;
        foreach($ta as $t)
        {
            $tarjeta = $t->fechas;
        }
        return $tarjeta;
    }
    
    public  function validaralta()
    {
        //no valido nada
        //$jug = Jugador::onlyTrashed()->where('dni', $this->dni)->first();
        //if($jug!=null)
       // {
           // throw new \Exception(env('MSJ_ERRORJUGADOR'));
        //}
    }

}