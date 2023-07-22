@extends('master')
@section('title', $title)

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }} Form</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @include('error.danger')
                    <form action="{{ route('payments.store') }}" method="POST" class="row" enctype="multipart/form-data">
                        @csrf
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Appointment</label>
                                <select name="appointment_id" class="form-control" required>
                                    @foreach ($appointments as $appointment)
                                        <option value="{{ $appointment->id }}">{{ $appointment->formatted_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Payment Method</label>
                                <input type="text" class="form-control input-default " name="payment_method" placeholder="Payment Method" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Payment Reference</label>
                                <input type="text" class="form-control input-default " name="payment_reference" placeholder="Payment Reference" >
                            </div>
                        </div>

                        <div class="col-6">
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
