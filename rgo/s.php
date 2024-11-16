<style>
    .sales-container {
        position: relative;
        width: 70%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #salesChartCanvas {
        padding: 20px;
        width: 100% !important;
        height: 100% !important;
        border-radius: 12px;
        border: 1px solid rgba(255, 204, 188, 0.7);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        background: transparent;
        transition: box-shadow 0.3s ease-in-out;
    }

    .no-sales-message {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.2em;
        color: #999;
        text-align: center;
    }

    .sales-title {
        height: 10%;
        margin-bottom: 10px;
        font-size: 24px;
        text-align: center;
    }
</style>

<div class="sales-container">
    <h2 class="sales-title">Sales Overview</h2>
    <canvas id="salesChartCanvas"></canvas>
    <div id="noSalesMessage" class="no-sales-message" style="display: none;">
        No sales data available.
    </div>
</div>

<script>
    function Sales(salesData) {
        const ctx = document.getElementById('salesChartCanvas').getContext('2d');

        // Create the gradient with 3 colors representing low, mid, and high sales
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(255, 190, 150, 1)');  // Soft peach for low sales
        gradient.addColorStop(0.5, 'rgba(255, 152, 0, 1)');  // Strong orange for mid sales
        gradient.addColorStop(1, 'rgba(255, 99, 132, 1)');  // Vibrant red for high sales

        const chartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Sales Revenue',
                data: salesData,
                fill: true, 
                borderColor: gradient,  // Applying the gradient color to the line
                backgroundColor: 'rgba(255, 190, 150, 0.3)',  // Soft peach background for the filled area
                borderWidth: 4,
                pointBackgroundColor: 'rgba(255, 190, 150, 1)',  // Matching point color with line color (peach)
                pointRadius: 6,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: 'rgba(255, 99, 132, 1)',  // Red when hovered
                tension: 0.3,  // Smooth curves for the line
            }]
        };

        const config = {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuint',
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(255, 255, 255, 0.3)',
                        borderWidth: 1,
                        callbacks: {
                            label: function (tooltipItem) {
                                return `Revenue: ₱${tooltipItem.raw.toLocaleString()}`;
                            }
                        }
                    },
                    legend: {
                        display: false,
                    },
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(220, 220, 220, 0.1)',
                        },
                        ticks: {
                            color: '#5a5a5a',
                            font: {
                                size: 12,
                                family: 'Arial',
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(220, 220, 220, 0.1)',
                        },
                        ticks: {
                            color: '#5a5a5a',
                            font: {
                                size: 12,
                                family: 'Arial',
                            },
                            callback: function (value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        };

        const salesChart = new Chart(ctx, config);

        // If no sales data is available, show a message
        const hasData = salesData.some(value => value > 0);
        if (!hasData) {
            document.getElementById('noSalesMessage').style.display = 'block';
            document.getElementById('salesChartCanvas').style.display = 'none';
        }
    }

    const exampleSalesData = [12000, 15000, 8000, 19000, 22000, 18000, 24000, 25000, 27000, 29000, 31000, 35000];
    Sales(exampleSalesData);
</script>
