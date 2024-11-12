<style>
.top-selling-section {
    display: flex;
    flex-direction: column;
    gap: 5px;
    width: 32%;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid rgba(255, 204, 188, 0.7);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(6px);
    height: 420px;
    transition: box-shadow 0.3s ease-in-out;
    background: transparent;
}

.top-selling-section:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
}

.filter-bar {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #5a5a5a;
    outline: none;
}

.filter-bar select {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid rgba(255, 204, 188, 0.8);
    background: rgba(255, 243, 224, 0.9);
    color: #5a5a5a;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    outline: none;
    font-size: 14px;
}

.tsc {
    height: 100%;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 10px;
}

.top-selling-card {
    padding: 15px;
    border-radius: 10px;
    background: linear-gradient(to bottom right, #fff3e0, #ffe0cc);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 204, 188, 0.7);
    text-align: center;
    transition: box-shadow 0.3s ease;
    display: flex;
    flex-direction: row;
    gap: 15px;
    align-items: center;
    margin-bottom: 10px;
}

.top-selling-card:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.top-selling-image {
    width: 40%;
    border-radius: 8px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    object-fit: cover;
}

.top-selling-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.top-selling-title {
    font-size: 18px;
    font-weight: bold;
    color: #5a5a5a;
    margin-bottom: 4px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.top-selling-stats {
    font-size: 15px;
    color: #757575;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>
<section class="top-selling-section">
    <div class="filter-bar">
        <label for="product-filter">Show Top:</label>
        <select id="product-filter">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>
    </div>
    <div class="tsc" id="products-container">
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function fetchTopSellingProducts(limit) {
            fetch(`../../sql/dashboard/product.php?limit=${limit}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('products-container');
                    container.innerHTML = ''; 

                    data.forEach(product => {
                        const card = document.createElement('div');
                        card.classList.add('top-selling-card');
                        
                        const imageSrc = product.media ? `data:image/jpeg;base64,${product.media}` : '../../src/img/no-image.jpg';
                        
                        card.innerHTML = `
                            <img src="${imageSrc}" alt="Top Selling Item" class="top-selling-image">
                            <div class="top-selling-info">
                                <h4 class="top-selling-title">${product.name}</h4>
                                <div class="top-selling-stats">Sales: ${product.total_sales} ${product.unit}s</div>
                            </div>
                        `;
                        container.appendChild(card);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        }

        fetchTopSellingProducts(10);

        document.getElementById('product-filter').addEventListener('change', function() {
            const selectedValue = this.value;
            fetchTopSellingProducts(selectedValue);
        });
    });
</script>
