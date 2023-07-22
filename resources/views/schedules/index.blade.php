@extends('master')
@section('title', $title)
@push("styles")
<link href="{{ asset("vendor/datatables/css/jquery.dataTables.min.css") }}" rel="stylesheet">
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <a href="javascript::void(0);" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" style="float:left">Create</a>
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
                                <th>Dentist</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->dentist->full_name }}</td>
                                    <td>{{ $schedule->start_time }}</td>
                                    <td>{{ $schedule->end_time }}</td>
                                    <td>
                                        <form action="{{ route('schedules.destroy',['schedule'=>$schedule]) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <a href="javascript::void(0);" 
                                                data-toggle="modal" 
                                                data-target="#updateModal{{ $schedule->id }}" 
                                                class="btn btn-success">Edit</a>
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <th>Name</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($schedules as $schedule)
   
<div class="modal fade" id="updateModal{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $schedule->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedules.update',['schedule'=>$schedule]) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name">From</label>
                        <input type="datetime-local" class="form-control input-default " name="start_time" placeholder="From" required="true" value="{{ $schedule->start_time }}">
                    </div>
                    <div class="form-group">
                        <label for="name">To</label>
                        <input type="datetime-local" class="form-control input-default " name="end_time" placeholder="To" required="true" value="{{ $schedule->end_time }}">
                    </div>
                    <div class="form-group">
                        <label for="dentist_id">Dentist</label>
                        <select name="dentist_id" class="form-control" required="true">
                            @foreach ($dentists as $dentist)
                                <option value="{{ $dentist->id }}" {{ $dentist->id == $schedule->dentist_id ? "selected='true'" : "" }}>{{ $dentist->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save Changes"/> 
                    </div>
                </form>
            </div>

        </div>
    </div>
</div> 
@endforeach
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">From</label>
                        <input type="datetime-local" class="form-control input-default " name="start_time" placeholder="From" required="true">
                    </div>
                    <div class="form-group">
                        <label for="name">To</label>
                        <input type="datetime-local" class="form-control input-default " name="end_time" placeholder="To" required="true">
                    </div>
                    <div class="form-group">
                        <label for="name">Dentist</label>
                        <select name="dentist_id" class="form-control" required="true">
                            @foreach ($dentists as $dentist)
                                <option value="{{ $dentist->id }}">{{ $dentist->full_name }}</option>
                            @endforeach
                        </select>
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


@push("scripts")
<script src="{{ asset("vendor/datatables/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("js/plugins-init/datatables.init.js") }}"></script>
@endpush