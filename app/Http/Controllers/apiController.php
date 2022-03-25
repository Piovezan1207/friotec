<?php

namespace App\Http\Controllers;

// include('/econea/nusoap/src/nusoap.php');

use App\Http\Requests\apiFormRequest;
use App\Services\consultaScada;
use App\Services\setaScada;
use Illuminate\Http\Request;

use function App\Services\testes;

class apiController extends Controller
{
    public function index(apiFormRequest $request)
    {   


        $serie = [
            "ar" => "Ar Condicionado",
            "chiller" => ""
        ];

        $pedido =[
            "temperatura" => "Temperatura Processo",
            "status" => "Liga/Desliga",
            "setpoint" => "Setpoint Processo" 
        ];

        if ($request->tipo == "leitura")
        {
            $leitura = consultaScada::consulta($serie[$request->serie],$pedido[$request->pedido]);
            return $leitura['itemsList']['value'];
        }
        else if($request->tipo == "escrita")
        {
            $leitura = setaScada::setar($serie[$request->serie],$pedido[$request->pedido],$request->valor);
            return $leitura['itemsList']['value'];
        }
        else{
            return "Esse tipo não existe!";
        }
    }

}
