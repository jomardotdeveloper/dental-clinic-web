@extends('end.master')
@section('content')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<div class="row gy-4">
    <div class="col-md-12 col-lg-12">
        <h3>Calendar</h3>
        <div id='calendar'></div>
    </div>
</div>
<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            @foreach ($appointments as $appointment)
                {
                    id: '{{ $appointment->id }}',
                    title: '{{ $appointment->formatted_id }}',
                    start: '{{ $appointment->date }}',
                    url: '{{ route('endappointments.show',  $appointment) }}'
                },
            @endforeach
        ],
        height: "auto"
      });
      calendar.render();
    });

  </script>
@endsection