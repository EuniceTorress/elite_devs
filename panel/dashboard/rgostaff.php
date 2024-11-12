    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .summary-cards {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 20px;
        }

        .sales-trend {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comp {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .comp-col {
            display: flex;
            flex-direction: column;
        }

        .f-rentals {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0;
        }

        .analytics-s {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .analytics-s1 {
            display: flex;
            flex-direction: column;
            width: 60%;
        }

        .analytics-s2 {
            display: flex;
            flex-direction: row;
            flex: wrap;
            gap: 20px;
        }

        
.card {
    border-radius: 12px; 
    padding: 20px;
    color: #333;
    font-size: 16px;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    background: #fff; 
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12); 
}

.card[data-type="inventory-data"] {
    background: #e8f5e9; 
    border-left: 6px solid #66bb6a; 
    color: #388e3c; 
    height: 130px;
}

.card[data-type="inventory-data"]:hover {
    background: #dcedc8; 
    border-left-color: #43a047; 
}

.card[data-type="sales-data"] {
    background: #fff3e0; 
    border-left: 6px solid #ffb74d; 
    color: #f57c00; 
    height: 130px;
}

.card[data-type="sales-data"]:hover {
    background: #ffe0b2; 
    border-left-color: #fb8c00; 
}

.card[data-type="sales"] {
    background: #fff3e0; 
    border-left: 6px solid #ffb74d; 
    color: #f57c00; 
}

.card[data-type="sales"]:hover {
    background: #ffe0b2; 
    border-left-color: #fb8c00; 
}

.card[data-type="stock"] {
    background: #e8f5e9; 
    border-left: 6px solid #66bb6a; 
    color: #388e3c; 
}

.card[data-type="stock"]:hover {
    background: #dcedc8;
    border-left-color: #43a047; 
}

.card[data-type="rentals"] {
    background: #ffe0e0;
    border-left: 6px solid #FF6F61;
    color: #d32f2f;
    margin: 0 0 20px 0;
}

.card[data-type="rentals"]:hover {
    background: #ffcccc;
    border-left-color: #FF6F61;
}

.card[data-type="rentals"] .card-icon {
    font-size: 40px;
    color: #f06292; 
}

.card[data-type="turnover"] {
    background: #e3f2fd;
    border-left: 6px solid #64b5f6;
    color: #1976d2; 
}

.card[data-type="turnover"]:hover {
    background: #bbdefb;
    border-left-color: #1e88e5; 
}

.card h3 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.card .icon {
    font-size: 20px;
    margin-right: 10px;
    vertical-align: middle;
    transition: transform 0.5s ease, color 0.3s ease;
    color: inherit; 
}
        .card:hover .card-icon {
            transform: translateX(-5px) rotate(-5deg);
        }

        .card p {
            font-size: 1.5rem;
        }

        .card {
            flex: 1;
            background: #800000;
            color: #fff;
            padding: 20px;
            height: 10rem;
            border-radius: 8px;
            text-align: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            align-content: center;
        }

        .card-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .c-value {
            display: flex;
            flex-direction: row;
        }

        .c-value p {
            padding: 5px;
            font-size: 1.2rem;
        }

        .calendar-section {
            background-color: #fff;
            margin-top: 20px;
            border-radius: 8px;
            padding: 0;
            border: 1px solid rgba(128, 0, 0, 0.8);
            margin-right: 20px;
        }

        .calendar-header {
            font-size: 2rem;
            font-weight: bold;
            color: #800000;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            padding: 10px;
        }

        .reservation-status {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .status-card {
            flex: 1 1 30%;
            background: #f4f4f4;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .pie-c {
            padding: 20px 20px 60px 20px;
            height: 520px;
            width: 45%;
        }

        .status-title {
            font-size: 18px;
            font-weight: bold;
            color: #800000;
            margin-bottom: 10px;
        }

        .chart-container {
            border-radius: 8px;
            padding: 20px 20px 60px 20px;
            justify-content: center;
            align-items: center;
            align-content: content;
        }
        
        .bar-chart-container {
            width: 100%;
            height: 410px;
            border-radius: 12px;
            padding: 20px 20px 70px 20px;
            text-align: center;
            border: 1px solid rgba(255, 204, 188, 0.7);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            background: transparent;
            transition: box-shadow 0.3s ease-in-out;
        }

        .bar-chart-container h2 {
            font-size: 22px;
            color: #800000;
            margin-bottom: 20px;
            font-weight: bold;
        }

        canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .chart-tooltip {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

    </style>
    

    <?php
        include 'rgo/sumcards.php';
    ?>
        
    <div class="sales-trend">
        <?php
        include 'rgo/sales.php';
        include 'rgo/product.php';
        ?>
    </div>


    
    <div class="comp">
        <?php
        include 'rgo/comparison.php';
        ?>
        <div class="chart-container pie-c">
            <h2 class="text-center">Inventory by Category</h2>
            <canvas id="pieChart"></canvas>
        </div>
    </div>

<div class="analytics-s">
    <?php include 'rgo/log.php'; ?>
    <div class="analytics-s1">
        <div class="analytics-s2">
            <div class="card" data-type="inventory-data">
                <div class="d-flex">
                    <span class="material-icons card-icon">inventory</span> 
                    <p>0%</p>
                </div>
                <h3>Total Inventory</h3>
            </div>

            <div class="card" data-type="sales-data">
                <div class="d-flex">
                    <span class="material-icons card-icon">shopping_cart</span>
                    <p>₱ 0</p> 
                </div>
                <h3>Total Sales</h3>
            </div>
        </div>
        <?php include 'rgo/analytics.php'; ?>
    </div>
</div>

<!-- 
    <h4 class="calendar-header">Upcoming Events & Reservations</h4>

    <div class="f-rentals">

        include 'rgo/calendar.php';


        <div class="comp-col">
            <div class="card" data-type="rentals">
                <div class="d-flex">
                    <span class="material-icons card-icon">account_balance_wallet</span>
                    <p>$150,000</p>
                </div>
                <h3>Rental Revenue</h3>
            </div>
            <div class="bar-chart-container">
                <h2 class="text-center">Facility Usage</h2>
                <canvas id="facilityUsageChart"></canvas>
            </div>
        </div>

    </div> -->

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        fetchAnalyticsDataD();
    });

    function fetchAnalyticsDataD() {
        fetch("../../sql/dashboard/analytics.php")
            .then(response => response.json())
            .then(data => {
                document.querySelector('.card[data-type="inventory-data"] p').textContent = `${data.inventory}`;
                document.querySelector('.card[data-type="sales-data"] p').textContent = `₱ ${data.sales}`;
            })
            .catch(error => console.error("Error fetching analytics data:", error));
    }


   async function loadPieChart() {
        try {
            const response = await fetch('../../sql/dashboard/pie-c.php');
            const data = await response.json();

            const labels = data.map(item => item.category);
            const values = data.map(item => item.total);

            new Chart(document.getElementById('pieChart'), {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Category Distribution',
                        data: values,
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        } catch (error) {
            console.error('Error loading pie chart data:', error);
        }
    }

    loadPieChart();

    // const facilityUsageChartCtx = document.getElementById('facilityUsageChart').getContext('2d');
    // const facilityUsageChart = new Chart(facilityUsageChartCtx, {
    //     type: 'bar',
    //     data: {
    //         labels: ['Facility 1', 'Facility 2', 'Facility 3', 'Facility 4', 'Facility 5'],
    //         datasets: [{
    //             label: 'Usage Percentage',
    //             data: [85, 75, 65, 55, 95], // Replace with dynamic data
    //             backgroundColor: ['#ffb74d', '#66bb6a', '#64b5f6', '#ff6f61', '#81c784'],
    //             borderColor: ['#fb8c00', '#388e3c', '#1976d2', '#d32f2f', '#4caf50'],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             tooltip: {
    //                 enabled: true,
    //                 backgroundColor: '#000',
    //                 bodyColor: '#fff',
    //                 borderColor: '#fff',
    //                 borderWidth: 1
    //             }
    //         },
    //         scales: {
    //             y: {
    //                 beginAtZero: true,
    //                 max: 100,
    //                 ticks: {
    //                     stepSize: 10
    //                 }
    //             }
    //         }
    //     }
    // });
</script>
