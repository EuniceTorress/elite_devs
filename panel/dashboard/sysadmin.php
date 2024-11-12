<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Styles for the dashboard */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .dashboard {
            padding: 20px;
            margin: auto;
            max-width: 1200px;
        }
        main {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .stats, .charts, .info-boxes {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .stat-card, .chart-container, .info-box {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex: 1;
            min-width: 250px;
            position: relative;
        }
        .stat-card h3 {
            margin: 0;
            color: #333;
        }
        .stat-card span {
            display: block;
            font-size: 1.5em;
            font-weight: bold;
            color: #007bff;
        }
        .chart-container {
            min-width: 300px;
        }
        .info-box h2 {
            margin-top: 0;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            color: #333;
        }
        .info-box ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .info-box ul li {
            background-color: #f9f9f9;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .info-box ul li:last-child {
            border-bottom: none;
        }
        .info-box ul li .icon {
            color: #007bff;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <main>
            <section class="stats">
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <span id="total-users">0</span>
                </div>
                <div class="stat-card">
                    <h3>Total Web Visitors</h3>
                    <span id="total-visitors">0</span>
                </div>
                <div class="stat-card">
                    <h3>Total Problems</h3>
                    <span id="total-problems">0</span>
                </div>
                <div class="stat-card">
                    <h3>Open Tickets</h3>
                    <span id="open-tickets">0</span>
                </div>
            </section>
            <section class="charts">
                <div class="chart-container">
                    <canvas id="user-growth" width="400" height="200"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="visitor-trend" width="400" height="200"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="problems-trend" width="400" height="200"></canvas>
                </div>
            </section>
            <section class="info-boxes">
                <div class="info-box">
                    <h2>Recent User Registrations</h2>
                    <ul id="user-list">
                        <!-- User info will be added here dynamically -->
                    </ul>
                </div>
                <div class="info-box">
                    <h2>Recent Problems Reported</h2>
                    <ul id="problems-list">
                        <!-- Problems will be added here dynamically -->
                    </ul>
                </div>
                <div class="info-box">
                    <h2>Stock Reservation Issues</h2>
                    <ul id="stock-issues-list">
                        <!-- Stock issues will be added here dynamically -->
                    </ul>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Sample data for charts
        const userGrowthData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'New Users',
                data: [20, 30, 25, 50, 40, 70],
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true
            }]
        };

        const visitorTrendData = {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Web Visitors',
                data: [200, 400, 300, 500],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true
            }]
        };

        const problemsTrendData = {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Reported Problems',
                data: [5, 10, 15, 8],
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true
            }]
        };

        document.addEventListener('DOMContentLoaded', () => {
            const ctxUserGrowth = document.getElementById('user-growth').getContext('2d');
            const ctxVisitorTrend = document.getElementById('visitor-trend').getContext('2d');
            const ctxProblemsTrend = document.getElementById('problems-trend').getContext('2d');

            new Chart(ctxUserGrowth, {
                type: 'line',
                data: userGrowthData,
                options: {
                    plugins: {
                        legend: { display: true },
                        title: { display: true, text: 'User Growth Over Time' }
                    }
                }
            });

            new Chart(ctxVisitorTrend, {
                type: 'bar',
                data: visitorTrendData,
                options: {
                    plugins: {
                        legend: { display: true },
                        title: { display: true, text: 'Web Visitor Trend' }
                    }
                }
            });

            new Chart(ctxProblemsTrend, {
                type: 'line',
                data: problemsTrendData,
                options: {
                    plugins: {
                        legend: { display: true },
                        title: { display: true, text: 'Reported Problems Trend' }
                    }
                }
            });

            // Sample data for lists
            const users = ['User A - Joined on 2024-01-10', 'User B - Joined on 2024-01-15'];
            const problems = ['Issue with reservation system - 2024-01-20', 'User reported stock issues - 2024-01-21'];
            const stockIssues = ['Low stock on item A', 'Item B reported missing'];

            // Populate user registrations
            const userList = document.getElementById('user-list');
            users.forEach(user => {
                const li = document.createElement('li');
                li.innerHTML = user + '<i class="fas fa-user icon"></i>';
                userList.appendChild(li);
            });

            // Populate problems reported
            const problemsList = document.getElementById('problems-list');
            problems.forEach(problem => {
                const li = document.createElement('li');
                li.innerHTML = problem + '<i class="fas fa-exclamation-triangle icon"></i>';
                problemsList.appendChild(li);
            });

            // Populate stock reservation issues
            const stockIssuesList = document.getElementById('stock-issues-list');
            stockIssues.forEach(issue => {
                const li = document.createElement('li');
                li.innerHTML = issue + '<i class="fas fa-box-open icon"></i>';
                stockIssuesList.appendChild(li);
            });

            // Update stats
            document.getElementById('total-users').textContent = users.length; // Example number
            document.getElementById('total-visitors').textContent = 1500; // Example number
            document.getElementById('total-problems').textContent = problems.length; // Example number
            document.getElementById('open-tickets').textContent = 2; // Example number
        });
    </script>
</body>
</html>
