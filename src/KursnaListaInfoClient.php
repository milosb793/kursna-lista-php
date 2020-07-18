<?php

namespace KursnaLista;

use KursnaLista\Api\ConversionApi;
use KursnaLista\Api\CurrencyApi;
use KursnaLista\Utils\KursnaListaException;

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

    /**
     * @param $app_id
     * @return static
     * @throws KursnaListaException
     */
    public static function make($app_id)
    {
        if (empty($app_id)) {
            throw new KursnaListaException("Invalid App ID provided");
        }

        return new static($app_id);
    }

}