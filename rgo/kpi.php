<style>
 
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

.card[data-type="total-value"] {
    background: #e8f5e9; 
    border-left: 6px solid #66bb6a; 
    color: #388e3c; 
}

.card[data-type="total-value"]:hover {
    background: #dcedc8;
    border-left-color: #43a047; 
}

.card[data-type="total-cost"] {
    background: #e3f2fd;
    border-left: 6px solid #64b5f6;
    color: #1976d2; 
}

.card[data-type="total-cost"]:hover {
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

.summary-cards {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    gap: 20px;
}
</style>

<div class="summary-cards" id="summary-cards">
    <div class="card" data-type="sales">
        <div class="d-flex">
            <span class="material-icons card-icon" style="margin-top: -5px;">₱</span>
            <p id="sales-value" style="margin-left: 5px;">0</p>
        </div>
        <h3>Sales Revenue</h3>
    </div>
    <div class="card" data-type="total-value">
        <div class="d-flex">
            <span class="material-icons card-icon" style="margin-top: -5px;">₱</span>
            <p id="total-value" style="margin-left: 5px;">0</p>
        </div>
        <h3>Total Sales</h3>
    </div>
    <div class="card" data-type="total-cost">
        <div class="d-flex">
            <span class="material-icons card-icon" style="margin-top: -5px;">₱</span>
            <p id="total-cost">0</p>
        </div>
        <h3>Total Cost</h3>
    </div>
</div>

<script>

    function loadKpi() {
        const currentDate = new Date();
        document.getElementById('month').value = currentDate.getMonth() + 1;
        document.getElementById('year').value = currentDate.getFullYear();
        fetchAnalyticsData(currentDate.getMonth() + 1, currentDate.getFullYear());
    }

    function fetchAnalyticsData(month, year) {
        let url = `../../sql/dashboard/s-cards.php?year=${year}`;
        if (month && month !== 'all') {
            url += `&month=${month}`;
        }

        fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log('Fetched Data:', data);  

        animateValue("sales-value", 0, data.salesRevenue, 1000);
        animateValue("total-value", 0, data.salesTotal, 1000);
        animateValue("total-cost", 0, data.totalCost, 1000);
    })
    .catch(error => console.error('Error fetching analytics data:', error));

    }

    function animateValue(id, start, end, duration, suffix = "") {
    const element = document.getElementById(id);
    const range = end - start;
    
    if (end === 0) {
        element.textContent = `${formatNumber(end)}${suffix}`;
        return; 
    }

    const increment = range / (duration / 10);
    let current = start;

    const timer = setInterval(() => {
        current += increment;
        element.textContent = `${formatNumber(Math.floor(current))}`;
        if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
            element.textContent = `${formatNumber(end)}${suffix}`;
            clearInterval(timer);
        }
    }, 10);
}

loadKpi();

</script>
