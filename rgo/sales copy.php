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

    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Sales',
                    data: [],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                },
                {
                    label: 'Cost',
                    data: [],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
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
                        text: 'Date'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Amount'
                    }
                }
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
                    const priceData = salesData.map(item => item.price);
                    const costData = salesData.map(item => item.cost);
                    const labels = salesData.map(item => item.date);

                    if (month) {
                        salesChart.data.labels = labels; 
                    } else {
                        const months = [
                            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                        ];
                        salesChart.data.labels = salesData.map(item => months[new Date(item.date).getMonth()]);
                    }

                    salesChart.data.datasets[0].data = priceData;
                    salesChart.data.datasets[1].data = costData;
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
