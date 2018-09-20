<?php

require_once "src/dataobject/Tcotizador.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$decode = json_decode(file_get_contents("php://input"));

if($decode){

     if(is_null($decode) && is_null($decode->cotizador) && is_null($decode->cotizador->id_rango_edad) 
        && is_null($decode->cotizador->val_min) && is_null($decode->cotizador->val_max))
     {
        $response['status'] = array(
            'type' => 'error',
            'value' => 'Invalid JSON value found.'
        );
     }
     else
     {
        
        $is_num = 0;

        if((!is_numeric($decode->cotizador->val_min)) || ($decode->cotizador->val_min <= 0))
            $is_num = 1;
            
        if((!is_numeric($decode->cotizador->id_rango_edad)) || ($decode->cotizador->id_rango_edad <= 0))
            $is_num = 1;
            
        if((!is_numeric($decode->cotizador->val_max)) || ($decode->cotizador->val_max <= 0))
            $is_num = 1;

        if($is_num == 1)
        {
            $response['status'] = array(
                'type' => 'error',
                'value' => 'Invalid JSON structure.'
            );
        }
        else
        {
            $Tcot = new Tcotizador();
            $data = $Tcot->getPlanes($decode->cotizador->id_rango_edad, $decode->cotizador->val_min, $decode->cotizador->val_max);


            if(isset($data['data']) || count($data['data']) > 0)
            {
                $response['status'] = array(
                    'type' => 'ok',
                    'value' => 'Valid JSON and found data in data base.' 
                    //,                    'planes' => $data['data']
                );

                $response['planes'] = $data['data'];
            }
            elseif($data['error'] > 0)
            {
                $response['status'] = array(
                    'type' => 'error',
                    'value' => 'Valid JSON but error in database.' ,
                    'error_data_base' => $data['mensaje']
                );
            }            
            else {
                $response['status'] = array(
                    'type' => 'ok',
                    'value' => 'Valid JSON but not found data in data base.'
                );
            }
            
        }
     }
 }
 else
 {
    $response['status'] = array(
        'type' => 'error',
        'value' => 'No JSON value set'
    );
 }
 $encode = json_encode($response);
 
 exit( $encode );

 



