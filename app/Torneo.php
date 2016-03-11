<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

class Torneo extends Model{

    use SoftDeletes;

    protected $table='torneos';

    protected $fillable = ['nombre_torneo','observaciones_torneo','idtipo_torneo','fecha_baja','tablas_x_torneo','estadisticas_x_torneo'];

    protected $primaryKey = 'idtorneo';

    public function MensajeConfiguracion()
    {
        $mensaje="";
        if($this->tablas_x_torneo ==1)
        {
            $mensaje=$mensaje . 'Las tablas de posiciones se calculan por Torneo. - ';
        }
        else
        {
            $mensaje=$mensaje . 'Las tablas de posiciones se calculan por Zonas. - ';
        }
        if($this->estadisticas_x_torneo ==1)
        {
           $mensaje = $mensaje . 'Las Estadisticas se calculan por Torneo. - ';
        }
        else
        {
            $mensaje = $mensaje . 'Las Estadisticas se calculan por Zonas. - ';
        }
        return $mensaje;
    }

    public function TablasXTorneo()
    {
        if($this->tablas_x_torneo ==1)
        {
            return 'SI';
        }
        else
        {
            return 'NO';
        }
    }
    public function EstadisticasXTorneo()
    {
        if($this->estadisticas_x_torneo ==1)
        {
            return 'SI';
        }
        else
        {
            return 'NO';
        }
    }

    public function TipoTorneo()
    {
        return $this->hasOne('torneo\TipoTorneo', 'idtipo_torneo','idtipo_torneo');
    }
    public function ListEquipos()
    {
       $list = new \Illuminate\Database\Eloquent\Collection();
        foreach ($this->ListZonas as $zona)
        {
            foreach($zona->ListEquipos as $eq)
            {
                $list->add($eq);
            }

        }
        return   $list;
      // return $list;
        //return $this->belongsToMany('torneo\Equipo','torneo_equipo','torneo_idtorneo','equipo_idequipo')->orderBy('nombre_equipo');
    }
    public function ListZonas()
    {
        return $this->hasMany('torneo\Zona','idtorneo','idtorneo')->orderBy('orden');
    }
    public function ListFechas()
    {
        $list = new \Illuminate\Database\Eloquent\Collection();
        foreach ($this->ListZonas as $zona)
        {
            //$list->push($zona->ListEquipos);

            foreach($zona->ListFechas as $f)
            {$list->add($f);}

        }
        return   $list;

    }

    public function TablaPosiciones()
    {

        $tabla =  DB::select(DB::raw("SELECT sum(emp) emp,sum(gan) gan,sum(per) per, sum(puntos) pun, sum(gf) gf, sum(gc) gc , sum(df) df, sum(pj) pj, id, nombre_equipo FROM
                            (
                            (SELECT sum(p.empatado_local) emp ,sum(p.ganado_local) gan,sum(p.perdido_local) per , sum(p.puntos_local) puntos, sum(p.goles_local) gf , sum(p.goles_visitante) gc,
                            sum(p.goles_local) - sum(p.goles_visitante) df , p.idequipo_local id , e.nombre_equipo, count(*) pj
                              FROM partidos p
                              INNER JOIN equipos e ON p.idequipo_local = e.idequipo
                              INNER JOIN fechas f ON f.idfecha = p.idfecha
                              INNER JOIN zonas z ON z.idzona = p.idzona
                            WHERE p.fue_jugado=1 AND z.idtorneo = :p1
                            AND f.es_play_off =0
                            AND e.es_libre=0
                            GROUP BY p.idequipo_local)

                            UNION  all

                            (SELECT sum(p.empatado_visitante) emp,sum(p.ganado_visitante) gan,sum(p.perdido_visitante) per , sum(p.puntos_visitante) puntos , sum(p.goles_visitante) gf, sum(p.goles_local) gc,
                            sum(p.goles_visitante) - sum(p.goles_local) df , p.idequipo_visitante id , e.nombre_equipo, count(*) pj
                              FROM partidos p
                              INNER JOIN equipos e ON p.idequipo_visitante = e.idequipo
                              INNER JOIN fechas f ON f.idfecha = p.idfecha
                              INNER JOIN zonas z ON z.idzona = p.idzona
                            WHERE p.fue_jugado=1 AND z.idtorneo = :p2
                            AND f.es_play_off=0
                            AND e.es_libre=0
                            GROUP BY  p.idequipo_visitante)
                            ) AS tabla
                            GROUP BY id, nombre_equipo
                            ORDER BY pun desc, df  DESC"), array(
                                            'p1' => $this->idtorneo,'p2' => $this->idtorneo));
        return $tabla;
    }

    public function Goleadores(){
        $goleadores =  DB::select(DB::raw("SELECT sum(phj.goles_favor) goles,j.nombre_jugador, e.nombre_equipo
                              FROM partido_has_jugador phj
                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                            INNER JOIN zonas z ON z.idzona = f.idzona
                            WHERE z.idtorneo= :p1
                            AND e.es_libre=0
                            GROUP BY j.nombre_jugador, e.nombre_equipo
                            ORDER BY goles DESC
                            LIMIT 10"), array(
                            'p1' => $this->idtorneo));
        return $goleadores;

    }

    public function TarjetasAmarillas()
    {
        $amonestados =  DB::select(DB::raw("SELECT max(f.fecha)fecha, sum(phj.tarjeta_amarilla) ta,j.nombre_jugador, e.nombre_equipo
                              FROM partido_has_jugador phj
                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                            INNER JOIN zonas z ON z.idzona = f.idzona
                            WHERE z.idtorneo= :p1
                            AND e.es_libre=0
                            AND phj.tarjeta_amarilla<>0
                            GROUP BY j.nombre_jugador, e.nombre_equipo
							HAVING sum(phj.tarjeta_amarilla) >0
                            ORDER BY ta DESC"), array('p1' => $this->idtorneo));
        return $amonestados;
    }

    public function Sancionados()
    {

        $tabla =  DB::select(DB::raw("SELECT  aux1.*, (aux1.sancion - ((SELECT count(*) FROM fechas f2 INNER JOIN zonas z2 ON z2.idoza = f2.idzona WHERE f2.fecha BETWEEN aux1.fecha AND CURRENT_DATE AND  z2.idtorneo=:p1)-1)) fechas_restantes
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
                                    WHERE p.fue_jugado=1 and f.fecha<= CURRENT_DATE AND z.idtorneo=:p2
                                    GROUP BY j.nombre_jugador, phj.cantidad_fechas_sancion, f.fecha) AS aux
                                    WHERE EXISTS (SELECT count(*) FROM fechas f INNER JOIN zonas z ON z.idoza = f.idzona WHERE f.fecha  BETWEEN aux.fecha AND CURRENT_DATE AND z.idtorneo=:p3 HAVING count(*) <=aux.sancion )

                                    )AS aux1

                                    "), array('p1' => $this->idtorneo,'p2' => $this->idtorneo,'p3' => $this->idtorneo));
        return $tabla;
    }

    //Propiedades Sin mapeo
    private  $activo;
    /**
     * @return Solo Lectura
     */
    public function Activo()
    {
        if($this->deleted_at ==null)
        {
            return 'SI';
        }
        else
        {
            return 'NO';
        }
    }

    public function Tarjetas()
    {
        $tarjetas =  DB::select(DB::raw("SELECT DISTINCT tamtaz.idjugador, tamtaz.nombre_jugador, tamtaz.nombre_equipo,  tamtaz.fecha_ta, tamtaz.ta ,tamtaz.fecha_taz, tamtaz.taz ,
                                            tar.fecha_tr, tar.tar
                                            FROM
                                            (SELECT DISTINCT tam.fecha_ta, tam.ta ,taz.fecha_taz, taz.taz ,tam.nombre_jugador, tam.nombre_equipo, tam.idjugador FROM
                                            (SELECT max(f.fecha)fecha_ta, sum(phj.tarjeta_amarilla) ta,j.nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p1
                                            AND e.es_libre=0
                                            AND phj.tarjeta_amarilla<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_amarilla) >0) AS tam
                                            LEFT JOIN
                                            (SELECT max(f.fecha)fecha_taz, sum(phj.tarjeta_azul) taz,j.nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p2
                                            AND e.es_libre=0
                                            AND phj.tarjeta_azul<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_azul) >0) AS taz
                                            ON tam.idjugador = taz.idjugador

                                            UNION ALL

                                            SELECT DISTINCT tam.fecha_ta, tam.ta ,taz.fecha_taz, taz.taz ,taz.nombre_jugador, taz.nombre_equipo, taz.idjugador FROM
                                            (SELECT max(f.fecha)fecha_ta, sum(phj.tarjeta_amarilla) ta,j.nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p3
                                            AND e.es_libre=0
                                            AND phj.tarjeta_amarilla<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_amarilla) >0) AS tam
                                            RIGHT JOIN
                                            (SELECT max(f.fecha)fecha_taz, sum(phj.tarjeta_azul) taz,j.nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p4
                                            AND e.es_libre=0
                                            AND phj.tarjeta_azul<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_azul) >0) AS taz
                                            ON tam.idjugador = taz.idjugador) AS tamtaz

                                            LEFT JOIN

                                            (SELECT max(f.fecha)fecha_tr, sum(phj.tarjeta_roja) tar,j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p5
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
                                            (SELECT max(f.fecha)fecha_ta, sum(phj.tarjeta_amarilla) ta,j.nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p6
                                            AND e.es_libre=0
                                            AND phj.tarjeta_amarilla<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_amarilla) >0) AS tam
                                            LEFT JOIN
                                            (SELECT max(f.fecha)fecha_taz, sum(phj.tarjeta_azul) taz,j.nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p7
                                            AND e.es_libre=0
                                            AND phj.tarjeta_azul<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_azul) >0) AS taz
                                            ON tam.idjugador = taz.idjugador

                                            UNION ALL

                                            SELECT DISTINCT tam.fecha_ta, tam.ta ,taz.fecha_taz, taz.taz ,taz.nombre_jugador, taz.nombre_equipo, taz.idjugador FROM
                                            (SELECT max(f.fecha)fecha_ta, sum(phj.tarjeta_amarilla) ta,j.nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p8
                                            AND e.es_libre=0
                                            AND phj.tarjeta_amarilla<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_amarilla) >0) AS tam
                                            RIGHT JOIN
                                            (SELECT max(f.fecha)fecha_taz, sum(phj.tarjeta_azul) taz,j.nombre_jugador, e.nombre_equipo, j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p9
                                            AND e.es_libre=0
                                            AND phj.tarjeta_azul<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_azul) >0) AS taz
                                            ON tam.idjugador = taz.idjugador) AS tamtaz

                                            RIGHT JOIN

                                            (SELECT max(f.fecha)fecha_tr, sum(phj.tarjeta_roja) tar,j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            FROM partido_has_jugador phj
                                            INNER JOIN jugadores j ON j.idjugador = phj.idjugador
                                            INNER JOIN partidos p ON p.idpartido = phj.idpartido
                                            INNER JOIN fechas f ON f.idfecha = p.idfecha
                                            INNER JOIN zonas z ON z.idzona = f.idzona
                                            INNER JOIN equipos e ON e.idequipo = j.idequipo
                                            WHERE z.idtorneo= :p10
                                            AND e.es_libre=0
                                            AND phj.tarjeta_roja<>0
                                            GROUP BY j.nombre_jugador, e.nombre_equipo,j.idjugador
                                            HAVING sum(phj.tarjeta_roja) >0) AS tar
                                            ON  tar.idjugador =tamtaz.idjugador

                                            ORDER BY ta DESC, taz DESC, tar DESC  "), array('p1' => $this->idtorneo,'p2' => $this->idtorneo,'p3' => $this->idtorneo,'p4' => $this->idtorneo,'p5' => $this->idtorneo,
                                                                                        'p6' => $this->idtorneo,'p7' => $this->idtorneo,'p8' => $this->idtorneo,'p9' => $this->idtorneo,'p10' => $this->idtorneo));
                return $tarjetas;
    }


}