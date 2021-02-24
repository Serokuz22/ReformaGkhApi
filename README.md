ReformaGkhApi
=============
Api Laravel для взаимодействия с https://www.reformagkh.ru/api SOAP 

Установка: 
composer require serokuz/reforma-gkh-api

Публикуем config/reforma-gkh.php
php artisan vendor:publish --provider "Serokuz\ReformaGkhApi\ReformaGkhApiServiceProvider"

Необходимо указать login password с портала.

```php
$soap = new ReformaGkhApi();
$soap->login();
$res = $soap->getHouseProfileActual('FIAS ID - из базы fias');
```
