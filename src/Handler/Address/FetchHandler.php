<?php

namespace Mia\Location\Handler\Address;

use Mia\Core\Exception\MiaException;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia_user_address/fetch/{id}",
 *     summary="MiaUserAddress Fetch",
 *     tags={"MiaUserAddress"},
 *     @OA\Parameter(
 *         name="id",
 *         description="Id of Item",
 *         required=true,
 *         in="path"
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaUserAddress")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 *
 * @author matiascamiletti
 */
class FetchHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Get Current User
        $user = $this->getUser($request);
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el tour en la DB
        $item = \Mia\Location\Model\MiaUserAddress::with(['city', 'state', 'country'])->where('id', $itemId)->where('user_id', $user->id)->first();
        // verificar si existe
        if($item === null){
            throw new MiaException('Not exist');
        }
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
}