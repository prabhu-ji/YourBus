<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    use HasFactory;

    protected $table = 'fleet';

    protected $fillable = [
        'fleet_name',
        'fleet_slug',
        'seat_layout',
        'total_seats',
        'facilities',
        'status'
    ];
}
