<?php

require_once __DIR__ . '/init.php';

print_r($exchange_client->currency_api->currencyExchangeList('-2 days'));