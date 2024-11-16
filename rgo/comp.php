<style>
    .s-items-container {
        width: 100%;
        height: 100vh;
        border-radius: 12px;
        background: transparent;
        border: 1px solid rgba(255, 204, 188, 0.7);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        padding: 10px 15px 60px 15px;
        box-sizing: border-box;
        position: relative;
        margin: 20px 0;
    }

    .s-items-container:hover {
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
    }

    .s-items-title {
        text-align: justify;
        color: #333;
        font-size: 1.5em;
        font-weight: 600;
        margin-bottom: 15px;
        font-family: Arial, sans-serif;
    }

    #comboChart {
        flex-grow: 1;
        position: relative;
        width: 100%;
    }

    .no-sales-message {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.2em;
        color: #999;
        text-align: center;
        font-family: Arial, sans-serif;
        display: none;
    }

    #categorySelect {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid rgba(255, 204, 188, 0.8);
        background: rgba(255, 243, 224, 0.9);
        color: #5a5a5a;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        outline: none;
        font-size: 14px;
        z-index: 20000;
    }
</style>

<div class="s-items-container">
<h2 class="top-items-title">Inventory x Sales</h2>
    <canvas id="comboChart"></canvas>
    <div id="noSalesMessage" class="no-sales-message">
        No sales this month.
    </div>
</div>

<script>
let comboChart = null;

async function loadStockAndSales(category = "", month = new Date().getMonth() + 1, year = new Date().getFullYear()) {
    try {
        const response = await fetch(`../../sql/dashboard/comp.php?category=${category}&month=${month}&year=${year}`);
        const items = await response.json();

        if (items.length === 0) {
            document.getElementById('noSalesMessage').style.display = 'block';
            document.getElementById('comboChart').style.display = 'none';
            return;
        }

        document.getElementById('noSalesMessage').style.display = 'none';
        document.getElementById('comboChart').style.display = 'block';

        if (comboChart) {
            comboChart.destroy(); 
        }

        const labels = items.map(item => item.name);
        const stockData = items.map(item => item.stock_quantity);
        const salesData = items.map(item => item.units_sold);

        const ctx = document.getElementById('comboChart').getContext('2d');
        comboChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Stock Quantity',
                        data: stockData,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        type: 'bar',
                        yAxisID: 'y1',
                    },
                    {
                        label: 'Units Sold',
                        data: salesData,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        type: 'line',
                        fill: false,
                        tension: 0.1,
                        yAxisID: 'y2',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y1: {
                        beginAtZero: true,
                        grid: {
                            color: "rgba(220, 220, 220, 0.1)"
                        },
                        ticks: {
                            color: '#5a5a5a',
                            font: {
                                size: 12,
                                family: 'Arial'
                            }
                        },
                        position: 'left',
                    },
                    y2: {
                        beginAtZero: true,
                        grid: {
                            color: "rgba(220, 220, 220, 0.1)"
                        },
                        ticks: {
                            color: '#5a5a5a',
                            font: {
                                size: 12,
                                family: 'Arial'
                            }
                        },
                        position: 'right',
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleFont: { size: 14, weight: 'bold', family: 'Arial' },
                        bodyFont: { size: 12, family: 'Arial' },
                        padding: 10,
                        cornerRadius: 6
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuint'
                }
            }
        });
    } catch (error) {
        console.error('Error fetching stock and sales data:', error);
    }
}
loadStockAndSales(); 

</script>
