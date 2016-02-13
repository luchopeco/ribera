<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;

class TipoTorneo extends Model{

    protected $table='tipos_torneos';

    protected $fillable = ['nombre_tipo_torneo','idtipo_torneo','fecha_baja'];

    protected $primaryKey = 'idtipo_torneo';


}