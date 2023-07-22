@extends('master')
@section('title', "View " . $title)

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }} Details</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @include('error.danger')
                    <div class="row">
                        @if($contact->user_id != null)
                        <div class="col-4">
                            <h4>Email</h4>
                            <p>{{ $contact->user->email }}</p>
                        </div>
                        @endif
                        <div class="col-4">
                            <h4>First Name</h4>
                            <p>{{ $contact->first_name }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Middle Name</h4>
                            <p>{{ $contact->middle_name }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Last Name</h4>
                            <p>{{ $contact->last_name }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Contact #</h4>
                            <p>{{ $contact->contact_number }}</p>
                        </div>

                        @if ($key == "is_patient")
                        <div class="col-4">
                            <h4>Address</h4>
                            <p>{{ $contact->address }}</p>
                        </div>
                        <div class="col-4">
                            <h4>Birthdate</h4>
                            <p>{{ $contact->birthdate }}</p>
                        </div>
                        @endif

                        @if ($key == "is_dentist")
                        <div class="col-4">
                            <h4>Availabilities</h4>
                            <p>{{ $contact->availabilities_names }}</p>
                        </div>
                        @endif

                        <div class="col-12">
                            <form action="{{ route('contacts.destroy', ['contact' => $contact]) }}?{{$key}}=1" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                @if ($contact->user_id == null)
                                <a href="javascript::void(0);" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Grant User Account</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('contacts.grant-user', ['contact' => $contact]) }}" method="POST">
                    @csrf
                    <div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" class="form-control input-default " name="email" placeholder="Email" required="true">
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" class="form-control input-default " name="password" placeholder="Password" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save Changes"/> 
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
