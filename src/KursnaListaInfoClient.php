<?php

namespace KursnaLista;

use Exception;
use KursnaLista\Api\ConversionApi;
use KursnaLista\Api\CurrencyApi;

class KursnaListaInfoClient implements ExchangeServiceInterface
{
    const API_BASE_URL = 'https://api.kursna-lista.info';

    public $app_id;
    public $currency_api;
    public $conversion_api;

    private function __construct($app_id)
    {
        $this->app_id = $app_id;
        $this->currency_api = new CurrencyApi($this);
        $this->conversion_api = new ConversionApi($this);
    }

    public static function make($app_id)
    {
        if (empty($app_id)) {
            throw new Exception("Invalid App ID provided");
        }

        return new static($app_id);
    }

}