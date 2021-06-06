# AgencyCoda Location Mezzio

1. Incluir libreria:
```bash
composer require mobileia/mia-core-mezzio
composer require mobileia/mia-auth-mezzio
composer require mobileia/mia-location-mezzio
```
5. Agregando las rutas:
```php
    /** MIA LOCATION **/
    $app->route('/mia-location/all-data', [\Mia\Location\Handler\AllDataHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-location.all-dat');
```