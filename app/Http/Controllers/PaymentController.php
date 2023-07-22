<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payments.index', [
            'title' => 'Payments',
            'payments' => Payment::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payments.create', [
            'title' => 'Create Payment',
            'appointments' => Appointment::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Payment::create($request->all());
        $appointment = Appointment::find($request->appointment_id);
        if($request->has('from_mobile'))
        {
            return redirect()->route('endappointments.show', $appointment)->with(['success'=> ['Payment created successfully.']]);
        }

        return redirect()->route('payments.index')->with(['success'=> ['Payment created successfully.']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return view('payments.show', [
            'title' => 'Payment Details',
            'payment' => $payment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('payments.edit', [
            'title' => 'Edit Payment',
            'payment' => $payment,
            'appointments' => Appointment::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->update($request->all());
        return redirect()->route('payments.index')->with(['success' => ['Payment updated successfully.']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with(['success'=> ['Payment deleted successfully.']]);
    }
}
