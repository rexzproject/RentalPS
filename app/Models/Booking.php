<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'play_station_id',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'delivery_address',
        'delivery_city',
        'delivery_postal_code',
        'start_datetime',
        'end_datetime',
        'rental_type',
        'duration',
        'total_price',
        'status',
        'notes'
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'total_price' => 'decimal:2'
    ];

    public function playStation()
    {
        return $this->belongsTo(PlayStation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
