<?php

namespace Mia\Location\Model;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $state_id Description for variable
 * @property mixed $title Description for variable
 * @property mixed $code Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="state_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="title",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="code",
 *  type="string",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaCity extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_city';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function state()
    {
        return $this->belongsTo(MiaState::class, 'state_id');
    }
}