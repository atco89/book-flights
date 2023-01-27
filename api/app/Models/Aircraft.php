<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Aircraft extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'aircrafts';

    /**
     * @var string[]
     */
    protected $fillable = [
        'model',
        'manufacturer',
        'capacity',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return HasMany
     */
    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class, 'aircraft_id', 'id');
    }
}
