<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';
    protected $fillable = [
        'flight_id',
        'flight_number',
        'departure',
        'destination',
        'departure_time',
        'arrival_time',
        'price',
    ];
}
