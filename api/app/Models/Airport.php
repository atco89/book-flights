<?php

namespace App\Models;

use App\Casts\CityCast;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Airport extends BaseModel
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'city_id',
        'code',
        'name',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'city_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        //'city_id' => CityCast::class,
    ];

    /**
     * @return HasOne
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    /**
     * @return HasMany
     */
    public function departureFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'id', 'dep_airport_id');
    }

    /**
     * @return HasMany
     */
    public function arrivalFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'id', 'arr_airport_id');
    }
}
