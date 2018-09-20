<?php

include($_SERVER["DOCUMENT_ROOT"] . "/gmz/cotizador/cotizador_gmz/globals.php");
include($_SERVER["DOCUMENT_ROOT"] . "/gmz/cotizador/cotizador_gmz/vendor/autoload.php");
use Medoo\Medoo;

class Tcotizador
{

    private $database;

    public function __construct(){
        $this->database = new Medoo([
            // required
            'database_type' => 'mysql',
            'database_name' => DATABASE,
            'server' => SQL_HOST,
            'username' => SQL_USER,
            'password' => SQL_PASS,
         
            // [optional]
            'charset' => 'utf8',
            'port' => SQL_PORT
        ]);
    }
    
   

    public function getPlanes($id_rango_edad, $val_min, $val_max)
    {
        $rt = array(
            'error'=> 0,
            'mensaje' => null,
            'data' => null
        );

              
        $data = $this->database->select('planes_edad',
                    ['[><]aseguradoras'=>['planes_edad.id_aseguradora'=>'id'],
                     '[><]rango_edades]'=>['planes_edad.id_rango_edad'=>'id']],                    
                    ['planes_edad.id', 
                    'rango_edades.rango', 
                    'aseguradoras.razon_social', 
                    'planes_edad.nombre_plan', 
                    'planes_edad.anual', 
                    'planes_edad.semi_anual', 
                    'planes_edad.trimestral', 
                    'planes_edad.bimestral', 
                    'planes_edad.mensual', 
                    'planes_edad.dentro_usa', 
                    'planes_edad.fuera_usa', 
                    'planes_edad.estado'],
                    ['AND' => [
                        'planes_edad.id_rango_edad' => $id_rango_edad,
                        'planes_edad.anual[>=]' => $val_min,
                        'planes_edad.anual[<=]' => $val_max,
                        'planes_edad.estado' => 1,
                        'aseguradoras.estado' => 1]
                    ]
                );

        if(count($this->database->error()) > 0 && isset($this->database->error()[1]))
        {
            $rt['error'] = $this->database->error()[1];
            $rt['mensaje'] = $this->database->error()[2];
        }
        else
        {
            if($data && count($data) > 0)
            {
                $rt['error'] = 0;
                $rt['data'] = $data;   
            }
        }
        return  $rt;
    }

}





