<?php

namespace KursnaLista\Api;

use KursnaLista\Utils\Util;
use KursnaLista\Utils\Response;
use KursnaLista\Utils\CurrencyList;
use KursnaLista\KursnaListaInfoClient;
use KursnaLista\ExchangeServiceInterface;
use KursnaLista\Utils\ExchangeRateTypeList;

class ConversionApi
{
    protected $client;
    static $data;

    public function __construct(ExchangeServiceInterface $client)
    {
        $this->client = $client;
    }

    private function buildUrl($from, $to, $amount, $exchange_type, $date)
    {
        $date = Util::parseDate($date);
        $base = KursnaListaInfoClient::API_BASE_URL;

        return "{$base}/{$this->client->app_id}/konvertor/{$from}/{$to}/{$amount}/{$date}/{$exchange_type}/json";
    }

    /**
     * @param string $from
     * @param string $to
     * @param $amount
     * @param mixed $exchange_type
     * @param null $date - If date is null, current day will be used
     * @return mixed
     * @throws \Exception
     */
    public function convert(string $from, string $to, $amount, $exchange_type = ExchangeRateTypeList::MIDDLE, $date = null)
    {
        $url = $this->buildUrl($from, $to, $amount, $exchange_type, $date);

        if (isset(static::$data[$url])) {
            return static::$data[$url];
        }

        $data = Response::getRequest($url);
        $result = Response::response($data);
        $value = round($result['value'], 2);
        static::$data[$url] = $value;

        return $value;
    }

    public function convertToday(string $from, string $to, $amount, $exchange_type = ExchangeRateTypeList::MIDDLE)
    {
        return $this->convert($from, $to, $amount, $exchange_type, 'now');
    }

    public function convertMiddleToday(string $from, string $to, $amount)
    {
        return $this->convertToday($from, $to, $amount);
    }

    public function convertFromEurToRsd($amount)
    {
        return $this->convertToday(CurrencyList::EUR, CurrencyList::RSD, $amount);
    }

    public function convertFromRsdToEur($amount)
    {
        return $this->convertToday(CurrencyList::RSD, CurrencyList::EUR, $amount);
    }

}