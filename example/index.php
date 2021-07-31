<?php

use Mia\Core\Helper\CsvHelper;
use Mia\Location\Model\MiaCity;
use Mia\Location\Model\MiaCountry;
use Mia\Location\Model\MiaState;

require '../vendor/autoload.php';

$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost:8889',
    'database'  => 'yoypr',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$data = CsvHelper::convertToArray(fopen("worldcities.csv", "r"));

$num = 0;
foreach($data as $city){
    if($num == 0){
        $num++;
        continue;
    }
    $country = MiaCountry::where('code', $city[6])->first();
    if($country == null){
        $country = new MiaCountry();
        $country->code = $city[6];
        $country->title = $city[4];
        $country->save();
    }

    $state = MiaState::where('title', $city[7])->first();
    if($state == null){
        $state = new MiaState();
        $state->country_id = $country->id;
        $state->title = $city[7];
        $state->save();
    }

    $item = new MiaCity();
    $item->state_id = $state->id;
    $item->title = $city[0];
    $item->latitude = $city[2];
    $item->longitude = $city[3];
    $item->save();
}

echo 'success'; exit();