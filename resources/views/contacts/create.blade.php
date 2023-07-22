@extends('master')
@section('title', "Create " . $title)

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
                    <form action="{{ route('contacts.store') }}" method="POST" class="row" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="key" value="{{ $key }}" />
                        @if($key != "is_patient")
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" class="form-control input-default " name="email" placeholder="Email" required="true">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" class="form-control input-default " name="password" placeholder="Password" required="true">
                            </div>
                        </div>
                        @endif
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control input-default " name="first_name" placeholder="First Name" required="true">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Middle Name</label>
                                <input type="text" class="form-control input-default " name="middle_name" placeholder="Middle Name" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input type="text" class="form-control input-default " name="last_name" placeholder="Last Name" required="true">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Contact #</label>
                                <input type="text" class="form-control input-default " name="contact_number" placeholder="Contact #" >
                            </div>
                        </div>
                        @if($key == "is_patient")
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Address</label>
                                <input type="text" class="form-control input-default " name="address" placeholder="Address" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Birthdate</label>
                                <input type="date" class="form-control input-default " name="birthdate" placeholder="Birthdate" >
                            </div>
                        </div>
                        @endif
                        @if ($key == "is_dentist")
                        <div class="col-6">
                            <div class="form-group">
                                <label for="dentist_availabilities">Availability</label>
                                <select name="dentist_availabilities[]" class="form-control" required="true" multiple="true">
                                    @foreach ($availabilities as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        @endif
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
