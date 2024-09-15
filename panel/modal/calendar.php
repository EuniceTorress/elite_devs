<style>
        /* Calendar Modal Styling */
        .calendar {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .calendar-header h2 {
        margin: 0;
        font-size: 1rem;
    }

    .calendar-header button {
        background: none;
        border: none;
        color: blue;
        font-size: 2rem;
        cursor: pointer;
        outline: none !important;
    }

    .calendar-header button:hover {
        color: maroon;
    }

    .calendar-weekdays {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .calendar-weekdays div {
        width: 14%;
        text-align: center;
        font-weight: bold;
        color: #666;
    }

    .calendar-days {
        display: flex;
        flex-wrap: wrap;
        overflow: auto;
        height: calc(100% - 60px);
    }

    .calendar-days div {
        width: 14%;
        height: 40px;
        text-align: center;
        line-height: 40px;
        margin-bottom: 5px;
        border-radius: 4px;
        cursor: pointer;
    }

    .calendar-days div:hover {
        background-color: #f0f0f0;
    }

    .calendar-days .today {
        background-color: #007bff;
        color: white;
    }

    .calendar-days .empty {
        background-color: transparent;
        cursor: default;
    }

    .event-details {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f8f9fa;
        overflow-y: auto;
    }

    .event-details h3 {
        margin-top: 0;
    }
</style>
<!-- Calendar Modal -->
<div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calendarModalLabel">Calendar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="calendar">
                    <div class="calendar-header">
                        <button onclick="prevMonth()">&lt;</button>
                        <h2 id="month-year"></h2>
                        <button onclick="nextMonth()">&gt;</button>
                    </div>
                    <div class="calendar-weekdays">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="calendar-days" id="calendar-days"></div>
                    <div class="event-details" id="event-details">
                        <h3 id="event-title">Select a date to view details</h3>
                        <p id="event-description">No event details available.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const calendarDays = document.getElementById('calendar-days');
    const monthYear = document.getElementById('month-year');
    const eventTitle = document.getElementById('event-title');
    const eventDescription = document.getElementById('event-description');
    const today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    const events = {
        '2024-08-15': { title: 'Event 1', description: 'Description for Event 1.' },
        '2024-08-18': { title: 'Event 2', description: 'Description for Event 2.' }
    };

    function renderCalendar(month, year) {
        calendarDays.innerHTML = "";
        monthYear.innerText = `${months[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            calendarDays.innerHTML += `<div class="empty"></div>`;
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const event = events[dateStr];
            const isToday = day === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            const eventClass = event ? 'event' : '';
            calendarDays.innerHTML += `<div class="${isToday ? 'today' : eventClass}" onclick="showEventDetails('${dateStr}')">${day}</div>`;
        }
    }

    function showEventDetails(dateStr) {
        const event = events[dateStr];
        if (event) {
            eventTitle.innerText = event.title;
            eventDescription.innerText = event.description;
        } else {
            eventTitle.innerText = 'No Event';
            eventDescription.innerText = 'No event details available.';
        }
    }

    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    }

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    }

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    function showCalendarModal() {
        // Render the calendar for the current month and year
        renderCalendar(currentMonth, currentYear);
        // Show the modal
        new bootstrap.Modal(document.getElementById('calendarModal')).show();
    }
</script>
