<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentData extends Model
{
    use HasFactory;

    protected $table = 'payment';

    protected $fillable = [
        'amount',
        'payment_id',
        'payment_done',
        'booking_id'
    ];
}
