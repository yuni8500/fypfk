@extends('layouts.sideNav')
@section('content')

<head>
    <title>Laravel Fullcalender Tutorial Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        .header1 {
            margin-bottom: 0.75rem;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-weight: 400;
            color: #3d5170;
        }

        .fc-event {
            background-color: #007bff;
        }

        .fc-title,
        .fc-time {
            color: white;
        }
    </style>
</head>

<body>
@if( auth()->user()->category== "Student")
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('createAppointment') }}" style="border-radius: 10px; border: none; width: 15%; color: white; font-size: 15px; background-color: #145956; margin-bottom:15px">
                <i class="material-icons" style="color: white">date_range</i> <b>BOOK MEETING</b>
            </a>
            <a class="btn btn-primary" href="{{ route('appointmentApprovalSupervisee') }}" style="border-radius: 10px; border: none; width: 17%; color: white; font-size: 15px; background-color: #145956; margin-bottom:15px">
                <i class="material-icons" style="color: white">mode_edit</i> <b>UPDATE MEETING</b>
            </a>
            <a class="btn btn-primary" href="{{ route('appointmentRejectedSupervisee') }}" style="border-radius: 10px; border: none; width: 18%; color: white; font-size: 15px; background-color: #145956; margin-bottom:15px">
                <i class="material-icons" style="color: white">assignment_late</i> <b>REJECTED MEETING</b>
            </a>
            <br>
            <div class="container">
                <div id='calendar'></div>
            </div>
        </div>
    </div><br>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: false,
                firstDay: 1,

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                },

                views: {
                    agendaDay: {
                        type: 'agenda',
                        duration: {
                            days: 1
                        },
                        
                    }
                },

               events: {
                    url: "{{ route('appointmentSupervisee') }}",
                    type: 'GET',
                    error: function() {
                        alert('Error fetching events');
                    },
                },
                eventRender: function(event, element) {
                    // Add a data attribute to the event element
                    element.attr('data-event-id', event.id);
                },
                eventClick: function(event, jsEvent, view) {
                var eventId = event.id; // Get the event ID directly from the event object
                var url = "{{ route('displayMeetingSupervisee', ['id' => ':id']) }}";                
                url = url.replace(':id', eventId);
                window.location.href = url;
            }
        });


        });

     
    </script>
@endif  
@if( auth()->user()->category== "Staff")
<div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('approvalMeeting') }}" style="border-radius: 10px; border: none; width: 19%; color: white; font-size: 15px; background-color: #145956; margin-bottom:15px">
                <i class="material-icons" style="color: white">date_range</i> <b>MEETING APPROVAL</b>
            </a>
            <a class="btn btn-primary" href="{{ route('appointmentRejectedSupervisee') }}" style="border-radius: 10px; border: none; width: 18%; color: white; font-size: 15px; background-color: #145956; margin-bottom:15px">
                <i class="material-icons" style="color: white">assignment_late</i> <b>REJECTED MEETING</b>
            </a>
            <br>
            <div class="container">
                <div id='calendar'></div>
            </div>
        </div>
    </div><br>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: false,
                firstDay: 1,

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                },

                views: {
                    agendaDay: {
                        type: 'agenda',
                        duration: {
                            days: 1
                        },
                        
                    }
                },

               events: {
                    url: "{{ route('appointmentSupervisee') }}",
                    type: 'GET',
                    error: function() {
                        alert('Error fetching events');
                    },
                },
                eventRender: function(event, element) {
                    // Add a data attribute to the event element
                    element.attr('data-event-id', event.id);
                },
                eventClick: function(event, jsEvent, view) {
                var eventId = event.id; // Get the event ID directly from the event object
                var url = "{{ route('displayMeetingSupervisee', ['id' => ':id']) }}";                
                url = url.replace(':id', eventId);
                window.location.href = url;
            }
        });


        });

     
    </script>
@endif
</body>
@endsection