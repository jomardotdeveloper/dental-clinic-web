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
                                <th>Name</th>
                                {{-- <th>Consultation Hours</th> --}}
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    {{-- <td>{{ $service->consultation_hours }}</td> --}}
                                    <td>
                                        <form action="{{ route('services.destroy',['service'=>$service]) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <a href="javascript::void(0);" 
                                                data-toggle="modal" 
                                                data-target="#updateModal{{ $service->id }}" 
                                                class="btn btn-success">Edit</a>
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>

                                    </td>
                                </tr>

                                <div class="modal fade" id="updateModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $service->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Service</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('services.update',['service'=>$service]) }}" method="POST">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control input-default " name="name" placeholder="Name" required="true" value="{{ $service->name }}">
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="name">Consultation Hours</label>
                                                        <input type="number" class="form-control input-default " name="consultation_hours" placeholder="Consultation Hours" required="true" value="{{ $service->consultation_hours }}">
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary" value="Save Changes"/> 
                                                    </div>
                                                </form>
                                            </div>
                                
                                        </div>
                                    </div>
                                </div>
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


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control input-default " name="name" placeholder="Name" required="true">
                    </div>
                    {{-- <div class="form-group">
                        <label for="name">Consultation Hours</label>
                        <input type="number" class="form-control input-default " name="consultation_hours" placeholder="Consultation Hours" required="true" >
                    </div> --}}
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save"/> 
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