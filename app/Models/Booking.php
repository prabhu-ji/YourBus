<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'pickup_point',
        'dropping_point',
        'seats',
        'total_amount',
        'user_name',
        'user_email',
        'user_phone',
        'payment_status',
        'bus_id'
    ];
}
