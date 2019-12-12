## KursnaLista.info PHP Wrapper
___

Register for APP Key here: https://www.kursna-lista.info/registracija

Create client using:

```PHP
$exchange_client = KursnaListaInfoClient::make($app_id);
```

### Available endpoints


##### Conversions 
Convert 
```php
$data = $exchange_client->conversion_api->convertFromEurToRsd(12);
```

_(More samples coming soon)_


##### Exchange List 
Get list for two days ago:
```php
$data = $exchange_client->currency_api->currencyExchangeList('-2 days');
```

_(More samples coming soon)_



Feel free to contribute!
___
Website: https://www.kursna-lista.info/