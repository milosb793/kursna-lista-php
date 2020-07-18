<?php

namespace KursnaLista\Api;

use InvalidArgumentException;
use KursnaLista\ExchangeServiceInterface;
use KursnaLista\KursnaListaInfoClient;
use KursnaLista\Utils\KursnaListaException;
use KursnaLista\Utils\Response;
use KursnaLista\Utils\Util;

class CurrencyApi
{
    protected $client;
    static $data;

    public function __construct(ExchangeServiceInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $date
     * @return string
     * @throws InvalidArgumentException - In case of invalid date provided
     */
    private function buildUrl($date)
    {
        $base = KursnaListaInfoClient::API_BASE_URL;
        $date = Util::parseDate($date);

        return "{$base}/{$this->client->app_id}/kl_na_dan/{$date}/json";
    }

    /**
     * @param string $date
     * @return array|mixed
     * @throws InvalidArgumentException|KursnaListaException
     */
    public function currencyExchangeList($date = 'now')
    {
        $url = $this->buildUrl($date);

        if (isset(static::$data[$url])) {
            return static::$data[$url];
        }

        $data = Response::getRequest($url);

        static::$data[$url] = $data;

        return $data;
    }

}