<?php namespace torneo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Zona extends Model {

    protected $table='zonas';

    protected $fillable = ['nombre','idtorneo','orden'];

    protected $primaryKey = 'idzona';

    public function Torneo()
    {
        return $this->belongsTo('torneo\Torneo','idtorneo')->withTrashed();;
    }

    public function ListEquipos()
    {
        return $this->belongsToMany('torneo\Equipo','torneo_equipo','zona_idzona','equipo_idequipo')->orderBy('nombre_equipo');
    }

    public function ListDescuentosPuntos()
    {
        return $this->hasMany('torneo\DescuentoPunto','idzona','idzona');
    }

    public function ListFechas()
    {
        return $this->hasMany('torneo\Fecha','idzona','idzona')->orderBy('fecha')->orderBy('numero_fecha');
    }

    public function TablaPosiciones()
    {
            $tabla =  DB::select(DB::raw("SELECT
                sum(emp)        emp,
                sum(gan)        gan,
                sum(per)        per,
                sum(puntos)     pun,
                sum(gf)         gf,
                sum(gc)         gc,
                sum(df)         df,
                sum(pj)         pj,
                id,
                nombre_equipo
            FROM
                (
                    (
                        SELECT
                            sum(p.empatado_local)      emp,
                            sum(p.ganado_local)        gan,
                            sum(p.perdido_local)       per,
                            sum(p.puntos_local)        puntos,
                            sum(p.goles_local)         gf,
                            sum(p.goles_visitante)     gc,
                            sum(p.goles_local) - sum(p.goles_visitante) df,
                            p.idequipo_local           id,
                            e.nombre_equipo,
                            count(*)                   pj
                        FROM
                            partidos p
                            INNER JOIN equipos e
                                ON   p.idequipo_local = e.idequipo
                            INNER JOIN fechas f
                                ON   f.idfecha = p.idfecha
                            INNER JOIN zonas z
                                ON   z.idzona = p.idzona
                        WHERE
                            p.fue_jugado = 1
                            AND z.idzona = :p1
                            AND f.es_play_off = 0
                            AND e.es_libre = 0
                        GROUP BY
                            p.idequipo_local
                    )

                    UNION ALL

                    (
                        SELECT
                            sum(p.empatado_visitante) emp,
                            sum(p.ganado_visitante)      gan,
                            sum(p.perdido_visitante)     per,
                            sum(p.puntos_visitante)      puntos,
                            sum(p.goles_visitante)       gf,
                            sum(p.goles_local)           gc,
                            sum(p.goles_visitante) - sum(p.goles_local) df,
                            p.idequipo_visitante         id,
                            e.nombre_equipo,
                            count(*)                     pj
                        FROM
                            partidos p
                            INNER JOIN equipos e
                                ON   p.idequipo_visitante = e.idequipo
                            INNER JOIN fechas f
                                ON   f.idfecha = p.idfecha
                            INNER JOIN zonas z
                                ON   z.idzona = p.idzona
                        WHERE
                            p.fue_jugado = 1
                            AND z.idzona = :p2
                            AND f.es_play_off = 0
                            AND e.es_libre = 0
                        GROUP BY
                            p.idequipo_visitante
                    )
                    UNION ALL(
                        SELECT
                            SUM(0)         emp,
                            SUM(0)         gan,
                            SUM(0)         per,
                            0 -SUM(dp.puntos_a_descontar) puntos,
                            SUM(0)         gf,
                            SUM(0)         gc,
                            SUM(0)         df,
                            e.idequipo     id,
                            e.nombre_equipo,
                            SUM(0)         pj
                        FROM
                            descuentos_puntos dp
                            INNER JOIN zonas z
                                ON   dp.idzona = z.idzona
                            INNER JOIN equipos e
                                ON   dp.idequipo = e.idequipo
                        WHERE
                            z.idzona = :p3
                        GROUP BY
                            e.idequipo,
                            e.nombre_equipo
                    )
                )            AS tabla
            GROUP BY
                id,
                nombre_equipo
            ORDER BY
                pun DESC,
                df DESC,
                gf DESC,
                gc ASC,
                gan ASC,
                emp ASC,
                per DESC"),
            array('p1' => $this->idzona,'p2' => $this->idzona,'p3' => $this->idzona));
        return $tabla;
    }

    public function Goleadores(){
        $goleadores =  DB::select(DB::raw("SELECT sum(phj.goles_favor) goles,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo
                              FROM partido_has_jugador phj
                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                            INNER JOIN zonas z ON z.idzona = f.idzona
                            WHERE z.idzona= :p1
                            AND e.es_libre=0
                            GROUP BY j.nombre_jugador ,j.apellido_jugador, e.nombre_equipo
                            ORDER BY goles DESC
                            LIMIT 10"), array(
            'p1' => $this->idzona));
        return $goleadores;

    }

    public function Tarjetas()
    {
        $tarjetas =  DB::select(DB::raw("SELECT DISTINCT tamtaz.idjugador, tamtaz.nombre_jugador, tamtaz.nombre_equipo,  tamtaz.fecha_ta, tamtaz.ta ,tamtaz.fecha_taz, tamtaz.taz ,
                                            tar.fecha_tr, tar.tar
                                            FROM
                                            (SELECT DISTINCT tam.fecha_ta, tam.ta ,taz.fecha_taz, taz.taz ,tam.nombre_jugador, tam.nombre_equipo, tam.idjugador FROM
                                            (SELECT max(f.fecha)fecha_ta, sum(phj.tarjeta_amarilla) ta,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona = :p1
                                            AND e.es_libre=0
                                            AND phj.tarjeta_amarilla<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_amarilla) >0) AS tam
                                            LEFT JOIN
                                            (SELECT max(f.fecha)fecha_taz, sum(phj.tarjeta_azul) taz,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona = :p2
                                            AND e.es_libre=0
                                            AND phj.tarjeta_azul<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_azul) >0) AS taz
                                            ON tam.idjugador = taz.idjugador

                                            UNION ALL

                                            SELECT DISTINCT tam.fecha_ta, tam.ta ,taz.fecha_taz, taz.taz ,taz.nombre_jugador, taz.nombre_equipo, taz.idjugador FROM
                                            (SELECT max(f.fecha)fecha_ta, sum(phj.tarjeta_amarilla) ta,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona = :p3
                                            AND e.es_libre=0
                                            AND phj.tarjeta_amarilla<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_amarilla) >0) AS tam
                                            RIGHT JOIN
                                            (SELECT max(f.fecha)fecha_taz, sum(phj.tarjeta_azul) taz,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona = :p4
                                            AND e.es_libre=0
                                            AND phj.tarjeta_azul<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_azul) >0) AS taz
                                            ON tam.idjugador = taz.idjugador) AS tamtaz

                                            LEFT JOIN

                                            (SELECT max(f.fecha)fecha_tr, sum(phj.tarjeta_roja) tar,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo,j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona = :p5
                                            AND e.es_libre=0
                                            AND phj.tarjeta_azul<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_roja) >0) AS tar
                                            ON  tamtaz.idjugador = tar.idjugador

                                            UNION


                                            SELECT DISTINCT tar.idjugador, tar.nombre_jugador, tar.nombre_equipo,  tamtaz.fecha_ta, tamtaz.ta ,tamtaz.fecha_taz, tamtaz.taz ,
                                            tar.fecha_tr, tar.tar
                                            FROM
                                            (SELECT DISTINCT tam.fecha_ta, tam.ta ,taz.fecha_taz, taz.taz ,tam.nombre_jugador, tam.nombre_equipo, tam.idjugador FROM
                                            (SELECT max(f.fecha)fecha_ta, sum(phj.tarjeta_amarilla) ta,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona = :p6
                                            AND e.es_libre=0
                                            AND phj.tarjeta_amarilla<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_amarilla) >0) AS tam
                                            LEFT JOIN
                                            (SELECT max(f.fecha)fecha_taz, sum(phj.tarjeta_azul) taz,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona = :p7
                                            AND e.es_libre=0
                                            AND phj.tarjeta_azul<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_azul) >0) AS taz
                                            ON tam.idjugador = taz.idjugador

                                            UNION ALL

                                            SELECT DISTINCT tam.fecha_ta, tam.ta ,taz.fecha_taz, taz.taz ,taz.nombre_jugador, taz.nombre_equipo, taz.idjugador FROM
                                            (SELECT max(f.fecha)fecha_ta, sum(phj.tarjeta_amarilla) ta,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona= :p8
                                            AND e.es_libre=0
                                            AND phj.tarjeta_amarilla<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_amarilla) >0) AS tam
                                            RIGHT JOIN
                                            (SELECT max(f.fecha)fecha_taz, sum(phj.tarjeta_azul) taz,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona = :p9
                                            AND e.es_libre=0
                                            AND phj.tarjeta_azul<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_azul) >0) AS taz
                                            ON tam.idjugador = taz.idjugador) AS tamtaz

                                            RIGHT JOIN

                                            (SELECT max(f.fecha)fecha_tr, sum(phj.tarjeta_roja) tar,CONCAT(COALESCE(j.apellido_jugador,''),', ',COALESCE(j.nombre_jugador,'')) as nombre_jugador, e.nombre_equipo,j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idzona= :p10
                                            AND e.es_libre=0
                                            AND phj.tarjeta_roja<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_roja) >0) AS tar
                                            ON  tar.idjugador =tamtaz.idjugador

                                            ORDER BY ta DESC, taz DESC, tar DESC  "), array('p1' => $this->idzona,'p2' => $this->idzona,'p3' => $this->idzona,'p4' => $this->idzona,'p5' => $this->idzona,
            'p6' => $this->idzona,'p7' => $this->idzona,'p8' => $this->idzona,'p9' => $this->idzona,'p10' => $this->idzona));
        return $tarjetas;
    }

    public function Sancionados()
    {

        $tabla =  DB::select(DB::raw("SELECT
                                        aux1.*,
                                        (
                                            aux1.sancion -(
                                                (
                                                    SELECT
                                                        count(*)
                                                    FROM
                                                        fechas f2
                                                        INNER JOIN zonas z2
                                                            ON   z2.idzona = f2.idzona
                                                    WHERE
                                                        f2.fecha >= aux1.fecha AND f2.fecha <  CURRENT_DATE
                                                        AND z2.idzona = :p1
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
                                                        sum(phj.cantidad_fechas_sancion) sancion,
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
                                                        AND z.idzona = :p2
                                                    GROUP BY
                                                        j.nombre_jugador,
                                                        j.apellido_jugador,
                                                        e.nombre_equipo,
                                                        f.fecha
                                                ) AS aux
                                            WHERE
                                                EXISTS (
                                                    SELECT
                                                        count(*)
                                                    FROM
                                                        fechas f
                                                        INNER JOIN zonas z
                                                            ON   z.idzona = f.idzona
                                                    WHERE
                                                        (f.fecha BETWEEN aux.fecha AND (CURRENT_DATE - INTERVAL 1 DAY))
                                                        AND z.idzona = :p3
                                                    HAVING COUNT(*) <=aux.sancion
                                                    AND
                                                         count(*) > 0
                                                )
                                        )  AS aux1"), array('p1' => $this->idzona,'p2' => $this->idzona,'p3' => $this->idzona));
        return $tabla;
    }

    public function TarjetasEquipos()
    {
        $tabla =  DB::select(DB::raw("SELECT a1.*, a2.pj FROM (SELECT
                                            e.nombre_equipo,
                                            SUM(COALESCE(phj.tarjeta_amarilla,0)) ta ,
                                            SUM(COALESCE( phj.tarjeta_roja,0)) tr ,
                                            p.idzona FROM partido_has_jugador phj
                                                INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                                INNER JOIN equipos e ON e.idequipo = j.idequipo
                                                INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                                WHERE p.idzona = :p2

                                                GROUP BY e.nombre_equipo, p.idzona
                                ORDER BY tr, ta)  AS a1
                                INNER JOIN
                                (SELECT count(DISTINCT p.idpartido) pj, e.nombre_equipo FROM partidos p
                                INNER JOIN equipos e ON p.idequipo_local = e.idequipo OR p.idequipo_visitante = e.idequipo
                                WHERE p.idzona = :p1 and p.fue_jugado=1
                                GROUP BY e.nombre_equipo) AS a2
                                ON a1.nombre_equipo = a2.nombre_equipo
                                ORDER BY tr,ta"), array(
                                    'p1' => $this->idzona, 'p2'=> $this->idzona));
        return $tabla;
    }
}
