@extends('end.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('end/assets/vendor/libs/select2/select2.css') }}" />
@endpush
@section('content')
<div class="row mb-5">
    <h3>Edit Appointment</h3>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Appointment Form</h5>
            <div class="card-body">
                @include('end.alert')
                <form action="{{ route('endappointments.update', $appointment) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if ($contact->is_dentist)
                    <input type="hidden" name="dentist_id" value="{{ $contact->id }}" />
                    @else
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" id="dentist_id" name="dentist_id" aria-label="Select Dentist" required>
                          @foreach ($dentists as $dentist)
                            <option value="{{ $dentist->id }}" {{ $appointment->dentist_id == $dentist->id ? "selected" : "" }}>{{ $dentist->full_name }}</option>
                          @endforeach
                        </select>
                        <label for="dentist_id">Select Dentist</label>
                    </div>
                    @endif

                    @if ($contact->is_patient)
                    <input type="hidden" name="patient_id" value="{{ $contact->id }}" />
                    @else
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" id="patient_id" name="patient_id" aria-label="Select Patient" required>
                          @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? "selected" : "" }}>{{ $patient->full_name }}</option>
                          @endforeach
                        </select>
                        <label for="patient_id">Select Patient</label>
                    </div>
                    @endif

                    @if ($contact->is_dentist || $contact->is_staff)
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" id="previous_appointment_id" name="previous_appointment_id" aria-label="Select Previous Appointment">
                            <option value="{{ null }}">None</option>
                            @foreach ($appointments as $appointment)
                                <option value="{{ $appointment->id }}" {{ $appointment->previous_appointment_id == $appointment->id ? "selected" : "" }}>{{ $appointment->formatted_id }}</option>
                            @endforeach
                        </select>
                        <label for="previous_appointment_id">Select Previous Appointment</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" type="text" placeholder="Consultation Hours" id="consultation_hours" value="{{ $appointment->consultation_hours }}" name="consultation_hours" />
                        <label for="consultation_hours">Text</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" id="priority_level" name="priority_level" aria-label="Select Priority Level">
                            @foreach ($priority_levels as $key => $val)
                                <option value="{{ $key }}" {{ $appointment->priority_level == $key ? "selected" : "" }}>{{ $val }}</option>
                            @endforeach
                        </select>
                        <label for="priority_level">Select Priority Level</label>
                    </div>
                        
                    @endif
                    <div class="form-floating form-floating-outline mb-4">
                        <div class="select2-primary">
                          <select id="select2Primary" class="select2 form-select" name="services[]" multiple>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{ in_array($service->id, $appointment->service_ids) ? "selected" : "" }}>{{ $service->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <label for="select2Primary">Services</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" name="date" type="date" id="html5-date-input" value="{{ $appointment->date }}" required/>
                        <label for="html5-date-input">Date</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <textarea
                          class="form-control h-px-100"
                          id="remarks"
                          name="remarks"
                          placeholder="Comments here...">{{$appointment->remarks}}</textarea>
                        <label for="remarks">Remarks</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    
                </form>
            </div>
        </div>
    </div>
    

</div>
@endsection
@push('scripts')
<script src="{{ asset('end/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('end/assets/js/forms-selects.js') }}"></script>
@endpush