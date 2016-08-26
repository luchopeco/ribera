<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model{


    protected $table='partidos';

    protected $fillable = ['idpartido','idfecha','idequipo_local','idequipo_visitante','goles_local',
        'goles_visitante','hora','idarbitro','idzona'];

    protected $primaryKey = 'idpartido';

    public function Zona()
    {
        return $this->hasOne('torneo\Zona', 'idzona','idzona');
    }

    public function Torneo()
    {

        return $this->Zona->Torneo();
    }

    public function Fecha()
    {
        return $this->hasOne('torneo\Fecha', 'idfecha','idfecha');
    }

    public function EquipoLocal()
    {
        return $this->hasOne('torneo\Equipo', 'idequipo','idequipo_local');
    }
    public function EquipoVisitante()
    {
        return $this->hasOne('torneo\Equipo', 'idequipo','idequipo_visitante');
    }
    public function Arbitro()
    {
        return $this->hasOne('torneo\Arbitro', 'idarbitro','idarbitro');
    }
    public function ListGoleadores()
    {
        return $this->belongsToMany('torneo\Jugador','partido_has_jugador','idpartido','idjugador')->withPivot('goles_favor', 'goles_contra','cantidad_fechas_sancion','tarjeta_amarilla','tarjeta_azul','tarjeta_roja')->withTrashed();
    }

}