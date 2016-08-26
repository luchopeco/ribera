<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipo extends Model{


    protected $table='equipos';

    protected $fillable = ['nombre_equipo','escudo','foto','es_libre','nombre_usuario','clave','observaciones','mensaje','autogestion','director_tecnico'];

    protected $primaryKey = 'idequipo';

    public function esLibre()
    {
        if($this->es_libre ==1)
        {
            return 'SI';
        }
        else
        {
            return 'NO';
        }
    }

    public function autogestionHabilitada()
    {
        if($this->autogestion ==1)
        {
            return 'SI';
        }
        else
        {
            return 'NO';
        }
    }

    public function ListJugadores()
    {
        return $this->hasMany('torneo\Jugador','idequipo', 'idequipo')->orderBy('apellido_jugador')->orderBy('nombre_jugador');
    }
    public function ListJugadoresWithTrashed()
    {
        return $this->hasMany('torneo\Jugador','idequipo', 'idequipo')->withTrashed()->orderBy('apellido_jugador')->orderBy('nombre_jugador');
    }
    public function ListJugadoresOnlyTrashed()
    {
        return $this->hasMany('torneo\Jugador','idequipo', 'idequipo')->onlyTrashed()->orderBy('apellido_jugador')->orderBy('nombre_jugador');
    }

    public function ListTorneosParaCombo()
    {
        $tabla = DB::select(DB::raw("SELECT t.idtorneo, t.nombre_torneo FROM torneos t INNER JOIN zonas z on z.idtorneo = t.idtorneo
                                        INNER JOIN torneo_equipo te ON te.zona_idzona= z.idzona
                                        WHERE te.equipo_idequipo = :p1
                                        ORDER BY t.deleted_at ASC , t.created_at DESC"), array('p1' => $this->idequipo));
        return $tabla;
    }

    public function ListZonas()
    {
        return $this->belongsToMany('torneo\Zona','torneo_equipo','equipo_idequipo','zona_idzona')->orderBy('nombre');
    }
    public function ListTorneos()
    {
        return $this->hasManyThrough('torneo\Torneo', 'torneo\Zona', 'idtorneo', 'idzona');
        return $this->belongsToMany('torneo\Torneo','torneo\Zona','equipo_idequipo','torneo_idtorneo')->orderBy('nombre_torneo');

    }

    public static  function EquiposSinInscripcion()
    {
        $tabla = DB::select(DB::raw("SELECT e.idequipo, e.nombre_equipo  FROM equipos e
                                        WHERE e.idequipo NOT IN
                                        ( SELECT DISTINCT te.equipo_idequipo FROM torneo_equipo te INNER JOIN zonas z on z.idzona = te.zona_idzona
                                          INNER JOIN torneos t ON t.idtorneo = z.idtorneo
                                          WHERE t.deleted_at IS NULL)
                                        ORDER BY e.nombre_equipo"));
        return $tabla;
    }

}