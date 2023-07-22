@extends('master')
@section('title', $title)
@push("styles")
<link href="{{ asset("vendor/datatables/css/jquery.dataTables.min.css") }}" rel="stylesheet">
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{ route('payments.create') }}" class="btn btn-primary" style="float:left">Create</a>
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
                                <th>Appointment ID</th>
                                <th>Payment Method</th>
                                <th>Payment Reference</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- DATA STARTS HERE --}}
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->appointment->formatted_id  }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                    <td>{{ $payment->payment_reference }}</td>
                                    <td>{{ $payment->payment_amount }}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route("payments.edit", ["payment" => $payment]) }}">
                                            Edit
                                        </a>
                                        <a class="btn btn-info" href="{{ route("payments.show", ["payment" => $payment]) }}">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- DATA ENDS HERE --}}
                        </tbody>
                        <tfoot>
                            <th>Appointment ID</th>
                            <th>Payment Method</th>
                            <th>Payment Reference</th>
                            <th>Amount</th>
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