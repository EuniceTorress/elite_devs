    <style>
        .top-items-container {
            width: 28%;
            height: 100%;
            border-radius: 12px;
            background: transparent;
            border: 1px solid rgba(255, 204, 188, 0.7);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            padding: 15px 15px 60px 15px;
            box-sizing: border-box;
            position: relative;
        }

        .top-items-container:hover {
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        .top-items-title {
            text-align: justify;
            color: #333;
            font-size: 1.5em;
            font-weight: 600;
            margin-bottom: 15px;
            font-family: Arial, sans-serif;
        }

        #topItemsChart {
            flex-grow: 1;
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
        }
    </style>
</head>
<body>

<div class="top-items-container">
    <h2 class="top-items-title">Slow Selling Items</h2>
    <canvas id="topItemsChart"></canvas>
    <div id="noSalesMessage" class="no-sales-message" style="display: none;">
        No sales this month.
    </div>
</div>

<script>
    async function fetchTopItems(month, year) {
        const response = await fetch(`../../sql/dashboard/sold.php?month=${month}&year=${year}`);
        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }
        return await response.json();
    }

    async function loadSold() {
        const selectedMonth = document.getElementById('month')?.value;
        const selectedYear = document.getElementById('year')?.value;

        try {
            const items = await fetchTopItems(selectedMonth, selectedYear);

            if (items.length === 0) {
                document.getElementById('noSalesMessage').style.display = 'block'; 
                document.getElementById('topItemsChart').style.display = 'none';  
                return;
            }

            document.getElementById('noSalesMessage').style.display = 'none';
            document.getElementById('topItemsChart').style.display = 'block';

            const labels = items.map(item => item.name);
            const data = items.map(item => item.total_units_sold);

            const ctx = document.getElementById('topItemsChart').getContext('2d');
            const topItemsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Units Sold',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 190, 150, 0.6)',
                            'rgba(255, 152, 0, 0.6)',
                            'rgba(255, 115, 64, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(240, 95, 160, 0.6)'
                        ],
                        borderColor: 'rgba(255, 255, 255, 0)',
                        borderRadius: 8,
                        barThickness: 20
                    }]
                },
                options: {
                    indexAxis: 'y',
                    layout: {
                        padding: { left: 10, right: 10, top: 5, bottom: 5 }
                    },
                    scales: {
                        x: {
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
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#5a5a5a',
                                font: {
                                    size: 12,
                                    family: 'Arial'
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleFont: { size: 14, weight: 'bold', family: 'Arial' },
                            bodyFont: { size: 12, family: 'Arial' },
                            padding: 10,
                            cornerRadius: 6
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuint'
                    },
                    hover: {
                        mode: 'nearest',
                        animationDuration: 0
                    }
                }
            });

        } catch (error) {
            console.error(error);
        }
    }

    loadSold();
</script>
