<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use torneo\Jugador;

class ReportesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.reportes');
    }

    public function listadojugadores()
    {
        Excel::create('Listado de Jugadores - Liga la Ribera',function($excel){
            $excel->sheet('Jugadores',function($sheet){


                $listJugadores =DB::select( DB::raw("SELECT DISTINCT
                                                    j.apellido_jugador Apellido,
                                                    j.nombre_jugador Nombre,
                                                    j.dni Documento,
                                                    DATE_FORMAT(j.fecha_nacimiento,'%d/%m/%Y') Fecha_Nacimiento,
                                                    e.nombre_equipo,
                                                    GROUP_CONCAT(DISTINCT CONCAT(t.nombre_torneo,' ', IF(t.deleted_at IS NULL, 'Activo', 'Inactivo')  ) SEPARATOR ' | ') AS Torneos
                                                    FROM jugadores j
                                                    INNER JOIN equipos e ON e.idequipo = j.idequipo
                                                    INNER JOIN torneo_equipo te ON te.equipo_idequipo = e.idequipo
                                                    INNER JOIN zonas z ON z.idzona = te.zona_idzona
                                                    INNER JOIN torneos t ON t.idtorneo = z.idtorneo
                                                    WHERE j.deleted_at IS NULL
                                                    GROUP BY
                                                    j.apellido_jugador,
                                                    j.nombre_jugador ,
                                                    j.dni ,
                                                    j.Fecha_Nacimiento,
                                                    e.nombre_equipo
                                                    ORDER BY e.nombre_equipo, j.apellido_jugador,j.nombre_jugador"));

                $arrj = array();
                foreach($listJugadores as $j)
                {
                    $arrj[]= array(
                        "Apellido"=>$j->Apellido,
                        "Nombre"=>$j->Nombre,
                        "Documento"=>$j->Documento,
                        "Fecha Nacimiento"=>$j->Fecha_Nacimiento,
                        "Equipo"=>$j->nombre_equipo,
                        "Torneos en los que participo"=>$j->Torneos,
                    );
                }

                $sheet->fromArray($arrj);
            });
        })->export('xls');
    }

}
