<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;

class Arbitro extends Model{

    protected $table='arbitros';

    protected $fillable = ['nombre'];

    protected $primaryKey = 'idarbitro';


}