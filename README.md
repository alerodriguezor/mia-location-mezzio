# AgencyCoda Location Mezzio

1. Incluir libreria:
```bash
composer require agencycoda/mia-core-mezzio
composer require agencycoda/mia-auth-mezzio
composer require agencycoda/mia-location-mezzio
```
5. Agregando las rutas:
```php
    /** MIA LOCATION **/
    $app->route('/mia-location/all-data', [\Mia\Location\Handler\AllDataHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-location.all-data');
```