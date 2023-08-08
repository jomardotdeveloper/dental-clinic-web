<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // route('sendmail', 'Hello World!');
        return view("dashboard", [
            'appointment_count' => \App\Models\Appointment::count(),
            'patient_count' => \App\Models\Contact::where('is_patient', true)->count(),
            'dentist_count' => \App\Models\Contact::where('is_dentist', true)->count(),
            'service_count' => \App\Models\Service::count(),
        ]);
    }
}
