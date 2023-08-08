<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class WebQueueController extends Controller
{
    public function index()
    {
        $appointment = $this->getFirstInQueue();
        $title = "Queue";
        return view('queue', compact('appointment', 'title'));
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


        $allAppointments = [];
        // $allAppointments = $highAppointments->merge($normalAppointments)->merge($lowAppointments);
        // dd($lowAppointments);
        // dd("JOMAR");
        // dd($highAppointments);
        foreach($highAppointments as $appointmentS) {
            $allAppointments[] = $appointmentS;
        }

        foreach($normalAppointments as $appointmentS) {
            $allAppointments[] = $appointmentS;
        }

        foreach($lowAppointments as $appointmentS) {
            $allAppointments[] = $appointmentS;
        }

        if(count($allAppointments) > 0)
        {
            $appointment = $allAppointments[0];
            $appointment->status = Appointment::STATUS_ONGOING;
            $appointment->save();
        }



        return $appointment;
    }
}
