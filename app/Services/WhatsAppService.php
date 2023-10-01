<?php

namespace App\Services;

Class WhatsAppService
{
    private $apiBaseUrl;

    public function __construct($apiKey)
    {
        $this->apiBaseUrl = "https://api.utalk.chat/send/";
    }

    public function sendMessage($apiKey, $toNumber, $message)
    {

        $url = $this->apiBaseUrl . $apiKey . '/?cmd=media&id=' . uniqid() . '&to' . $toNumber . '&msg' . urlencode($message);
        // contatena a url com os paramtros vindos do contrutor(url) e apiKey (env), toNumber e msg vindos dos parametros da função

        $response = file_get_contents($url);
        // Analisa a resposta


        if ($response === false) {
            return false; // trata falha no envio
        }

        $responseData = json_decode($response);


        if (isset($responseData->status) && $responseData->status === 'ok')
        {
            return true; // envia foi ok
        }

    return false;

    }


}


