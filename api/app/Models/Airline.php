<?php

namespace App\Models;

use App\Casts\CountryCast;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Airline extends BaseModel
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'country_id',
        'code',
        'name',
        'image_path',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'country_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        //'country_id' => CountryCast::class,
    ];

    /**
     * @return HasOne
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * @return HasMany
     */
    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class, 'aircraft_id', 'id');
    }
}
