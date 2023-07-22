@extends('end.master')

@section('content')
<div class="row">
    <h3>Profile</h3>
    <div class="col-12">
        @include('end.alert')
    </div>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Personal Information</h5>
            <div class="card-body">
                
                <form action="{{ route('end.update-profile') }}" method="POST">
                    @csrf
                    <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" type="text" placeholder="Name" id="first_name" value="{{ $contact->first_name }}" name="first_name" required />
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" type="text" placeholder="Name" id="last_name" value="{{ $contact->last_name }}" name="last_name" required/>
                        <label for="last_name">Last Name</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" type="text" placeholder="Name" id="middle_name" value="{{ $contact->middle_name }}" name="middle_name" />
                        <label for="middle_name">Middle Name</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
                

                
            </div>
        </div>
    </div>
    <div class="col-12 mt-2">
        <div class="card">
            <h5 class="card-header">Password</h5>
            <div class="card-body">
                <form action="{{ route('end.change-password') }}" method="POST">
                    @csrf
                    <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" type="password" placeholder="Password"  name="password" required />
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" type="password" placeholder="Password"  name="password_confirmation" required />
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" type="password" placeholder="Password"  name="current_password" required />
                        <label for="current_password">Current Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
              
            </div>
        </div>
    </div>
</div>
@endsection