<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'consultation_hours'
    ];

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_services');
    }
}
