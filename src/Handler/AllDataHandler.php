<?php

namespace Mia\Location\Handler;

use Mia\Location\Model\MiaCity;
use Mia\Location\Model\MiaCountry;
use Mia\Location\Model\MiaState;

/**
 * Description of ListHandler
 * 
 * @OA\Get(
 *     path="/mia-location/all-data",
 *     summary="Get all data",
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MIAPost")
 *     )
 * )
 *
 * @author matiascamiletti
 */
class AllDataHandler extends \Mia\Core\Request\MiaRequestHandler
{
    /**
     * 
     *
     * @var array
     */
    protected $data = [];
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $states = [];
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $cities = [];

    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Get all countries
        $this->data = MiaCountry::all()->toArray();
        // get All states
        $this->states = MiaState::all()->toArray();
        // get all cities
        $this->cities = MiaCity::all()->toArray();
        // Process States
        $this->processData();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($this->data);
    }

    protected function processData()
    {
        // for each countries
        for ($i=0; $i < count($this->data); $i++) { 
            $this->data[$i]['states'] = $this->getStatesByCountry($this->data[$i]['id']);
        }
    }

    protected function getStatesByCountry($countryId)
    {
        $result = [];
        foreach ($this->states as $state) {
            if($state['country_id'] != $countryId){
                continue;
            }

            $state['cities'] = $this->getCitiesByState($state['id']);

            $result[] = $state;
        }
        return $result;
    }

    protected function getCitiesByState($stateId)
    {
        $result = [];
        foreach ($this->cities as $city) {
            if($city['state_id'] != $stateId){
                continue;
            }

            $result[] = $city;
        }
        return $result;
    }
}