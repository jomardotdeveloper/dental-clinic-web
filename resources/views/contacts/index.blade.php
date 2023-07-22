@extends('master')
@section('title', $title)
@push("styles")
<link href="{{ asset("vendor/datatables/css/jquery.dataTables.min.css") }}" rel="stylesheet">
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{ route('contacts.create') }}?{{ $key }}=1" class="btn btn-primary" style="float:left">Create</a>
    </div>
    <div class="col-12 mt-2">
        @include('error.success')
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
                                <th>Full Name</th>
                                <th>Contact #</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- DATA STARTS HERE --}}
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->full_name }}</td>
                                    <td>{{ $contact->contact_number }}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route("contacts.edit", ["contact" => $contact]) }}?{{ $key }}=1">
                                            Edit
                                        </a>
                                        <a class="btn btn-info" href="{{ route("contacts.show", ["contact" => $contact]) }}?{{ $key }}=1">
                                            View
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            {{-- DATA ENDS HERE --}}
                        </tbody>
                        <tfoot>
                            <th>Full Name</th>
                            <th>Contact #</th>
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