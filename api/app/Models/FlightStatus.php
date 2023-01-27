<?php

namespace App\Models;

class FlightStatus extends BaseModel
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'finished',
        'review',
        'edit',
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
     * @var string[]
     */
    protected $casts = [
        'finished' => 'boolean',
        'review' => 'boolean',
        'edit' => 'boolean',
    ];
}
