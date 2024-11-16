<style>
    #analytics-c {
        padding: 0;
        margin-top: 20px;
        height: 250px;
        width: 100%;
    }

    .wise-decisions-container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        width: 100%;
    }

    .wise-decision-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 48.5%;
        height: 250px;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .wise-decision-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .wise-decision-card h3 {
        margin-bottom: 10px;
    }

    .wise-decision-card p {
        font-size: 16px;
        color: #555;
    }

    .low-stock {
        background-color: #FFEBEE;
        border-left: 5px solid #F44336;
    }

    .most-sold {
        background-color: #E8F5E9;
        border-left: 5px solid #4CAF50;
    }

    .fast-selling {
        background-color: #FFFDE7;
        border-left: 5px solid #FFEB3B;
    }
</style>

<div class="dashboard" id="analytics-c">
    <div class="wise-decisions-container">
        <div class="wise-decision-card low-stock">
            <h4>Voids</h4>
            <ul id="void-products">
            </ul>
        </div>

        <div class="wise-decision-card fast-selling">
            <h4>Low Stock</h4>
            <ul id="low-stock-list">
            </ul>
        </div>
    </div>
</div>
<script>
function fetchAnalyticsDataA() {
    fetch('../../sql/dashboard/analytics2.php')
        .then(response => response.json())
        .then(data => {
            const lowStockList = document.getElementById('low-stock-list');
            lowStockList.innerHTML = '';
            if (data.length > 0) {
                data.forEach(product => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${product.name}  ${product.rqty} ${product.unit}(s)`;
                    lowStockList.appendChild(listItem);
                });
            } else {
                lowStockList.innerHTML = '<li>No products are running low on stock.</li>';
            }
        })
        .catch(error => console.error('Error fetching low stock data:', error));

    fetch('../../sql/dashboard/analytics3.php')
        .then(response => response.json())
        .then(data => {
            const voidProductsList = document.getElementById('void-products');
            voidProductsList.innerHTML = '';
            if (data.length > 0) {
                data.forEach(product => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${product.name}  ${product.qty} ${product.unit}(s)`;
                    voidProductsList.appendChild(listItem);
                });
            } else {
                voidProductsList.innerHTML = '<li>No voided products found.</li>';
            }
        })
        .catch(error => console.error('Error fetching voided product data:', error));
}

fetchAnalyticsDataA();
</script>
