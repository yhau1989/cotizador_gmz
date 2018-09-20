<?php

include($_SERVER["DOCUMENT_ROOT"] . "/cotizador_gmz/globals.php");
include($_SERVER["DOCUMENT_ROOT"] . "/cotizador_gmz/vendor/autoload.php");
use Medoo\Medoo;

class Tcotizador
{

    private $database;

    public function __construct(){
        $this->database = new Medoo([
            // required
            'database_type' => 'mysql',
            'database_name' => 'bgarantias',
            'server' => SQL_HOST,
            'username' => SQL_USER,
            'password' => SQL_PASS,
         
            // [optional]
            'charset' => 'utf8',
            'port' => SQL_PORT
        ]);
    }
    
    

    public function getCientes()
    {
        $rt = array(
            'error'=> 0,
            'mensaje' => null,
            'data' => null
        );

        $data = $this->database->select('tcliente',['codigo', 'cod_legal', 'tipo_cliente','nombre', 'apellido', 
                                                    'telefono', 'email', 'ciudad', 'direccion', 'observacion', 'estado']);
        
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





