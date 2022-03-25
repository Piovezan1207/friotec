<?php

namespace App\Services;


function testes()
{   
    $parameters = [
        "tipo" => "setpoint",
        "modelo" => "ar"];
    
      $options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => json_encode($parameters),
    'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
    )
);

$context  = stream_context_create( $options );
$json = file_get_contents("https://teste.industrialdroids.com/api", false, $context );

$data = json_decode($json);

dd($data);
}