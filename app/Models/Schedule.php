<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['available_date', 'available_time', 'is_available'];

    protected $casts = ['available_date' => 'date', 'is_available' => 'boolean'];

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }
}