@if (Session::has('error'))
<div class="alert alert-solid-danger d-flex align-items-center alert-dismissible" role="alert">
    <i class="mdi mdi-alert-circle-check-outline me-2"></i>
    <ul>
        @foreach(Session::get('error') as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


@if (Session::has('success'))
<div class="alert alert-solid-success d-flex align-items-center alert-dismissible" role="alert">
    <i class="mdi mdi-check-circle-outline me-2"></i>
    <ul>
        @foreach(Session::get('success') as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
