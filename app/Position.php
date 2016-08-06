<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 店家座標
 *
 * @property-read int id
 * @property int shop_id
 * @property string description
 * @property float longitude
 * @property float latitude
 *
 * @property \Carbon\Carbon|null created_at
 * @property \Carbon\Carbon|null updated_at
 *
 * @property Shop|null shop
 *
 * @mixin \Eloquent
 */
class Position extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'shop_id',
        'description',
        'address',
        'longitude',
        'latitude',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
