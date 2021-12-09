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

    /** MIA ADDRESSES */
    $app->route('/mia-address/fetch/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Location\Handler\Address\FetchHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'mia_user_address.fetch');
    $app->route('/mia-address/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Location\Handler\Address\ListHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_user_address.list');
    $app->route('/mia-address/remove/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Location\Handler\Address\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'mia_user_address.remove');
    $app->route('/mia-address/save', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Location\Handler\Address\SaveHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_user_address.save');
```