<style>
    .dashboard {
    padding: 20px;
}

main {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.stats {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.stat-card {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
    flex: 1;
    min-width: 200px;
}

.charts {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.chart-container {
    flex: 1;
    min-width: 300px;
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

.recent-activity {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

.recent-activity h2 {
    margin-top: 0;
}

.recent-activity ul {
    list-style: none;
    padding: 0;
}

.recent-activity ul li {
    background-color: #f9f9f9;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}
</style>

<div class="dashboard">
    <main>
        <section class="stats">
            <div class="stat-card">Total Users: <span id="total-users">0</span></div>
            <div class="stat-card">Total Sales: $<span id="total-sales">0</span></div>
            <div class="stat-card">Active Sessions: <span id="active-sessions">0</span></div>
            <div class="stat-card">New Signups Today: <span id="new-signups">0</span></div>
        </section>
        <section class="charts">
            <div class="chart-container">
                <canvas id="sales-trend" width="400" height="200"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="user-growth" width="400" height="200"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="sessions-overview" width="400" height="200"></canvas>
            </div>
        </section>
        <section class="recent-activity">
            <h2>Recent Activity</h2>
            <ul id="activity-feed">
                <!-- Activities will be added here dynamically -->
            </ul>
        </section>
    </main>
</div>

<script>
    // scripts.js

// Sample data for charts
const salesData = [1200, 1500, 1800, 2000, 2500];
const userData = [300, 320, 340, 360, 380];
const sessionsData = [50, 75, 100, 125, 150];
const activities = [
    'User A logged in',
    'User B made a purchase',
    'User C updated profile',
    'User D signed up',
    'User E commented',
    'User F sent a message',
    'User G uploaded a file',
    'User H deleted an account'
];

// Initialize Charts
document.addEventListener('DOMContentLoaded', () => {
    const ctxSales = document.getElementById('sales-trend').getContext('2d');
    const ctxUsers = document.getElementById('user-growth').getContext('2d');
    const ctxSessions = document.getElementById('sessions-overview').getContext('2d');

    new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                label: 'Sales Trend',
                data: salesData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true
            }]
        }
    });

    new Chart(ctxUsers, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                label: 'User Growth',
                data: userData,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        }
    });

    new Chart(ctxSessions, {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Idle', 'Offline'],
            datasets: [{
                data: sessionsData,
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                borderWidth: 1
            }]
        }
    });

    // Populate recent activities
    const activityFeed = document.getElementById('activity-feed');
    activities.forEach(activity => {
        const li = document.createElement('li');
        li.textContent = activity;
        activityFeed.appendChild(li);
    });

    // Update stats
    document.getElementById('total-users').textContent = userData.reduce((a, b) => a + b, 0);
    document.getElementById('total-sales').textContent = salesData.reduce((a, b) => a + b, 0);
    document.getElementById('active-sessions').textContent = sessionsData.reduce((a, b) => a + b, 0);
    document.getElementById('new-signups').textContent = Math.floor(Math.random() * 50) + 10; // Example number
});

</script>