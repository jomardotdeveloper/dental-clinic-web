@extends('end.master')

@section('content')
<div class="row invoice-preview">
    <!-- Invoice -->
    @if ($appointment)
        
    
    <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4">
      <div class="card invoice-preview-card">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column">
                <div class="mb-xl-0 pb-3">
                  <div class="d-flex svg-illustration align-items-center gap-2 mb-4">
                    <span class="h4 mb-0 app-brand-text fw-bold">#{{ $appointment->formatted_id }} 
                        @if (!auth()->user()->is_patient)
                        ({{ $appointment->is_paid ? "Paid - " . $appointment->payment->payment_amount : "Unpaid" }})
                        @endif
                        
                    </span>
                  </div>
                </div>
                <div>
                  <h5>Patient: {{ $appointment->patient->full_name}}</h5>
                  <div class="mb-1">
                    <span>Dentist:</span>
                    <span>{{ $appointment->dentist->full_name }}</span>
                  </div>
                  <div class="mb-1">
                    <span>Services:</span>
                    <span>{{ $appointment->service_names }}</span>
                  </div>
                  <div class="mb-1">
                    <span>Date:</span>
                    <span>{{ $appointment->date }}</span>
                  </div>
                  <div class="mb-1">
                    <span>Status:</span>
                    <span>{{ $appointment->status_name }}</span>
                  </div>
                  <div class="mb-1">
                    <span>Approval Status:</span>
                    <span>{{ $appointment->approval_status_name }}</span>
                  </div>
                  <div class="mb-1">
                    <span>Priority Level:</span>
                    <span>{{ $appointment->priority_level_name }}</span>
                  </div>
                  <div class="mb-1">
                    <span>Type of Appointment:</span>
                    <span>{{  $appointment->is_walk_in ? "Walked In" : "Online" }}</span>
                  </div>
                  @if ($appointment->previous_appointment_id)
                  <div class="mb-1">
                    <span>Previous Appointment:</span>
                    <span>{{ $appointment->previousAppointment->formatted_id }}</span>
                  </div>
                  @endif
                  <div class="mb-1">
                    <span>Consultation Hours:</span>
                    <span>{{ $appointment->consultation_hours }}</span>
                  </div>
                  
                  <div class="mb-1">
                    <span>Remarks:</span>
                    <span>{{ $appointment->remarks ? $appointment->remarks : "N/A" }}</span>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4 mt-2">
        <div class="card">
            <div class="card-body">
              <a
                href="{{ route('endappointments.complete', $appointment) }}"
                class="btn btn-success d-grid w-100 mb-3">
                Complete
             </a>
             <a
                href="{{ route('endappointments.cancel', $appointment) }}"
                class="btn btn-danger d-grid w-100 mb-3">
                Cancel
             </a>

          
              
             
            </div>
        </div>
    </div>
    @else

    No appointment found.
    @endif
   
</div>
@endsection