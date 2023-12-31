<?php

namespace App\Http\Controllers;

use App\Http\Traits\AppointmentTrait;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    use AppointmentTrait;
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

        return view('appointments.index', [
            'title' => 'Appointments',
            'appointments' => $appointments
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

        // CHECKING IF DATE IS DIFFERENT
        $dateMessage = "Your appointment with Dr. " . $appointment->dentist->full_name . " has been rescheduled to " . $appointment->date;
        if($request->input('date') != $appointment->date) {
            Mail::raw($dateMessage, function ($message)  use ($appointment){
                $message->from("dres.dentalclinic.13@gmail.com", "dres.dentalclinic.13@gmail.com");
                $message->to($appointment->patient->user->email, 'Patient');
            });
        }



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

    public function cancel($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = Appointment::STATUS_CANCELLED;
        $appointment->save();
        return redirect()->route('web-queue')->with(['success'=> ['Appointment cancelled successfully.']]);
    }

    public function complete($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = Appointment::STATUS_COMPLETED;
        $appointment->save();
        return redirect()->route('web-queue')->with(['success'=> ['Appointment completed successfully.']]);
    }

    public function approve($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->approval_status = Appointment::APPROVAL_APPROVED;
        $appointment->save();
        $apmessage = "Your appointment with Dr. " . $appointment->dentist->full_name . " has been approved.";
        Mail::raw($apmessage, function ($message) use ($appointment) {
            $message->from("dres.dentalclinic.13@gmail.com", "dres.dentalclinic.13@gmail.com");
            $message->to($appointment->patient->user->email, 'Patient');
        });
        return redirect()->route('appointments.index')->with(['success'=> ['Appointment approved successfully.']]);
    }

    public function reject($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->approval_status = Appointment::APPROVAL_REJECTED;
        $appointment->save();
        $rjmessage = "Your appointment with Dr. " . $appointment->dentist->full_name . " has been rejected.";
        Mail::raw($rjmessage, function ($message) use ($appointment){
            $message->from("dres.dentalclinic.13@gmail.com", "dres.dentalclinic.13@gmail.com");
            $message->to($appointment->patient->user->email, 'Patient');
        });
        return redirect()->route('appointments.index')->with(['success'=> ['Appointment rejected successfully.']]);
    }
}
