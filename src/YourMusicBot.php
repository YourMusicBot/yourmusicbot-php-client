<?php

namespace YourMusicBotAPI;
use GuzzleHttp\Client;

class YourMusicBot
{
    private $webClient;
    private $botManager;
    private $requestURL;
    private $apiToken;
    public function __construct($apiToken = null) {
        $this->setWebClient();
        $this->apiToken = $apiToken;
        $this->requestURL = 'https://YMB-Control.eu/api/v2/';
    }

    public function setWebClient()
    {
        $this->webClient = new Client([
            'timeout' => 30,
            'allow_redirects' => false
        ]);
    }

    public function getWebClient() 
    {
        return $this->webClient;
    }

    private function request($path, $parameters = [])
    {
        $fullURL = $this->requestURL.$path;

        if (!is_array($parameters)) throw new InvalidArgumentException();
        
        $parameters['apiToken'] = $this->apiToken ? $this->apiToken : $_ENV['YMB_API_TOKEN'];

        if (empty($this->apiToken ? $this->apiToken : $_ENV['YMB_API_TOKEN'])) throw new InvalidArgumentException();
       
        return $this->getWebClient()->post($fullURL, [
            'verify' => false,
            'form_params' => $parameters,
        ]);

    }


    public function webCall($path, $parameters = [])
    {
        $request = $this->request($path, $parameters);
        $return = $request->getBody()->__toString();
        return json_decode($return);
        
    }

    public function getBotManager() {
        if (!$this->botManager) {
            $this->botManager = new BotManager($this);
        }
        return $this->botManager;
    }

    // TODO: Implement the accounting manager
    /*public function getAccountingManager() {
        if (!$this->accountingManager) {
            $this->accountingManager = new AccountingManager($this);
        }
        return $this->accountingManager;
    }*/
}