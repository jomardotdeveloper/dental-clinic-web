<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'dentist_id',
        'service_id',
        'schedule_id',
        'status',
        'previous_appointment_id',
        'consultation_hours',
        'remarks'
    ];

    public function patient()
    {
        return $this->belongsTo(Contact::class, 'patient_id');
    }

    public function dentist()
    {
        return $this->belongsTo(Contact::class, 'dentist_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function previousAppointment()
    {
        return $this->belongsTo(Appointment::class, 'previous_appointment_id');
    }

    public function getIsNewAppointmentAttribute()
    {
        return $this->previous_appointment_id === null;
    }
}
