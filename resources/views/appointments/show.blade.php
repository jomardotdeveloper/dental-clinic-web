@extends('master')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
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
                            <form action="{{ route('appointments.destroy', ['appointment' => $appointment]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                @if ($appointment->approval_status == 1)
                                    <a
                                        href="{{ route('appointments.approve', $appointment) }}"
                                        class="btn btn-success ">
                                        Approve Appointment
                                    </a>
                                    <a
                                        href="{{ route('appointments.reject', $appointment) }}"
                                        class="btn btn-warning ">
                                        Reject Appointment
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
