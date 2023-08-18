<?php

namespace App\WebService;

class Correios
{

    /**
     * URL base da API
     */
    const URL_BASE = 'http://ws.correios.com.br';

    /**
     * Código de serviços Correios
     * @var string
     */
    const SERVICO_SEDEX = '04014';
    const SERVICO_SEDEX_12 = '04782';
    const SERVICO_SEDEX_10 = '04790';
    const SERVICO_SEDEX_HOJE = '04804';
    const SERVICO_PAC = '04510';

    /**
     * Códigos dos formatos dos Correios
     * @var integer 
     */
    const FORMATO_CAIXA_PACOTE = 1;
    const FORMATO_ROLO_PRISMA = 2;
    const FORMATO_ENVELOPE = 3;

    /**
     * Código da empresa com contrato
     * @var string
     */
    private $codigoEmpresa = '';

    /**
     * Senha da empresa com contrato
     * @var string
     */
    private $senhaEmpresa = '';

    /**
     * Método responsável pela definição dos dados de contrato do webservice dos Correios
     * @param string $codigoEmpresa
     * @param string $senhaEmpresa
     */
    public function __construct($codigoEmpresa = '', $senhaEmpresa = '')
    {
        $this->codigoEmpresa = $codigoEmpresa;
        $this->senhaEmpresa = $senhaEmpresa;
    }

    /**
     * Método para calcular o valor do frete por pacote
     * @param string $codigoServico
     * @param string $cepOrigem
     * @param string $cepDestino
     * @param float $peso
     * @param integer $formato
     * @param integer $omprimento
     * @param integer $altura
     * @param integer $largura
     * @param integer $diametro
     * @param boolean $maoPropria
     * @param integer $valorDeclarado
     * @param boolean $avisoRecebimento
     * @return object
     */
    public function calcularFrete($codigoServico, $cepOrigem, $cepDestino, $peso, $formato, $comprimento, $altura, $largura, $diametro = 0, $maoPropria = false, $valorDeclarado = 0, $avisoRecebimento = false)
    {

        // Parametros da URL de cálculo
        $parametros = [
            'nCdEmpresa'            => $this->codigoEmpresa,
            'sDsSenha'              => $this->senhaEmpresa,
            'nCdServico'            => $codigoServico,
            'sCepOrigem'            => $cepOrigem,
            'sCepDestino'           => $cepDestino,
            'nVlPeso'               => $peso,
            'nCdFormato'            => $formato,
            'nVlComprimento'        => $comprimento,
            'nVlAltura'             => $altura,
            'nVlLargura'            => $largura,
            'nVlDiametro'           => $diametro,
            'sCdMaoPropria'         => $maoPropria ? 'S' : 'N',
            'nVlValorDeclarado'     => $valorDeclarado,
            'sCdAvisoRecebimento'   => $avisoRecebimento ? 'S' : 'N',
            'StrRetorno'            => 'xml',
        ];

        // QUERY 
        $query = http_build_query($parametros);

        $resultado = $this->get('/calculador/CalcPrecoPrazo.aspx?'.$query);

        echo '<pre>';
        print_r($resultado);
        echo '</pre>'; exit;
    }

    /**
     * Método responsavel por realizar a consulta GET no  WebService dos Correios
     * @param string $resource
     * @return object
     */
    public function get($resource){
        //ENDPOINT  COMPLETO
        $endpoint = self::URL_BASE.$resource;

        //INICIA O CURL
        $curl = curl_init();
        
        //CONFIGURAÇÃO DO CURL
        curl_setopt_array($curl,[
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        //EXECUTAR A CONSULTA CURL
        $response = curl_exec($curl);

        //FECHA A CONEXÃO DO CURL
        curl_close($curl);

        echo '<pre>';
        print_r($response);
        echo '</pre>'; exit;
    }
}
