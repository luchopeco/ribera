<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model{

    protected $table='noticias';

    protected $fillable = ['titulo','fecha','texto','mostrar_en_home','mostrar_en_seccion','imagen','link'];

    protected $primaryKey = 'idnoticia'; 


}