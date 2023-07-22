<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public const DENTIST_AVAILABILITIES = [
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday',
    ];

    public const USER_TYPES = [
        'is_dentist' => 'Dentist',
        'is_patient' => 'Patient',
        'is_staff' => 'Staff'
    ];

    protected $fillable = [
        'first_name', 
        'last_name', 
        'middle_name', 
        'contact_number', 
        'user_id', 
        'is_dentist', 
        'is_patient', 
        'is_admin', 
        'is_staff',
        'address',
        'birthdate',
        'dentist_availabilities'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patientAppointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function dentistAppointments()
    {
        return $this->hasMany(Appointment::class, 'dentist_id');
    }

    public function getFullNameAttribute()
    {
        if($this->is_dentist)
        {
            return "Dr. {$this->first_name} {$this->last_name}";
        }
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAvailabilitiesNamesAttribute()
    {
        $availabilities = explode(',', $this->dentist_availabilities);
        $availabilityNames = [];
        foreach($availabilities as $availability)
        {
            $availabilityNames[] = self::DENTIST_AVAILABILITIES[$availability];
        }
        return implode(', ', $availabilityNames);
    }

    public function scopePatients($query)
    {
        return $query->where('is_patient', true);
    }

    public function scopeAvailableDentistsToday($query)
    {
        $date = now();
        return $query->where('dentist_availabilities', 'LIKE', "%{$date->format('N')}%");
    }

}
