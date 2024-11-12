<style>
    .sales-container {
        width: 66%;
        height: 420px;
        padding: 20px 20px 70px 20px;
        border-radius: 12px;
        border: 1px solid rgba(255, 204, 188, 0.7);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        background: transparent;
        transition: box-shadow 0.3s ease-in-out;
    }

    .sales-container:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    h2 {
        text-align: center;
        color: #5a5a5a;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1.8em;
        margin-bottom: 20px;
    }
</style>
<div class="sales-container">
    <h2>Sales Overview</h2>
    <canvas id="salesChart"></canvas>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(255, 190, 150, 0.4)');
    gradient.addColorStop(1, 'rgba(255, 240, 220, 0.2)');
    
    const labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    const data = {
        labels: labels,
        datasets: [{
            label: 'Monthly Sales',
            data: Array(12).fill(0),
            backgroundColor: gradient,
            borderColor: 'rgba(255, 152, 0, 0.8)',
            borderWidth: 3,
            pointBackgroundColor: '#fff',
            pointBorderColor: 'rgba(255, 152, 0, 1)',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 8,
            pointHoverBackgroundColor: 'rgba(255, 140, 0, 0.9)',
            tension: 0.4,
            fill: true
        }]
    };

    const options = {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: 'none'
            },
            tooltip: {
                enabled: true,
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                titleFont: { size: 16, weight: 'bold', family: 'Arial' },
                bodyFont: { size: 14, family: 'Arial' },
                padding: 12,
                cornerRadius: 6,
                callbacks: {
                    label: function(context) {
                        return `Sales: $${context.raw}`;
                    }
                }
            }
        },
        scales: {
            x: {
                ticks: { 
                    color: '#5a5a5a',
                    font: { size: 12, family: 'Arial' }
                },
                grid: { color: 'rgba(220, 220, 220, 0.1)' }
            },
            y: {
                beginAtZero: true,
                ticks: { 
                    color: '#5a5a5a',
                    font: { size: 12, family: 'Arial' }
                },
                grid: { color: 'rgba(220, 220, 220, 0.1)' }
            }
        },
        animation: {
            duration: 1200,
            easing: 'easeOutQuint'
        },
        hover: {
            mode: 'nearest',
            intersect: true
        }
    };

    const salesChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });

    function fetchSalesData(year) {
        fetch(`../../sql/dashboard/sales.php?year=${year}`)
            .then(response => response.json())
            .then(monthlySales => {
                salesChart.data.datasets[0].data = monthlySales;
                salesChart.update();
            })
            .catch(error => console.error('Error fetching sales data:', error));
    }

    window.onload = function() {
        const currentYear = new Date().getFullYear();
        fetchSalesData(currentYear);
    };

    document.getElementById('year').addEventListener('change', function() {
        const selectedYear = this.value;
        fetchSalesData(selectedYear);
    });
</script>
