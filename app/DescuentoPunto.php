<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;

class DescuentoPunto extends Model{

    protected $table='descuentos_puntos';

    protected $fillable = ['observaciones','idzona','puntos_a_descontar','idequipo'];

    protected $primaryKey = 'id';

    public function Zona()
    {
        return $this->belongsTo('torneo\Zona','idzona');
    }
    public function Torneo()
    {
        return $this->Zona->Torneo();
    }

    public function Equipo()
    {
        return $this->hasOne('torneo\Equipo', 'idequipo','idequipo');
    }
}