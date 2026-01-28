<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeaWeather extends Model
{
    protected $fillable = ['location', 'temp', 'wind', 'wave', 'status'];
}
