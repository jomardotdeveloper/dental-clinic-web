@extends('end.master')

@section('content')
<div class="row invoice-preview">
    <!-- Invoice -->
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
                href="{{ route('endappointments.edit', $appointment) }}"
                class="btn btn-primary d-grid w-100 mb-3">
                Edit Appointment
             </a>

            @if (!auth()->user()->is_patient && !$appointment->is_paid)
                <button type="button" class="btn btn-warning d-grid w-100 mb-3" data-bs-toggle="modal" data-bs-target="#editUser">
                    Add Payment
                </button>
                <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                      <div class="modal-content p-3 p-md-5">
                        <div class="modal-body py-3 py-md-0">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          <div class="text-center mb-4">
                            <h3 class="mb-2">Payment Form</h3>
                            {{-- <p class="pt-1">Details </p> --}}
                          </div>
                          <form id="editUserForm" action="{{ route("payments.store") }}" class="row g-4" method="POST">
                            @csrf
                            <input type="hidden" name="from_mobile" value="1"/>
                            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}"/>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Payment Method</label>
                                    <input type="text" class="form-control input-default " name="payment_method" placeholder="Payment Method" required>
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Payment Reference</label>
                                    <input type="text" class="form-control input-default " name="payment_reference" placeholder="Payment Reference" >
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Payment Amount</label>
                                    <input type="number" class="form-control input-default " name="payment_amount" placeholder="Payment Amount" required>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Remarks</label>
                                    <textarea name="remarks" id="remarks" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                              <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                              {{-- <button
                                type="reset"
                                class="btn btn-outline-secondary"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                                Cancel
                              </button> --}}
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
            @endif

             @if (!auth()->user()->contact->is_patient && $appointment->approval_status == 1)
                <a
                    href="{{ route('endappointments.approve', $appointment) }}"
                    class="btn btn-success d-grid w-100 mb-3">
                    Approve Appointment
                </a>
                <a
                    href="{{ route('endappointments.reject', $appointment) }}"
                    class="btn btn-danger d-grid w-100 mb-3">
                    Reject Appointment
                </a>


             @endif
            
              @if (auth()->user()->contact->is_patient && $appointment->approval_status == 1)
              <form action="{{ route('endappointments.destroy', $appointment) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="btn btn-danger d-grid w-100 mb-3">
                        Cancel/Delete Appointment
                    </button>
              </form>
            
              @endif
              
             
            </div>
        </div>
    </div>
   
</div>
@endsection