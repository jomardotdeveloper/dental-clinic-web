@extends('master')
@section('title', "Edit " . $title)

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
                    <form action="{{ route('contacts.update', ['contact' => $contact]) }}" method="POST" class="row" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="key" value="{{ $key }}" />
                        @if($contact->user_id != null)
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" class="form-control input-default " name="email" placeholder="Email" required="true" value="{{ $contact->user->email }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" class="form-control input-default " name="password" placeholder="Password" required="true" value="JOMARPOGI">
                            </div>
                        </div>
                        @endif
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control input-default "  name="first_name" placeholder="First Name" required="true" value="{{ $contact->first_name }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Middle Name</label>
                                <input type="text" class="form-control input-default " name="middle_name" placeholder="Middle Name" value="{{ $contact->middle_name }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input type="text" class="form-control input-default " name="last_name" placeholder="Last Name" required="true" value="{{ $contact->last_name }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Contact #</label>
                                <input type="text" class="form-control input-default " name="contact_number" placeholder="Contact #" value="{{ $contact->contact_number }}">
                            </div>
                        </div>
                        @if($key == "is_patient")
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Address</label>
                                <input type="text" class="form-control input-default " name="address" placeholder="Address" value="{{ $contact->address }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Birthdate</label>
                                <input type="date" class="form-control input-default " name="birthdate" placeholder="Birthdate" value="{{ $contact->birthdate }}">
                            </div>
                        </div>
                        @endif

                        @if ($key == "is_dentist")
                        <div class="col-6">
                            <div class="form-group">
                                <label for="dentist_availabilities">Availability</label>
                                <select name="dentist_availabilities[]" class="form-control" required="true" multiple="true">
                                    @foreach ($availabilities as $key => $value)
                                        <option value="{{ $key }}" {{ str_contains($contact->dentist_availabilities, $key) ? "selected" : "" }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        @endif
                        <div class="form-group col-6">
                            <input type="submit" class="btn btn-primary" value="Save Changes"/> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
