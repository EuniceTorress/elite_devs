 <style>

        .dashboard {
            padding: 20px;
            margin: auto;
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

        .stat-card {
            text-align: center;
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

        .info-box {
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

        .recent-activity {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .recent-activity h2 {
            margin-top: 0;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            color: #333;
        }

        .recent-activity ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .recent-activity ul li {
            background-color: #f9f9f9;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            color: #333;
            display: flex;
            align-items: center;
        }

        .recent-activity ul li:last-child {
            border-bottom: none;
        }

        .recent-activity ul li .timestamp {
            margin-left: auto;
            font-size: 0.9em;
            color: #888;
        }
    </style>
    <div class="dashboard">
        <main>
            <section class="stats">
                <div class="stat-card">
                    <h3>Total Facilities</h3>
                    <span id="total-facilities">0</span>
                </div>
                <div class="stat-card">
                    <h3>Total Reservations</h3>
                    <span id="total-reservations">0</span>
                </div>
                <div class="stat-card">
                    <h3>Available Items</h3>
                    <span id="available-items">0</span>
                </div>
                <div class="stat-card">
                    <h3>Upcoming Rentals</h3>
                    <span id="upcoming-rentals">0</span>
                </div>
            </section>
            <section class="charts">
                <div class="chart-container">
                    <canvas id="facility-utilization" width="400" height="200"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="item-reservation-trend" width="400" height="200"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="inventory-overview" width="400" height="200"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="sales-trends" width="400" height="200"></canvas>
                </div>
            </section>
            <section class="info-boxes">
                <div class="info-box">
                    <h2>Facility Rentals</h2>
                    <ul id="rental-list">
                        <!-- Rental info will be added here dynamically -->
                    </ul>
                </div>
                <div class="info-box">
                    <h2>Item Reservations</h2>
                    <ul id="reservation-list">
                        <!-- Reservation info will be added here dynamically -->
                    </ul>
                </div>
                <div class="info-box">
                    <h2>Inventory Management</h2>
                    <ul id="inventory-list">
                        <!-- Inventory info will be added here dynamically -->
                    </ul>
                </div>
                <div class="info-box">
                    <h2>High-Demand Stocks</h2>
                    <ul id="high-demand-stocks">
                        <!-- High-demand stocks info will be added here dynamically -->
                    </ul>
                </div>
                <div class="info-box">
                    <h2>Fast-Selling Stocks</h2>
                    <ul id="fast-selling-stocks">
                        <!-- Fast-selling stocks info will be added here dynamically -->
                    </ul>
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
        // Sample data for charts
        const facilityUtilizationData = {
            labels: ['Facility A', 'Facility B', 'Facility C', 'Facility D'],
            datasets: [{
                label: 'Usage %',
                data: [75, 60, 90, 50],
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const reservationTrendData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                label: 'Reservations Over Time',
                data: [50, 60, 70, 65, 80],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true
            }]
        };

        const inventoryData = {
            labels: ['In Stock', 'Low Stock', 'Out of Stock'],
            datasets: [{
                data: [200, 150, 50],
                backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(255, 159, 64, 0.6)', 'rgba(75, 192, 192, 0.6)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        };

        const salesTrendsData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                label: 'Sales Trends',
                data: [1500, 1700, 1800, 1900, 2200],
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.4)',
                fill: true
            }]
        };

        document.addEventListener('DOMContentLoaded', () => {
            const ctxFacility = document.getElementById('facility-utilization').getContext('2d');
            const ctxReservations = document.getElementById('item-reservation-trend').getContext('2d');
            const ctxInventory = document.getElementById('inventory-overview').getContext('2d');
            const ctxSales = document.getElementById('sales-trends').getContext('2d');

            new Chart(ctxFacility, {
                type: 'bar',
                data: facilityUtilizationData,
                options: {
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Facility Utilization'
                        }
                    }
                }
            });

            new Chart(ctxReservations, {
                type: 'line',
                data: reservationTrendData,
                options: {
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Item Reservation Trend'
                        }
                    }
                }
            });

            new Chart(ctxInventory, {
                type: 'pie',
                data: inventoryData,
                options: {
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Inventory Overview'
                        }
                    }
                }
            });

            new Chart(ctxSales, {
                type: 'line',
                data: salesTrendsData,
                options: {
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Sales Trends'
                        }
                    }
                }
            });

            // Sample data for lists
            const rentals = ['Conference Room A - 2024-08-15', 'Meeting Room B - 2024-08-20'];
            const reservations = ['Projector - 2024-08-12', 'Laptop - 2024-08-15'];
            const inventory = ['Chairs - 200', 'Tables - 100', 'Whiteboards - 50'];
            const highDemandStocks = ['Item X - 100 units', 'Item Y - 80 units'];
            const fastSellingStocks = ['Item A - 50 units', 'Item B - 40 units'];
            const activities = [
                'User A reserved a conference room',
                'User B checked out a projector',
                'User C updated inventory',
                'User D made a reservation for a laptop',
                'User E created a new rental'
            ];

            // Populate recent activities
            const activityFeed = document.getElementById('activity-feed');
            activities.forEach(activity => {
                const li = document.createElement('li');
                li.innerHTML = activity + '<span class="timestamp">Just now</span>';
                activityFeed.appendChild(li);
            });

            // Populate rental info
            const rentalList = document.getElementById('rental-list');
            rentals.forEach(rental => {
                const li = document.createElement('li');
                li.innerHTML = rental + '<i class="fas fa-calendar-alt icon"></i>';
                rentalList.appendChild(li);
            });

            // Populate reservation info
            const reservationList = document.getElementById('reservation-list');
            reservations.forEach(reservation => {
                const li = document.createElement('li');
                li.innerHTML = reservation + '<i class="fas fa-box icon"></i>';
                reservationList.appendChild(li);
            });

            // Populate inventory info
            const inventoryList = document.getElementById('inventory-list');
            inventory.forEach(item => {
                const li = document.createElement('li');
                li.innerHTML = item + '<i class="fas fa-cube icon"></i>';
                inventoryList.appendChild(li);
            });

            // Populate high-demand stocks info
            const highDemandList = document.getElementById('high-demand-stocks');
            highDemandStocks.forEach(stock => {
                const li = document.createElement('li');
                li.innerHTML = stock + '<i class="fas fa-arrow-up icon"></i>';
                highDemandList.appendChild(li);
            });

            // Populate fast-selling stocks info
            const fastSellingList = document.getElementById('fast-selling-stocks');
            fastSellingStocks.forEach(stock => {
                const li = document.createElement('li');
                li.innerHTML = stock + '<i class="fas fa-clock icon"></i>';
                fastSellingList.appendChild(li);
            });

            // Update stats
            document.getElementById('total-facilities').textContent = 10; // Example number
            document.getElementById('total-reservations').textContent = 15; // Example number
            document.getElementById('available-items').textContent = 50; // Example number
            document.getElementById('upcoming-rentals').textContent = 5; // Example number
        });
    </script>