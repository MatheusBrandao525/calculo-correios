<?php
require __DIR__.'/vendor/autoload.php';

use \App\Webservice\Correios;

$objetoCorreios = new Correios();

$codigoServico = Correios::SERVICO_PAC;
$ceoOrigem = '76937000';
$cepDestino = '76932000';
$peso = 1;
$formato = Correios::FORMATO_CAIXA_PACOTE;
$comprimento = 15;
$altura = 15;
$largura = 15;
$diametro = 0;
$maoPropria = false;
$valorDeclarado = 0;
$avisoRecebimento = false;


$frete = $objetoCorreios->calcularFrete($codigoServico,$ceoOrigem,$cepDestino,$peso,$formato,$comprimento,$altura,$largura,$diametro,$maoPropria,$valorDeclarado,$avisoRecebimento);

echo '<pre>';
print_r($frete);
echo '</pre>';

?>