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
        height: 100%;
        width: 48.5%;
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
            <h4>Low Stock</h4>
            <ul id="low-stock-list">
            </ul>
        </div>

        <div class="wise-decision-card fast-selling">
            <h4>Out of Stock</h4>
            <p id="out-of-stock">
            </p>
        </div>
    </div>
</div>

<script>
function fetchAnalyticsDataA() {
    fetch('../../sql/dashboard/analytics2.php') 
        .then(response => response.json())
        .then(products => {
            const lowStockList = document.getElementById('low-stock-list');
            lowStockList.innerHTML = '';
            const lowStockProducts = products.filter(product => product.rqty <= 10);
            if (lowStockProducts.length > 0) {
                lowStockProducts.forEach(product => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${product.name} - ${product.rqty} ${product.unit}(s) remaining`;
                    lowStockList.appendChild(listItem);
                });
            } else {
                lowStockList.innerHTML = '<li>No products are running low on stock.</li>';
            }

            const outOfStockProducts = products.filter(product => product.rqty === 0);
            const outOfStockElement = document.getElementById('out-of-stock'); 
            if (outOfStockProducts.length > 0) {
                outOfStockElement.textContent = `${outOfStockProducts[0].name} is currently out of stock!`;
            } else {
                outOfStockElement.textContent = "No products are currently out of stock.";
            }
        })
        .catch(error => {
            console.error('Error fetching analytics data:', error);
            document.getElementById('low-stock-list').innerHTML = '<li>No products are running low on stock.</li>';
            document.getElementById('most-sold-product').textContent = 'Unable to fetch most sold product data.';
            document.getElementById('out-of-stock').textContent = 'Unable to fetch out of stock product data.';
        });
}

fetchAnalyticsDataA();


    // function updateHeaderColor() {
    //     const cards = document.querySelectorAll('.wise-decision-card');
        
    //     let headerColor = '#4CAF50'; 
        
    //     cards.forEach(card => {
    //         if (card.classList.contains('low-stock')) {
    //             headerColor = '#F44336'; 
    //         } else if (card.classList.contains('fast-selling')) {
    //             headerColor = '#FFEB3B'; 
    //         }
    //     });

    //     document.querySelector('h3').style.color = headerColor;
    // }

    analyzeInventory();
</script>