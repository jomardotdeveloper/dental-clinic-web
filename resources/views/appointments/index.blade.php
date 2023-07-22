@extends('master')
@section('title', $title)
@push("styles")
<link href="{{ asset("vendor/datatables/css/jquery.dataTables.min.css") }}" rel="stylesheet">
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary" style="float:left">Create Walked-In</a>
    </div>
    <div class="col-12 mt-2">
        @include('error.success')
        @include('error.danger')
    </div>
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            {{-- COLUMNS STARTS HERE --}}
                            <tr>
                                <th>ID</th>
                                <th>Dentist</th>
                                <th>Patient</th>
                                <th>Status</th>
                                <th>Approval Status</th>
                                {{-- <th>Walked In</th> --}}
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- DATA STARTS HERE --}}
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->formatted_id }}</td>
                                    <td> {{ $appointment->dentist->full_name }} </td>
                                    <td> {{ $appointment->patient->full_name }} </td>
                                    <td> {{ $appointment->status_name }} </td>
                                    <td> {{ $appointment->approval_status_name }} </td>
                                    {{-- <td> {{ $appointment->is_walk_in ? "Yes" : "No" }} </td> --}}
                                    <td> {{ $appointment->date }} </td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route("appointments.edit", ["appointment" => $appointment]) }}">
                                            Edit
                                        </a>
                                        <a class="btn btn-info" href="{{ route("appointments.show", ["appointment" => $appointment]) }}">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- DATA ENDS HERE --}}
                        </tbody>
                        <tfoot>
                            <th>ID</th>
                            <th>Dentist</th>
                            <th>Patient</th>
                            <th>Status</th>
                            <th>Approval Status</th>
                            {{-- <th>Walked In</th> --}}
                            <th>Date</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push("scripts")
<script src="{{ asset("vendor/datatables/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("js/plugins-init/datatables.init.js") }}"></script>
@endpush