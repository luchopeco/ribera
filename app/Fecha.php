<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;

class Fecha extends Model{


    protected $table='fechas';

    protected $fillable = ['fecha','observaciones','idtorneo','numero_fecha','imagen_equipo_ideal',
        'imagen_figura_fecha','imagen_fecha','es_play_off'];

    protected $primaryKey = 'idfecha';

    //Propiedades Sin mapeo
    private  $playOff;
    /**
     * @return Solo Lectura
     */
    public function esPlayOff()
    {
        if($this->es_play_off ==1)
        {
            return 'SI';
        }
        else
        {
            return 'NO';
        }
    }


    public function Torneo()
    {
        return $this->belongsTo('torneo\Torneo','idtorneo');
    }

    public function ListPartidos()
    {
        return $this->hasMany('torneo\Partido','idfecha','idfecha');
    }

}