<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;

class TipoImagen extends Model{


    protected $table='tipo_imagenes';

    protected $fillable = ['descripcion'];

    protected $primaryKey = 'idtipo_imagen';

}