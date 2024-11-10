<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'routes';

    protected $fillable = [
        'route_name',
        'start_point',
        'end_point',
        'total_distance',
        'total_time',
        'status'
    ];
}
