<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model{


    protected $table='imagenes';

    protected $fillable = ['titulo','imagen','mostrar','idtipo_imagen'];

    protected $primaryKey = 'idimagen';

    public function Activo()
    {
        if($this->mostrar ==1)
        {
            return 'SI';
        }
        else
        {
            return 'NO';
        }
    }

    public function TipoImagen()
    {
        return $this->hasOne('torneo\TipoImagen', 'idtipo_imagen','idtipo_imagen');
    }
}