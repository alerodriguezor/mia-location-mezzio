<?php

namespace Mia\Location\Model;

use Mia\Auth\Model\MIAUser;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $user_id Description for variable
 * @property mixed $title Description for variable
 * @property mixed $address Description for variable
 * @property mixed $address_number Description for variable
 * @property mixed $floor Description for variable
 * @property mixed $postal_code Description for variable
 * @property mixed $city_id Description for variable
 * @property mixed $state_id Description for variable
 * @property mixed $country_id Description for variable
 * @property mixed $status Description for variable
 * @property mixed $is_primary Description for variable
 * @property mixed $created_at Description for variable
 * @property mixed $updated_at Description for variable
 * @property mixed $deleted Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="user_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="title",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="address",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="address_number",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="floor",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="postal_code",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="city_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="state_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="country_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="status",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="is_primary",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="created_at",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="updated_at",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="deleted",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaUserAddress extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_user_address';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function city()
    {
        return $this->belongsTo(MiaCity::class, 'city_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function country()
    {
        return $this->belongsTo(MiaCountry::class, 'country_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function state()
    {
        return $this->belongsTo(MiaState::class, 'state_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(MIAUser::class, 'user_id');
    }


    /**
    * Configurar un filtro a todas las querys
    * @return void
    */
    protected static function boot(): void
    {
        parent::boot();
        
        static::addGlobalScope('exclude', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('mia_user_address.deleted', 0);
        });
    }
}