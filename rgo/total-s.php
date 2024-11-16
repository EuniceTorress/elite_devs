<div class="pie-chart-container">
    <div class="card" data-type="total-cost" style="margin-bottom: 30px">
        <div class="d-flex">
            <span class="material-icons card-icon" style="margin-top: -5px;">inventory_2</span>
            <p id="inventory-value" style="margin-left: 5px;">0</p>
        </div>
        <h3>Total Stocks</h3>
    </div>
<script>
    document.getElementById('month').addEventListener('change', function() {
        let month = this.value;
        let year = document.getElementById('year').value;

        fetch('../../sql/dashboard/total.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `month=${month}&year=${year}`
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('sales-value').textContent = data.totalStocks;
        })
        .catch(error => console.error('Error fetching data:', error));
    });
</script>
