<?php

namespace KursnaLista\Utils;


use Exception;

class Response
{
    const MESSAGES = [
        0 => ["description" => "-", "status" => "ok"],
        1 => ["description" => "Pogrešan api-id", "status" => "fail"],
        2 => ["description" => "api-id nije aktiviran", "status" => "fail"],
        3 => ["description" => "api-id je onemogućen", "status" => "fail"],
        4 => ["description" => "Nepravilan format datuma", "status" => "fail"],
        5 => ["description" => "Ne možete izabrati datum pre 15.05.2002. i posle 11.12.2019.", "status" => "fail"],
        6 => ["description" => "Valute nisu validne", "status" => "fail"],
        7 => ["description" => "Tip kursa nije validan", "status" => "fail"],
        8 => ["description" => "Greška u konvertovanju", "status" => "fail"],
    ];

    /**
     * @param $res
     * @return array|mixed
     * @throws Exception
     */
    public static function response($res)
    {
        if (empty($res)) {
            throw new Exception("Empty response");
        }

        $code = $res['code'];
        $result = $res['result'] ?? [];

        if ($code == 0) {
            return $result;
        }

        throw new Exception(static::MESSAGES[$code]['description']);
    }

    /**
     * @param $url
     * @return array|mixed
     * @throws Exception
     */
    public static function getRequest($url)
    {
        return HttpClient::get($url);
    }
}