<?php

namespace App\Models;

use App\Casts\FlightCast;
use App\Casts\TravelClassCast;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FlightTicket extends BaseModel
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'flight_id',
        'travel_class_id',
        'capacity',
        'price',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'flight_id',
        'travel_class_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        //'flight_id' => FlightCast::class,
       // 'travel_class_id' => TravelClassCast::class,
        //'capacity' => 'integer',
        //'price' => 'float',
    ];

    /**
     * @return HasOne
     */
    public function flight(): HasOne
    {
        return $this->hasOne(Flight::class, 'id', 'flight_id');
    }

    /**
     * @return HasOne
     */
    public function travelClass(): HasOne
    {
        return $this->hasOne(TravelClass::class, 'id', 'travel_class_id');
    }
}
