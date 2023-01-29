<?php

namespace App\Models;

use App\Casts\FlightStatusCast;
use App\Casts\FlightTicketCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class UserFlight extends BaseModel
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'flight_status_id',
        'rate',
        'comment',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
        'flight_ticket_id',
        'flight_status_id',
    ];

    /**
     * @var string[]
     */
    protected $guarded = [
        'flight_ticket_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'flight_ticket_id' => FlightTicketCast::class,
        //'flight_status_id' => FlightStatusCast::class,
    ];

    /**
     * @return void
     * @noinspection PhpUndefinedFieldInspection
     */
    protected static function booting(): void
    {
        parent::booting();
        static::creating(function (Model $model): void {
            $model->user_id = Auth::id();
            $model->flight_status_id = 1; // Upcoming.
        });

        static::updating(function (Model $model): void {
            $model->user_id = Auth::id();
        });
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function ticket(): HasOne
    {
        return $this->hasOne(FlightTicket::class, 'id', 'flight_ticket_id');
    }

    /**
     * @return HasOne
     */
    public function flightStatus(): HasOne
    {
        return $this->hasOne(FlightStatus::class, 'id', 'flight_status_id');
    }
}
