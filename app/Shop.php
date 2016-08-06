<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 店家座標
 *
 * @property-read int id
 * @property string name
 * @property string description
 * @property string url
 * @property string tel
 * @property \Carbon\Carbon|null open_at
 * @property \Carbon\Carbon|null close_at
 * @property \Carbon\Carbon|null created_at
 * @property \Carbon\Carbon|null updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|Position[]|null position
 *
 * @mixin \Eloquent
 */
class Shop extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'name',
        'description',
        'url',
        'tel',
        'open_at',
        'close_at',
    ];

    /* @var array $dates 自動轉換為Carbon的屬性 */
    protected $dates = ['open_at', 'close_at'];

    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}
