<?php


namespace KursnaLista\Utils;


use Exception;

class HttpClient
{
    static $attempts = 1;

    public static function client($config)
    {
        return new \GuzzleHttp\Client($config);
    }

    public static function get($url, $headers = [], $basic_auth = [])
    {
        $client   = self::client([]);
        $data     = null;

        /**
         * Wrap whole request so make it repeat itself until
         * response is not null or attempts got decreased to zero
         */

        $attempts = static::$attempts;
        while ($attempts >= 0 && !$data) {

            try {
                $response = $client->request('GET', $url, [
                    "headers" => $headers,
                    "auth"    => $basic_auth,
                ]);

                $data = json_decode($response->getBody()->getContents(), true) ?? null;

            } catch (Exception $e) {
                $data = null;
            }

            $attempts--;
        }

        return $data;
    }

    public static function post($url, $payload = null, $headers = [], $basic_auth = [], $is_form = false)
    {
        $client   = self::client([]);
        $data     = null;

        /**
         * Wrap whole request so make it repeat itself until
         * response is not null or attempts got decreased to zero
         */

        $attempts = static::$attempts;
        while ($attempts >= 0 && !$data) {

            try {

                $options = [
                    "auth" => $basic_auth,
                    "headers" => $headers,
                ];

                if ($is_form) {
                    $options['form_params'] = $payload;
                } else {
                    $options['json'] = $payload;
                }

                $response = $client->request('POST', $url, $options);

                $data = json_decode($response->getBody()->getContents(), true) ?? null;

            } catch (Exception $e) {
                $data = null;
            }

            $attempts--;
            sleep(0.3);
        }

        return $data;
    }
}