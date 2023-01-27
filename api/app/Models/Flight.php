<?php

namespace App\Models;

use App\Casts\AircraftCast;
use App\Casts\AirlineCast;
use App\Casts\AirportCast;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Flight extends BaseModel
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'flight_iata',
        'flight_number',
        'airline_id',
        'aircraft_id',
        'dep_airport_id',
        'dep_time',
        'arr_airport_id',
        'arr_time',
        'duration',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'airline_id',
        'aircraft_id',
        'dep_airport_id',
        'arr_airport_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        //'airline_id' => AirlineCast::class,
        //'aircraft_id' => AircraftCast::class,
        //'dep_airport_id' => AirportCast::class,
        //'arr_airport_id' => AirportCast::class,
        'duration' => 'integer'
    ];

    /**
     * @return HasOne
     */
    public function airline(): HasOne
    {
        return $this->hasOne(Airline::class, 'id', 'airline_id');
    }

    /**
     * @return HasOne
     */
    public function aircraft(): HasOne
    {
        return $this->hasOne(Aircraft::class, 'id', 'aircraft_id');
    }

    /**
     * @return HasOne
     */
    public function departureAirport(): HasOne
    {
        return $this->hasOne(Airport::class, 'id', 'dep_airport_id');
    }

    /**
     * @return HasOne
     */
    public function arrivalAirport(): HasOne
    {
        return $this->hasOne(Airport::class, 'id', 'arr_airport_id');
    }

    /**
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(FlightTicket::class, 'flight_id', 'id');
    }
}
