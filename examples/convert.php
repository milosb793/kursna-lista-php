<?php

require_once __DIR__ . '/init.php';

$data = $exchange_client->conversion_api->convertFromEurToRsd(12);
print_r($data);