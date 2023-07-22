<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    // STATUS
    public const STATUS_PENDING = 1;
    public const STATUS_ONGOING = 2;
    public const STATUS_CANCELLED = 3;
    public const STATUS_COMPLETED = 4;
    // APPROVAL STATUS
    public const APPROVAL_PENDING = 1;
    public const APPROVAL_APPROVED = 2;
    public const APPROVAL_REJECTED = 3;
    // PRIORITY LEVEL
    public const PRIORITY_URGENT = 1;
    public const PRIORITY_NORMAL = 2;
    public const PRIORITY_LOW = 3;
    public const PRIORITY_LEVELS = [
        self::PRIORITY_URGENT => 'Urgent',
        self::PRIORITY_NORMAL => 'Normal',
        self::PRIORITY_LOW => 'Low',
    ];

    protected $fillable = [
        'patient_id', #
        'dentist_id', #
        'date', #
        'schedule_id', ##
        'status', #
        'previous_appointment_id', #
        'consultation_hours', #
        'remarks', #
        'approval_status', #
        'priority_level', #
        'is_walk_in', #
    ];


    public function payment ()
    {
        return $this->hasOne(Payment::class);
    }
    public function patient()
    {
        return $this->belongsTo(Contact::class, 'patient_id');
    }

    public function dentist()
    {
        return $this->belongsTo(Contact::class, 'dentist_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointment_services');
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

    public function getStatusNameAttribute()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_ONGOING => 'Ongoing',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_COMPLETED => 'Completed',
        ][$this->status];
    }

    public function getPriorityLevelNameAttribute()
    {
        return self::PRIORITY_LEVELS[$this->priority_level];
    }

    public function getApprovalStatusNameAttribute()
    {
        return [
            self::APPROVAL_PENDING => 'Pending',
            self::APPROVAL_APPROVED => 'Approved',
            self::APPROVAL_REJECTED => 'Rejected',
        ][$this->approval_status];
    }

    public function getServiceIdsAttribute()
    {
        return $this->services->pluck('id')->toArray();
    }

    public function getServiceNamesAttribute()
    {
        return $this->services->pluck('name')->implode(', ');
    }

    public function getFormattedIdAttribute()
    {
        $id = strval($this->id);
        return "AP" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }

    public function getIsPaidAttribute()
    {
        return $this->payment !== null;
    }
    
}
