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
                            <h4>Appointment</h4>
                            <p>{{ $payment->appointment->formatted_id }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Payment Method</h4>
                            <p>{{ $payment->payment_method }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Payment Reference</h4>
                            <p>{{ $payment->payment_reference }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Payment Amount</h4>
                            <p>{{ $payment->payment_amount }}</p>
                        </div>
                        <div class="col-12">
                            <h4>Remarks</h4>
                            <p>{{  $payment->remarks}}</p>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('payments.destroy', ['payment' => $payment]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
