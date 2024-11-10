<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trips';

    protected $fillable = [
        'title',
        'fleet_type',
        'route',
        'start_time',
        'end_time',
        'start_from',
        'end_to',
        'day_off',
    ];
}
