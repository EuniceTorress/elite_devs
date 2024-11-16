<style>
    .sales-container {
        position: relative;
        width: 70%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .sales-container h2 {
        height: 10%;
        margin-bottom: 10px;
        font-size: 24px;
        text-align: center;
    }

    #salesChart {
        padding: 20px;
        width: 100% !important;
        height: 100% !important;
        border-radius: 12px;
        border: 1px solid rgba(255, 204, 188, 0.7);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        background: transparent;
        transition: box-shadow 0.3s ease-in-out;
    }

    #salesChart:hover {
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
    }
</style>

<div class="sales-container">
    <h2>Sales Overview</h2>
    <canvas id="salesChart"></canvas>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    // Custom styles for Sales Line (light pastel green with border)
    const salesBackground = 'rgba(102, 187, 106, 0.3)';  // Light pastel green with some transparency
    const salesBorder = '#66bb6a';      // Green border
    const salesColor = '#388e3c';       // Green text color

    // Custom styles for Revenue Line (soft pastel orange with border)
    const revenueBackground = 'rgba(255, 183, 77, 0.3)';  // Light pastel orange with some transparency
    const revenueBorder = '#ffb74d';      // Orange border
    const revenueColor = '#f57c00';       // Orange text color

    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Sales',
                    data: [],
                    borderColor: salesBorder,  // Green border for the line
                    backgroundColor: salesBackground,  // Pastel green background with transparency
                    fill: true,
                    tension: 0.3,  // Slightly smoother curve
                    pointRadius: 5,
                    pointBackgroundColor: salesColor,  // Green points
                    pointBorderColor: salesBorder  // Green border for points
                },
                {
                    label: 'Sales Revenue',
                    data: [],
                    borderColor: revenueBorder,  // Orange border for the line
                    backgroundColor: revenueBackground,  // Pastel orange background with transparency
                    fill: true,
                    tension: 0.3,  // Slightly smoother curve
                    pointRadius: 5,
                    pointBackgroundColor: revenueColor,  // Orange points
                    pointBorderColor: revenueBorder,  // Orange border for points
                    opacity: 0.3  // Start with low opacity for the Revenue line
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Date or Month',
                        color: '#333'
                    },
                    ticks: {
                        color: '#333'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Amount ($)',
                        color: '#333'
                    },
                    beginAtZero: true,
                    ticks: {
                        color: '#333'
                    }
                }
            },
            plugins: {
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#333',
                    bodyColor: '#555',
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.raw) {
                                label += '$' + context.raw.toFixed(2);  // Format value as currency
                            }
                            return label;
                        }
                    }
                }
            },
            interaction: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                axis: 'x'
            }
        }
    });

    document.getElementById('month').addEventListener('change', updateSalesData);
    document.getElementById('year').addEventListener('change', updateSalesData);

    function updateSalesData() {
        const month = document.getElementById('month').value;
        const year = document.getElementById('year').value;

        fetchSalesData(month, year);
    }

    function fetchSalesData(month, year) {
        let url = `../../sql/dashboard/sales.php?year=${year}`;
        if (month) {
            url += `&month=${month}`;
        }

        fetch(url)
            .then(response => response.json())
            .then(salesData => {
                if (salesData.length > 0) {
                    const salesDataArray = salesData.map(item => item.price);
                    const revenueDataArray = salesData.map(item => item.revenue);
                    const labels = salesData.map(item => item.date);

                    if (month) {
                        salesChart.data.labels = labels;
                    } else {
                        const months = [
                            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                        ];
                        salesChart.data.labels = salesData.map(item => months[new Date(item.date).getMonth()]);
                    }

                    salesChart.data.datasets[0].data = salesDataArray;
                    salesChart.data.datasets[1].data = revenueDataArray;

                    // Logic for fading in the Revenue line when it intersects with Sales
                    salesDataArray.forEach((salesValue, index) => {
                        const revenueValue = revenueDataArray[index];
                        
                        if (revenueValue >= salesValue) {
                            salesChart.data.datasets[1].opacity = 1;  // Make the Revenue line fully visible
                        } else {
                            salesChart.data.datasets[1].opacity = 0.3;  // Keep Revenue line faded
                        }
                    });

                    salesChart.update();
                } else {
                    console.error('No sales data available for the selected month/year.');
                    salesChart.data.labels = [];
                    salesChart.data.datasets[0].data = [];
                    salesChart.data.datasets[1].data = [];
                    salesChart.update();
                }
            })
            .catch(error => console.error('Error fetching sales data:', error));
    }

    updateSalesData();
</script>