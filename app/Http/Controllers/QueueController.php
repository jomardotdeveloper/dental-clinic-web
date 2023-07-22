<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        $appointment = $this->getFirstInQueue();
        return view('end.queue', compact('appointment'));
    }

    public function getFirstInQueue()
    {
        $appointment = null;
        // Appointment with approved status and highest priority
        $highAppointments = Appointment::where('approval_status', Appointment::APPROVAL_APPROVED)->where('priority_level', Appointment::PRIORITY_URGENT)->where('status',  Appointment::STATUS_ONGOING)->orWhere('status', Appointment::STATUS_PENDING)->get();

        // Appointment with approved status and normal priority
        $normalAppointments = Appointment::where('approval_status', Appointment::APPROVAL_APPROVED)->where('priority_level', Appointment::PRIORITY_NORMAL)->where('status',  Appointment::STATUS_ONGOING)->orWhere('status', Appointment::STATUS_PENDING)->get();

        // Appointment with approved status and low priority
        $lowAppointments = Appointment::where('approval_status', Appointment::APPROVAL_APPROVED)->where('priority_level', Appointment::PRIORITY_LOW)->where('status',  Appointment::STATUS_ONGOING)->orWhere('status', Appointment::STATUS_PENDING)->get();

        $allAppointments = $highAppointments->merge($normalAppointments)->merge($lowAppointments);

        if($allAppointments->count() > 0)
        {
            $appointment = $allAppointments->first();
            $appointment->status = Appointment::STATUS_ONGOING;
            $appointment->save();
        }



        return $appointment;
    }
}
