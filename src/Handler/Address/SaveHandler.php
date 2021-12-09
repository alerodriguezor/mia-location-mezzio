<?php

namespace Mia\Location\Handler\Address;

use Mia\Location\Model\MiaCity;

/**
 * Description of SaveHandler
 * 
 * @OA\Post(
 *     path="/mia_user_address/save",
 *     summary="MiaUserAddress Save",
 *     tags={"MiaUserAddress"},
*      @OA\RequestBody(
 *         description="Object",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/MiaUserAddress")
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaUserAddress")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class SaveHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        // Obtener item a procesar
        $item = $this->getForEdit($request);
        // Guardamos data
        $item->title = $this->getParam($request, 'title', '');
        $item->address = $this->getParam($request, 'address', '');
        $item->address_number = $this->getParam($request, 'address_number', '');
        $item->floor = $this->getParam($request, 'floor', '');
        $item->postal_code = $this->getParam($request, 'postal_code', '');
        $item->city_id = $this->getParam($request, 'city_id', null);
        $item->state_id = $this->getParam($request, 'state_id', null);
        $item->country_id = $this->getParam($request, 'country_id', null);
        $item->status = intval($this->getParam($request, 'status', '0'));
        $item->is_primary = intval($this->getParam($request, 'is_primary', '0'));
        
        try {
            if($item->is_primary == 1){
                $this->resetPrimary($request);
            }

            $item->save();
        } catch (\Exception $exc) {
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-2, $exc->getMessage());
        }

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }

    protected function resetPrimary(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // get current user
        $user = $this->getUser($request);
        // Reset primary
        \Mia\Location\Model\MiaUserAddress::where('user_id', $user->id)->update(['is_primary' => 0]);
    }
    
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \App\Model\MiaUserAddress
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // get current user
        $user = $this->getUser($request);
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = \Mia\Location\Model\MiaUserAddress::where('id', $itemId)->where('user_id', $user->id)->first();
        // verificar si existe
        if($item === null){
            $item = new \Mia\Location\Model\MiaUserAddress(); 
            $item->user_id = $user->id;
            return $item;
        }
        // Devolvemos item para editar
        return $item;
    }
}