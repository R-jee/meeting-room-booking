<!-- Modal for event details -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Event Title:</strong> <span id="eventTitle"></span></p>
                <p><strong>Start Time:</strong> <span id="eventStart"></span></p>
                <p><strong>End Time:</strong> <span id="eventEnd"></span></p>
                <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                <p><strong>Event Organizer:</strong> <span id="eventOrganizer"></span></p>
                <p><strong>Participants:</strong> <span id="eventParticipants"></span></p>
                <p><strong>Duration:</strong> <span id="eventTotalDuration"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
