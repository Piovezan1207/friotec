<?php

namespace App\Http\Controllers;

// include('/econea/nusoap/src/nusoap.php');

use App\Services\consultaScada;
use Illuminate\Http\Request;



class apiController extends Controller
{
    public function index(Request $request)
    {   

        $modelos = [
            "ar" => "Ar Condicionado",
            "chiller" => ""
        ];

        $tipos =[
            "temperatura" => "Temperatura Processo",
            "status" => "Liga/Desliga",
            "setpoint" => "Setpoint Processo" 
        ];

        // $modelo["ar"];
        $leitura = consultaScada::consulta($modelos[$request->modelo],$tipos[$request->tipo]);

        return $leitura['itemsList']['value'];

        // if($request->tipo == "temperatura")
        // {

        //     #consulta
        // }
    
        // else if($request->consulta == "status")
        // {
        //     return "O status é...";
        // }
    }

}
