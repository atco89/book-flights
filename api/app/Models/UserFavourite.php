<?php

namespace App\Models;

use App\Casts\FlightCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class UserFavourite extends BaseModel
{

    /**
     * @var string[]
     */
    protected $guarded = [
        'flight_id',
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
        'flight_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        //'flight_id' => FlightCast::class,
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
    public function flight(): HasOne
    {
        return $this->hasOne(Flight::class, 'id', 'flight_id');
    }
}
