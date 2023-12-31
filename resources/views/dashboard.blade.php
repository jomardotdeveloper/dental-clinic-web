@extends('master')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-4">
        <div class="widget-stat card bg-danger">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-calendar-1"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Appointment</p>
                        <h3 class="text-white">{{ $appointment_count }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="widget-stat card bg-success">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-diamond"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Patient</p>
                        <h3 class="text-white">{{  $patient_count  }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="widget-stat card bg-info">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-heart"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Dentist</p>
                        <h3 class="text-white">{{ $dentist_count }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="widget-stat card bg-primary">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-user-7"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Service</p>
                        <h3 class="text-white">{{ $service_count }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
