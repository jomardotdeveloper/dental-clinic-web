@extends('master')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        @if ($appointment)
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $appointment->formatted_id }}</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @include('error.danger')
                    <div class="row">
                        <div class="col-4">
                            <h4>Patient</h4>
                            <p>{{ $appointment->patient->full_name }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Dentist</h4>
                            <p>{{ $appointment->dentist->full_name }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Date</h4>
                            <p>{{ $appointment->date }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Status</h4>
                            <p>{{ $appointment->status_name }}</p>
                        </div>
                        @if ($appointment->previous_appointment_id)
                        <div class="col-4">
                            <h4>Previous Appointment</h4>
                            <p>{{ $appointment->previousAppointment->formatted_id }}</p>
                        </div>
                        @endif
                        <div class="col-4">
                            <h4>Consultation Hours</h4>
                            <p>{{ $appointment->consultation_hours }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Approval Status</h4>
                            <p>{{ $appointment->approval_status_name }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Approval Status</h4>
                            <p>{{ $appointment->priority_level_name }}</p>
                        </div>

                        <div class="col-4">
                            <h4>Type of Appointment</h4>
                            <p>{{  $appointment->is_walk_in ? "Walked In" : "Online" }}</p>
                        </div>

                        <div class="col-12">
                            <h4>Remarks</h4>
                            <p>{{  $appointment->remarks}}</p>
   
                        </div>
                        <div class="col-12">
                            <a href="{{ route('appointments.complete', $appointment) }}" class="btn btn-success">Complete</a>
                            <a href="{{ route('appointments.cancel', $appointment) }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        No appointment found.
        @endif
     
    </div>
</div>
@endsection
