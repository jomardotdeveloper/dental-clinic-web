@extends('end.master')
@section('content')
<div class="row gy-4">
    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-md-6 order-2 order-md-1">
                <div class="card-body">
                  <h4 class="card-title pb-xl-2">Hello <strong> {{ auth()->user()->contact->first_name }}!</strong>🎉</h4>
                  <p>Welcome to our mobile booking app, Stay in control of your health journey with our mobile booking app, putting your well-being at your fingertips!</p>
                  @if(auth()->user()->contact->is_patient)
                  <a href="{{ route('endappointments.create') }}" class="btn btn-primary">Book now</a>
                  @else
                    <a href="{{ route('endappointments.index') }}" class="btn btn-primary">View Appointments</a>
                @endif
                </div>
              </div>
              <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                <div class="card-body pb-0 px-0 px-md-4 ps-0">
                  <img
                    src="{{ asset('end/assets/img/illustrations/illustration-john-light.png') }}"
                    height="180"
                    alt="View Profile"
                    data-app-light-img="illustrations/illustration-john-light.png"
                    data-app-dark-img="illustrations/illustration-john-dark.png" />
                </div>
              </div>
            </div>
        </div>
    </div>
    @if (!auth()->user()->contact->is_staff)
    <div class="col-md-12 col-lg-8">
        <div class="card h-100">
            <div class="row">
              <div class="col-6">
                <div class="card-body">
                  <div class="card-info mb-3 py-2 mb-lg-1 mb-xl-3">
                    <h5 class="mb-3 mb-lg-2 mb-xl-3 text-nowrap">Appointment</h5>
                    <div class="badge bg-label-primary rounded-pill lh-xs">Today</div>
                  </div>
                  <div class="d-flex align-items-end flex-wrap gap-1">
                    <h4 class="mb-0 me-2">
                        @if (auth()->user()->contact->is_patient)
                            {{ auth()->user()->contact->patientAppointments->where('date', date('Y-m-d'))->count() }}
                        @elseif (auth()->user()->contact->is_dentist)
                            {{ auth()->user()->contact->dentistAppointments->where('date', date('Y-m-d'))->count() }}
                        @endif
                    </h4>
                  </div>
                </div>
              </div>
              <div class="col-6 text-end d-flex align-items-end justify-content-center">
                <div class="card-body pb-0 pt-3 position-absolute bottom-0">
                  <img
                    src="{{ asset('end/assets/img/illustrations/card-ratings-illustration.png') }}"
                    alt="Ratings"
                    width="95" />
                </div>
              </div>
            </div>
          </div>
    </div>

    <div class="col-md-12 col-lg-8">
        <div class="card h-100">
            <div class="row">
              <div class="col-6">
                <div class="card-body">
                  <div class="card-info mb-3 py-2 mb-lg-1 mb-xl-3">
                    <h5 class="mb-3 mb-lg-2 mb-xl-3 text-nowrap">Appointment</h5>
                    <div class="badge bg-label-success rounded-pill lh-xs">Total</div>
                  </div>
                  <div class="d-flex align-items-end flex-wrap gap-1">
                    <h4 class="mb-0 me-2">
                        @if (auth()->user()->contact->is_patient)
                            {{ count(auth()->user()->contact->patientAppointments) }}
                        @elseif (auth()->user()->contact->is_dentist)
                            {{ count(auth()->user()->contact->dentistAppointments) }}
                        @endif
                    </h4>
                  </div>
                </div>
              </div>
              {{-- card-orders-illustration --}}
              <div class="col-6 text-end d-flex align-items-end justify-content-center">
                <div class="card-body pb-0 pt-3 position-absolute bottom-0">
                  <img
                    src="{{ asset('end/assets/img/illustrations/card-session-illustration.png') }}"
                    alt="Ratings"
                    width="95" />
                </div>
              </div>
            </div>
          </div>
    </div>

    @endif
    <div class="col-md-12 col-lg-8">
        <div class="card h-100">
            <div class="row">
              <div class="col-6">
                <div class="card-body">
                  <div class="card-info mb-3 py-2 mb-lg-1 mb-xl-3">
                    <h5 class="mb-3 mb-lg-2 mb-xl-3 text-nowrap">Available Dentists</h5>
                    <div class="badge bg-label-success rounded-pill lh-xs">Today</div>
                  </div>
                  <div class="d-flex align-items-end flex-wrap gap-1">
                    {{-- <h4 class="mb-0 me-2"> --}}
                        <ul>
                            @foreach ($available_dentists as $dentist)
                                
                                  <li>{{ $dentist->full_name }}</li>
                                
                            @endforeach
                          </ul>
                    {{-- </h4> --}}
                  </div>
                </div>
              </div>
              {{-- card-orders-illustration --}}
              <div class="col-6 text-end d-flex align-items-end justify-content-center">
                <div class="card-body pb-0 pt-3 position-absolute bottom-0">
                  <img
                    src="{{ asset('end/assets/img/illustrations/card-orders-illustration.png') }}"
                    alt="Ratings"
                    width="95" />
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection