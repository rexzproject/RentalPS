<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayStation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'controller_count',
        'hourly_rate',
        'daily_rate',
        'included_games',
        'image_url',
        'is_available'
    ];

    protected $casts = [
        'included_games' => 'array',
        'hourly_rate' => 'decimal:2',
        'daily_rate' => 'decimal:2',
        'is_available' => 'boolean'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
