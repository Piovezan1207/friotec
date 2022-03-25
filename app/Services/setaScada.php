<?php

namespace App\Services;

use nusoap_client;

class setaScada 
{
    static public function setar($modelo, $var,$valor)
    {
        
        // define a localizacao do wsdl
        $wsdl = env('URL_SCADA');

        // criacao de uma instancia do cliente
        $cliente = new  nusoap_client($wsdl, true);
            
        // verifica se ocorreu algum erro na inicializacao do objeto
        $err = $cliente->getError();

        if ($err) {
        echo 'Erro no construtor<pre>".$err"</pre>';
        }
        // else {
        // echo 'Nenhum erro na inicializacao...' ;
        // printf("\n");
        // }



        $proxy = $cliente->getProxy();

        $itemPathList = array('itemPathList' => "$modelo.$var");

        $param = array($itemPathList);


            
            

        // Chama o metodo readData
        $result = $proxy->call('readData', $param);


        return($result);
    }
}