<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EndAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

        return view('end.appointments.index', [
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('end.appointments.create', [
            'dentists' => Contact::availableDentistsToday()->get(),
            'patients' => Contact::patients()->get(),
            'services' => Service::all(),
            'appointments' => Appointment::all(),
            'priority_levels' => Appointment::PRIORITY_LEVELS,
            'contact' => auth()->user()->contact,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required | date | after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error'=> $validator->errors()->all()]);
        }



        $appointment =  Appointment::create($request->all());
        $services = $request->input('services');
        $appointment->services()->attach($services);

        return redirect()->route('endappointments.index')->with(['success' =>  ['Appointment created successfully.']]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('end.appointments.show', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('end.appointments.edit', [
            'appointment' => $appointment,
            'dentists' => Contact::availableDentistsToday()->get(),
            'patients' => Contact::patients()->get(),
            'services' => Service::all(),
            'appointments' => Appointment::all(),
            'priority_levels' => Appointment::PRIORITY_LEVELS,
            'contact' => auth()->user()->contact,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required | date | after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error'=> $validator->errors()->all()]);
        }

        $appointment = Appointment::find($id);
        $appointment->update($request->all());
        $services = $request->input('services');
        $appointment->services()->sync($services);

        return redirect()->route('endappointments.index')->with(['success' => ['Appointment updated successfully.']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('endappointments.index')->with(['success'=> ['Appointment deleted successfully.']]);
    }

    public function approve($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->approval_status = Appointment::APPROVAL_APPROVED;
        $appointment->save();
        return redirect()->route('endappointments.index')->with(['success'=> ['Appointment approved successfully.']]);
    }

    public function reject($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->approval_status = Appointment::APPROVAL_REJECTED;
        $appointment->save();
        return redirect()->route('endappointments.index')->with(['success'=> ['Appointment rejected successfully.']]);
    }

    public function cancel($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = Appointment::STATUS_CANCELLED;
        $appointment->save();
        return redirect()->route('endappointments.index')->with(['success'=> ['Appointment cancelled successfully.']]);
    }

    public function complete($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = Appointment::STATUS_COMPLETED;
        $appointment->save();
        return redirect()->route('endappointments.index')->with(['success'=> ['Appointment completed successfully.']]);
    }
}
