<?php
require __DIR__.'/vendor/autoload.php';

use \App\Webservice\Correios;

$objetoCorreios = new Correios();

$codigoServico = Correios::SERVICO_PAC;
$cepOrigem = '76937000';
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


$frete = $objetoCorreios->calcularFrete($codigoServico,$cepOrigem,$cepDestino,$peso,$formato,$comprimento,$altura,$largura,$diametro,$maoPropria,$valorDeclarado,$avisoRecebimento);

    //VERIFICA O RESULTADO
    if(!$frete){
        die('Problemas ao calcular o frete');
    }


    //VERIFICA O ERRO
    if(strlen($frete->MsgErro)){
        die('Erro: '.$resultado->MsgErro);
    }

    //IMPRIME OS DADOS DA CONSULTA
    echo "CEP Origem: ".$cepOrigem."\n"; 
    echo "CEP Destino: ".$cepDestino."\n"; 
    echo "Valor: ".$frete->valor."\n"; 
    echo "Prazo: ".$frete->PrazoEntrega."\n"; 
?>