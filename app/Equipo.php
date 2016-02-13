<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipo extends Model{


    protected $table='equipos';

    protected $fillable = ['nombre_equipo','escudo','foto','es_libre','nombre_usuario','clave','observaciones','mensaje','autogestion'];

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
        return $this->hasMany('torneo\Jugador','idequipo', 'idequipo');
    }

    public function ListTorneosParaCombo()
    {
        $tabla = DB::select(DB::raw("SELECT t.idtorneo, t.nombre_torneo FROM torneos t INNER JOIN torneo_equipo te ON te.torneo_idtorneo = t.idtorneo
                                        WHERE te.equipo_idequipo = :p1
                                        ORDER BY t.deleted_at ASC , t.created_at DESC"), array('p1' => $this->idequipo));
        return $tabla;
    }

    public function ListTorneos()
    {
        return $this->belongsToMany('torneo\Torneo','torneo_equipo','equipo_idequipo','torneo_idtorneo')->orderBy('nombre_torneo');
    }

    public static  function EquiposSinInscripcion()
    {
        $tabla = DB::select(DB::raw("SELECT e.idequipo, e.nombre_equipo  FROM equipos e
                                        WHERE e.idequipo NOT IN
                                        ( SELECT te.equipo_idequipo FROM torneo_equipo te INNER JOIN torneos t ON t.idtorneo = te.torneo_idtorneo
                                          WHERE t.deleted_at IS NULL)
                                        ORDER BY e.nombre_equipo"));
        return $tabla;
    }

}