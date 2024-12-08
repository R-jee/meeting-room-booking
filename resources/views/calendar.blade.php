@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Meeting Room Calendar</h2>
        <div id="calendar"></div>
    </div>
@endsection

@include('calendar.popup')

@push('scripts')
    <!-- FullCalendar CDN -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            if (calendarEl) {
                // Initialize FullCalendar
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth', // Default view
                    events: '/api/bookings', // Use the fetched events for the calendar

                    // Customizing FullCalendar features
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },

                    // Event pop-up on click
                    eventClick: function(info) {
                        // Get event details
                        const event = info.event;

                        // Populate the modal with event details
                        document.getElementById('eventTitle').innerText = event.title;
                        document.getElementById('eventStart').innerText = event.start.toLocaleString();
                        document.getElementById('eventEnd').innerText = event.end ? event.end.toLocaleString() : 'N/A';
                        document.getElementById('eventDescription').innerText = event.extendedProps.description || 'No description available';
                        document.getElementById('eventOrganizer').innerText = event.extendedProps.organizer || 'No organizer available';
                        document.getElementById('eventParticipants').innerHTML = event.extendedProps.participants || 'No participants available';
                        document.getElementById('eventTotalDuration').innerText = event.extendedProps.totalDuration || 'No duration available';

                        // Show the Bootstrap modal
                        $('#eventModal').modal('show');
                    },

                    // Enable event dragging and resizing
                    editable: true,
                    droppable: true,

                    // Add custom color based on event data
                    eventColor: '#000000',
                    eventTextColor: '#fff',

                    // Adding a custom tooltip for events
                    eventRender: function(info) {
                        $(info.el).tooltip({
                            title: info.event.title,
                            placement: 'top',
                            trigger: 'hover'
                        });
                    },
                });

                // Render the calendar
                calendar.render();
            }
        });
    </script>
@endpush

