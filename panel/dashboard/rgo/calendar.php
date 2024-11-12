<style>
.calendar-section {
    background: linear-gradient(135deg, #fafafa 0%, #f0f0f0 100%);
    border-radius: 18px;
    padding: 25px 35px;
    border: 1px solid #FF6F61; 
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    width: 70%;
    height: 560px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    position: relative;
    animation: fadeIn 1s ease-in-out;
    margin: 0 20px 0 0;
}

.calendar-header {
    font-size: 2rem;
    color: #FF6F61;
    text-align: center;
    margin-bottom: 20px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: capitalize;
}

.calendar-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.calendar-controls button {
    background-color: #FF6F61;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 12px;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-weight: 500;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
}

.calendar-controls button:hover {
    background-color: #FF3B30;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.calendar-month {
    font-size: 1.3rem;
    font-weight: 500;
    color: #FF6F61;
    letter-spacing: 0.8px;
}

.calendar {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 15px;
    text-align: center;
}

.day-name {
    font-weight: 600;
    color: #333;
    font-size: 1rem;
    padding: 10px;
    background-color: #f7f7f7;
    border-radius: 10px;
    transition: background-color 0.2s ease;
}

.day-name:hover {
    background-color: #f2f2f2;
}

.calendar-day {
    padding: 18px;
    background-color: #fff;
    border-radius: 12px;
    font-weight: 500;
    color: #333;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.calendar-day:hover {
    transform: scale(1.05);
    background-color: #FF6F61;
    color: #fff;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
}

.calendar-day.event-day {
    background-color: #FF9800; 
    color: #fff;
    font-weight: 600;
}

.calendar-day.today {
    border: 3px solid #FF6F61;
    background-color: #fff;
    font-weight: bold;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    animation: bounceIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes bounceIn {
    0% {
        transform: scale(0.9);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}

@media (max-width: 500px) {
    .calendar-section {
        padding: 20px;
    }
    .calendar-controls button {
        padding: 8px 15px;
        font-size: 0.95rem;
    }
    .calendar-day {
        padding: 14px;
        font-size: 1rem;
    }
}

</style>
<div class="calendar-section">
    
    <div class="calendar-controls">
        <button onclick="prevMonth()">&#8592; Prev</button>
        <div class="calendar-month" id="calendar-month"></div>
        <button onclick="nextMonth()">Next &#8594;</button>
    </div>
    
    <div class="calendar" id="calendar"></div>
</div>

<script>
    const calendarElement = document.getElementById('calendar');
    const monthElement = document.getElementById('calendar-month');
    const events = [
        { date: '2024-03-10', title: 'Conference Room Booking' },
        { date: '2024-03-15', title: 'Workshop' },
        { date: '2024-03-20', title: 'Event in Hall' }
    ];

    const monthNames = ["January", "February", "March", "April", "May", "June", 
                        "July", "August", "September", "October", "November", "December"];
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function isToday(day) {
        const today = new Date();
        return day === today.getDate() && 
               currentMonth === today.getMonth() && 
               currentYear === today.getFullYear();
    }

    function populateCalendar() {
        calendarElement.innerHTML = '';
        monthElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;

        const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayNames.forEach(day => {
            const dayNameDiv = document.createElement('div');
            dayNameDiv.classList.add('day-name');
            dayNameDiv.textContent = day;
            calendarElement.appendChild(dayNameDiv);
        });

        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyDiv = document.createElement('div');
            calendarElement.appendChild(emptyDiv);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayDiv = document.createElement('div');
            dayDiv.classList.add('calendar-day');
            dayDiv.textContent = day;

            if (isToday(day)) {
                dayDiv.classList.add('today');
            }

            const event = events.find(e => {
                const eventDate = new Date(e.date);
                return eventDate.getDate() === day &&
                       eventDate.getMonth() === currentMonth &&
                       eventDate.getFullYear() === currentYear;
            });

            if (event) {
                dayDiv.classList.add('event-day');
                dayDiv.title = event.title;
            }

            calendarElement.appendChild(dayDiv);
        }
    }

    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        populateCalendar();
    }

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        populateCalendar();
    }

    populateCalendar();
</script>
