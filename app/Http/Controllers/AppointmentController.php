<?php

namespace App\Http\Controllers;

use App\Http\Traits\AppointmentTrait;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use AppointmentTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('appointments.index', [
            'title' => 'Appointments',
            'appointments' => Appointment::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appointments.create', [
            'title' => 'Create Appointment',
            'dentists' => Contact::availableDentistsToday()->get(),
            'patients' => Contact::patients()->get(),
            'services' => Service::all(),
            'appointments' => Appointment::all(),
            'priority_levels' => Appointment::PRIORITY_LEVELS,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'is_walk_in' => true,
            'approval_status' => Appointment::APPROVAL_APPROVED,
        ]);
        $apt = $this->createAppointment($request);

        if($apt["status"] == "failed") {
            return redirect()->back()->with(['error'=> $apt["error"]]);
        }

        return redirect()->route('appointments.index')->with(['success' =>  ['Appointment created successfully.']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', [
            'title' => 'Appointment Details',
            'appointment' => $appointment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', [
            'title' => 'Edit Appointment',
            'dentists' => Contact::availableDentistsToday()->get(),
            'patients' => Contact::patients()->get(),
            'services' => Service::all(),
            'appointments' => Appointment::all(),
            'priority_levels' => Appointment::PRIORITY_LEVELS,
            'appointment' => $appointment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $apt = $this->updateAppointment($request, $appointment->id);

        if($apt["status"] == "failed") {
            return redirect()->back()->with(['error'=> $apt["error"]]);
        }

        return redirect()->route('appointments.index')->with(['success' =>  ['Appointment updated successfully.']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with(['success'=> ['Appointment deleted successfully.']]);
    }
}
