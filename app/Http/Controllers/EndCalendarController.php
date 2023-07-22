<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class EndCalendarController extends Controller
{
    public function calendar()
    {
        $appointments = Appointment::all();

        if(auth()->user()->contact->is_patient)
        {
            $appointments = Appointment::where('patient_id', auth()->user()->id)->get();
        }
        else if(auth()->user()->contact->is_dentist)
        {
            $appointments = Appointment::where('dentist_id', auth()->user()->id)->get();
        }
        
        return view('end.calendar', [
            'appointments' => $appointments,
        ]);
    }
}
