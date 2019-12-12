<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use KursnaLista\KursnaListaInfoClient;

$app_id = "";
$exchange_client = KursnaListaInfoClient::make($app_id);