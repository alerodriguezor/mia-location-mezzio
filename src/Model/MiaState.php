<?php

namespace Mia\Location\Model;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $country_id Description for variable
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
 *  property="country_id",
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
class MiaState extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_state';
    
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
    public function country()
    {
        return $this->belongsTo(MiaCountry::class, 'country_id');
    }
}