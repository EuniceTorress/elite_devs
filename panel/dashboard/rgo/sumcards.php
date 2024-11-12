<div class="summary-cards" id="summary-cards">
    <div class="card" data-type="sales">
        <div class="d-flex">
            <span class="material-icons card-icon" style="margin-top: -5px;">₱</span>
            <p id="sales-value" style="margin-left: 5px;">0</p>
        </div>
        <h3>Sales Revenue</h3>
    </div>
    <div class="card" data-type="stock">
        <div class="d-flex">
            <span class="material-icons card-icon">inventory_2</span>
            <p id="stock-value">0%</p>
        </div>
        <h3>Stock Availability</h3>
    </div>
    <div class="card" data-type="turnover">
        <div class="d-flex">
            <span class="material-icons card-icon">loop</span>
            <p id="turnover-value">0%</p>
        </div>
        <h3>Inventory Turnover</h3>
    </div>
</div>

<script>
    window.onload = function() {
        const currentDate = new Date();
        document.getElementById('month').value = currentDate.getMonth() + 1;
        document.getElementById('year').value = currentDate.getFullYear();
        fetchAnalyticsData(currentDate.getMonth() + 1, currentDate.getFullYear());
    };

    function fetchAnalyticsData(month, year) {
        fetch(`../../sql/dashboard/s-cards.php?month=${month}&year=${year}`)
            .then(response => response.json())
            .then(data => {
                animateValue("sales-value", 0, data.salesRevenue, 3000);
                animateValue("stock-value", 0, data.stockAvailability, 3000, "%");
                animateValue("turnover-value", 0, data.inventoryTurnover, 3000, "%");
            })
            .catch(error => console.error('Error fetching analytics data:', error));
    }

    function animateValue(id, start, end, duration, suffix = "") {
        const element = document.getElementById(id);
        const range = end - start;
        const increment = end > start ? 1 : -1;
        const stepTime = Math.abs(Math.floor(duration / range));

        let current = start;
        const timer = setInterval(() => {
            current += increment;
            element.textContent = `${current}${suffix}`;
            if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                element.textContent = `${end}${suffix}`;
                clearInterval(timer);
            }
        }, stepTime);
    }

    document.getElementById('month').addEventListener('change', function() {
        const month = this.value;
        const year = document.getElementById('year').value;
        fetchAnalyticsData(month, year);
    });

    document.getElementById('year').addEventListener('change', function() {
        const year = this.value;
        const month = document.getElementById('month').value;
        fetchAnalyticsData(month, year);
    });
</script>
