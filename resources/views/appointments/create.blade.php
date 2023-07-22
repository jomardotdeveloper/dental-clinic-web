@extends('master')
@section('title', "Create " . $title)

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }} Form (Walked In)</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @include('error.danger')
                    <form action="{{ route('appointments.store') }}" method="POST" class="row" enctype="multipart/form-data">
                        @csrf
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Patient</label>
                                <select name="patient_id" class="form-control" required="true">
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Dentist</label>
                                <select name="dentist_id" class="form-control" required="true">
                                    @foreach ($dentists as $dentist)
                                        <option value="{{ $dentist->id }}">{{ $dentist->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Priority Level</label>
                                <select name="priority_level" class="form-control" required="true">
                                    @foreach ($priority_levels as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Previous Appointment</label>
                                <select name="previous_appointment_id" class="form-control">
                                    <option value="{{ null }}">None</option>
                                    @foreach ($appointments as $appointment)
                                        <option value="{{ $appointment->id }}">{{ $appointment->formatted_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Services</label>
                                <select name="services[]" class="form-control" required multiple>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Consultation Hours</label>
                                <input type="text" class="form-control input-default " name="consultation_hours" placeholder="Consultation Hours" >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Date</label>
                                <input type="date" class="form-control input-default " name="date" placeholder="Date" value="{{  date('Y-m-d')  }}" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Remarks</label>
                                <textarea name="remarks" id="remarks" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>


                        <div class="form-group col-6">
                            <input type="submit" class="btn btn-primary" value="Save"/> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
