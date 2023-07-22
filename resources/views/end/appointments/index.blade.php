@extends('end.master')
@section('content')
<div class="row mb-5">
    <h3>Appointments</h3>
    <div class="col-12">
        <a href="{{ route('endappointments.create') }}" class="btn btn-primary">Book</a>
    </div>
    <div class="col-12 mt-2">
        @include('end.alert')
    </div>
    
    @foreach ($appointments as $appointment)
    <div class="col-12 mt-3">
        <div class="card mb-4">
            <div class="card-header header-elements">
              <span class="me-2">{{ $appointment->formatted_id }}</span>
              <div class="card-header-elements ms-auto">
                <a href="{{ route('endappointments.show', $appointment) }}" class="btn btn-xs btn-primary">
                    <span class="tf-icon mdi mdi-eye"> </span> View
                </a>
              </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mt-2">
                        <h5>Dentist: </h5>
                        <p class="card-text">
                            {{ $appointment->dentist->full_name }}
                        </p>
                    </div>
                    <div class="col-6 mt-2">
                        <h5>Date: </h5>
                        <p class="card-text">
                            {{ $appointment->date }}
                        </p>
                    </div>
                    <div class="col-6 mt-2">
                        <h5>Status</h5>
                        <p class="card-text">
                            {{ $appointment->status_name }}
                        </p>
                    </div>
                    <div class="col-6 mt-2">
                        <h5>Approval Status</h5>
                        <p class="card-text">
                            {{ $appointment->approval_status_name }}
                        </p>
                    </div>
                    <div class="col-6 mt-2">
                        <h5>Priority Level</h5>
                        <p class="card-text">
                            {{ $appointment->priority_level_name }}
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endforeach
    
      
    </div>
</div>
@endsection