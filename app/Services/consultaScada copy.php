<?php // cliente php

// inclusao do arquivo da classe NuSOAP
include('nusoap/lib/nusoap.php');
include('ItemValue.php');

// define a localizacao do wsdl
$wsdl = 'http://150.162.164.129:8080/ScadaBR/services/API?wsdl';

// criacao de uma instancia do cliente
$cliente = new nusoap_client($wsdl, true);

// verifica se ocorreu algum erro na inicializacao do objeto
$err = $cliente->getError();

if ($err) {
  echo 'Erro no construtor<pre>".$err"</pre>';
}
else {
  echo 'Nenhum erro na inicializacao...' ;
  printf("\n");
}

$proxy = $cliente->getProxy();

$ItemValue = new ItemValue();

$ItemValue->itemName = "scadabr.clp.analogico.responsavel";
$ItemValue->dataType = 'STRING';
$ItemValue->value = 'Raphael';
$ItemValue->quality = 'GOOD';
$ItemValue->timestamp = time();

$iv1 = array("itemName" => "scadabr.clp.analogico.responsavel", "dataType" => 'String', "value" => 'Raphael', "quality" => 'GOOD',
"timestamp" => time());


$itemsList = array($iv1);
echo '<pre>';
print_r($itemsList);
echo '</pre>';

$param = array($itemsList);
echo '<pre>';
print_r($param);
echo '</pre>';

// chama o metodo browseTags
$result = $proxy->call('writeData', $param);

// Check for a fault
if ($proxy->fault) {
	echo '<h2>Fault</h2><pre>';
	print_r($result);
	echo '</pre>';
} else {
	// Check for errors
	$err = $proxy->getError();
	if ($err) {
		// Display the error
		echo '<h2>Error</h2><pre>' . $err . '</pre>';
	} else {
		// Display the result
		echo '<h2>Result</h2><pre>';
		print_r($result);
		echo '</pre>';
	}
}

if ($result == null) {
  echo 'Retorno nulo !';
}

//exibe o resultado
print_r($result);

?>